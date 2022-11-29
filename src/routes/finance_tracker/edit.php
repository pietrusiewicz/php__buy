<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/finance_tracker/edit', function (Request $request) {
    #TODO
    return User::go_view($request, 'finance_tracker_editor');
});
Route::post('/finance_tracker/edit', function (Request $request) {
  $r = $request->session();
    $bought_things = $r->get("bought_things");
    $r->forget("bought_things");
    for ($i=0; $i<count($bought_things); $i++) {
        $name = $_POST["name$i"];
        $price = $_POST["nr$i"];
        $r->push('bought_things', [$name, $price]);
    }

    return Redirect::to('/finance_tracker');
    
});
?>
