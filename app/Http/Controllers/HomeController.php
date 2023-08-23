<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home', [
            'shops' => Shop::get(),
        ]);
    }
}
