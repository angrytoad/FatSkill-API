@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Question Types</h1>
                <p>All the question types!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Actions</div>
                    <div class="panel-body">
                        <a href="/admin/tests">
                            <button class="btn btn-info">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Current Question Types</div>
                    <div class="panel-body">
                        <ul id="question_type_list">
                            @foreach($question_types as $question_type)
                                <li>
                                    <div>
                                        <h4>{{ $question_type->name }}</h4>
                                        <a href="/admin/tests/question_types/{{$question_type->id}}/delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <p>{{ $question_type->description }}</p>
                                    </div>


                                </li>
                            @endforeach
                        </ul>
                        @if(count($question_types) === 0)
                            <p>No Question Types have been created yet.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Add a new question type</div>
                    <div class="panel-body">
                        <form id="new_question_type_form" class="row" method="POST" action="/admin/tests/question_types/create">
                            {{ csrf_field() }}
                            <div class="form-group col-xs-12">
                                <label for="question_type_name" class="col-md-12 control-label">Name:</label>
                                <div class="col-md-12">
                                    <input id="question_type_name" type="text" class="form-control" name="question_type_name" required>
                                </div>
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="question_type_description" class="col-md-12 control-label">Description:</label>
                                <div class="col-md-12">
                                    <textarea id="question_type_description" class="form-control" name="question_type_description" required></textarea>
                                </div>
                            </div>
                            <div class="form-group col-xs-12">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection