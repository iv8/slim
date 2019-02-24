<?php
namespace App\Controllers;

class HomeController extends BaseController
{
  	public function index()
    {
        return $this->view()->assign("test", time())->display('index.tpl');
    }

}
