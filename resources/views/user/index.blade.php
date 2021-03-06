@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <h1 class="text-center p-2">Gente</h1>
        </div>

        <div class="col-md-8">
            <form action="{{route('user.search')}}" method="GET" class="mt-3">
                @csrf
                    <div class="row">
                        <div class="form-group mb-2 col-9 col-md-10">
                            <input type="text" class="form-control" id="search" name="search" placeholder="Buscador de usuarios..." required>
                        </div>
                        
                        <div class="form-group col-3  col-md-2">
                            <button type="submit" class="btn btn-secondary btn-block mb-2">Buscar</button>
                        </div>
                    </div>
            </form>
        </div>

        <div class="col-md-8">
            
            <div class="content__user-perfil text-center mb-4">
                @foreach ($users as $user)
                    <div class="row content__users mt-3">
                        
                        {{-- Image --}}
                        <div class="col-4 mb-3">
                            <div class="user-image-perfil">
                                @php
                                    $srcImg = Storage::disk('users')->exists($user->image) ? route('user.avatar', ['filename' => $user->image]) : asset('img/img-perfil.png');
                                @endphp
                                
                                <img src="{{$srcImg}}" alt="avatar" class="img-fluid">
                            </div>
                        </div>
                        
                        {{-- Info --}}
                        <div class="col-8 user-info-perfil">
                            <a href="{{route('user.profile', ['id'=>$user->id])}}">
                                <h2>{{ucfirst($user->name). " ".ucfirst($user->surname)}}</h2>
                                <h3>{{"@".ucfirst($user->nick)}}</h3>
                                <h4>
                                    Se unió el {{ \Carbon\Carbon::parse($user->created_at)->month."/".\Carbon\Carbon::parse($user->created_at)->year }}
                                </h4>
                            </a>
                        </div>
                        
                    </div>
                    <hr>
                @endforeach
            </div>
        
            {{-- Paginación --}}
            @include('includes.pagination', ['datos' => $users])
        
        </div>
    </div>
</div>
@endsection
