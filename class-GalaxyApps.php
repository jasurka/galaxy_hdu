<?php

use League\Csv\Reader;

class GalaxyApps {
	public $apps = array();

	public function __construct() {
		$this->apps = self::get_apps();
	}

	// Get all apps
	public static function get_apps() {
		$apps = array();
		$reader = Reader::createFromPath('app.csv', 'r');
		$reader->setHeaderOffset(0);
		$records = $reader->getRecords();

		foreach ( $records as $record ) {
			$apps[] = $record;
		}
		return $apps;
	}

	// Get all apps from given category
	public static function get_apps_by_category( $category = 'ART_AND_DESIGN' ) {
		$category_apps = array();
		$records = self::get_apps();
		foreach ( $records as $record ) {
			if ( $record['Category'] === $category ) {
				$category_apps[] = $record;
			}
		}
		return $category_apps;
	}

	// Get all categories names
	public static function get_categories_name() {
		$categories_name = array();
		$records = self::get_apps();

		foreach ( $records as $record ) {
			$categories_name[] = $record['Category'];
		}
		return array_unique( $categories_name );
	}

	// Get average rating in given category
	public static function get_category_average_rating( $category ) {
		$return_array = array();
		$records = self::get_apps();
		$rating = 0;

		foreach ( $records as $record ) {
			if ( $record['Category'] === $category ) {
				$return_array[] = $record['Rating'];
				$rating += $record['Rating'];
			}
		}
		$rating = $rating / count( $return_array );

		return number_format( $rating, 2 );
	}

	// Use for chart
	// Get average rating per category
	public static function get_all_categories_average_rating() {
		$return_array = array();
		$categories = self::get_categories_name();

		foreach ( $categories as $category ) {
			$return_array[ $category ] = self::get_category_average_rating( $category );
		}

		return $return_array;
	}

	// Get count of given content rating
	public static function get_content_rating_count( $content_rating ) {
		$records = self::get_apps();
		$count = 0;
		foreach ( $records as $record ) {
			if ( $record['Content Rating'] === $content_rating ) {
				$count++;
			}
		}

		return $count;
	}

	// Use for chart
	// Get all content rating count
	public static function get_content_rating_overall_count() {
		$return_array = array();
		$content_ratings = array( 'Everyone', 'Teen', 'Everyone 10+', 'Mature 17+', 'Adults only 18+', 'Unrated' );

		foreach ( $content_ratings as $rating ) {
			$return_array[ $rating ] = self::get_content_rating_count( $rating );
		}
		return $return_array;
	}

	// Get count of given free and paid type
	public static function get_free_and_paid_count( $type ) {
		$records = self::get_apps();
		$count = 0;
		foreach ( $records as $record ) {
			if ( $record['Type'] === $type ) {
				$count++;
			}
		}

		return $count;
	}

	// Use for chart
	// Get all free and paid count
	public static function get_free_and_paid_overall_count() {
		$return_array = array();
		$free_and_paid = array( 'Free', 'Paid' );

		foreach ( $free_and_paid as $type ) {
			$return_array[ $type ] = self::get_free_and_paid_count( $type );
		}
		return $return_array;
	}

	// Use for chart
	// Get given top max size apps
	public static function get_top_maxsize_apps( $number = 10 ) {
		$return_array = array();
		$records = self::get_apps();

		foreach ( $records as $record ) {
			$return_array[ $record['App'] ] = $record['Size'];
		}
		arsort( $return_array );
		return array_slice( $return_array, 0, $number );
	}

	// Use for chart
	// Get given top priced apps
	public static function get_top_price_apps( $number = 10 ) {
		$return_array = array();
		$records = self::get_apps();

		foreach ( $records as $record ) {
			$return_array[ $record['App'] ] = $record['Price'];
		}
		arsort( $return_array );
		return array_slice( $return_array, 0, $number );
	}

	// Use for chart
	// Get given top rating apps
	public static function get_top_rating_apps( $number = 10 ) {
		$return_array = array();
		$records = self::get_apps();

		foreach ( $records as $record ) {
			$return_array[ $record['App'] ] = $record['Rating'];
		}
		arsort( $return_array );
		return array_slice( $return_array, 0, $number );
	}

	// Use for chart
	// Get given top reviewed apps
	public static function get_top_reviewed_apps( $number = 10 ) {
		$return_array = array();
		$records = self::get_apps();

		foreach ( $records as $record ) {
			$return_array[ $record['App'] ] = $record['Reviews'];
		}
		arsort( $return_array );
		return array_slice( $return_array, 0, $number );
	}
}

