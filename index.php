<?php

if (($open = fopen("app.csv", "r")) !== false) {
	while (($data = fgetcsv($open, 1000, ",")) !== false) {
		$array[] = $data;
	}

	fclose($open);
}
echo "<pre>";

// To display array data
var_dump($array);
echo "</pre>";
?>