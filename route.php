<?php

use League\Csv\Reader;
$routes = FastRoute\simpleDispatcher( function ( FastRoute\RouteCollector $r ) {
		$r->addRoute('GET', '/', 'front_page');
		$r->addRoute('GET', '/api/apps', 'get_apps');
		$r->addRoute('GET', '/api/apps/category_{name}', 'get_apps_by_category');
	}
);
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
	$uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $routes->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
	case FastRoute\Dispatcher::NOT_FOUND:
		// ... 404 Not Found
		break;
	case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
		$allowedMethods = $routeInfo[1];
		// ... 405 Method Not Allowed
		break;
	case FastRoute\Dispatcher::FOUND:
		$handler = $routeInfo[1];
		$vars = $routeInfo[2];
		// ... call $handler with $vars
		$handler( $vars );
		break;
}

function front_page() {
	include 'front.php';
}

function get_apps_array() {
	$apps = array();
	$reader = Reader::createFromPath('app.csv', 'r');
	$reader->setHeaderOffset(0);
	$records = $reader->getRecords();

	foreach ( $records as $record ) {
		$apps[] = $record;
	}
	return $apps;
}
function get_apps() {
	$apps = array();
	$records = get_apps_array();

	foreach ( $records as $record ) {
		$apps[] = $record;
	}
	echo json_encode( $apps );
}

function get_apps_by_category( $category ) {
	$category_apps = array();
	$records = get_apps_array();
	foreach ( $records as $record ) {
		if ( $record['Category'] === $category['name'] ) {
			$category_apps[] = $record;
		}
	}
	echo json_encode( $category_apps );
}