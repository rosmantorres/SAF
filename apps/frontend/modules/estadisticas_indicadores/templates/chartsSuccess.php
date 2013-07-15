<?php use_javascript('highcharts.js') ?>
<?php use_javascript('exporting.js') ?>
<?php slot('title', 'SAF .::Estadísticas e Indicadores::.') ?>
<?php slot('menu_activo_estadisticas_indicadores', 'active') ?>

<script type="text/javascript">

  var categorias = new Array(<?php echo Doctrine_Core::getTable('SAF_ASISTENCIA')->getCategoriasDelIndicadorAsistencia($indicador); ?>);
  var data_series = new Array(<?php echo Doctrine_Core::getTable('SAF_ASISTENCIA')->getSeriesDelIndicadorAsistencia($indicador); ?>);
  var data_series2 = new Array();
  for (var i = 0; i < data_series.length; i++)
  {
    data_series2[i] = data_series[i] / <?php echo $num_asistencias ?> * 100;
  }

  $(document).ready(function() {
    $('#container').highcharts({
      chart: {
        marginTop: 70,
      },
      title: {
        text: 'Indicador de Asistencias (2013)'
      },
      xAxis: [{
          categories: categorias,
          labels: {
            rotation: -90,
            align: 'right',
            style: {
              fontSize: '10px',
              fontFamily: 'Verdana, sans-serif'
            }
          }
        }],
      yAxis: [{// Primary yAxis 
          min: 0,
          tickInterval: 20,
          labels: {
            format: '{value}%',
            style: {
              color: 'RED'
            }
          },
          title: {
            text: '% De Asistencias',
            style: {
              color: 'BLACK'
            }
          }
        }, {// Secondary yAxis 
          min: 0,
          tickInterval: <?php echo $scala; ?>,
          title: {
            text: 'Número de asistencias',
            style: {
              color: 'BLACK'
            }
          },
          labels: {
            style: {
              color: '#4572A7'
            }
          },
          opposite: true
        }],
      legend: {
        align: 'center',
        y: 25,
        verticalAlign: 'top',
        floating: true,
      },
      plotOptions: {
        line: {
          dataLabels: {
            enabled: true
          }
        }
      },
      series: [{
          name: 'Control Asistencia',
          color: '#4572A7',
          type: 'column',
          yAxis: 1,
          data: data_series,
          dataLabels: {
            enabled: true,
            rotation: 0,
            color: '#FFFFFF',
            align: 'center',
            y: 20,
          }
        }, {
          name: 'Porcentaje Asistencia',
          color: 'RED',
          type: 'spline',
          data: data_series2,
          dataLabels: {
            enabled: true,
            formatter: function() {
              return this.y + '%';
            }
          },
          tooltip: {
            valueSuffix: '%'
          }
        }]
    });
  });
</script>

<script type="text/javascript">
  
  var categorias = new Array(<?php echo Doctrine_Core::getTable('SAF_COMP_UE')->getCategoriasDelIndicadorDeCompromisos($unidades); ?>);
  var data_series_pendientes = new Array(<?php echo Doctrine_Core::getTable('SAF_COMP_UE')->getSeriesDelIndicadorDeCompromisos($unidades,'PENDIENTE'); ?>);
  var data_series_terminados = new Array(<?php echo Doctrine_Core::getTable('SAF_COMP_UE')->getSeriesDelIndicadorDeCompromisos($unidades,'TERMINADO'); ?>);
  
  $(document).ready(function() {
    $('#container2').highcharts({
      chart: {
        type: 'column',
        marginTop: 70
      },
      title: {
        text: 'Indicador de Compromisos'
      },
      xAxis: {
        categories: categorias,
        labels: {
          rotation: -90,
          align: 'right',
          style: {
            fontSize: '11px',
            fontFamily: 'Verdana, sans-serif'
          }
        }
      },
      yAxis: {
        title: {
          text: 'Números de casos',
          style: {
            color: 'black'
          }
        },
        stackLabels: {
          enabled: true,
          style: {
            fontWeight: 'bold',
            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
          }
        }
      },
      legend: {
        align: 'center',
        y: 25,
        verticalAlign: 'top',
        floating: true,
      },
      tooltip: {
        formatter: function() {
          return '<b>' + this.x + '</b><br/>' +
                  this.series.name + ': ' + this.y + '<br/>' +
                  'Total: ' + this.point.stackTotal;
        }
      },
      plotOptions: {
        column: {
          stacking: 'normal',
          dataLabels: {
            enabled: true,
            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
          }
        }
      },
      series: [{
          color: '#a9302a',
          name: 'Pendientes',
          data: data_series_pendientes,
          dataLabels: {
            align: 'center',
            x: 6,
            y: -5
          }
        }, {
          color: '#002a80',
          name: 'Terminados',
          data: data_series_terminados,
          dataLabels: {
            align: 'center',
            x: 6,
            y: 4
          }
        }]
    });
  });

</script>

<div id="container" style="width:90%; height:400px;"></div>
<br><hr><br>
<div id="container2" style="width:90%; height:400px;"></div>