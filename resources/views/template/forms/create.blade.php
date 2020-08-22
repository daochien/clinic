@extends('layouts.template')

@section('content')
<div class="container">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ __('template.title.create') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
                <button class="btn btn-outline-accent">
                    {{ __('template.btn.save-draft')}}
                </button>
                <button type="button" class="btn btn-primary pl-5 pr-5">{{ __('template.btn.create')}}</button>
            </div>
        </div>
        <!-- End Page Header -->

    <form action="{{ route('template.store') }}" method="POST" id="createFormForm">
        @csrf
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label>
                                        {{ __('template.title')}}
                                        <span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-10">
                                <input type="text" name="title" class="form-control"
                                       @error('title') is-invalid @enderror
                                       placeholder="{{__('template.place_holder.title')}}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label>
                                        {{ __('template.category')}}
                                        <span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-10">
                                <input type="text" name="title" class="form-control"
                                       @error('title') is-invalid @enderror
                                       placeholder="{{__('template.place_holder.title')}}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            {{ $pageTitle ?? '' }}

                            <a href="{{ route('template.index') }}" class="btn btn-sm btn-primary float-md-right">
                                <i class="fa fa-arrow-left"></i> Back To My Form
                            </a>
                        </h5>
                    </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Form Name</label>

                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter Form Name">

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="visibility" class="col-form-label">Form Visibility</label>

                                        <select name="visibility" id="visibility" class="form-control" required="required">
                                            <option value="">Select Form Visibility</option>
                                            @foreach(App\Models\Form::$visibility_options as $option)
                                                <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('visibility'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('visibility') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4" style="display: none;" id="allows_edit_DIV">
                                    <div class="form-group">
                                        <label for="allows_edit" class="col-form-label">
                                            Allow Submission Edit
                                        </label>

                                        <select name="allows_edit" id="allows_edit" class="form-control" required="required">
                                            <option value="0">NO (submissions are final)</option>
                                            <option value="1">YES (allow users to edit their submissions)</option>
                                        </select>

                                        @if ($errors->has('allows_edit'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('allows_edit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-info" role="alert">
                                        <i class="fa fa-info-circle"></i>
                                        Click on or drag and drop components onto the main panel to build your form content.
                                    </div>

                                    <div id="fb-editor" class="fb-editor"></div>
                                </div>
                            </div>
                        </div>

                    <div class="card-footer" id="fb-editor-footer" style="display: none;">
                        <button type="button" class="btn btn-primary fb-clear-btn">
                            <i class="fa fa-remove"></i> Clear Form
                        </button>
                        <button type="button" class="btn btn-primary fb-save-btn">
                            <i class="fa fa-save"></i> Submit &amp; Save Form
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push(config('formbuilder.layout_js_stack', 'scripts'))
    <script type="text/javascript">
        window.FormBuilder = window.FormBuilder || {}
        window.FormBuilder.form_roles = @json($form_roles);
    </script>
    <script src="{{ asset('vendor/formbuilder/js/create-form.js') }}{{ \App\Helper\FormBuilderHelper::bustCache() }}" defer></script>
@endpush
