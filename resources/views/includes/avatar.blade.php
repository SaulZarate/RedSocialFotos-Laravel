

@isset ( (Auth::user())->image )

    <div class="container-avatar">
        <img src="{{ route('user.avatar',['filename' => (Auth::user())->image]) }}" alt="avatar" class="avatar">
    </div>

@endisset