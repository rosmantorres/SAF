<script type="text/javascript">

  var categorias = new Array(<?php echo Doctrine_Core::getTable('SAF_COMP_UE')->getCategoriasDelIndicadorDeCompromisos($unidades); ?>);
  var data_series_pendientes = new Array(<?php echo Doctrine_Core::getTable('SAF_COMP_UE')->getSeriesDelIndicadorDeCompromisos($unidades, 'PENDIENTE'); ?>);
  var data_series_terminados = new Array(<?php echo Doctrine_Core::getTable('SAF_COMP_UE')->getSeriesDelIndicadorDeCompromisos($unidades, 'TERMINADO'); ?>);
  var data_series_confirmacion = new Array(<?php echo Doctrine_Core::getTable('SAF_COMP_UE')->getSeriesDelIndicadorDeCompromisos($unidades, 'CONFIRMACION'); ?>);

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
        }
      },
      legend: {
        align: 'center',
        y: 25,
        verticalAlign: 'top',
        floating: true,
      },
      tooltip: {
        headerFormat: '<b><u span style="font-size:12px">{point.key}</u><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} </b></td></tr></b>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
      },
      plotOptions: {
        column: {
          pointWidth: 20,
          borderColor: '#000000',
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
            y: 60
          }
        }, {
          color: '#002a80',
          name: 'Terminados',
          data: data_series_terminados,
          dataLabels: {
            align: 'center',
            y: 60
          }
        }, {
          color: '#cccccc',
          name: 'Por Confirmar (IO)',
          data: data_series_confirmacion,
          dataLabels: {
            align: 'center',
            y: 60
          }
        }]
    });
  });

</script>