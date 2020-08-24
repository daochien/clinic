@extends('layouts.template')

@section('content')
    <form action="{{ route('template.store') }}" method="POST" id="createFormForm">
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ __('template.title-create') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
                <button class="btn btn-outline-accent">
                    {{ __('template.btn.save-draft')}}
                </button>
                <button type="button" class="btn btn-primary pl-5 pr-5 fb-save-btn">{{ __('template.btn.create')}}</button>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container">
            @csrf
            <div class="row mb-5">
                <div class="col-md-12">
                    <label class="font-weight-bold">{{ __('template.basic_info')}}</label>
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
                                    <input type="text" name="name" id="name" required class="form-control
                                           @error('name') is-invalid @enderror"
                                           placeholder="{{__('template.place_holder.title')}}">
                                    @error('name')
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
                                <div class="col-5">
                                    <select name="category[]" id="category" required class="js-example-basic-multiple form-control
                                           @error('category') is-invalid @enderror" multiple="multiple">
                                        <option value="">{{__('template.place_holder.category')}}</option>
                                        @foreach($category as $cat)
                                            <option value="{{ $cat['id'] }}">
                                                {{ $cat['name'] }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category')
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
                                            {{ __('template.approver')}}
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <input type="text" name="approver" id="approver" required class="form-control
                                           @error('approver') is-invalid @enderror"
                                           placeholder="{{__('template.place_holder.approver')}}">
                                    @error('approver')
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
                                            {{ __('template.multi_approve')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="custom-control custom-toggle custom-toggle-sm mb-1 col-2">
                                        <input type="checkbox" id="customToggle2" name="multi_approve" class="custom-control-input">
                                        <label class="custom-control-label" for="customToggle2"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            <label>{{ __('app.label.description')}}</label>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="form-group">
                                        <textarea rows="12" id="description" name="description"
                                                  placeholder="{{__('app.user.place_holder.description')}}"
                                                  class="form-control
                                                  @error('description') is-invalid @enderror">
                                        </textarea>
                                        @error('description')
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
            </div>
            <div class="row mb-5">
                <div class="col-md-12">
                    <label class="font-weight-bold">{{ __('template.setting')}}</label>
                    <div class="card">
                        <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@push(config('formbuilder.layout_js_stack', 'scripts'))
    <script type="text/javascript">
        window.FormBuilder = window.FormBuilder || {}
        window.FormBuilder.form_roles = @json($form_roles);
    </script>
    <script src="{{ asset('vendor/formbuilder/js/create-form.js') }}{{ \App\Helper\FormBuilderHelper::bustCache() }}" defer></script>
@endpush
<script>
    $(document).ready(function() {
        $('#category').select2();
    });
</script>

