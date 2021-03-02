
@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row justify-content-center">

            {{-- Profile User --}}
            <div class="col-md-3 px-3 mt-3">
                    
                <div class="row content__user-perfil text-center">
                    {{-- Image --}}
                    <div class="col-12 mb-3">
                        @if ($user->image)
                            <div class="user-image-perfil">
                                <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" alt="avatar" class="img-fluid">
                            </div>
                        @endif
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

            <div class="col-md-9">
                @foreach ($user->images as $image)
                    @include('includes.image', [ 'image' => $image])
                @endforeach
            </div>

        </div>
    </div>

@endsection