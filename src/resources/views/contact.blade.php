@extends('layout')

@section('content')
<h1>Contact Us</h1>
<p>If you have any questions or comments, feel free to reach out to us using the form below:</p>
<form action="{{ route('handleContact') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea>
    <button type="submit">Send</button>
</form>
@endsection