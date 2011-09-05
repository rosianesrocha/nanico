<?php

/**
 * @package Core
 */

namespace Core;

/**
 * The class for routing process.
 *
 * @package Core
 */

class Router
{
        /**
         * Controller path.
         * 
         * @staticvar string
         */
    
        private static $controller_path = null;
	
        /**
         * URL segments.
         * 
         * @staticvar array
         */
        
	private static $segments = array();

        /**
         * Controller name.
         * 
         * @staticvar string
         */
        
	private static $controller = null;

	/**
         * Action name.
         * 
         * @staticvar string
         */
        
	private static $action = 'index';
        
        /**
         * Change label regex for real code.
         * 
         * @param string
         * @return string
         */
        
	private static function regex($route)
	{
		$labels = array(':any'=>'([0-9a-zA-Z]{1,})', ':number'=>'([0-9]{1,})');
		
		$route = str_replace('/', '\/', $route);

		foreach($labels as $key => $value)
		{
			$route = str_replace($key, $value, $route);
		}
		
		return $route;
	}
        
        /**
         * Check if url is named route.
         * 
         * @param string
         * @return string
         */

	private static function named_route($url)
	{
		global $routes;

		if ( ! empty($url))
		{
			$url = static::sanitize($url);

			foreach ($routes as $key => $value)
			{
				$key = static::regex($key); 
				$key = static::sanitize($key);
				$value = static::sanitize($value);
				
				if (preg_match("/^$key$/", $url))
				{
					$url = $value;
				}
			}
		}
		else
		{
			$url = static::sanitize($routes['default']);
		}

		return $url;
	}
        
        /**
         * Start routing process.
         * 
         * @return void
         */

	public static function go()
	{
                // Define controllers root path.
            	static::$controller_path = ROOT . '/controllers';
                
                // Get segments of url.
		static::segments();
                
                // Check if exists subpath in controllers path.
		static::path_exists();
                
                // Instance controller.
		static::controller();
                
                // Define action for call.
		static::action(); 

		$controller = static::$controller;
		$action = static::$action;
		$controller->$action();
	}
        
        /**
         * Instance controller.
         * 
         * @return void
         */
	
	private static function controller()
	{
		if(isset(static::$segments[0]) and static::$segments[0] != null)
		{
			$controller =  static::$controller_path . '/' . Inflector::camelize(static::$segments[0]) . 'Controller.php';
			
			if(is_file($controller))
			{
				require static::$controller_path . '/' . Inflector::camelize(static::$segments[0]) . 'Controller.php';
				$controller = 'Controllers\\'. Inflector::camelize(static::$segments[0]) . 'Controller';
				static::$controller = new $controller();
			}
			else
			{
			    throw new ControllerException('Controller ' . static::$segments[0] . ' not found.');
			}
		}
                else
		{
		    throw new RouteException('Route not found.');
		}
	}
        
        /**
         * Call action based in instance controller 
         * created in controller method.
         * 
         * @return void
         */
	
	private static function action()
	{
            	$reflection = new \ReflectionClass(static::$controller);
               
		if(isset(static::$segments[1]))
		{ 

                        if( ! $reflection->hasMethod(static::$segments[1]))
                        {
                                throw new ActionException('Action ' . static::$segments[1] . ' not found');
                        }
                        
                        static::$action = static::$segments[1];
		}
			
                if( ! $reflection->hasMethod('index'))
                {
                        throw new ActionException('Action index not found');
                }
	}
        
        /**
         * Check of exxistence if an subpath in controllers path, 
         * check this based in first item of segments array. 
         * 
         * @return void
         */
	
	private static function path_exists()
	{
		if(is_dir(static::$controller_path . '/' . static::$segments[0]))
		{
			static::$controller_path .= '/' . static::$segments[0];
			unset(static::$segments[0]);
			static::$segments = array_values(static::$segments);
		} 
	}
        
        /**
         * Sanitize slash and organize url.
         * 
         * @return string 
         */

	private static function sanitize($url)
	{
		return trim(preg_replace('%/+%', '/', $url), '/');
	}
        
        /**
         * Get segments of url.
         * 
         * @return void
         */
	
	private static function segments()
	{
		$url = explode('index.php', $_SERVER['PHP_SELF']);
		$url = static::named_route($url[1]);
		static::$segments = explode('/', $url);
	}
}

