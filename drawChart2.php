<?php 
require_once("RandomClass.php");

$reg = new RanndomTable();

$rawdata = $reg->getInfoRegistro();

$result = array();
foreach ($rawdata as $k) {
	//print_r(gettype(is_bool($k[2])));
	$repeat = false;
	for ($i=0; $i < count($result); $i++) {

		if ($result[$i]['categoria'] == $k['categoria'] ) {

			$result[$i]['costo'] += $k['costo'];
			$repeat = true;
			break;
		}
	}
	if ($repeat == false) {
		$result[] = array('cat' => $k['categoria'], 'monto'  => $k['costo']);
	}
}
 ?>



<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>

<style type="text/css">
	#container {
    min-width: 300px;
    max-width: 800px;
    height: 500px;
    margin: 1em auto;
}
</style>

<div id="container" style="width:100%; height:400px;"></div>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function () {
    var myChart = Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: '$ del Dia'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Monto $'
            }
        },
        series: [{
            name: 'Monto',
            colorByPoint: true,
            data: [
            
            	<?php 
            		foreach ($result as $key => $val) {
            			echo "{";
            			?>
            			
            			name: <?php echo '"'.$val['cat'].'"'?>,
            			y: <?=$val['monto']?>,


            			<?php
            			echo "},";
            		}
            	 ?>
            	
            
            ]
            
            /*data: [
            {
            	name: "catoria1",
            	y: 34,
            },
            {
            	name: "catoria2",
            	y: 20,
            },
            {
            	name: "catoria3",
            	y: 50,
            },
            ]*/
        }]
    });
});
</script>
