@extends('theme.default.layouts.app')
@section('content')
<!-- Contact Form Wrapper Start 👇-->
<div class="container max-width-xs margin-top-xxl card padding-lg">

<!-- Contact Form Content 👇-->
<form action="{{ route('contact.store') }}" method="POST">@csrf
  <form class="sign-up-form padding-lg">

    <div class="text-component text-center margin-bottom-sm">
      <h1>Contact Us</h1>
    </div>

    <div class="grid gap-xs">
    <div class="padding-bottom-sm col-7@md">
      <x-form.input value='{{ old("first_name") }}' name="first_name" placeholder="Your First Name"/>
    </div>

    <div class="padding-bottom-sm col-8@md">
    <x-form.input value='{{ old("last_name") }}' name="last_name" placeholder="Your Last Name"/>
    </div>
    </div>

    <div class="margin-bottom-sm">
    <x-form.input value='{{ old("email") }}' type="email" name="email" placeholder="Your Email"/>
    </div>

    <div class="padding-bottom-sm">
    <x-form.input required="false" type="name" name="subject" placeholder="Your Subject"/>
    </div>

    <div class="form-validate__input-wrapper js-form-validate__input-wrapper">

    <x-form.text-area name="message" placeholder="Enter Your Messages"/>
    </div>


    <div class="margin-bottom-sm margin-top-md">
      <button class="btn btn--primary btn--md width-25%">Submit</button>
    </div>

  </form>
</form>
<!-- Contact Form Content END -->

</div>
<!-- Contact Form Wrapper END-->
@endsection
