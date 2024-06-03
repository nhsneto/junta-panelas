@props(['label', 'type' => 'text', 'name', 'id' => $name])

<div class="flex flex-col gap-y-2">
    <label for="{{ $id }}" class="font-semibold">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" class="px-3 py-2 border border-black/10 rounded" />
</div>
