<?php
require __DIR__ . '/vendor/autoload.php';
require 'class-GalaxyApps.php';

$galaxyApps = new GalaxyApps();

?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="charts-wrapper">
	<div class="chart-item">
		<canvas id="average_ratings_chart"></canvas>
	</div>
	<div class="chart-item">
		<canvas id="contentRatingCountsChart"></canvas>
	</div>
	<div class="chart-item">
		<canvas id="freeAndPaidCountsChart"></canvas>
	</div>
	<div class="chart-item">
		<canvas id="topPricedAppsChart"></canvas>
	</div>
	<div class="chart-item">
		<canvas id="topRatedAppsChart"></canvas>
	</div>
	<div class="chart-item">
		<canvas id="topReviewedAppsChart"></canvas>
	</div>
	<div class="chart-item">
		<canvas id="topMaxSizeAppsChart"></canvas>
	</div>
</div>
<script type="text/javascript">
	let averageRatings = JSON.parse('<?php echo json_encode(GalaxyApps::get_all_categories_average_rating()); ?>');
	let avtgratingchart = document.getElementById('average_ratings_chart');
	let averageRatingsChart = new Chart(avtgratingchart, {
		type: 'bar',
		data: {
			labels: Object.keys(averageRatings),
			datasets: [{
				label: 'Average Ratings',
				data: Object.values(averageRatings),
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)',
				],
				borderWidth: 1,
				width: 800,
			}]
		}
	});

	let contentRatingCounts = JSON.parse('<?php echo json_encode(GalaxyApps::get_content_rating_overall_count()); ?>');
	let contentRating = document.getElementById('contentRatingCountsChart');
	let contentRatingCountsChart = new Chart(contentRating, {
		type: 'bar',
		data: {
			labels: Object.keys(contentRatingCounts),
			datasets: [{
				label: 'Content Rating Counts',
				data: Object.values(contentRatingCounts),
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				],
				borderWidth: 1
			}]
		}
	});

	let freeAndPaidCounts = JSON.parse('<?php echo json_encode(GalaxyApps::get_free_and_paid_overall_count()); ?>');
	let freeandpaid = document.getElementById('freeAndPaidCountsChart');
	let freeAndPaidCountsChart = new Chart(freeandpaid, {
		type: 'pie',
		data: {
			labels: Object.keys(freeAndPaidCounts),
			datasets: [{
				label: 'Free and Paid Counts',
				data: Object.values(freeAndPaidCounts),
				backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(192, 75, 75, 0.2)'],
				borderColor: ['rgba(75, 192, 192, 1)', 'rgba(192, 75, 75, 1)'],
				borderWidth: 1
			}]
		}
	});

	let topPricedApps = JSON.parse(`<?php echo json_encode(GalaxyApps::get_top_price_apps(10)); ?>`);
	let toppriced = document.getElementById('topPricedAppsChart');
	let topPricedAppsChart = new Chart(toppriced, {
		type: 'doughnut',
		data: {
			labels: Object.keys(topPricedApps),
			datasets: [{
				label: 'Top Priced Apps',
				data: Object.values(topPricedApps),
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				],
				borderWidth: 1
			}]
		},
		options: {
			plugins: {
				legend: {
					position: 'right'
				}
			}
		}
	});

	let topRatedApps = JSON.parse('<?php echo json_encode(GalaxyApps::get_top_rating_apps(10)); ?>');
	let topratedapps = document.getElementById('topRatedAppsChart');
	let topRatedAppsChart = new Chart(topratedapps, {
		type: 'polarArea',
		data: {
			labels: Object.keys(topRatedApps),
			datasets: [{
				label: 'Top Rated Apps',
				data: Object.values(topRatedApps),
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				],
			}]
		},
		options: {
			plugins: {
				legend: {
					position: 'right'
				}
			}
		}
	});

	let topReviewedApps = JSON.parse('<?php echo json_encode(GalaxyApps::get_top_reviewed_apps(10)); ?>');
	let topreviewed = document.getElementById('topReviewedAppsChart');
	let topReviewedAppsChart = new Chart(topreviewed, {
		type: 'radar',
		data: {
			labels: Object.keys(topReviewedApps),
			datasets: [{
				label: 'Top Reviewed Apps',
				data: Object.values(topReviewedApps),
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		}
	});

	let topMaxSizeApps = JSON.parse('<?php echo json_encode(GalaxyApps::get_top_maxsize_apps(10)); ?>');
	let topMaxSize = document.getElementById('topMaxSizeAppsChart');
	let topMaxSizeAppsChart = new Chart(topMaxSize, {
		type: 'bar',
		data: {
			labels: Object.keys(topMaxSizeApps),
			datasets: [{
				label: 'Top Max Size Apps',
				data: Object.values(topMaxSizeApps),
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				],
			}]
		}
	});
</script>
<style>
	.chart-item{
		width: 48%;
		height: 400px;
	}
	.charts-wrapper{
		display: flex;
		flex-wrap: wrap;
		max-width: 90vw;
		margin: 0 auto;
		justify-content: space-between;
	}
</style>
</body>
</html>