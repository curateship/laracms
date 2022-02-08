@props(['type' => 'text', 'name', 'placeholder', 'required' => 'true', 'value'])

<input value='{{ $value }}' {{ $required == 'true' ? 'required' : '' }} type="{{ $type }}" id="{{ $name }}" name='{{ $name }}' class="form-control width-100%" placeholder="{{ $placeholder }}">

@error('name')
 <span class="form-control--error" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
