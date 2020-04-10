# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://doc.scrapy.org/en/latest/topics/item-pipeline.html
 
import json, csv
try:
    import pymysql
    pymysql.install_as_MySQLdb()
except ImportError:
    pass

import MySQLdb
from time import gmtime, strftime

class MapachecrawlerPipeline(object):
        def open_spider(self, spider):
            self.db = MySQLdb.connect(host='localhost', port= 3306, user= 'root', passwd= '',
                                    db= 'mapache', charset="utf8",
                                    use_unicode=True)

            self.cursor = self.db.cursor()


        def process_item(self, item, spider):
            f= open(r'C:\Users\Sabal\Desktop\mapache\crawler\okami.txt', "w+")
            print("insertando en la base de datos")

            credentialFile = open(r'C:\Users\Sabal\Desktop\mapache\Crawler\credenciales', 'r')
            buffer = credentialFile.read()
            credentialFile.close()
            print("Utilizando la credencial")
            data = buffer.split(",")

            username = data[0]
            # password = data[1]
            # siiautype = data[2]
            user = data[3]
            # subjects = []
            # for i in item:
            #     print(i)
            
            debug = ""
            try:

                f.write(item['nrc']+'\n'+item['cve']+'\n'+item['materia']+'\n'+item['seccion']+'\n'+item['creditos']+'\n'+item['horario']+'\n'+item['dias']+'\n'+item['edificio']+'\n'+item['aula']+'\n'+item['profesor']+'\n'+item['fechaInicia']+'\n'+item['fechaFinal']+'\n')
                #GLOBAL VARIABLES
                subject_id = 0
                classroom_id = 0
                user_id = 0
                
                debug = "module"
                #LOOKIN FOR THE MODULE
                look_module =  ("INSERT INTO modules (Module_Name, Coordinates, Directions, Image_Path, created_at ) SELECT * FROM (SELECT %s, 'miau', '0', 'null', NOW()) AS tmp WHERE NOT EXISTS ( SELECT Module_Name FROM modules WHERE Module_Name = %s) LIMIT 1;")
                data = ( item['edificio'].encode('utf-8'), item['edificio'].encode('utf-8'))
                self.cursor.execute(look_module, data)
                self.db.commit()


                debug = "subject"
                # INSERTING ON SUBJECTS
                insert_subject = ("INSERT INTO subjects (NRC, Name, Schedule, FK_Module, created_at ) SELECT * FROM (SELECT %s, %s, %s, %s, NOW()) AS tmp WHERE NOT EXISTS ( SELECT name FROM subjects WHERE NRC = %s) LIMIT 1;")
                data = (item['nrc'].encode('utf-8'), item['materia'].encode('utf-8'), item['horario'].encode('utf-8'), item['edificio'].encode('utf-8'), item['nrc'].encode('utf-8'))
                self.cursor.execute(insert_subject, data)

                if(self.cursor.rowcount > 0):
                    subject_id = self.cursor.lastrowid
                else:
                    select_id = ("SELECT Subject_ID FROM subjects WHERE nrc = %s")
                    data = item['nrc'].encode('utf-8')
                    self.cursor.execute(select_id, [data])
                    subject_id = self.cursor.fetchall()
                self.db.commit()


                debug = "classroom"
                # INSERTING ON CLASSROOM
                insert_classroom = ("INSERT INTO classrooms (Name) SELECT * FROM ( SELECT %s) AS tmp WHERE NOT EXISTS ( SELECT name FROM classrooms WHERE Name = %s) LIMIT 1;")
                data = (item['aula'].encode('utf-8'), item['aula'].encode('utf-8'))
                self.cursor.execute(insert_classroom, data)
                if(self.cursor.rowcount > 0):
                    classroom_id = self.cursor.lastrowid
                else:
                    select_id = ("SELECT Classroom_ID FROM classrooms WHERE Name = %s")
                    data = item['aula'].encode('utf-8')
                    self.cursor.execute(select_id, [data])
                    classroom_id = self.cursor.fetchall()
                self.db.commit()


                debug = "sub class"
                #LINK SUBJECTS AND CLASSROOMS
                link_sub_class = ("INSERT INTO subject_classroom (FK_Classroom, FK_Subject) SELECT * FROM ( SELECT %s AS cid, %s AS sid) AS tmp WHERE NOT EXISTS ( SELECT SC_ID FROM subject_classroom WHERE FK_Classroom = %s AND FK_Subject = %s) LIMIT 1;")
                if(isinstance(classroom_id, int) or isinstance(subject_id, int)):
                    data = (classroom_id, subject_id, classroom_id, subject_id)
                else:
                    data = (classroom_id[0], subject_id[0], classroom_id[0], subject_id[0])
                self.cursor.execute(link_sub_class, data)
                

                set_siiau = ("UPDATE users SET siiaucode = %s WHERE username = %s")
                data = (username, user)
                self.cursor.execute(set_siiau, data)

                get_id_siiau = ("SELECT User_ID FROM users WHERE username = %s")
                data = user
                self.cursor.execute(get_id_siiau, [data])
                user_id = self.cursor.fetchall()
                self.db.commit()

                
                debug = "sub users"

                #LINK SUBJECTS AND USERS
                link_user_subject = ("INSERT INTO user_subject (FK_User, FK_Subject) SELECT * FROM ( SELECT %s AS uid , %s AS sid) AS tmp WHERE NOT EXISTS ( SELECT US_ID FROM user_subject WHERE FK_User = %s AND FK_Subject = %s) LIMIT 1;")
                if(isinstance(user_id, int) or isinstance(subject_id, int)):
                    data = (user_id, subject_id, user_id, subject_id)                
                else:                
                    data = (user_id[0], subject_id[0], user_id[0], subject_id[0])
                self.cursor.execute(link_user_subject, data)
                
            
                self.db.commit()
                result = open(r'C:\Users\Sabal\Desktop\mapache\Crawler\result', 'w')
                result.write("SUCCESS")
                result.close()

            except (MySQLdb.Error, MySQLdb.Warning) as e:

                print("+=====+ \n|ERROR| \n +=====+ \n")
                print("On"+debug)
                print(e)
                result = open(r'C:\Users\Sabal\Desktop\mapache\Crawler\result', 'w')
                result.write("FAIL")
                result.close()
                

            return item
