<?php 
require_once("RandomClass.php");

//creamos un objeto de la clase randomTable
$rand = new RanndomTable();
//insertamds un valor aleatorio
@$rand->insertRandom();
$rawdata = $rand->getAllinfo();

//Creamos dos arrays para almacenar el tiempo y el valor numerico
$valoresArray;
$timeArray;
//en un bucle for aobtenemos en cada iteracion el valor numerico y 
//el TIMESTAMP del tiempo y lo almacenamos en los arrays
for ($i = 0; $i < count($rawdata); $i++) { 
	$valoresArray[$i] = $rawdata[$i][1];
	//obtenemos el timestamp
	$time= $rawdata[$i][2];
	$date = new DateTime($time);
	//Almacenamos el timestamp en el array
	$timeArray[$i] = $date->getTimestamp()*1000;
}

?>

<script src="https://code.jquery.com/jquery.js"></script>
    <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<style type="text/css">
	#contenedor {
    min-width: 300px;
    max-width: 800px;
    height: 500px;
    margin: 1em auto;
}
</style>
<div id="contenedor">
	
</div>

<script type="text/javascript">
	
	chartCPU = Highcharts.StockChart({
		chart: {
			renderTo: 'contenedor',
			type: 'column'
		},
		rangeSelector : {
			enabled: false
		},
		title: {
			text: 'Grafica'
		},
		xAxis: {
			type: 'datetime'
		},
		yAxis: {
			minPadding: 0.2,
			maxPadding: 0.2,
			title: {
				text: 'Valores',
				margin: 10
			},
		},
		series: [{
			name: 'Valor',
			data: (function(){
				//generate an array of random data
				var data = [];
				<?php 
					for ($i=0; $i <count($rawdata); $i++) { 
					?>
					data.push([<?php echo $timeArray[$i];?>,<?php echo $valoresArray[$i];?>])
					<?php
					}
				 ?>
				 return data;
			})()
		}],
		credits: {
			enabled: false
		}
	});
</script>
