# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# https://doc.scrapy.org/en/latest/topics/items.html

import scrapy

from scrapy import Field

class HorarioItem(scrapy.Item):
    titulos = Field()
    horarios = Field()

class AlumnoItem(scrapy.Item):
    nrc = Field()
    cve = Field()
    materia = Field()
    seccion = Field()
    creditos = Field()
    horario = Field()
    dias = Field()
    edificio = Field()
    aula = Field()
    profesor = Field()
    fechaInicia = Field()
    fechaFinal = Field()
