<?php

namespace Laramie\Admin\Http\Controllers\Backend;

class BackendController extends BaseController
{
	public function index()
	{
		return view('home/index');
	}

	public function ui($slug)
	{
		return view('ui/' . $slug);
	}

	public function tables($slug)
	{
		return view('tables/' . $slug);
	}

	public function extras($slug)
	{
		return view('extras/' . $slug);
	}
}