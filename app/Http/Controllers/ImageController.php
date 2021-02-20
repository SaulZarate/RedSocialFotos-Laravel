<?php

namespace App\Http\Controllers;

use App\Models\Image;
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
}
