<?php
class Todolist {
    /*
    public static function addItem(Request $request, $item_name) {
        $request->session()->get('todolist');//array_push($todolist,$item_name);
        return $todolist;
    }
     */
    public static function addItem($todolist){
    $tl = [];
    $i = 0;
    for($i=0;$i<count($todolist); $i++) {
        if (!isset($_POST["$i"])){
            array_push($tl, $todolist[$i]);
        }
    }
    return $tl;
    //$r->forget('todolist');
    //$r->put("todolist", $tl);
    //$r->push('todolist', $item);
    //return Profile::go_view($request);
    }
}
