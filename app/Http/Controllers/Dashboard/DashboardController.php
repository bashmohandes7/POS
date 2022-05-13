<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\DashboardInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public  $dashboardInterface;
    public function __construct(DashboardInterface $dashboardInterface)
    {
        $this->dashboardInterface = $dashboardInterface;
    } // end of construct

    public function index()
    {
        return $this->dashboardInterface->index();
    }
}//   end of controller
