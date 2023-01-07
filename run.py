import sys,os

# table second index, cols after third
table_name, cols = sys.argv[1], sys.argv[2:]
prefix = 'docker compose run'

os.system(f'{prefix} artisan migrtate')
migrate_file = """
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {{
        Schema::create('{1}', function (Blueprint $table) 
        {{
            $table->id();
            {0}
            $table->timestamps();
        }});
    }}
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {{
        Schema::dropIfExists('{1}');
    }}
}}
""".format(str(f'\n{12*" "}'.join([f'$table->string({s});' for s in cols])), table_name)
model_name = input("Enter model name").capitalize()

controller_file = """
<?php
namespace App\Http\Controllers;

use App\Models\{0};
use Illuminate\Http\Request;

class {0}Controller extends Controller {{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() {{
        $items = {0}::latest()->paginate(5);
        return view('{1}.index',compact('items'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }}
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {{
        return view('{1}.create');
    }}
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request) {{
        $request->validate({2});
        {0}::create($request->all());
        return redirect()->route('{1}.index')
            ->with('success','{0} created successfully.');
    }}
    /**
    * Display the specified resource.
    *
    * @param  \App\{0}  $item
    * @return \Illuminate\Http\Response
    */
    public function show({0} $item) {{
        return view('{1}.show',compact('item'));
    }}
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\{0}  $item
    * @return \Illuminate\Http\Response
    */
    public function edit({0} $item) {{
        return view('{1}.edit',compact('item'));
    }}
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\{0}  $item
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, {0} $item) {{
        $request->validate({2});
        $item->update($request->all());
        return redirect()->route('{1}.index')
            ->with('success','{0} updated successfully');
    }}
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\{0}  $item
    * @return \Illuminate\Http\Response
    */
    public function destroy({0} $item) {{
        $item->delete();
        return redirect()->route('{1}.index')
            ->with('success','{0} deleted successfully');
    }}
}}
""".format(model_name, table_name, str([f"'{col}' => 'required'" for col in cols]).replace('"',''))

# app/Models/*model_name*.php
model_file = """
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {{
    use HasFactory;
    protected $fillable = {0};
}}
""".format(cols)

# resources/views/*table_name*/layout.blade.php
layout_file = """
<!DOCTYPE html>
<html>
<head>
    <title>Your CRUD App</title>
</head>
<body>
    <div>@yield('content')</div>
</body>
</html>
"""

# resources/views/*table_name*/index.blade.php
index_file = """
@extends('{0}.layout')
@section('content')
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
    <h2>Your Laravel CRUD from scratch</h2>
</div>
<div class="pull-right">
    <a class="btn btn-success" href="{{{{ route('{0}.create') }}}}"> Create New {1}</a>
</div>
</div>
</div>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{{{ $message }}}}</p>
    </div>
@endif
<table class="table table-bordered">
<tr>
    <th>No</th>
    {2}
    <th width="280px">Action</th>
</tr>
@foreach ($items as $item)
<tr>
    <td>{{{{ ++$i }}}}</td>
    {3}
    <td>
        <form action="{{{{ route('{0}.destroy',$item->id) }}}}" method="POST">
        <a class="btn btn-info" href="{{{{ route('{0}.show',$item->id) }}}}">Show</a>
        <a class="btn btn-primary" href="{{{{ route('{0}.edit',$item->id) }}}}">Edit</a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>
    {{!! $items->links() !!}}
@endsection
""".format(table_name, model_name, '\n    '.join([f"<th>{col}</th>" for col in cols]).replace('"', ''), '\n    '.join([f"<td>{{{{ $item->{col} }}}}</td>" for col in cols]).replace('"', ''))

# resources/views/*table_name*/create.blade.php
create_file = """
@extends('{0}.layout')
@section('content')
<div class="row">
    <h2>Add New {2}</h2>
    <a href="{{{{ route('{0}.index') }}}}"> Back</a>
</div>
@if ($errors->any())
    <strong>Whoops!</strong> 
    There were some problems with your input.<br><br>
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{{{ $error }}}}</li>
    @endforeach
    </ul>
@endif
<form action="{{{{ route('{0}.store') }}}}" method="POST">
@csrf
<div class="row">
    {1}
</div>
<button type="submit">Submit</button>
</form>
@endsection
""".format(table_name, '\n'.join([f"<strong>{col.capitalize()}:</strong>\n    <input type='text' name='{col}' placeholder='{col.capitalize()}'/>" for col in cols]).replace('"', ''), model_name)

# resources/views/*table_name*/edit.blade.php
edit_file = """
@extends('{0}.layout')
@section('content')
<div class="row">
    <h2>Edit {2}</h2>
    <a href="{{{{ route('{0}.index') }}}}"> Back</a>
</div>
@if ($errors->any())
    <div>
    <strong>Whoops!</strong> 
    There were some problems with your input.<br><br>
    <ul>@foreach ($errors->all() as $error)
    <li>{{{{ $error }}}}</li>
    @endforeach</ul>
    </div>
@endif
<form action="{{{{ route('{0}.update',$item->id) }}}}" method="POST">
    @csrf
    @method('PUT')

    {1}

    <button type="submit">Submit</button>
</form>
@endsection
""".format(table_name, '\n    '.join([f"<strong>{col.capitalize()}:</strong>\n    <input type='text' name='{col}' placeholder='{col.capitalize()}'/>" for col in cols]).replace('"', ''), model_name)

# resources/views/*table_name*/show.blade.php
show_file = """
@extends('{0}.layout')
@section('content')
<div class="row">
    <h2> Show {2}</h2>
    <a href="{{{{ route('{0}.index') }}}}"> Back</a>
</div>
<div class="row">
    {1}
</div>
@endsection
""".format(table_name, '\n'.join([f"    <strong>{col}</strong>{{{{ $item->{col} }}}}" for col in cols]), model_name)

#print(migrate_file)
#print(controller_file)
#print(model_file)
#print(index_file)
#print(create_file)
#print(edit_file)
print(show_file)
#os.system(f'{prefix} artisan migrate');

