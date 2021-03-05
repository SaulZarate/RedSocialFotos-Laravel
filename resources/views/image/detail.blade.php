@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                
            @include('includes.message')

            {{-- Card de Image --}}
            <div class="card pub_image pub_image_detail">

                {{-- Card header --}}
                <div class="card-header">
                    {{-- Datos dueño de la imagen --}}
                    <div class="d-flex align-items-center">
                        {{-- Avatar del usuario --}}
                        @if ($image->user->image)
                        <div class="container-avatar border mr-3">
                            <img src="{{ route('user.avatar',['filename' => $image->user->image]) }}" alt="avatar" class="avatar">
                        </div>
                        @endif

                        {{-- Enlace al usuario --}}
                        <div class="data-user">
                        <a href="{{route('image.detail', [ 'id' => $image->id])}}">
                            {{ ucfirst($image->user->name).' '.ucfirst($image->user->surname) }}
                            <span class="nick-name">{{' | @'.$image->user->nick}}</span>
                        </a>
                        </div>
                    </div>
                    {{-- Fecha publicacion --}}
                    <div class="d-flex align-items-center ">

                        <p class="date-pub mr-3">{{ \Carbon\Carbon::now()->locale('es_AR')->diffForHumans($image->created_at) }}</p>

                        {{-- Actions de la imagen (publicacón) --}}
                        @if ( $image->user->id === Auth::user()->id && Auth::user() )
                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('image.edit', ['id'=>$image->id])}}">Editar</a>
                                    {{-- <a class="dropdown-item" href="#">Borrar</a> --}}

                                    <!-- Button Modal-->
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal{{time()}}">
                                        Borrar publicación
                                    </button>

                                </div>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="modal{{time()}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{time()}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{time()}}">Confirmación</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Si eliminas esta imagen no podras recuperarla. ¿ Esta seguro ?
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{route('image.delete', ['id' => $image->id])}}" class="btn btn-danger">Eliminar</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                        
                    </div>
                </div>

                {{-- Card body --}}
                <div class="card-body">

                    {{-- Imagen --}}
                    <div class="image-container image-detail">
                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="foto del usuario {{$image->user->name}}">
                    </div>
                    
                    {{-- Texto --}}
                    <div class="description">

                        {{-- Nick --}}
                        <span class="nick-name">{{'@'.$image->user->nick}}</span>

                        {{-- Likes --}}
                        <div class="likes">
                            @if ( $image->likes->where('user_id',\Auth::user()->id)->count() == 1 )
                                <img data-id="{{$image->id}}" src="{{asset('img/hearts-red.png')}}" alt="corazon rojo" class="btn-dislike">
                            @else
                                <img data-id="{{$image->id}}" src="{{asset('img/hearts-gray.png')}}" alt="corazon gris" class="btn-like">
                            @endif
                            <span class="number_likes">{{ count($image->likes) }}</span>
                        </div>

                        {{-- Description --}}
                        <p>{{ ucfirst($image->description) }}</p>

                        
                            <div class="actions m-0">
                                {{-- <a href="{{route('image.edit', ['id'=>$image->id])}}" class="btn btn-sm btn-success">Editar publicación</a> --}}

                                {{-- <!-- Button Modal-->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal{{time()}}">
                                    Borrar publicación
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="modal{{time()}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{time()}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{time()}}">Confirmación</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Si eliminas esta imagen no podras recuperarla. ¿ Esta seguro ?
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{route('image.delete', ['id' => $image->id])}}" class="btn btn-danger">Eliminar</a>
                                        </div>
                                        </div>
                                    </div>
                                </div> --}}

                            </div>
                        

                        <hr>

                        {{-- Boton de comentarios --}}
                        <div class="commets">
                            <h2>Comentarios ({{ count($image->comments)}})</h2>
                            
                            {{-- Comment --}}
                            @foreach ($image->comments as $comment)
                                {{-- link user --}}
                                <div class="data-user content-comment-image-detail">
                                    {{'@'.$comment->user->nick}} 
                                    <span class="nick-name">
                                        | {{ \Carbon\Carbon::now()->locale('es_AR')->diffForHumans($comment->created_at) }}
                                    </span>
                                </div>
                                {{-- Comment --}}
                                <p>{{ucfirst($comment->content)}}
                                    {{-- Eliminar comentario--}}
                                    @if( Auth::check() && ($comment->user_id == Auth::user()->id || (($comment->image) && $comment->image->user_id == Auth::user()->id)) )
                                        <br>
                                        <a href="{{route('comment.delete', ['id'=>$comment->id])}}" class="btn btn-outline-danger btn-sm mt-2">
                                            Eliminar
                                        </a>
                                    @endif
                                </p>
                            @endforeach

                            <hr> {{-- Separador --}}

                            {{-- Formulario comentario --}}
                            <form action="{{route('comment.save')}}" method="POST">
                                @csrf
                                <input type="hidden" name="image_id" value="{{$image->id}}">

                                <div class="form-group">
                                    <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="3"></textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary">Comentar</button>
                                </div>
                            </form>

                        </div>

                    </div>
                    
                </div>
            </div>
        
        </div> {{-- Fin col-md-8 --}}
    </div>
</div>
@endsection
