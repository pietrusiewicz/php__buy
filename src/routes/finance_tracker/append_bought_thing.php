<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('/finance_tracker/append_bought_thing', function (Request $request) {
    $item = $_POST['item_name'];
    $price = $_POST['price'];
    $request->session()->push('bought_things', [$item,$price]);
    return Redirect::back();
});
?>
