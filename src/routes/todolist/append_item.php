<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
Route::post('/todolist/add_item', function (Request $request) {
    $item = $_POST['item_name'];
    $request->session()->push('todolist', [$item, 0]);
    //return Profile::go_view($request);
    return Redirect::back();
});
?>
