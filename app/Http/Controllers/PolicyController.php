<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class PolicyController extends Controller
{
    public function show()
    {
        return Inertia::render('Legal/Policy');
    }
}
