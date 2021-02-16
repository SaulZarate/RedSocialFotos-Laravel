<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    public function __construct(){
        // Redirecciona al usuario al login si no esta logeado
        // Funciona para todos los metodos del controlador
        $this->middleware('auth');
    }

    public function config(){
        $user = Auth::user();
        return view('user.config', compact('user'));
    }

    public function update(Request $request){

        // ID Usuario
        $id = Auth::user()->id;
        
        // Validacion del formulario
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => 'required|string|max:191|unique:users,nick,'.$id, // indico que el nick sea unico y que puede ser el que tiene
            'email' => 'required|string|max:191|unique:users,email,'.$id,
            ]);
            
        // Obtener datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');
        
        // Usuario actual
        $user = User::find($id);

        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;
        
        // Subir la imagen
        $image_path = $request->file('image_path');

        // Si envio una imagen
        if($image_path != null){
            // Creo un nombre unico
            $image_path_name = time().$image_path->getClientOriginalName(); 

            // Guardo en la carpeta storage/app/users
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            
            // Seteo el nombre de la imagen en la DB
            $user->image = $image_path_name;
            
        }
        
        // Guardo los datos
        $user->update();

        // Redirecciono
        return redirect()->route('config')->with('message' , 'Usuario actualizado correctamente');
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
}
