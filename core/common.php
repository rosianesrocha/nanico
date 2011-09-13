<?php

/**
 * Load classes of php-activerecord framework
 * 
 * @param string
 * @return void
 */

function activerecord_autoload($class_name)
{
	$path = ActiveRecord\Config::instance()->get_model_directory();
	$root = realpath(isset($path) ? $path : '.');

	if (($namespaces = ActiveRecord\get_namespaces($class_name)))
	{
		$class_name = array_pop($namespaces);
		$directories = array();

		foreach ($namespaces as $directory)
		{
		    $directories[] = $directory;
		}

		$root .= DIRECTORY_SEPARATOR . implode($directories, DIRECTORY_SEPARATOR);
	}

	$file = "$root/$class_name.php";

	if (file_exists($file))
	{
	    require $file;
	}
}

/**
 * Load classes
 * 
 * @param String Class name of class for loading
 * @param string Directory of class
 * @param boolean If class need instantiation
 * @return object
 */

function load_class($class, $directory = 'core', $instantiate = FALSE )
{
	static $_classes = array();

        $class_path = ROOT . '/' . $directory . '/' . $class;

        // return classe instance if exists (singleton pattern)
	if (isset($_classes[$class]))
	{
		return $_classes[$class];
	}

        if (file_exists($class_path . '.php'))
        {
                require $class_path . '.php';

                $reflection = new ReflectionClass("\\$directory\\$class");

                if($reflection->inNamespace())
                {
                        $class = $reflection->getNamespaceName() . '\\' . $class;
                }

                if($instantiate === TRUE)
                {
                        $_classes[$class] = new $class();
                        return $_classes[$class];
                }
        }
}

/**
 * Redirect for a action event
 * 
 * @param string url
 * @return null
 */

function redirect($url)
{
        header("location: $url");
}