@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Test Manager</h1>
                <p>Manage them tests</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Actions</div>
                    <div class="panel-body">
                        <a href="/admin">
                            <button class="btn btn-info">Admin Panel</button>
                        </a>
                        <a href="/admin/tests/question_types">
                            <button class="btn btn-info">Create a new question type</button>
                        </a>
                        <a href="/admin/tests/create">
                            <button class="btn btn-info">Manually Create Test</button>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Recently Created Tests</div>
                    <div class="panel-body">
                        <ul id="recently_create_tests_list">
                            @foreach($recent_tests as $recent_test)
                                <li>{{ $recent_test->name }}</li>
                            @endforeach
                            @if(count($recent_tests) === 0)
                                <p>There have been no recently created tests</p>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Overall Statistics</div>
                    <div class="panel-body">
                        <p>Total Tests: <strong>{{  $test_count }}</strong></p>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Recent Revisions</div>
                    <div class="panel-body">
                        <ul id="recently_created_revisions_list">
                            @foreach($recent_revisions as $recent_revision)
                                <li>{{ $recent_revisions->title }}</li>
                            @endforeach
                            @if(count($recent_revisions) === 0)
                                <p>There have been no recently created revisions</p>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection