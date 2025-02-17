<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class TermsController extends Controller
{
    public function show()
    {
        return Inertia::render('Legal/Terms');
    }
}
