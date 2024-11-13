<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        return view('home');
    }

    public function okregowa() {
        return view('okregowa');
    }

    public function aklasa() {
        return view('aklasa');
    }

    public function bklasa() {
        return view('bklasa');
    }

    public function gallery() {
        return view('gallery');
    }

    public function contact() {
        return view('contact');
    }

    public function handleContact(Request $request) {
        $name = $request->input('name');
        $message = $request->input('message');
        // Przykładowa akcja na otrzymanych wartościach
        return redirect()->route('home')->with('status', 'Formularz został przesłany!');
    }
}