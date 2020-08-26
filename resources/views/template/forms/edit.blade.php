@extends('layouts.template')

@section('content')
    <form action="{{ route('template.update', $form) }}" method="POST" id="createFormForm" data-form-method="PUT">
    @csrf
    @method('PUT')
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ __('template.title-create') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
                <button class="btn btn-outline-accent fb-save-draft-btn">{{ __('template.btn.save-draft')}}</button>
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
                                    <input type="text" name="name" id="name" class="form-control
                                           @error('name') is-invalid @enderror" value="{{$form->name}}"
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
                                    <select name="category[]" id="category" class="form-control
                                           @error('category') is-invalid @enderror" >
                                        <option value="">{{ __('template.place_holder.category') }}</option>
                                        @foreach($category as $cat)
                                            <option value="{{ $cat['id'] }}" {{ $cat['id'] == $form['category']->toArray()[0]['id'] ? 'selected' : '' }}>
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
                                    <select type="text" name="approver[]" id="approver" class="js-example-basic-multiple form-control
                                           @error('approver') is-invalid @enderror" multiple="multiple">
                                        @foreach($adminList as $admin)
                                            <option value="{{ $admin['id'] }}" {{ in_array($admin['id'], $form['approvers']->pluck('id')->all()) ? 'selected' : '' }}>
                                                {{ $admin['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                        <input type="checkbox" id="multi_approve" name="multi_approve" class="custom-control-input" {{$form['multi_approve'] ? 'checked' : ''}}>
                                        <label class="custom-control-label" for="multi_approve"></label>
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
                                                  @error('description') is-invalid @enderror">{{$form['description']}}
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

@section('page-js-files')
    <script src="{{ asset('vendor/formbuilder/js/create-form.js') }}{{ \App\Helper\FormBuilderHelper::bustCache() }}" defer></script>
@stop
@section('page-js-script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#approver').select2({
                placeholder: "{{__('template.place_holder.approver')}}",
            });
        });
        window.FormBuilder = window.FormBuilder || {}
        window.FormBuilder.form_roles = @json($form_roles);

        window._form_builder_content = {!! json_encode($form->form_builder_json) !!}
    </script>
@stop
