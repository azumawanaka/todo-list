@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="tasks">
            <a href="javascript:;" class="btn btn-white pl-0 mb-3" data-toggle="modal" data-target="#newTask"><i class="fa fa-plus"></i> Add new task</a>

            <task-lists></task-lists>
        </div>
    </div>
@endsection
