@php $editing = isset($document) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="slug"
            label="Slug"
            value="{{ old('slug', ($editing ? $document->slug : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="is_pdf"
            label="Is Pdf"
            :checked="old('is_pdf', ($editing ? $document->is_pdf : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="is_audio"
            label="Is Audio"
            :checked="old('is_audio', ($editing ? $document->is_audio : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="is_image"
            label="Is Image"
            :checked="old('is_image', ($editing ? $document->is_image : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="is_video"
            label="Is Video"
            :checked="old('is_video', ($editing ? $document->is_video : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="is_html"
            label="Is Html"
            :checked="old('is_html', ($editing ? $document->is_html : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="file_url"
            label="File Url"
            value="{{ old('file_url', ($editing ? $document->file_url : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="blurb" label="Blurb" maxlength="255"
            >{{ old('blurb', ($editing ? $document->blurb : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="content_html"
            label="Content Html"
            maxlength="255"
            >{{ old('content_html', ($editing ? $document->content_html : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="content_size"
            label="Content Size"
            value="{{ old('content_size', ($editing ? $document->content_size : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="edit_quality" label="Edit Quality">
            @php $selected = old('edit_quality', ($editing ? $document->edit_quality : '')) @endphp
            <option value="high" {{ $selected == 'high' ? 'selected' : '' }} >High</option>
            <option value="medium" {{ $selected == 'medium' ? 'selected' : '' }} >Medium</option>
            <option value="low" {{ $selected == 'low' ? 'selected' : '' }} >Low</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="formatting_quality" label="Formatting Quality">
            @php $selected = old('formatting_quality', ($editing ? $document->formatting_quality : '')) @endphp
            <option value="high" {{ $selected == 'high' ? 'selected' : '' }} >High</option>
            <option value="medium" {{ $selected == 'medium' ? 'selected' : '' }} >Medium</option>
            <option value="low" {{ $selected == 'low' ? 'selected' : '' }} >Low</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="publication_permission"
            label="Publication Permission"
        >
            @php $selected = old('publication_permission', ($editing ? $document->publication_permission : '')) @endphp
            <option value="author" {{ $selected == 'author' ? 'selected' : '' }} >Author</option>
            <option value="editor" {{ $selected == 'editor' ? 'selected' : '' }} >Editor</option>
            <option value="publisher" {{ $selected == 'publisher' ? 'selected' : '' }} >Publisher</option>
            <option value="translator" {{ $selected == 'translator' ? 'selected' : '' }} >Translator</option>
            <option value="recipient" {{ $selected == 'recipient' ? 'selected' : '' }} >Recipient</option>
            <option value="fair use" {{ $selected == 'fair use' ? 'selected' : '' }} >Fair use</option>
            <option value="" {{ $selected == '' ? 'selected' : '' }} ></option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="notes" label="Notes" maxlength="255"
            >{{ old('notes', ($editing ? $document->notes : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="input_type" label="Input Type">
            @php $selected = old('input_type', ($editing ? $document->input_type : '')) @endphp
            <option value="scanned" {{ $selected == 'scanned' ? 'selected' : '' }} >Scanned</option>
            <option value="typed" {{ $selected == 'typed' ? 'selected' : '' }} >Typed</option>
            <option value="transcribed" {{ $selected == 'transcribed' ? 'selected' : '' }} >Transcribed</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="input_by"
            label="Input By"
            value="{{ old('input_by', ($editing ? $document->input_by : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="input_date"
            label="Input Date"
            value="{{ old('input_date', ($editing ? optional($document->input_date)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="proof_by"
            label="Proof By"
            value="{{ old('proof_by', ($editing ? $document->proof_by : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="proof_date"
            label="Proof Date"
            value="{{ old('proof_date', ($editing ? optional($document->proof_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="format_by"
            label="Format By"
            value="{{ old('format_by', ($editing ? $document->format_by : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="format_date"
            label="Format Date"
            value="{{ old('format_date', ($editing ? optional($document->format_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="post_by"
            label="Post By"
            value="{{ old('post_by', ($editing ? $document->post_by : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="post_date"
            label="Post Date"
            value="{{ old('post_date', ($editing ? optional($document->post_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="publication_approval"
            label="Publication Approval"
        >
            @php $selected = old('publication_approval', ($editing ? $document->publication_approval : '')) @endphp
            <option value="approved" {{ $selected == 'approved' ? 'selected' : '' }} >Approved</option>
            <option value="rejected" {{ $selected == 'rejected' ? 'selected' : '' }} >Rejected</option>
            <option value="pending" {{ $selected == 'pending' ? 'selected' : '' }} >Pending</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="views"
            label="Views"
            value="{{ old('views', ($editing ? $document->views : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
