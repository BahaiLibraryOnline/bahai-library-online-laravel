@php $editing = isset($edition) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            value="{{ old('title', ($editing ? $edition->title : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="subtitle"
            label="Subtitle"
            value="{{ old('subtitle', ($editing ? $edition->subtitle : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title_parent"
            label="Title Parent"
            value="{{ old('title_parent', ($editing ? $edition->title_parent : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="volume"
            label="Volume"
            value="{{ old('volume', ($editing ? $edition->volume : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="page_range"
            label="Page Range"
            value="{{ old('page_range', ($editing ? $edition->page_range : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="page_total"
            label="Page Total"
            value="{{ old('page_total', ($editing ? $edition->page_total : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="publisher_name"
            label="Publisher Name"
            value="{{ old('publisher_name', ($editing ? $edition->publisher_name : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="publisher_city"
            label="Publisher City"
            value="{{ old('publisher_city', ($editing ? $edition->publisher_city : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($edition->date)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="isbn"
            label="Isbn"
            value="{{ old('isbn', ($editing ? $edition->isbn : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="document_id" label="Document" required>
            @php $selected = old('document_id', ($editing ? $edition->document_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Document</option>
            @foreach($documents as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
