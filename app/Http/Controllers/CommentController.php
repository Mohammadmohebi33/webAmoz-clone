<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        if (auth()->user()->userHasRole('admin')){
            $comments = Comment::query()->where('status' , 'pending')->latest()->paginate(30);
        }else{
            foreach (\auth()->user()->courses as $course)
            {
                $comments = $course->comments()->where('status' , 'pending')->latest()->paginate(30);
            }
        }
        return view('panel.comments.index' , compact('comments'));
    }


    public function activeComments()
    {
        if (auth()->user()->userHasRole('admin')){
            $comments = Comment::query()->where('status' ,'active')->latest()->paginate(30);
        }else{
            foreach (\auth()->user()->courses as $course)
            {
                $comments = $course->comments()->where('status' , 'active')->latest()->paginate(30);
            }
        }

        return view('panel.comments.index' , compact('comments'));
    }


    public function rejectComments()
    {
        if (auth()->user()->userHasRole('admin')){
            $comments = Comment::query()->where('status' , 'deactivate')->latest()->paginate(30);
        }else{
            foreach (\auth()->user()->courses as $course)
            {
                $comments = $course->comments()->where('status' , 'deactivate')->latest()->paginate(30);
            }
        }
        return view('panel.comments.index' , compact('comments'));
    }



    public function store(Request $request)
    {
        auth()->user()->comments()->create([
            'body' => $request->comment,
            'course_id' => $request->course_id,
            'parent_id' => $request->parent_id,
        ]);
        return back();
    }



    public function changeStatus(Comment $comment , string $status)
    {
        $this->authorize('can-comment' , $comment);
        if ($status == Comment::CONFIRM){
            $comment->update([
                'status' => 'active'
            ]);
        }elseif ($status == Comment::REJECT){
            $comment->update([
                'status' => 'deactivate',
            ]);
        }

        return back();
    }
}
