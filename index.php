<?php 

try
{
     require 'config/settings.php';
     require 'config/bootstrap.php';
     require 'config/database.php';
     require 'config/routes.php';
     
     \spl_autoload_register('activerecord_autoload');
     \Core\Router::go();

}
catch (Exception $exception)
{
    $error = ROOT . '/views/errors/' . ENVIRONMENT . '.php';
    require_once $error;
}