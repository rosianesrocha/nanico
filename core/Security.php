<?php

/**
 * @package Core
 */
namespace Core; 

/**
 * Security provides methods for filter data.
 * 
 * @package Core
 */

class Security
{
        /**
         * Prevent XSS attack
         * 
         * @param string
         * @return string 
         */

	public static function xss($input)
	{
	    return htmlentities($input, ENT_QUOTES);
	}
        
        /**
         * Prevent SQL Injection attack
         * 
         * @param type $input
         * @return type 
         */
	
	public static function sql_injection($input)
	{
                // Remove sql words for nothing.
		$input = preg_replace('/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/', '', $input);
		$input = trim($input); // clean spaces
		$input = strip_tags($input); // Remove html and php tags
		$input = addslashes($input); // Add invert slashes for an string
		return $input;
	}

}