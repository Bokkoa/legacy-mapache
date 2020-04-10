# -*- coding: utf-8 -*-
import base64
import json
import os
import logging

from time import gmtime, strftime, sleep

from selenium.webdriver.remote.remote_connection import LOGGER
from selenium import webdriver
from selenium.webdriver.support.ui import Select

from scrapy import Request
from scrapy.spiders import CrawlSpider
from scrapy import Selector
from mapacheCrawler.items import AlumnoItem, HorarioItem


class LoginSpider(CrawlSpider):
    name = 'login'
    carreras=['INNI', 'INCO', 'INBI', 'INCE']

    def __init__(self):
        LOGGER.setLevel(logging.WARNING)
        self.driver = webdriver.Chrome(executable_path='C:\chromedriver.exe')

        self.checkDate()
        self.checkDirs()
        self.loadCredentials(r'C:\Users\Sabal\Desktop\mapache\Crawler\credenciales')


    def start_requests(self):

        return [Request(
                    url= 'http://siiauescolar.siiau.udg.mx/wus/gupprincipal.inicio',
                    callback= self.navigateSIIAU
                    )]
                    

    def navigateSIIAU(self, response):
        self.driver.get(response.url)
        self.driver.switch_to_frame(1)

        self.login()

        self.driver.switch_to.frame('Menu')
        if(self.credentials[2] == 'L'):
            self.driver.find_element_by_xpath('//a[text() = "ALUMNOS"]').click()
            self.driver.find_element_by_xpath('//a[text() = "REGISTRO"]').click()
            self.switchCarrera()
        else:    
            self.driver.find_element_by_xpath('//a[text() = "ALUMNOS SEMS"]').click()
            self.driver.find_element_by_xpath('//a[text() = "REGISTRO"]').click()


        print("Cambiando carrera")

        self.driver.find_element_by_xpath('//a[contains(text(),"Horario")]').click()

        self.driver.switch_to.default_content()
        self.driver.switch_to_frame(1)
        self.driver.switch_to.frame('contenido')

        selector = Selector(text = self.driver.find_element_by_xpath('//table[position()=3]/tbody').get_attribute('innerHTML')).xpath('//tr')

        self.driver.get("http://siiauescolar.siiau.udg.mx/wus/gupprincipal.salir")

        return self.getHorario(selector)


    def saveScreen(self, data, name):
        name = './screenshoots/login/' + name + '_' + self.timeDate + '.png'

        with open(name, 'wb') as f:
            f.write(base64.b64decode(data))


    def loadCredentials(self, filepath):
        credentialFile = open(filepath, 'r')

        buffer = credentialFile.read()

        credentialFile.close()
        data = buffer.split(",")

        username = data[0]
        password = data[1]
        siiautype = data[2]
        user = data[3]
        
        self.credentials = (username, password, siiautype, user)


    def login(self):
        code = self.driver.find_element_by_name('p_codigo_c')
        password = self.driver.find_element_by_name('p_clave_c')

        code.send_keys(self.credentials[0])
        password.send_keys(self.credentials[1])

        self.driver.find_element_by_xpath('//input[@type="submit"]').click()


    def switchCarrera(self):
        carreras = []
        element = self.driver.find_element_by_name('p_carrera')

        selectorCarreras = Selector(text = element.get_attribute('innerHTML')).xpath('//option/text()')
        selectCarreras = Select(element)
        # selectorCarreras = Select("INCO-2015-B")
        print("Esto trae: ")
        print(element.get_attribute('innerHTML'))
        if (element == "BGC-2012-B"):
            # selectCarreras = Select("INCO-2015-B")
            print("Entra")
            # for i in range(0, len(selectorCarreras)):
            #     carreras.append(selectorCarreras[i].extract())

            # for i in range(0, len(carreras)):
            #     for j in range(0, len(self.carreras)):
            #         if(carreras[i].find(self.carreras[j]) != 0):
            #             selectCarreras.select_by_index(i)


    def getHorario(self, selector):
        table = []

        currentRow = 0

        for i in range(2, len(selector)):
            row = selector[i].xpath('td/text() | td/br | td/table/tbody/tr/td/text()').extract()
            if(row[1][0] == 'I' and len(row[1]) == 5):
                table.append(row)
                currentRow = len(table)
                print('primer [' + '] ['.join(row) + ']')
            else:
                table[currentRow-1].extend(row)
                print('segundo [' + '] ['.join(row) + ']')

        for row in table:
            print(row)
            item = AlumnoItem()

            numHorario = int(len(row) / 17)

            item['nrc'] = row[0]
            item['cve'] = row[1]
            item['materia'] = row[2]
            item['seccion'] = row[3]
            item['creditos'] = row[4]

            item['dias'] = ''

            for i in range(0, numHorario):
                for j in range(6 + (17*i), 12 + (17*i)):
                    if(row[j] != '<br>'):
                        item['dias'] += row[j]
                item['dias'] += '|'

            item['edificio'] = ''
            item['aula'] = ''

            for i in range(0, numHorario):
                item['horario'] = row[5 + (17*i)]
                item['edificio'] += row[12 + (17*i)][3]
                item['aula'] += row[13 + (17*i)]

            item['profesor'] = row[14]
            item['fechaInicia'] = row[15]
            item['fechaFinal'] = row[16]

            yield item


    def checkDirs(self):
        if not os.path.exists('screenshoots/login'):
            os.makedirs('screenshoots/login')

        if not os.path.exists('data/login'):
            os.makedirs('data/login')


    def checkDate(self):
        self.timeDate = strftime("%Y_%m_%d_%H_%M_%S", gmtime())
