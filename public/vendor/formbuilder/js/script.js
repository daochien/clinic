function handleAjaxError(error) {
	var errMsg = "An error occurred while processing your request"
	var errTitle = "Error"

	// check if this is a validation error
	if (error.status === 422) {
		var json = error.responseJSON
		if (json && json.message) errTitle = json.message

		if (json.errors) {
			errMsg = ''
			Object.keys(json.errors).forEach(function(key) {
				var messages = json.errors[key]
                $('#' + key).addClass('is-invalid');
                $('.input-error.' + key).text(messages);
			})
		}
	}
	return errMsg
}


function sConfirm(message, callback, type, title, cancelled) {
	// var title = title || 'Are you sure?'
	var type = type || 'warning'
	var message = message || 'Message'
	var callback = callback || function () {}
	var cancelled = cancelled || function () {}

	swal.fire({
        title: title,
        text: message,
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'はい',
        cancelButtonText: 'キャンセル',
	})
	.then((result) =>  {
	    console.log(result);
		if (result.value) {
			callback()
		} else {
			cancelled()
		}
	})
}

if (window.Clipboard && Clipboard.isSupported && Clipboard.isSupported()) {
    var clip = new Clipboard('.clipboard')

    clip.on('success', function( e ) {
        // e.clearSelection();
        var ref = $( e.trigger )

        ref.html('<i class="fa fa-check-circle"></i> '+ref.data('message'))

        setTimeout(function() {
            ref.html('<i class="fa fa-clipboard"></i> '+ref.data('original'))
        }, 1200);
    });
}

jQuery(function($){
    $('.table').footable({
        "filtering": {
            "enabled": true,
        },
        "paging": {
            "enabled": true,
            "size": 100,
            "position": "right",
        },
        "sorting": {
            "enabled": true,
        },
    });
});

function initilizeConfirmListeners() {
	$('.confirm').click( function( e ) {
		e.preventDefault()

		var ref = $(this)
		var data = ref.data()

		var message = data.message ? data.message : ref.attr('title')

		sConfirm(message, function() {
			window.location = ref.attr('href')
		})
	})

	$('.confirm-form').click( function( e ) {
		e.preventDefault()

		var ref = $(this)
		var data = ref.data()

		var message = data.message ? data.message : ref.attr('title')

		var form = $('#'+ref.data('form'))

		if ( ! form.parsley().validate() ) return

		sConfirm(message, function() {
			form.submit()
		})
	})
}

$(function () {
  $('[data-toggle="tooltip"]').tooltip()

  setTimeout(function() {
  	initilizeConfirmListeners()
  }, 1000);
})
