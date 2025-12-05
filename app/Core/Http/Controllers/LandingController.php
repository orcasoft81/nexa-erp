<?php

namespace App\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Module;

class LandingController extends Controller
{
    public function index()
    {
       // active modules from DB
        $modules = Module::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('core.landing', compact('modules'));
    }
}
