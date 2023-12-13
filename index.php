<?php
require __DIR__ . '/vendor/autoload.php';
require 'class-GalaxyApps.php';

$galaxy_apps = new GalaxyApps();

?>
<div class="wrapper" style="max-width: 800px">
	<canvas id="firstChart" width="800" height="500" aria-label="First chart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	// Following scripts are for demonstration
	const ctx = document.getElementById('firstChart');
	let apps = <?php $galaxy_apps::get_apps(); ?>;
	let categories = [];
	let ratings = [];
	apps.forEach( function( app ) {
		categories.push(app.Category);
		ratings.push(app.Rating);
	});

	categories = removeDuplicates(categories)
	ratings = removeDuplicates(ratings)

	new Chart(
		ctx,
		{
			type: 'pie',
			data: {
				labels: categories,
				datasets: [{
					label: 'Average Rating',
					data: ratings,
				},]
			},
	});

	function removeDuplicates( data ) {
		let unique = [];
		data.forEach( function( element ) {
			if( !unique.includes(element) ) {
				unique.push(element)
			}
		});
		return unique;
	}
</script>