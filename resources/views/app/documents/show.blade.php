<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.documents.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('documents.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.slug')
                        </h5>
                        <span>{{ $document->slug ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.is_pdf')
                        </h5>
                        <span>{{ $document->is_pdf ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.is_audio')
                        </h5>
                        <span>{{ $document->is_audio ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.is_image')
                        </h5>
                        <span>{{ $document->is_image ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.is_video')
                        </h5>
                        <span>{{ $document->is_video ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.is_html')
                        </h5>
                        <span>{{ $document->is_html ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.file_url')
                        </h5>
                        <span>{{ $document->file_url ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.blurb')
                        </h5>
                        <span>{{ $document->blurb ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.content_html')
                        </h5>
                        <span>{{ $document->content_html ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.content_size')
                        </h5>
                        <span>{{ $document->content_size ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.edit_quality')
                        </h5>
                        <span>{{ $document->edit_quality ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.formatting_quality')
                        </h5>
                        <span>{{ $document->formatting_quality ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.publication_permission')
                        </h5>
                        <span
                            >{{ $document->publication_permission ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.notes')
                        </h5>
                        <span>{{ $document->notes ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.input_type')
                        </h5>
                        <span>{{ $document->input_type ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.input_by')
                        </h5>
                        <span>{{ $document->input_by ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.input_date')
                        </h5>
                        <span>{{ $document->input_date ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.proof_by')
                        </h5>
                        <span>{{ $document->proof_by ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.proof_date')
                        </h5>
                        <span>{{ $document->proof_date ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.format_by')
                        </h5>
                        <span>{{ $document->format_by ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.format_date')
                        </h5>
                        <span>{{ $document->format_date ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.post_by')
                        </h5>
                        <span>{{ $document->post_by ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.post_date')
                        </h5>
                        <span>{{ $document->post_date ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.publication_approval')
                        </h5>
                        <span
                            >{{ $document->publication_approval ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.documents.inputs.views')
                        </h5>
                        <span>{{ $document->views ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('documents.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Document::class)
                    <a href="{{ route('documents.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
