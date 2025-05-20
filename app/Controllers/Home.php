<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('public/index');
    }
    public function about()
    {
        return view('public/about');
    }
}
