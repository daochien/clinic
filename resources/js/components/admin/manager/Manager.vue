<template>
    <div class="page-create-manager">
        <div class="page-header row no-gutters py-4">
            <div class="col-12 col-sm-8 text-center text-sm-left mb-0">
                <h3 class="page-title">{{ $t('manager.title_page_create') }}</h3>
            </div>            
        </div>
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1">
                <div class="card card-small mb-3">
                    <div class="card-header border-bottom">
                        <h6 class="m-0">{{ $t('manager.form_create.title') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-12 col-sm-6">
                                <label for="feInputTitle">{{ $t('manager.form_create.input_name') }} <span style="color:#c4183c;">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-12 col-sm-6">
                                <label for="feInputTitle">{{ $t('manager.form_create.input_email') }} <span style="color:#c4183c;">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                {{ $t('manager.form_create.role') }} <span style="color:#c4183c;">*</span>
                            </div>
                            <div class="col-12">
                                <div class="custom-control custom-checkbox mb-3 mr-4 float-left">
                                    <input type="checkbox" class="custom-control-input" id="formsCheckboxChecked" checked="">
                                    <label class="custom-control-label" for="formsCheckboxChecked">Checked</label>
                                </div>
                                <div class="custom-control custom-checkbox mb-3 mr-4 float-left">
                                    <input type="checkbox" class="custom-control-input" id="formsCheckboxChecked" checked="">
                                    <label class="custom-control-label" for="formsCheckboxChecked">Checked</label>
                                </div>
                                <div class="custom-control custom-checkbox mb-3 mr-4 float-left">
                                    <input type="checkbox" class="custom-control-input" id="formsCheckboxChecked" checked="">
                                    <label class="custom-control-label" for="formsCheckboxChecked">Checked</label>
                                </div>
                                <div class="custom-control custom-checkbox mb-3 mr-4 float-left">
                                    <input type="checkbox" class="custom-control-input" id="formsCheckboxChecked" checked="">
                                    <label class="custom-control-label" for="formsCheckboxChecked">Checked</label>
                                </div>
                                <div class="custom-control custom-checkbox mb-3 mr-4 float-left">
                                    <input type="checkbox" class="custom-control-input" id="formsCheckboxChecked" checked="">
                                    <label class="custom-control-label" for="formsCheckboxChecked">Checked</label>
                                </div>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="feInputTitle">{{ $t('manager.form_create.note') }}</label>
                                <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button class="mb-2 btn btn-sm btn-primary"> {{ $t('manager.form_create.button_create') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    
}
</script>

<style lang="scss" scoped>

</style>