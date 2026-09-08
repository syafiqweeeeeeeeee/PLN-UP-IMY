<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the company history page.
     *
     * @return \Illuminate\View\View
     */
    public function sejarah()
    {
        return view('tentang_kami.sejarah');
    }

    /**
     * Show the vision & mission page.
     *
     * @return \Illuminate\View\View
     */
    public function visiMisi()
    {
        return view('tentang_kami.visi_misi');
    }
}
