@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Panel</h1>
    <p>Keeping track of the numbers</p>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Actions</div>
                <div class="panel-body">
                    <a href="/register">Register New Admin Account</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Statistics</div>
                <div class="panel-body">
                    <p>Total number of registered user accounts: {{ $users }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection