<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
// use App\Traits\Authorizable;
use Karlomikus\Theme\Contracts\ThemeInterface;

class BaseController extends Controller
{
	// use Authorizable;
	
	private $theme;
	private $namespace = 'frontend';

	public function __construct(ThemeInterface $theme)
	{
		$this->theme = $theme;
		$this->theme->set($this->namespace);
		view()->addLocation(resource_path('views/themes/' . $this->namespace .'/'));
	}
}