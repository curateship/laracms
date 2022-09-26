@extends(config('theme.admin_app_template'))

@section('content')
<!-- Post Image With Gradiant -->
<figure class="card__img img-blend opacity-20%" data-blend-pattern="0,0,1,0" data-blend-color="--color-bg-light" data-blend-height="100%">
    <img class="radius-md post-image" src="https://codyhouse.co/app/assets/img/how-it-works-v4-img-1.jpg" alt="Card preview img">
</figure>

<!-- Post Body -->
<div class="post-content padding-md">
  <div class="flex">
    <div class="post-content">
        <div class="margin-top-md">{!! $contest->getContent() !!}</div>
    </div>
  </div>
</div>
@endsection


