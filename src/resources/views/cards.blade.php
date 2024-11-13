@extends('layout')

@section('content')
<h1>Contact Us</h1>
<p>Licznik czerwonych kartek</p>
<form action="{{ route('submit-card') }}" method="POST">
    @csrf
    <label for="yellow">żółte kartki:
    <input type="number" id="yellow" name="yellow" min=0></label>
    <label for="red">czerwone kartki:
    <input type="number" id="red" name="red" max=5 min=0></label>
    <br/>
    <button type="submit">Send</button>
</form>
@endsection