<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FullCalendarController extends Controller
{
    public function index()
    {
        return view('full-calendar.master');
    }
}
