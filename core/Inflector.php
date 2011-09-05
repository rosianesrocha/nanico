<?php

/**
 * @package Core
 */

namespace Core;

/**
 * Class of manipulation of strings.
 * 
 * @package Core
 */

class Inflector
{
    
        /**
         * Change normal text for camelize style.
         *
         * @return string 
         */
    
	public static function camelize($string)
	{
                return str_replace(' ', '', ucwords(str_replace(array('_', '-'), ' ', $string)));
	}
        
        /**
         * Change underscore and hyphen for space.
         * 
         * @param string
         * @return string
         */

	public static function humanize($string)
	{
                return ucwords(str_replace(array('_', '-'), ' ', $string));
	}
        
        /**
         * Change normal spaces for underscore.
         * 
         * @param string
         * @return string
         */

	public static function underscore($string)
	{
                return strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $string));
	}
        
        /**
         * Change spaces for uncerscore and letters accented for non accented.
         * 
         * @param string
         * @param caracter for replace
         * @return string 
         */

	public static function slug($string, $replace = '-')
	{
                $map = array
                (
                        '/À|à|Á|á|å|Ã|â|Ã|ã/' => 'a',
                        '/È|è|É|é|Ê|ê|ẽ|Ë|ë/' => 'e',
                        '/Ì|ì|Í|í|Î|î/' => 'i',
                        '/Ò|ò|Ó|ó|Ô|ô|ø|Õ|õ/' => 'o',
                        '/Ù|ù|Ú|ú|ů|Û|û|Ü|ü/' => 'u',
                        '/ç|Ç/' => 'c',
                        '/ñ|Ñ/' => 'n',
                        '/ä|æ/' => 'ae',
                        '/Ö|ö/' => 'oe',
                        '/Ä|ä/' => 'Ae',
                        '/Ö/' => 'Oe',
                        '/ß/' => 'ss',
                        '/[^\w\s]/' => ' ',
                        '/\\s+/' => $replace,
                        '/^' . $replace . '+|' . $replace . '+$/' => ''
                );

                return strtolower(preg_replace(array_keys($map), array_values($map), $string));
	}
        
        /**
         * Convert all hyphen to underscore
         * 
         * @param string
         * @return string
         */
        
	public static function hyphen_to_underscore($string)
	{
                return str_replace('-', '_', $string);
	}
}
