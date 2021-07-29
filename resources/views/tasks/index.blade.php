@extends('layouts.app')

@section('content')
<div class="container">
    <div class="tasks">
        <a href="javascript:;" class="btn btn-light pl-0 mb-3" data-toggle="modal" data-target="#newTask"><i class="fa fa-plus"></i> Add new task</a>
        <div class="incomplete mb-4">
            <h5>Incomplete</h5>
            <task-lists :tasks="tasks"></task-lists>
        </div>
        <div class="completed">
            <h5>Completed</h5>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="completed_1" checked disabled>
                <label class="form-check-label" for="completed_1">
                    Respond to email
                </label>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newTask" tabindex="-1" role="dialog" aria-labelledby="newTaskLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTaskLabel">New Task</h5>
            </div>

            <task-form
                v-on:taskadded="saveTask"
                :user="{{ Auth::user() }}"
            ></task-form>
        </div>
        </div>
    </div>
    </div>
@endsection
