<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
