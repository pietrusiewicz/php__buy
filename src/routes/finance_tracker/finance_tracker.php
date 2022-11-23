<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
require_once __DIR__ . '/../funcs.php';
require_once __DIR__ .'/../User.php';

Route::get('/finance_tracker', function (Request $request) {
    #TODO
    return User::go_view($request, 'finance_tracker');
});

Route::post('/finance_tracker/append_bought_thing', function (Request $request) {
    $item = $_POST['item_name'];
    $price = $_POST['price'];
    $request->session()->push('bought_things', [$item,$price]);
    return Redirect::back();
});

Route::get('/finance_tracker/edit', function (Request $request) {
    #TODO
    return User::go_view($request, 'finance_tracker_editor');
});

Route::get('/finance_tracker/delete/{i?}', function (Request $request, $i=null) {
    if ($i==null) {
        return Redirect::back();
    } else {
    $items = $request->get('bought_things');
    unset($items[$i]);
    $request->session()->forget('bought_things');
    $request->session()->put("bought_things", $items);
    //$request->session()->push('bought_things', [$item,$price]);
    return Redirect::back();
    }
});
?>
