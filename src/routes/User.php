<?php 

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
}
