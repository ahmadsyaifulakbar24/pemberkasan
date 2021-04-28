let file = null

$(document).on('change', 'input[type="file"]', function(e) {
    let val = $(this).get(0).files[0]
    let ext = val.name.split('.').pop()
    if (val.size <= 2000000) {
        file = val
        addStagingFile(val.name, ext)
        $(this).parents('.file-group').hide()
        $(this).removeClass('is-invalid')
    } else {
        $(this).addClass('is-invalid')
        $(this).siblings('.invalid-feedback').html('Ukuran file maksimal 2MB.')
    }
})

function addStagingFile(name, type) {
    let append = `<div class="file-group">
		<div class="staging-file d-flex align-items-center border rounded-top rounded-bottom pr-0">
			<div class="d-flex align-items-center text-truncate w-100">
				<i class="mdi ${icon(type)} mdi-18px px-2"></i>
				<small class="text-truncate" title="${name}">${name}</small>
			</div>
			<i class="mdi mdi-close mdi-staging ml-auto pl-2 py-2" role="button"></i>
		</div>
	</div>`
    $('#form-file').append(append)
}

$(document).on('click', '.mdi-staging', function() {
    file = null
    $('#file').val('')
    $('.file-group').show()
    $(this).parents('.file-group').remove()
})
