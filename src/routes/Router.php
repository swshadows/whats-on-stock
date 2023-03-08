<?php

class Router
{
	private static $routes = array();
	public static function register(string $uri, string $view_file)
	{
		array_push(self::$routes, ['URI' => $uri, 'View' => $view_file]);
	}

	public static function route(string $current_uri)
	{
		$format_uri = explode("?", $current_uri);
		foreach (self::$routes as $arr => $item) {
			if ($format_uri[0] == $item['URI']) {
				return $item['View'];
			}
		}

		return '/views/404.php';
	}
}
