@props([
    'label' => '',
    'name',
    'type' => 'text',
    'id' => $name,
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'min' => '',
])

<div class="flex flex-col gap-y-2">
    @if($label) <label for="{{ $id }}" class="self-start font-semibold text-sm md:text-base">{{ $label }}</label> @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($value) value="{{ $value }}" @endif
        @if($min) min="{{ $min }}" @endif
        @if($required) required @endif
        class="px-3 py-2 border border-black/10 rounded"
    />
    <x-input-error :messages="$errors->get($name)"/>
</div>
