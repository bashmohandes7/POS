<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\DashboardInterface;

class DashboardRepository implements DashboardInterface
{

    public function index()
    {
        return view('dashboard.welcome');
    }// end of index
} // end of class
