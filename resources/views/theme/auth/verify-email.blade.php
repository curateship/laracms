@extends('themes.layouts.app')
@section('content')

<div class="container max-width-xs margin-top-xxl padding-lg card">
  @include('components.auth.verify-email')
</div>

@endsection