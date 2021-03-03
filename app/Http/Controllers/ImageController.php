<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ImageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function save(Request $request){
        
        // Datos del formulario
        $description = $request->input('description');
        $image_path = $request->file('image_path');

        // Validacion
        $validate = $this->validate($request, [
            'description' => ['required'],
            'image_path' => ['required','image'],
        ]);

        // Usuario
        $user = Auth::user();

        // Modelo
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;
        
        // Subir la imagen
        if( $image_path != null ){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        
        // Guardo en la DB
        $image->save();
        
        return redirect()->route('home')->with( 'message','La imagen ha sido subida correctamente');
    }

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id){
        $image = Image::find($id);
        return view('image.detail', [
            'image' => $image
        ]);
    }

    public function delete($id){

        $user = Auth::user();
        $image = Image::find($id);

        $message = "No se pudo borrar la imagen";
        // Verifico que el usuario sea el dueño de la imagen/publicacion
        if( $user && $image && $image->user->id == $user->id){

             //Eliminar likes
            $image->likes()->delete();
    
            //Eliminar comments
            $image->comments()->delete();
    
            //Eliminar imagen
            $image->delete();

            // Eliminar imagen del Storage
            Storage::disk('images')->delete($image->image_path);
        
            $message = "Se borro la imagen correctamente";
        }

        return redirect()->route('home')->with(['message' => $message]);
    }
    
    public function edit($id){

        $user = Auth::user();
        $image = Image::find($id);

        if( $user && $image && $image->user->id == $user->id){
            return view('image.edit', compact('image'));
        }else{
            return redirect()->route('home');
        }
    }

    public function update(Request $request){

        // Validacion
        $validate = $this->validate($request, [
            'description' => ['required'],
            'image_path' => ['image'],
        ]);

        $image_id = $request->input('image_id');
        $description = $request->input('description');
        $image_path = $request->file('image_path');

        // Busco la image en la DB
        $image = Image::find($image_id);
        $image->description = $description;
        $image_antigua = $image->image_path;

        // Subir la imagen y eliminarla del storage
        if( $image_path != null ){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        
            // Eliminar imagen del Storage
            if($image_antigua){
                Storage::disk('images')->delete($image_antigua);
            }
        }



        // Actualizar registro
        $image->update();

        return redirect()->route('image.detail', ['id' => $image->id])->with(['message'=>'Imagen actualizada con exito']);

    }
}
