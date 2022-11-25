<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/finance_tracker/edit', function (Request $request) {
    #TODO
    return User::go_view($request, 'finance_tracker_editor');
});
?>
