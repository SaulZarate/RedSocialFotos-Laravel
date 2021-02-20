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
                    <div>
                        <p class="date-pub">{{ \Carbon\Carbon::now()->locale('es_AR')->diffForHumans($image->created_at) }}</p>
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
                        {{-- <div class="likes">
                            <img src="{{asset('img/hearts-gray.png')}}" alt="corazon">
                        </div> --}}
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
                                        <br><a href="{{route('comment.delete', ['id'=>$comment->id])}}">Eliminar comentario...</a>
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
                                    <button type="submit" class="btn btn-sm btn-secondary">Comentar</button>
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
