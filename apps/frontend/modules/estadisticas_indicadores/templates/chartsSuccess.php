<?php slot('title', 'SAF .::Estadísticas e Indicadores::.') ?>
<?php slot('menu_activo_estadisticas_indicadores', 'active') ?>

<?php use_javascript('highcharts.js') ?>
<?php use_javascript('exporting.js') ?>

<?php include_component('estadisticas_indicadores', 'indicadorDeAsistencias') ?>
<?php include_component('estadisticas_indicadores', 'indicadorDeCompromisos') ?>

<div id="indicador_de_asistencia" style="width:90%; height:400px;"></div>

<br><hr><br>

<div id="indicador_de_compromisos" style="width:90%; height:400px;"></div>