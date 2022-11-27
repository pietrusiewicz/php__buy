<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Eloquent {
    protected $fillable = array('user', 'item', 'trufals');
}
?>
