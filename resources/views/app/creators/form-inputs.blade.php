@php $editing = isset($creator) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="first_names"
            label="First Names"
            value="{{ old('first_names', ($editing ? $creator->first_names : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="last_names"
            label="Last Names"
            value="{{ old('last_names', ($editing ? $creator->last_names : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="author"
            label="Author"
            :checked="old('author', ($editing ? $creator->author : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="editor"
            label="Editor"
            :checked="old('editor', ($editing ? $creator->editor : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="translator"
            label="Translator"
            :checked="old('translator', ($editing ? $creator->translator : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="compiler"
            label="Compiler"
            :checked="old('compiler', ($editing ? $creator->compiler : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
