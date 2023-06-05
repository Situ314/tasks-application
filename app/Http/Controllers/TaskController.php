<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::orderBy('priority')
            ->get();

        $projects = Project::all();

        return view('pages.task-list')
            ->withTasks($tasks)
            ->withProjects($projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        $users = User::all();

        return view('pages.task-create')
                    ->withUsers($users)
                    ->withProjects($projects)
                    ->withTask(null);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = Task::create($request->all());

        return redirect('tasks')
                ->with('succes', 'Task "'.$task->name.'" succesfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projects = Project::all();
        $users = User::all();

        $task = Task::find($id);

        return view('pages.task-create')
            ->withUsers($users)
            ->withProjects($projects)
            ->withTask($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->fill($request->all())->save();

        return redirect('tasks')
            ->with('succes', 'Task "'. $task->name .'" succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Task::find($id)->delete();

        return redirect('tasks')
            ->with('succes', 'Task succesfully deleted');
    }
}
