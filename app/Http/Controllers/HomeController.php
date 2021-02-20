<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtengo todas las imagenes
        /* $images = Image::orderBy('id', 'desc')->simplePaginate(5); */
        $images = Image::orderBy('id', 'desc')->paginate(5);

        return view('home', [
            'images' => $images
        ]);
    }
}
