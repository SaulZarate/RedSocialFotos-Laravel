
@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <h1 class="text-center mb-3">Imagenes favoritas</h1>

                @foreach ($likes as $like)
                    
                    @include( 'includes.image', ['image' => $like->image] )

                @endforeach

                {{-- Paginación --}}
                @include('includes.pagination', ['datos' => $likes])

            </div>
        </div>
    </div>

@endsection