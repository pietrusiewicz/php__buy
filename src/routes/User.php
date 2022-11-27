<?php 
//namespace App\Models;
//use Illuminate\Database\Eloquent\Model;
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
        $username = $request->session()->get("usname");
        $todolist = $request->session()->get('todolist');
        $foods = $request->session()->get('foods');
        $ate_foods = $request->session()->get('ate_foods');
        $bought_things = $request->session()->get('bought_things');
        return ['user'=>$username, "todolist"=>$todolist, "bought_things"=>$bought_things, "i"=>0];
    }
    public static function go_view(Request $request, $view_name='profile') {

        return view($view_name, self::get_data($request));
    
    }
}
