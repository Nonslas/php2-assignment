<?php namespace App\Controllers;

use Jenssegers\Blade\Blade;
/**
 * 
 */
class BaseController
{
	public function render($page, $data = [])
	{
		
		$blade = new Blade('../app/Views', '../writable/cache');
		echo $blade->render($page, $data);
	}
}