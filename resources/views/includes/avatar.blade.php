

<div class="container-avatar">
    @php
        $srcImg = Storage::disk('users')->exists( (Auth::user())->image ) ? route('user.avatar', ['filename' => (Auth::user())->image ]) : asset('img/img-perfil.png');
    @endphp

    <img src="{{ $srcImg }}" alt="avatar" class="avatar rounded">
</div>