<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.documents.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Document::class)
                            <a
                                href="{{ route('documents.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.slug')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.is_pdf')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.is_audio')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.is_image')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.is_video')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.is_html')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.file_url')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.blurb')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.content_html')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.content_size')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.edit_quality')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.formatting_quality')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.publication_permission')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.notes')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.input_type')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.input_by')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.input_date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.proof_by')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.proof_date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.format_by')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.format_date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.post_by')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.post_date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.publication_approval')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.documents.inputs.views')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($documents as $document)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $document->slug ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->is_pdf ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->is_audio ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->is_image ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->is_video ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->is_html ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->file_url ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->blurb ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->content_html ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->content_size ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->edit_quality ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->formatting_quality ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->publication_permission ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->notes ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->input_type ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->input_by ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->input_date ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->proof_by ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->proof_date ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->format_by ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->format_date ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->post_by ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->post_date ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->publication_approval ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $document->views ?? '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="relative inline-flex align-middle"
                                    >
                                        @can('update', $document)
                                        <a
                                            href="{{ route('documents.edit', $document) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $document)
                                        <a
                                            href="{{ route('documents.show', $document) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $document)
                                        <form
                                            action="{{ route('documents.destroy', $document) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-trash text-red-600"
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="26">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="26">
                                    <div class="mt-10 px-4">
                                        {!! $documents->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
