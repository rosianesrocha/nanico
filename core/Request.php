<?php

/**
 * @package Core
 */

namespace Core;

/**
 * Class for working with request HTTP values.
 * 
 * @package Core
 */

class Request 
{
        /**
         * Clean request data of XSS and SQL Injection attack.
         * 
         * @return string  
         */
    
	public function security($request)
	{
                if(is_array($request))
                {
                        foreach ($request as $key => $value)
                        {
                                if(is_array($value))
                                {
                                        // Unset multidimensional arrays in request
                                        unset($request[$key]);
                                }
                                else
                                {	
                                        $request[$key] = static::sanitize($value);
                                }
                        }
                }
                else
                {
                        $request = static::sanitize($value);
                }

		return $request;
	}
        
        /**
         * Filter GET HTTP request
         * 
         * @param mixed
         * @return mixed 
         */
	
	public function get($key = null)
	{
		if(isset($_GET[$key]))
		{
			return static::security($_GET[$key]);
		}
	}
        
        /**
         * Get HTTP method utilized in request
         * 
         * @return string
         */

	public function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}

        /**
         * Filter POST HTTP request
         * 
         * @param mixed
         * @return mixed 
         */
        
	public function post($key = null)
	{
		if(isset($_POST[$key]))
		{
			return static::security($_POST[$key]);
		}
	}
        
        /**
         * Returns segments of URL and prevent segments of XSS and SQL Injection attacks.
         * 
         * @return string
         */
                
        public static function segments($segment)
	{
                
		$url = explode('index.php', $_SERVER['PHP_SELF']);
		$url = trim($url[1], '/');
		$url = explode('/', $url);
                return ( isset($url[$segment]) ) ? $url[$segment]: null;
	}
        
        /**
         * Clener HTTP request for XSS and SQL Injection attacks
         * 
         * @return string
         */
        
        private function sanitize($value)
        {
                $clean = Security::xss($value);
                return Security::sql_injection($clean);	 
        }
}


