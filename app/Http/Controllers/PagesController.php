<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function index()
    {
        $title = "Welcome";
        return view('pages.index', compact('title'));
    }

    public function about()
    {
        $title = "About";
        return view('pages.about')->with('title', $title);
    }

    public function services()
    {
        $data = [
            'title' => 'Categories',
            'services' => ['Web', 'Design', 'SEO']
        ];
        return view('pages.services')->with($data);
    }

    public function lang($lang)
    {
        Session::put('lang', $lang);
        return Redirect::back()->with('message','Operation Successful !');
    }
}
