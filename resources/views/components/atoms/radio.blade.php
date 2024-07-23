@props([
    'selected' => false,
])

<input type="radio" {{ $attributes }} @if($selected) checked @endif>
<label for="{{ $attributes->get("id") }}" class="radio" @if($attributes->has('disabled')) aria-disabled="true" @endif>
  {{ $slot }}
</label>
