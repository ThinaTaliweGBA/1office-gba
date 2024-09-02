<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'text' => 'required|string',
            'author' => 'required|string',
            'link' => 'nullable|string',
            'users_id' => 'required|integer',
            'model_name'=> 'required|string',
            'model_record' => 'required|integer',
        ]);

        $Comment = new Comment();
        $Comment->users_id = auth()->user()->id;
        $Comment->author = $request->author;
        $Comment->link = $request->link;
        $Comment->model_name = $request->model_name;
        $Comment->model_record = $request->model_record;

          // Format text field as JSON
        $Comment->text = json_encode(['id' => time(), 'title' => $request->text]);

            
        $Comment->save();

        return back()->with('success', 'Comment added successfully!');
    }

    public function edit(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        //dd($comment);
        return response()->json($comment);
        //return view('edit_comment', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        //dd(Comment::findOrFail($id));
        $request->validate([
            'text' => 'required|string',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->text = json_encode(['id' => time(), 'title' => $request->text]);
    

        $comment->save();

        return back()->with('success', 'Comment updated successfully!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully!');
    }

}
