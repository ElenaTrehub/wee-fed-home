<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user = Auth::user();

        if($user && $user->can("create", Comment::class)) {
            $comment= Comment::create([
                'idUser' =>Auth::user()->id,
                'idRecipe' => $request->get('recipeId'),
                'commentText' => $request->get('comment')

            ]);
            if(!$comment){
                return redirect()->back();
            }
            $request->session()->flash('flash_message', 'Комментарий успешно добавлен!');
            return redirect()->back();
        }
      else{
          return view('auth.login');
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo('jbwlbhrwlihbq');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $user = Auth::user();
        if(!$user){
            return view('auth.login');
        }
        if($user->can("delete", $comment)) {
            $comment->delete();

            return redirect()->back();
        }
        else{
            return redirect()->back();

        }
    }
    public function showComments(Request $request){

        $offset = $request->input('offset');
        $limit = $request->input('limit');
        //dd($offset);
        $comments = Comment::with('user')->orderBy('createdAt', 'desc')->skip($offset)->take($limit)->get();
        if(count($comments)>0){
            $context = [
                'comments'=>$comments
            ];
            //dd($context);
            return $context;
        }
        else{
            return 0;
        }
    }//showMoreComments
}
