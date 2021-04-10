@php $editing = isset($search) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.textarea name="query" label="Query" maxlength="255"
            >{{ old('query', ($editing ? $search->query : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
