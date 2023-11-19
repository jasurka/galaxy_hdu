<?php
require __DIR__ . '/vendor/autoload.php';

use League\Csv\Reader;

$reader = Reader::createFromPath('app.csv', 'r');
$reader->setHeaderOffset(0);
$records = $reader->getRecords();
echo '<pre>';


foreach ($records as $offset => $record) {
	var_dump($record);
}
echo '</pre>';