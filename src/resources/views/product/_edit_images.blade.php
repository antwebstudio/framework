    <div class="card card-accent-secondary">
        <div class="card-header">{{ __('Images') }}
            <span class="badge badge-pill badge-info">{{ $product->getMedia()->count() }}</span>
        </div>
        <div class="card-body">
            @if($errors->has('images'))
                <div class="alert alert-danger">{{ $errors->first('images') }}</div>
            @endif
            @foreach($product->getMedia() as $media)
                <div class="card mb-2">
                    <div class="card-body p-0 d-flex align-items-center">
                        <img class="mr-3 w-25" src="{{ $media->getUrl('thumbnail') }}"
                             alt="{{ $media->name }}" title="{{ $media->name }}">
                        <div class="w-50">
                            <div class="text-sm-left text-info font-weight-bold">
                                <span title="{{ $media->getPath() }}">{{ $media->human_readable_size }}</span>
                            </div>
                            <div class="text-muted text-uppercase font-weight-bold small">
                                <a href="{{ $media->getUrl() }}" title="{{ $media->getUrl() }}"
                                   target="_blank">{!! icon('link') !!}</a>
                            </div>
                        </div>
                        <div class="w-25 pr-2 pl-0 b-l-1">
                            <div class="align-content-center text-center">
                                @can('delete media')
                                    {!! Form::open(['route' => ['vanilo.media.destroy', $media], 'method' => 'DELETE', 'class' => "float-right"]) !!}
                                    <button class="btn btn-sm btn-outline-danger" title="{{ __('Delete image') }}">
                                        {!! icon('delete') !!}
                                    </button>
                                    {!! Form::close() !!}
                                @endcan

                                    @can('edit media')
                                        @unless($media->getCustomProperty('isPrimary'))
                                            {!! Form::open(['route' => ['vanilo.media.update', $media], 'method' => 'PUT', 'class' => "float-right"]) !!}
                                            <button class="btn btn-sm btn-outline-info mr-1" title="{{ __('Set as Primary Image') }}">
                                                {!! icon('image') !!}
                                            </button>
                                            {!! Form::close() !!}
                                        @else
                                            <div class="float-right">
                                                <button class="btn btn-sm btn-info mr-1" title="{{ __('Primary Image') }}" disabled>
                                                    {!! icon('image') !!}
                                                </button>
                                            </div>
                                        @endunless
                                    @endcan
                            </div>
                        </div>

                    </div>

                </div>
            @endforeach

            @can('create media')
                {!! Form::open(['route' => 'vanilo.media.store', 'enctype'=>'multipart/form-data', 'class' => 'card']) !!}
                    <div class="card-body p-0 d-flex align-items-center">
                        <div class="w-75 p-2">
                            {{ Form::hidden('for', 'product') }}
                            {{ Form::hidden('forId', $product->id) }}

                            {{ Form::file('images[]', ['multiple', 'class' => 'form-control-file']) }}
                        </div>
                        <div class="w-25 p-2 bg-success">
                            <div class="align-content-center text-center">
                                <button class="btn btn-sm btn-success" title="{{ __('Upload image(s)') }}">
                                    {!! icon('check') !!}
                                </button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            @endcan
        </div>
    </div>

