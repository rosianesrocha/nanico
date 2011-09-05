<?php
/**
 * @
 */
namespace Core;

class Controller
{
        /**
	 * Array of classes for autoloading.
         * 
	 * @var array
	 */
    
	public $import = array();

	/**
         * Template pattern for views
         * 
	 * @var string
	 */
	
	public $template = 'application';
	
	/**
	 * Content for views
         * 
	 * @var string
	 */
	
	public $content = null;
        
        /**
         * Define if autoload of model it`s necessary
         * 
         * @var boolean
         */
        
        public $autoload_model = TRUE;
        
	function __construct()
	{
                if($this->autoload_model)
                {
                    $this->import[] = $this->name();
                }
                
		$this->import();
	}

	/**
	 * Loading classes into controller
         * 
	 * @return void 
	 */
	
	public function import()
	{
		$source_paths = array('models', 'core');
		
		foreach ($source_paths as $source_path)
		{
		    foreach ($this->import as $class)
		    {
			load_class($class, $source_path);
		    }
		}
	}

	/**
	 * Name of controller (used for instance model)
         * 
	 * @return string
	 */

	private function name()
	{
		$class_name = get_class($this);
		$lenght = strpos($class_name, 'Controller');
		return substr($class_name, 0, $lenght);
	}

	/**
	 * Load view nd send data it
         * 
	 * @param $path string 
	 * @param $data string
	 * @return void
	 */
	
	public function view($path, $data = null)
	{
		$view = ROOT . '/views/' . $path . '.php';
		
		$template = ROOT . '/views/layouts/' . $this->template . '.php';

		if (is_file($view))
		{
			
			if( ! empty($data)) 
			{
			    extract($data); 
			}
			
			ob_start();
			    require_once $view;
			    $this->content = ob_get_contents();
			ob_end_clean();
			
			require_once $template;
		}
		else
		{
			throw new ViewException('View ' . $path . ' not found .', 2);
		}
	}
}