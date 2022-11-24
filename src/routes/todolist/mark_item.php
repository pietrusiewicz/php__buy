<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
?>
