<?php

/**
 * @package Core
 */

namespace Core;

/**
 * Session class create sessions and flash messages
 * 
 * @package Core;
 */

class Session
{      
        /**
         * Create sessions vars of array or string data
         * 
         * @param mixed Data of session var 
         * @param string name of session var  
         * @return void
         */
    
        public static function create($data = array(), $name = null)
        {
                session_start();

                if(is_array($data))
                {
                        foreach ($data as $key => $value)
                        {
                                $_SESSION[$key] = $value;
                        }
                }
                else 
                {
                        $_SESSION[$name] = $data; 
                }       
        }
        
        /**
         * Delete session var
         * 
         * @param string session var name
         * @return void
         */
        
        public static function delete($name)
        {
                session_start();
            
                if( ! empty($name)) 
                { 
                        unset($_SESSION[$name]);
                }
        }
        
        /**
         * Read session var
         * 
         * @param string session var name
         * @return mixed
         */
        
        public static function read($name)
        {
                session_start();
                
                if(isset($_SESSION[$name]))
                {
                        return $_SESSION[$name];
                }
        }
        
        /**
         * Create an flash session var  
         * 
         * @param string name of session flash var
         * @param mixed 
         * @return void
         */
        
        public static function flash($name = '', $data = null)
        {
                if( ! empty($name))
                {
                        static::create($name, $data);
                }
        }
        
        /**
         * Read an flash session var
         * 
         * @param string name of flash session var
         * @return mixed
         */
        
        public static function flash_read($name)
        {
                if( ! empty($name))
                {
                        return static::red($name);
                }
                
                return null;
        }
}