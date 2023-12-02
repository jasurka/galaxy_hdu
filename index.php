<?php
require __DIR__ . '/vendor/autoload.php';
require 'class-GalaxyApps.php';

$galaxy_apps = new GalaxyApps();

?>
<div>
	<canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	const ctx = document.getElementById('myChart');
	let apps = <?php $galaxy_apps::get_apps(); ?>;
	let categories = [];
	apps.forEach( function( app ) {
		categories.push(app.Category);
	});
	new Chart(
		ctx,
		{
			type: 'bar',
			data: {
				labels: [...new Set(categories)],
				datasets: [{
					label: 'Category',
					data: apps.forEach((app) => app.Rating)
				}]
			},
	});
</script>