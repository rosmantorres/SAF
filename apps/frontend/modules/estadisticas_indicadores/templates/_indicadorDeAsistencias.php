<script type="text/javascript">

  var categorias = new Array(<?php echo Doctrine_Core::getTable('SAF_ASISTENCIA')->getCategoriasDelIndicadorAsistencia($indicador); ?>);
  var data_series = new Array(<?php echo Doctrine_Core::getTable('SAF_ASISTENCIA')->getSeriesDelIndicadorAsistencia($indicador); ?>);
  var data_series2 = new Array();
  for (var i = 0; i < data_series.length; i++)
  {
    data_series2[i] = data_series[i] / <?php echo $num_asistencias ?> * 100;
  }

  $(document).ready(function() {
    $('#indicador_de_asistencia').highcharts({
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