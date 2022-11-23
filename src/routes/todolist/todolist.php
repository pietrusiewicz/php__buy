<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
require_once __DIR__ . '/../funcs.php';
require_once __DIR__ .'/../User.php';

Route::get('/todolist', function (Request $request) {
    $todolist = $request->session()->get('todolist');
    return User::go_view($request, 'todolist');
});

Route::post('/todolist/del_item', function (Request $request) {
    $r = $request->session();
    $todolist = $r->get('todolist');
    $tl = delItemArray($todolist);

    $r->forget('todolist');
    $r->put("todolist", $tl);

    return Redirect::back();
});

Route::get('/todolist/tl_toggle/{id}', function(Request $request, $id) {
    $r = $request->session();
    $tl = $r->get('todolist');
    //if ($tl[$id][1]) {
    $tl[$id][1] = !$tl[$id][1];
    //} else {
	//    $tl[$td][1]=1;
    //}
    $r->forget('todolist');
    $r->put("todolist", $tl);

    return Redirect::back();
});
Route::post('/todolist/add_item', function (Request $request) {
    $item = $_POST['item_name'];
    $request->session()->push('todolist', [$item, 0]);
    //return Profile::go_view($request);
    return Redirect::back();
});

?>
