<?php defined('SYSPATH') OR die('No direct script access.');

class Config_Environment extends Config_File
{
	public function load($group)
	{
		$config = array();
		
		if ($files = Kohana::find_file($this->_directory, $group, NULL, TRUE))
		{
			foreach ($files as $file)
			{			
				// Load the config
				$configs = Kohana::load($file);

				// Check if there is a config for a specefic environment
				if (array_key_exists(Kohana::$environment, $configs))
				{
					$config = Arr::merge($config, $configs, $configs[Kohana::$environment]);
				}
				else
				{
					$config = Arr::merge($config, $configs);
				}
			}
		}
		
		return $config;
	}
}