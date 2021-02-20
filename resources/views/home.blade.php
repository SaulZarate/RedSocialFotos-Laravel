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
                @include('includes.image', ['image' => $image])
            @endforeach
        
            {{-- Paginación --}}
            @include('includes.pagination', ['datos' => $images])
        
        </div>
    </div>
</div>
@endsection
