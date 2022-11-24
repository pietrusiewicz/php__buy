<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
require_once __DIR__ . '/../funcs.php';

Route::post('/todolist/del_item', function (Request $request) {
    $r = $request->session();
    $todolist = $r->get('todolist');
    $tl = delItemArray($todolist);

    $r->forget('todolist');
    $r->put("todolist", $tl);

    return Redirect::back();
});
?>
