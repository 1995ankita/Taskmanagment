<?php

namespace App\Http\Controllers;
use App\Models\Board;
use App\Models\project;
use Illuminate\Http\Request;


class BoardController extends Controller
{
    public function index(Request $request, $id)
    {
        $boards = Board::all();
        return view('project.board.list', compact('boards','id'));
    }
    public function create($id)
    {
        $projects = project::all();
        return view('project.board.create',compact('projects','id'));
    }
    public function store($id,Request $request)
    {

        Board::create([
            'name' => $request->name,
            'project_id'=>$id
        ]);
        session()->flash('success', 'Board created successfully.');
        return redirect()->route('project.board.index',$id);
    }
    public function edit($boardId,Board $board)
    {

        return view('project.board.edit', compact('board','boardId'));
    }

    public function update($id,Request $request, Board $board)
    {
        $board->update([
            'name' => $request->name,
            'project_id'=>$id

        ]);
        session()->flash('success', 'Board updated successfully.');
        return redirect()->route('project.board.index',$id);
    }
    public function destroy($boardId,Board $board)
    {
        $board->delete();
        return redirect()->route('project.board.index',$boardId)->with('success', 'Board deleted successfully.');
    }
}
