<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('users.index');
    }
}
