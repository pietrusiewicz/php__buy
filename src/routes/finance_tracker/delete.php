<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
require_once __DIR__ . '/../funcs.php';

Route::get('/finance_tracker/delete/{i}', function (Request $request, $i) {
    $r = $request->session();
    $items = $r->get('bought_things');
    //echo $items;
    $r->forget('bought_things');
    $r->put("bought_things", []);
	for ($j=0; $j<count($items); $j++) {
        if (!($i==$j)) {
			$r->push("bought_things", $items[$j]);
		}
    }
    return Redirect::back();
});
?>
