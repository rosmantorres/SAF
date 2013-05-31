<?php

/**
 * Clase para las pruebas unitarias de los metodos de la clase Evento
 * Ejecutamos esta prueba desde la consola de la siguiente manera:
 * $ php test/unit/EventoUnit.php
 * $ php symfony test:unit Evento
 */
require_once dirname(__FILE__) . '/../bootstrap/unit.php';
require_once dirname(__FILE__) . '/../../apps/frontend/lib/Evento.class.php';

// Cantidad de pruebas unitarias
$t = new lime_test(10);

// Pruebas unitarias
$t->pass('Comenzaremos las pruebas para la clase Evento');

// Pruebas para el método ::getTipoFalla()
$t->is(Evento::getTipoFalla(100), 'IMPREVISTA', '::getTipoFalla() Falla IMPREVISTA');
$t->is(Evento::getTipoFalla(502), 'CAUSA-500', '::getTipoFalla() Falla IMPREVISTA CAUSA 500');
$t->isnt(Evento::getTipoFalla(903), 'IMPREVISTA', '::getTipoFalla() No es una Falla IMPREVISTA');

// Pruebas para el método ::getRegion()
$t->is(Evento::getRegion(1), 'Este', '::getRegion() Este es la region del distrito 1');
$t->isnt(Evento::getRegion(1), 'Oeste', '::getRegion() Oeste no es la region del distrito 1');
$t->is(Evento::getRegion(6), '', '::getRegion() No existe region para el distrito 6');

// Pruebas para el método ::getClimatologia()
$t->is(Evento::getClimatologia(100), '', '::getClimatologia() No hay climatologia para este cod_causa');
$t->isnt(Evento::getClimatologia(1), 'Lluvia', '::getClimatologia() El cod_causa 1 no es Lluvia');
$t->is(Evento::getClimatologia(2), 'Lluvia', '::getClimatologia() El cod_causa 2 es Lluvia');