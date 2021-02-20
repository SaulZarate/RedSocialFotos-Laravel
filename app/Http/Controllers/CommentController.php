<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function save(Request $request){
        
        // Usuario
        $user = Auth::user();

        // Datos del formulario
        $content = $request->input('content');
        $image_id = $request->input('image_id');
        
        // Validacion
        $validate = $this->validate($request, [
            'image_id' => ['integer','required'],
            'content' => ['string','required']
        ]);

        // Modelo 
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        // Guardo en la DB
        $comment->save();
    
        return redirect()->route('image.detail', [
            'id' => $image_id
        ])->with('message','Su comentario se ha agregado');
    }

    public function delete($id){
        
        // Usuario logeado
        $user = Auth::user();

        // Comentario
        $comment = Comment::find($id);

        // Comprobar si es el dueño del commentario o de la publicacion
        if( $user && ($comment->user_id == $user->id || (($comment->image) && $comment->image->user_id == $user->id)) ){
            // Borro el comentario
            $comment->delete();
        
            return redirect()->route('image.detail', [$comment->image->id])->with('message','Comentario eliminado');
        }else{
            return redirect()->route('image.detail', [$comment->image->id])->with('message','No tiene autorizacion para eliminar el comentario');
        }
    }
}
