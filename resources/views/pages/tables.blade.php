@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h6>LIST OF TASKS</h6>
                            <a type="button" class="btn btn-outline-primary btn-sm ms-auto" href="{{ \Illuminate\Support\Facades\URL::route('tasks.create') }}">New Task</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Task</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Assigned User</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Start - Final date</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$task->name}}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{$task->project->name}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$task->user->username}}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{$task->user->email}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $task->start_date->format('m/d/Y').' - '. $task->final_date->format('m/d/Y')}}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @switch($task->status_id)
                                                @case(1)
                                                <span class="badge badge-sm bg-gradient-danger">{{$task->status->name}}</span>
                                                @break
                                                @case(2)
                                                <span class="badge badge-sm bg-gradient-warning">{{$task->status->name}}</span>
                                                @break
                                                @case(3)
                                                <span class="badge badge-sm bg-gradient-success">{{$task->status->name}}</span>
                                                @break
                                            @endswitch
                                        </td>

                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                               data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>LIST OF PROJECTS</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Project</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Description</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Status</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                        Completion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($projects as $project)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="/img/small-logos/logo-webdev.svg"
                                                         class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">{{$project->name}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$project->description}}</p>
                                        </td>
                                        <td>
                                            @if($project->get_completion() == 100)
                                                <span class="badge badge-sm bg-gradient-success">Completed</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-warning"> {{ $project->tasks_completed()->count() }} from {{ $project->tasks()->count() }} complete</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="me-2 text-xs font-weight-bold">{{ number_format((float)$project->get_completion(), 2, '.', '') }}%</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-gradient-info" role="progressbar"
                                                             aria-valuenow="{{ $project->get_completion() }}" aria-valuemin="0" aria-valuemax="100"
                                                             style="width: {{ $project->get_completion() }}%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
