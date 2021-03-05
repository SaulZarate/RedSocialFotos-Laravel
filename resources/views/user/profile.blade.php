
@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row justify-content-center">

            {{-- Profile User --}}
            <div class="col-md-3 pt-3 border mb-2 mb-md-0">
                <div class="row content__user-perfil text-center">
                    {{-- Image --}}
                    <div class="col-12 mb-3">
                        <div class="user-image-perfil">
                            @php
                                $srcImg = Storage::disk('users')->exists($user->image) ? route('user.avatar', ['filename' => $user->image]) : asset('img/img-perfil.png');
                            @endphp
                            
                            <img src="{{$srcImg}}" alt="avatar" class="img-fluid">
                        </div>
                    </div>
                    
                    {{-- Info --}}
                    <div class="col-12 user-info-perfil">
                        <h1>{{ucfirst($user->name). " ".ucfirst($user->surname)}}</h1>
                        <h2>
                            {{"@".ucfirst($user->nick)}}
                        </h2>
                        <h3>
                            Se unió el {{ \Carbon\Carbon::parse($user->created_at)->month."/".\Carbon\Carbon::parse($user->created_at)->year }}
                        </h3>
                    </div>
                </div>
            </div>

            {{-- Publicaciones/Imagenes --}}
            <div class="col-md-9">
                <h1 class="text-center border p-2">Publicaciones</h1>
                @foreach ($user->images as $image)
                    @include('includes.image', [ 'image' => $image])
                @endforeach
            </div>

        </div>
    </div>

@endsection