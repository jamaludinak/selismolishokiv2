<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;

class homeController extends Controller
{
    public function index()
    {
        $ulasans = Ulasan::all(); // Fetch all reviews

        return view('home', compact('ulasans')); // Adjust the view name as necessary
    }
}
