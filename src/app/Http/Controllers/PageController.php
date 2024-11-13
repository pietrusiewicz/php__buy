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

    public function cards() {
        return view('cards');
    }

    public function submitCard(Request $request) {
        $y = $request->input('yellow');
        $r = $request->input('red');
        // Przykładowa akcja na otrzymanych wartościach
        return view('submitcards', ['yellow' => $y, 'red' => $r]);
    }
}