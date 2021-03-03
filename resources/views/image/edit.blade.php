@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                
                <div class="card">
                    <div class="card-header">Editar imagen</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('image.update')}}" enctype="multipart/form-data">
                            @csrf
                            
                            <input type="hidden" name="image_id" value="{{$image->id}}">

                            {{-- Imagen --}}
                            <div class="form-group row">
                                <label for="image_path" class="col-md-3 col-form-label text-md-right">{{ __('Imagen') }}</label>
                                <div class="col-md-7">
                                    <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="foto del usuario {{$image->user->name}}" class="img-fluid mb-2 rounded border">
                                    {{-- Input file --}}
                                    <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path" autocomplete="image_path">
                                    {{-- Error de validacion --}}
                                    @error('image_path')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Descripcion --}}
                            <div class="form-group row">
                                <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Descripcion') }}</label>
                                <div class="col-md-7">
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" cols="30" rows="4">{{$image->description ?? ""}}</textarea>
                                    
                                    {{-- Error de validacion --}}
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Boton --}}
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection