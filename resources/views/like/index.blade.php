
@extends('layouts.app')

@section('content')
    
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @if ($likes && count($likes) > 0)
                    
                    <h1 class="text-center mb-3 border py-2">Imagenes favoritas</h1>

                    {{-- Images favoritas --}}
                    @foreach ($likes as $like)
                        @include( 'includes.image', ['image' => $like->image] )
                    @endforeach

                    {{-- Paginación --}}
                    @include('includes.pagination', ['datos' => $likes])

                @else
                    <h1 class="text-center mt-3 ">No tenes imagenes favoritas</h1>
                @endif
                
            </div>
        </div>
    </div>

@endsection