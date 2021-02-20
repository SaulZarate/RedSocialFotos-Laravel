@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            {{-- Alert --}}
            @include('includes.message')
            
            {{-- Message status --}}
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Publicaciones de todos los usuario --}}
            @foreach ($images as $image)
                
                <div class="card pub_image">

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
                            <div class="data-user home-data-user">
                                <a href="">
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

                    <div class="card-body">
                        {{-- Imagen --}}
                        <div class="image-container">
                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="foto del usuario {{$image->user->name}}">
                        </div>
                        
                        {{-- Texto --}}
                        <div class="description">

                            {{-- Nick --}}
                            <span class="nick-name">{{'@'.$image->user->nick}}</span>

                            {{-- Likes --}}
                            <div class="likes">
                                <img src="{{asset('img/hearts-gray.png')}}" alt="corazon">
                            </div>

                            {{-- Description --}}
                            <p>{{ ucfirst($image->description) }}</p>

                            {{-- Boton de comentarios --}}
                            <a href="{{route('image.detail', [ 'id' => $image->id])}}" class="btn btn-sm btn-secondary">Comentarios ({{ count($image->comments)}})</a>
                        </div>
                        
                    </div>
                </div>
            @endforeach
        
            {{-- Paginación --}}
            <div class="d-flex justify-content-center">
                {{ $images->links() }}
            </div>
        
        </div> {{-- Fin col-md-8 --}}
    </div>
</div>
@endsection
