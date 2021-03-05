
<div class="card pub_image">

    <div class="card-header">
        {{-- Datos dueño de la imagen --}}
        <div class="d-flex align-items-center">
            
            {{-- Avatar del usuario --}}
            <div class="container-avatar border mr-3">
                @php
                    $srcImg = Storage::disk('users')->exists( $image->user->image ) ? route('user.avatar',['filename' => $image->user->image]) : asset('img/img-perfil.png');
                @endphp
                <img src="{{ $srcImg }}" alt="avatar" class="avatar">
            </div>
                
            {{-- Enlace al usuario --}}
            <div class="data-user home-data-user">
                <a href="{{ route('user.profile', ['id' => $image->user->id ]) }}">
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
                @if ( $image->likes->where('user_id',\Auth::user()->id)->count() == 1 )
                    <img data-id="{{$image->id}}" src="{{asset('img/hearts-red.png')}}" alt="corazon" class="btn-dislike">
                @else
                    <img data-id="{{$image->id}}" src="{{asset('img/hearts-gray.png')}}" alt="corazon" class="btn-like">
                @endif
                <span class="number_likes">{{ count($image->likes) }}</span>
            </div>

            {{-- Description --}}
            <p>{{ ucfirst($image->description) }}</p>

            {{-- Boton de comentarios --}}
            <a href="{{route('image.detail', [ 'id' => $image->id])}}" class="btn btn-sm btn-secondary">Comentarios ({{ count($image->comments)}})</a>
        </div>
        
    </div>
</div>