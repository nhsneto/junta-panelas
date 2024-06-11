@props([
    'label',
    'name',
    'type' => 'text',
    'id' => $name,
    'placeholder' => '',
    'value' => '',
    'required' => false,
])

<div class="flex flex-col gap-y-2">
    <label for="{{ $id }}" class="font-semibold">{{ $label }}</label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id }}"
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
        {{ $required ? 'required' : '' }}
        class="px-3 py-2 border border-black/10 rounded"
    />
    <x-input-error :messages="$errors->get($name)"/>
</div>
