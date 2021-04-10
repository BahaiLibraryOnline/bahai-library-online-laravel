@php $editing = isset($language) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="language"
            label="Language"
            value="{{ old('language', ($editing ? $language->language : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="language_tag"
            label="Language Tag"
            value="{{ old('language_tag', ($editing ? $language->language_tag : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
