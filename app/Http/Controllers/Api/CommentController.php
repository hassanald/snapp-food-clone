<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'food_id' => 'required_without:restaurant_id',
            'restaurant_id' => 'required_without:food_id',
        ]);

        $comments = Comment::with('user' , 'cart.cartItems')
            ->where('status' , Comment::APPROVE)
            ->when($request->filled('food_id') , function ($query) use ($request){
                $query->whereRelation('cart.cartItems.food' , 'food_id' , '=' , $request->food_id);})
            ->when($request->filled('restaurant_id') , function ($query) use ($request){
                $query->whereRelation('cart' , 'restaurant_id' , '=' , $request->restaurant_id);})
            ->get();

        return response()->json(['comments' => CommentResource::collection($comments)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $cart = auth()->user()->carts()->find($request->validated('cart_id'));
        if (!$cart){
            return response()->json(['message' => 'Not Found'] , 404);
        }

        $comment = $cart->comments()->create([
            'score' => $request->validated('score'),
            'user_id' => auth()->user()->id,
            'content' => $request->validated('content')
        ]);

        return response()->json([
            'comment' => CommentResource::make($comment->load('user' , 'cart.cartItems.food')),
            'message' => 'Comment has been created successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
