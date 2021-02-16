
@isset ($user->image)

<div class="container-avatar">
    <img src="{{ route('user.avatar',['filename'=>$user->image])}}" alt="" class="avatar">
</div>

@endisset