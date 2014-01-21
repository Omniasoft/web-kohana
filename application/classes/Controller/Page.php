<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Page extends Controller
{
	public function action_index()
	{
		$flexagon = new Flexagon();
		die($flexagon->render());
		$this->setContent($this->getActionView()

		);
	}

	public function action_about()
	{
		$this->setContent($this->getActionView()

		);
	}

	static public function title($route, $params)
	{
		switch(Route::name($route))
		{
			case 'page-home': return tr('Home');
			case 'page-about': return tr('About');
			default: return tr('Home');
		}
	}
}