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
$t = new lime_test(4);

// Pruebas unitarias
$t->pass('Esta prueba siempre pasa');
$t->is(Evento::getRegion(1), 'Este', '::getRegion() Este es la region del distrito 1');
$t->isnt(Evento::getRegion(1), 'Oeste', '::getRegion() Oeste no es la region del distrito 1');
$t->is(Evento::getRegion(6), '', '::getRegion() No existe region para el distrito 6');