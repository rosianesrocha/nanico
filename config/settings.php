<?php

// defines the root directory
define('ROOT', dirname(__DIR__));

// defines the root directory
define('CORE', ROOT . '/core');

// php-activerecord environment
define('PHP_ACTIVERECORD_VERSION_ID', '1.0');

// Environment execution
define('ENVIRONMENT', 'development');

if (defined('ENVIRONMENT'))
{
     switch (ENVIRONMENT)
     {
          case 'development':
               error_reporting(E_ALL);
          break;

          case 'production':
               error_reporting(0);
          break;

          default: exit('The application environment is not set correctly.');
     }
}

