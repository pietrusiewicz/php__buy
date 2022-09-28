<?php 
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class User {
    public static function all() {
        return [
            "user"=>"pass",
        ];
    }
    public static function authenticate($usname, $passwd) {
        if (isset(self::all()[$usname])) {
            if (self::all()[$usname] == $passwd) {
                return true;
            }
        return false;
        }
    }

    public static function get_data(Request $request) {
        $todolist = $request->session()->get('todolist');
        $foods = $request->session()->get('foods');
        $ate_foods = $request->session()->get('ate_foods');
        return ['user'=>$request->session()->get("usname"), "todolist"=>$todolist, "foods"=>$foods, "ate_foods"=>$ate_foods, "i"=>0];
    }
    public static function go_view(Request $request, $view_name='profile') {

        return view($view_name, self::get_data($request));
    
    }
}
