@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tasks'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if(isset($task))
                        <form role="form" method="POST" action={{ route('tasks.update', $task->id) }} enctype="multipart/form-data">
                        @method('PUT')
                    @else
                        <form role="form" method="POST" action={{ route('tasks.store') }} enctype="multipart/form-data">
                    @endif
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">{{ isset($task) ? 'Edit' : 'Create'}} Task</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">{{ isset($task) ? 'EDIT' : 'SAVE'}}</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-uppercase text-sm">Task Information</p>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Task Name</label>
                                        <input required class="form-control" type="text" name="name" value="{{ old('name', $task) }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Project</label>
                                        <select name="project_id" class="form-control" required>
                                            <option value="" disabled selected hidden>Please Choose a Project...</option>
                                            @foreach($projects as $project)
                                                <option value="{{$project->id}}" {{ (old("project_id", $task) == $project->id ? "selected":"") }}>
                                                    {{$project->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Priority</label>
                                        <select name="priority" class="form-control" required>
                                            <option value="" disabled selected hidden>Please Choose a Priority...</option>
                                            <option value="1" {{ (old("priority", $task) == "1" ? "selected":"") }}>1 - High</option>
                                            <option value="2" {{ (old("priority", $task) == "2" ? "selected":"") }}>2 - Medium</option>
                                            <option value="3" {{ (old("priority", $task) == "3" ? "selected":"") }}>3- Low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Description</label>
                                        <input class="form-control" type="text" name="description" value="{{ old('description', $task) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Start date</label>
                                        <input class="form-control" type="datetime-local" name="start_date" required value="{{ old('start_date', $task) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">End date</label>
                                        <input class="form-control" type="datetime-local" name="final_date" required value="{{ old('final_date', $task) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Select user</label>
                                        <select name="user_id" class="form-control" required>
                                            <option value="" disabled selected hidden>Please Choose a User...</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" {{ (old("user_id", $task) == $user->id ? "selected":"") }}>{{$user->username}} ({{$user->email}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
