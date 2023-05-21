<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index(){
        $restaurants = Restaurant::where('user_id' , auth()->user()->id)->get();
        $comments = Comment::with('cart.restaurant','cart.cartItems.food' , 'user')
            ->where('deleted_at' , null)
            ->whereRelation('cart' , function ($query){
                $query->whereRelation('restaurant' , 'user_id' , '=' , auth()->user()->id);
            })
            ->when(\request()->filled('restaurant') , function ($query){
                $query->whereRelation('cart.restaurant' , 'name' , 'LIKE' , \request('restaurant'));
            })
            ->paginate(10);

        return view('seller.comment.index' , compact('comments' , 'restaurants'));
    }

    public function approve(Comment $comment){
        $comment->update([
            'status' => Comment::APPROVE
        ]);

        return redirect()->back()->with('success' , 'Comment status has been changed to approve successfully.');
    }

    public function pending(Comment $comment){
        $comment->update([
            'status' => Comment::PENDING
        ]);

        return redirect()->back()->with('success' , 'Comment status has been changed to pending successfully.');
    }

    public function deleteReq(Comment $comment){
        $comment->update([
            'status' => Comment::DELETE_REQ
        ]);

        return redirect()->back()->with('success' , 'Delete request has been sent successfully!');
    }

    public function response(Comment $comment , Request $request){
        $validator = Validator::make($request->all() , [
            'answer' => 'required|min:5'
        ]);
        if ($validator->fails()){
            return redirect()->back()->with('danger' , $validator->errors()->first());
        }
        $comment->update([
            'answer' => $request->get('answer')
        ]);

        return redirect()->back()->with('success' , 'Your response has been sent successfully!');
    }
}
