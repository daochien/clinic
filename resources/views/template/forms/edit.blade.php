@extends('layouts.template')

@section('content')
    <form action="{{ route('template.update', $form) }}" method="POST" id="createFormForm" data-form-method="PUT">
    @csrf
    @method('PUT')
        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-4 text-center text-sm-left mb-4 mb-sm-0">
                <h3 class="page-title">{{ __('request.template.info._page_title_edit') }}</h3>
            </div>
            <div class="col-12 col-sm-8 text-right text-sm-right mb-4 mb-sm-0">
                <button class="btn btn-outline-accent fb-save-draft-btn">{{ __('request.template.info.others._btn_draft_save')}}</button>
                <button type="button" class="btn btn-primary pl-5 pr-5 fb-save-btn">{{ __('request.template.info.others._btn_edit')}}</button>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="container">
            @csrf
            <div class="row mb-5">
                <div class="col-md-12">
                    <label class="font-weight-bold">{{ __('request.template.info.basic_form._subtitle')}}</label>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label>
                                            {{ __('request.attr._title')}}
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <input type="text" name="name" id="name" class="form-control
                                           @error('name') is-invalid @enderror" value="{{$form->name}}"
                                           placeholder="{{__('request.template.info.basic_form._title_pl')}}">
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
                                            {{ __('request.attr._category')}}
                                            <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <select name="category[]" id="category" class="form-control
                                           @error('category') is-invalid @enderror" >
                                        <option value="">{{ __('request.template.info.basic_form._category_df') }}</option>
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
                                            {{ __('request.attr._approver')}}
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
                                            {{ __('request.attr._all_approval')}}
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
                                            <label>{{ __('request.attr._memo')}}</label>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="form-group">
                                        <textarea rows="12" id="description" name="description"
                                                  placeholder="{{__('request.template.info.basic_form._memo_pl')}}"
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
                    <label class="font-weight-bold">{{ __('request.template.info.question_form._subtitle')}}</label>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-info" role="alert">
                                        <i class="fa fa-info-circle"></i>
                                        {{ __('request.template.info.question_form._description')}}
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
                placeholder: "{{__('request.template.info.basic_form._approver_pl')}}",
            });
        });
        window.FormBuilder = window.FormBuilder || {}
        window._form_builder_content = {!! json_encode($form->form_builder_json) !!}
    </script>
@stop
