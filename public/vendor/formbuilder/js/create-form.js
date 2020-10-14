jQuery(function() {
    $('#visibility').change(function(e) {
        e.preventDefault()
        var ref = $(this)

        if (ref.val() == "" || ref.val() == 'PUBLIC') {
            $('#allows_edit_DIV').hide()
        } else {
            $('#allows_edit_DIV').slideDown()
            $('#allows_edit').val('0')
        }
    });
    var locale = document.head.querySelector('meta[name="locale"]').content;
    var formLang = '';
    if (locale === 'ja') {
        formLang = 'ja-JP'
    } else {
        formLang = 'en-US'
    }
    // create the form editor
    var fbEditor = $(document.getElementById('fb-editor'))
    var formBuilder
    var fbOptions = {
        dataType: 'json',
        formData: window._form_builder_content ? window._form_builder_content : '',
        controlOrder: [
            'header',
            'paragraph',
            'text',
            'textarea',
            'select',
            'number',
            'date',
            'autocomplete',
            'file',
        ],
        disableFields: [
            'button', // buttons are not needed since we are the one handling the submission
            'hidden',
            'autocomplete',
        ],  // field types that should not be shown
        disabledAttrs: [
            // 'access',
            'toggle',
            'inline',
        ],
        typeUserDisabledAttrs: {
            'checkbox': [
                'toggle',
                'inline',
            ],
            'textarea': [
                'subtype',
            ],
            'file': [
                'multiple',
                'subtype',
            ],
            'number': [
                'min',
                'max',
                'step',
            ],
            'paragraph': [
                'subtype',
            ],
            'checkbox-group': [
                'other',
            ],
        },
        showActionButtons: false, // show the actions buttons at the bottom
        disabledActionButtons: ['data'], // get rid of the 'getData' button
        sortableControls: false, // allow users to re-order the controls to their liking
        editOnAdd: false,
        fieldRemoveWarn: false,
        roles: window.FormBuilder.form_roles || {},
        notify: {
            error: function(message) {
              return swal('Error', message, 'error')
            },
            success: function(message) {
              return swal('Success', message, 'success')
            },
            warning: function(message) {
              return swal('Warning', message, 'warning');
            }
        },
        onSave: function() {
            // var formData = formBuilder.formData
            // console.log(formData)
        },
        i18n: {locale: formLang}
    }

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "1500",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    formBuilder = fbEditor.formBuilder(fbOptions)

    var fbClearBtn = $('.fb-clear-btn')
    var fbShowDataBtn = $('.fb-showdata-btn')
    var fbSaveBtn = $('.fb-save-btn')
    var fbSaveDraftBtn = $('.fb-save-draft-btn')

    // setup the buttons to respond to save and clear
    fbClearBtn.click(function(e) {
        e.preventDefault()

        if (! formBuilder.actions.getData().length) return

        sConfirm("Are you sure you want to clear all fields from the form?", function() {
            formBuilder.actions.clearFields()
        })
    });

    fbShowDataBtn.click(function(e) {
        e.preventDefault()
        formBuilder.actions.showData()
    });

    fbSaveBtn.click(function(e) {
        $(".input-error").text('');
        $('.form-control').removeClass('is-invalid');
        e.preventDefault()

        var form = $('#createFormForm')

        // make sure the form is valid
        if ( ! form.parsley().validate() ) return

        // make sure the form builder is not empty
        if (! formBuilder.actions.getData().length) {
            swal.fire({
                title: "エラー",
                text: "申請フォーム項目を必ず指定してください。",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'はい',
            })
            return
        }

        // ask for confirmation
        // sConfirm("このテンプレート定義を保存します?asdf s", function() {
            fbSaveBtn.attr('disabled', 'disabled');
            fbClearBtn.attr('disabled', 'disabled');

            var formBuilderJSONData = formBuilder.actions.getData('json')

            var postData = {
                name: $('#name').val(),
                category: $('#category').val(),
                approver: $('#approver').val(),
                multi_approve: $('#multi_approve:checked').val() == 'on' ? 1 : 0,
                description: $('#description').val(),
                visibility: "PUBLIC",
                allows_edit: 1,
                form_builder_json: formBuilderJSONData,
                _token: window.FormBuilder.csrfToken
            }

            var method = form.data('formMethod') ? 'PUT' : 'POST'
            jQuery.ajax({
                url: form.attr('action'),
                processData: true,
                data: postData,
                method: method,
                cache: false,
            })
            .then(function(response) {
                fbSaveBtn.removeAttr('disabled')
                fbClearBtn.removeAttr('disabled')

                if (response.success) {
                    // the form has been created
                    // send the user to the form index page
                    toastr["info"](response.details || '')

                    setTimeout(function() {
                        window.location = response.dest
                    }, 1500);

                } else {
                    toastr["error"](response.details || 'Error')
                }
            }, function(error) {
                handleAjaxError(error)

                fbSaveBtn.removeAttr('disabled')
                fbClearBtn.removeAttr('disabled')
            })
        // })

    })

    fbSaveDraftBtn.click(function(e) {
        e.preventDefault()

        var form = $('#createFormForm')

        // make sure the form is valid
        if ( ! form.parsley().validate() ) return

        // make sure the form builder is not empty
        if (! formBuilder.actions.getData().length) {
            swal.fire({
                title: "エラー",
                text: "申請フォーム項目を必ず指定してください。",
                // showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'はい',
                // cancelButtonText: 'キャンセル',
            })
            return
        }

        // ask for confirmation
        sConfirm("このテンプレート定義を保存します?", function() {
            fbSaveBtn.attr('disabled', 'disabled');
            fbClearBtn.attr('disabled', 'disabled');

            var formBuilderJSONData = formBuilder.actions.getData('json')

            var postData = {
                name: $('#name').val(),
                category: $('#category').val(),
                approver: $('#approver').val(),
                multi_approve: $('#multi_approve:checked').val() == 'on' ? 1 : 0,
                description: $('#description').val(),
                visibility: "PRIVATE",
                allows_edit: 1,
                form_builder_json: formBuilderJSONData,
                _token: window.FormBuilder.csrfToken
            }

            var method = form.data('formMethod') ? 'PUT' : 'POST'
            jQuery.ajax({
                url: form.attr('action'),
                processData: true,
                data: postData,
                method: method,
                cache: false,
            })
                .then(function(response) {
                    fbSaveBtn.removeAttr('disabled')
                    fbClearBtn.removeAttr('disabled')

                    if (response.success) {
                        window.location = response.dest
                    } else {
                        swal.fire({
                            title: "エラー",
                            text: response.message || "新規申請テンプレートの作成に失敗しました",
                            // showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'はい',
                        })
                    }
                }, function(error) {
                    handleAjaxError(error)

                    fbSaveBtn.removeAttr('disabled')
                    fbClearBtn.removeAttr('disabled')
                })
        })

    })

    // show the clear and save buttons
    $('#fb-editor-footer').slideDown()
})
