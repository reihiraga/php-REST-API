<div id='chart_div'></div>
<script>
google.charts.load('current', {'packages':['line', 'corechart']}); 
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
	var button = document.getElementById('change-chart'); 
	var chartDiv = document.getElementById('chart_div'); 
	var data = new google.visualization.DataTable(); 
	data.addColumn('string', 'time'); 
	data.addColumn('number', 'jarak');
	data.addRows([
		["1",10], ["2",7], ["3",8], ["4",5], ["5",3], ["6",1], 
		<?php
			include 'connect.php';
			//Count data
			$query =  "Select count(id) as baris from data";
			$hitung=mysqli_query($connect,$query);
			$data=mysqli_fetch_array($hitung);
			$jml_baris=$data['baris'];
			//showing data 
			$query =  "Select* from data where id<='$jml_baris' and id>'".($jml_baris-20)."'
			ORDER By id ASC";
			$tampil=mysqli_query($connect,$query);
			while ($data = mysqli_fetch_array ($tampil)){
				echo "['".$data['id']."', ".$data['temperature']."],";
			}
		?>
	]);
	var materialOptions = {
		chart: {  title: 'Temperature' }, 
		colors: ['#e57206'],
		width: 'auto',
		height: 420,
		curveType:'function',
	};
	function drawMaterialChart() {
		var materialChart = new google.charts.Line(chartDiv); 
		materialChart.draw(data, materialOptions);
	} 
	drawMaterialChart();
} 
</script>