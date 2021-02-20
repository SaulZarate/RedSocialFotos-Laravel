<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        // User
        $user = Auth::user();
        // Likes
        /* $likes = Like::orderBy('id','desc')->paginate(5); */
        $likes = Like::where('user_id',$user->id)
                        ->orderBy('id','desc')
                        ->paginate(5);
        // Vista
        return view('like.index', ['likes' => $likes]);
    }

    public function like($image_id){
        // Usuario logeado
        $user = Auth::user();

        // Verifico si ya existe el like
        $isset_like = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->count();
        
        if($isset_like == 0){
            // Modelo 
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;

            $like->save();

            return response()->json([
                'like' => true,
                'data' => $like,
                'message' => 'Le diste like'
            ]);

        }else{
            return response()->json([
                'like' => false,
                'message' => "Tiene like",
            ]);
        }
        
    }

    public function dislike($image_id){
        // Usuario logeado
        $user = Auth::user();

        // Verifico si ya existe el like
        $like = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->first();

        if($like){
            // Eliminar
            $like->delete();

            return response()->json([
                'dislike' => true,
                'data' => $like,
                'message' => 'Le has dado dislike'
            ]);

        }else{
            return response()->json([
                'dislike' => false,
                'message' => "No tiene like",
            ]);
        }
    }


}
