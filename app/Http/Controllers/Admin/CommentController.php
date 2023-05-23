<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        $restaurants = Restaurant::all();
        $status = null;
        if (\request()->filled('status')){
            switch (\request('status')){
                case "pending":
                    $status = Comment::PENDING;
                break;
                case "approve":
                    $status = Comment::APPROVE;
                break;
                case "delete-req":
                    $status = Comment::DELETE_REQ;
                break;
            }
        }

        $comments = Comment::with('cart.restaurant','cart.cartItems.food' , 'user')
            ->where('deleted_at' , null)
            ->when(\request()->filled('restaurant') , function ($query){
                $query->whereRelation('cart.restaurant' , 'name' , 'LIKE' , \request('restaurant'));
            })
            ->when(\request()->filled('status') , function ($query) use ($status){
                $query->where('status' , $status);
            })
            ->paginate(10);

        return view('admin.comment.index' , compact('comments' , 'restaurants'));
    }

    public function destroy(Comment $comment){
        $comment->delete();
        return redirect()->back()->with('success' , 'Comment has been deleted successfully');
    }
}
