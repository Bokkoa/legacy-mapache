# -*- coding: utf-8 -*-
import base64
import json
import os

from time import gmtime, strftime

from scrapy.spiders import CrawlSpider
from scrapy_splash import SplashFormRequest, SplashRequest
from scrapy import Selector

from mapacheCrawler.items import AlumnoItem, HorarioItem


class HorarioSpider(CrawlSpider):
    name = 'horario'

    args={
            'html': 1,
            'png': 1,
        }

    def __init__(self):
        self.checkDate()
        self.checkDirs()

    def start_requests(self):
        script = '''
            treat = require("treat")

            function main(splash)
                assert(splash:go{
                    splash.args.url,
                    headers=splash.args.headers,
                    http_method=splash.args.http_method,
                    body=splash.args.body,
                })

                local resultado = {}
                local valores = {ciclop = '201820', cup = 'D', ordenp = '1', mostrarp = '100',}
                local forma = splash:select('form[name=frm_consulta_oferta]')

                assert(forma:fill(valores))

                table.insert(resultado, {
                    png = splash:png(),
                    url = splash:url(),
                    html = splash:html(),
                })

                assert(forma:submit())
                assert(splash:wait(2))

                table.insert(resultado, {
                        png = splash:png(),
                        url = splash:url(),
                        html = splash:html(),
                    })

                local proximo = splash:select('form[name=frm_consulta_oferta3]')

                while(proximo ~= nil)
                do
                    assert(proximo:submit())
                    assert(splash:wait(3))

                    table.insert(resultado, {
                        png = splash:png(),
                        url = splash:url(),
                        html = splash:html(),
                    })

                    proximo = splash:select('form[name=frm_consulta_oferta3]')
                end

                treat.as_array(resultado)

            return resultado
            end
            '''

        return [SplashRequest(
                    url= 'http://consulta.siiau.udg.mx/wco/sspseca.forma_consulta',
                    callback= self.leerHorario,
                    endpoint='execute',
                    args={'lua_source': script,'timeout': 3600}
                    )]


    def leerHorario(self, response):
        print(len(response.data))

        for i in range(0, len(response.data)):
            self.saveScreen(response.data[i]['png'],str(i))

        item = HorarioItem()

        tabla = []

        for i in range(1, len(response.data)):
            selector = Selector(text = response.data[i]['html'])
            temp = selector.xpath('body/table[1]/tbody/tr')

            for i in range(2, len(temp)):
                tabla.append(self.giveFormat(temp[i].xpath('td/text() | td/a/text() | td/table/tbody/tr/td/text()').extract()))

        item['horarios'] = tabla

        yield item

    def giveFormat(self, horario):

        numeroDeCampos = len(horario)

        if numeroDeCampos == 14:
            horario.pop(7)
        elif numeroDeCampos == 17:
            horario.pop(7)
            horario.pop(13)
        elif numeroDeCampos == 29:
            horario.pop(7)
            horario.pop(25)
            horario[12] += '|' + horario.pop(18) + '|' + horario.pop(23)
            horario[11] += '|' + horario.pop(17) + '|' + horario.pop(21)
            horario[10] += '|' + horario.pop(16) + '|' + horario.pop(19)
            horario[9] += '|' + horario.pop(15) + '|' + horario.pop(17)
            horario[8] += '|' + horario.pop(14) + '|' + horario.pop(15)
            horario[7] = int(str(horario[7]) + '0' + str(horario.pop(13)) + '0' + str(horario.pop(13)))
        elif numeroDeCampos == 23:
            horario.pop(7)
            horario.pop(19)
            horario[12] += '|' + horario.pop(18)
            horario[11] += '|' + horario.pop(17)
            horario[10] += '|' + horario.pop(16)
            horario[9] += '|' + horario.pop(15)
            horario[8] += '|' + horario.pop(14)
            horario[7] = int(str(horario[7]) + '0' + str(horario.pop(13)))
        elif numeroDeCampos == 11:
            horario.pop(7)
            horario.pop(7)
            horario.insert(7, 0)
            horario.insert(8, 'N/A')
            horario.insert(9, 'N/A')
            horario.insert(10, 'N/A')
            horario.insert(11, 'N/A')
            horario.insert(12, 'N/A')

        return horario

    def saveScreen(self, data, name):
        name = './screenshoots/' + name + '_' + self.timeDate + '.png'

        with open(name, 'wb') as f:
            f.write(base64.b64decode(data))

    def checkDirs(self):
        if not os.path.exists('screenshoots'):
            os.makedirs('screenshoots')

        if not os.path.exists('data'):
            os.makedirs('data')

    def checkDate(self):
        self.timeDate = strftime("%Y_%m_%d_%H_%M_%S", gmtime())
