<?php

use League\Csv\Reader;

class GalaxyApps {
	public $apps = array();

	public function __construct() {
		$this->apps = self::get_apps_array();
	}

	// Get all apps in arrays
	public static function get_apps_array() {
		$apps = array();
		$reader = Reader::createFromPath('app.csv', 'r');
		$reader->setHeaderOffset(0);
		$records = $reader->getRecords();

		foreach ( $records as $record ) {
			$apps[] = $record;
		}
		return $apps;
	}

	// Get all apps in JSON
	public static function get_apps() {
		$apps = array();
		$records = self::get_apps_array();

		foreach ( $records as $record ) {
			$apps[] = $record;
		}
		echo json_encode( $apps );
	}

	public static function get_apps_by_category( $category ) {
		$category_apps = array();
		$records = self::get_apps_array();
		foreach ( $records as $record ) {
			if ( $record['Category'] === $category['name'] ) {
				$category_apps[] = $record;
			}
		}
		echo json_encode( $category_apps );
	}
}

