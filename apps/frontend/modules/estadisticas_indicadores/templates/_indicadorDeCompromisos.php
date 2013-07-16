<script type="text/javascript">
  
  var categorias = new Array(<?php echo Doctrine_Core::getTable('SAF_COMP_UE')->getCategoriasDelIndicadorDeCompromisos($unidades); ?>);
  var data_series_pendientes = new Array(<?php echo Doctrine_Core::getTable('SAF_COMP_UE')->getSeriesDelIndicadorDeCompromisos($unidades,'PENDIENTE'); ?>);
  var data_series_terminados = new Array(<?php echo Doctrine_Core::getTable('SAF_COMP_UE')->getSeriesDelIndicadorDeCompromisos($unidades,'TERMINADO'); ?>);
  
  $(document).ready(function() {
    $('#indicador_de_compromisos').highcharts({
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