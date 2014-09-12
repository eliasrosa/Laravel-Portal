<?php

class AdminController extends BaseController {

	//
	public function getIndex()
	{
		$this->layout->content = View::make('admin.home');
	}

}
