@props(['name', 'placeholder'])

<textarea rows="5" required id="{{ $name }}" name='{{ $name }}' class="form-control width-100%" placeholder="{{ $placeholder }}" minlength="20"></textarea>
<p class="text-xs color-contrast-medium margin-top-xxs">At least 10 characters.</p>
<div role="alert" class="form-validate__error-msg bg-error bg-opacity-20% padding-x-xs padding-y-xxs radius-md text-xs color-contrast-higher margin-top-xxs"><p>Must be at least 10 characters.</div>

@error($name)
<strong>{{ $message }}</strong>
@enderror