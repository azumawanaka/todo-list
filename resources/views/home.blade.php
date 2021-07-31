@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="tasks">
            <a href="javascript:;" class="btn btn-light pl-0 mb-3" data-toggle="modal" data-target="#newTask"><i class="fa fa-plus"></i> Add new task</a>

            <task-lists :tasks="tasks"></task-lists>
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
                    ></task-form>
                </div>
            </div>
        </div>
    </div>
@endsection
