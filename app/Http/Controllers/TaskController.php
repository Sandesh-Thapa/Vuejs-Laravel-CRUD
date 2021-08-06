<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    protected $model;

    public function __construct(Task $modelObj)
    {
        $this->model = $modelObj;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all tasks
       $tasks = $this->model->paginate(10);
       $latest_tasks = $this->model->latest()->take(10)->get();
       $completed_task_count = $this->model->where('completed','1')->count();
       $incomplete_task_count = $this->model->where('completed','0')->count();
       $total = $this->model->all()->count();
        return [
            'tasks' => $tasks,
            'latest' => $latest_tasks,
            'complete' => $completed_task_count,
            'incomplete' => $incomplete_task_count,
            'total' => $total
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:tasks|max:50|min:2',
        ]);

        $task = new Task;
        $task->title = $request->all()["title"];
        $task->completed = false;
        $task->save();

        return $task;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->title = $request->all()["title"];
        $task->completed = $request->all()["completed"] == true ? true : false;

        $task->update();

        return ['Edited'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $task = Task::findOrFail($id);
        $task->delete();
        return ['Deleted'];
    
        
    }
}
