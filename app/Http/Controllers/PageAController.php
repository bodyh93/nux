<?php

namespace App\Http\Controllers;


class PageAController extends Controller
{
    public function index()
    {
        return view('pages.page_a.index');
    }
}
