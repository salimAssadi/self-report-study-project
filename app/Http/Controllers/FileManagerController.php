<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

class FileManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View|Factory
     */
    public function index(Request $request)
    {
        return view('filemanager');
    }
}
