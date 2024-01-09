<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index(Request $request,$projectId,$boardId)
    {
        $forms = Task::all();
        return view('project.board.task.index', compact('forms','boardId','projectId'));
    }


    public function create(Request $request,$projectId, $boardId)
    {
        //print_r($request);
        // $item = new Task();
        // $item->name = $request->name;
        // $item->content = $request->form;
        // $item->project_id = $projectId;
        // $item->board_id = $boardId;
        // $item->save();

        // return response()->json('added successfully');
        return view('project.board.task.create',compact('projectId','boardId'));
    }
    public function store(Request $request, $projectId, $boardId) {
        $item = new Task();
        $item->name = $request->name;
        $item->content = $request->form;
        $item->project_id = $projectId;
        $item->board_id = $boardId;
        $item->save();
        return response()->json('added successfully');

    }

    // public function edit($projectId, $boardId, $taskId, Request $request)
    // {
    //     // Fetch the task details by ID
    //     $task = Task::findOrFail($taskId);

    //     return response()->json([
    //         'taskId' => $taskId,
    //         'projectId' => $projectId,
    //         'boardId' => $boardId,
    //         'task' => $task,
    //        //'formBuilderData' => $formBuilderData,
    //    ]);

    //     // Return the view with task details
    //    // return view('project.board.task.edit', compact('taskId', 'projectId', 'boardId', 'task'));
    // }

    public function editData(Request $request){
        return Task::where('id', $request->id)->first();

    }
    public function update(Request $request)
    {
        $item = Task::findOrFail($request->id);
        $item->name =$request->name;
        $item->content = $request->form;
        $item->update();
        return response()->json('updated successfully');
    }

    // public function destroy($id)
    // {
    //     $form = Task::findOrFail($id);
    //     $form->delete();

    //     return redirect('form-builder')->with('success', 'Form deleted successfully');
    // }
}
