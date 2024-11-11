<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\CommentReply;
use App\Models\Comment;

class CommentController extends Controller
{
     // عرض جميع التعليقات الخاصة بعقار معين
     public function index($propertyId)
     {
         $comments = Comment::where('property_id', $propertyId)->get();
         return view('admin.comments.index', compact('comments'));
     }
 

     public function store(Request $request, $propertyId)
     {
         $request->validate([
             'comment' => 'required|string|max:1000',
         ]);
     
         $comment = Comment::create([
             'comment' => $request->comment,
             'user_id' => auth()->id(),
             'property_id' => $propertyId,
             'parent_comment_id' => $request->parent_comment_id,
         ]);
     
         if ($comment->parent_comment_id) {
             $parentComment = $comment->parent;
             $parentComment->user->notify(new CommentReply($comment));
         }
     
         return redirect()->route('comments.index', $propertyId);
     }

     // تعديل تعليق
     public function edit($id)
     {
         $comment = Comment::findOrFail($id);
         return view('admin.comments.edit', compact('comment'));
     }
 
     public function update(Request $request, $id)
     {
         $request->validate([
             'comment' => 'required|string|max:1000',
         ]);
 
         $comment = Comment::findOrFail($id);
         $comment->update([
             'comment' => $request->comment,
         ]);
 
         return redirect()->route('comments.index', $comment->property_id)->with('success', 'تم تعديل التعليق بنجاح');
     }
 
     // حذف تعليق
     public function destroy($id)
     {
         $comment = Comment::findOrFail($id);
         $propertyId = $comment->property_id;
         $comment->delete();
 
         return redirect()->route('comments.index', $propertyId)->with('success', 'تم حذف التعليق بنجاح');
     }
}
