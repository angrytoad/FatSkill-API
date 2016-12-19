@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thanks for registering with Fatskill!</h1>
    <p>Just click the link the link below to activate your account</p>
    <a href="{{ $url }}">Activate!</a>
</div>
@endsection