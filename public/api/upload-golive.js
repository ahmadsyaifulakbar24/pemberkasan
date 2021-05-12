$.ajax({
    url: api_url + 'project/get/' + id,
    type: 'GET',
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token)
    },
    success: function (result) {
        let value = result.data
        // console.log(value)
        if (status_id > value.status.id) {
            window.history.back()
        } else {
            $('#card').show()
            $('#loading').remove()
        }
    }
})

$('#form').submit(function (e) {
    $('.is-invalid').removeClass('is-invalid')
    e.preventDefault()
    addLoading()

    let formData = new FormData()
    let keterangan = $('#keterangan').val()
    formData.append('status_project_id', status_id)
    formData.append('file_name', file_name)
    formData.append('file', file)
    formData.append('keterangan', keterangan)

    $.ajax({
        url: `${api_url}file_manager/${id}/create`,
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token)
        },
        success: function (result) {
            if (localStorage.getItem('type_id') == 11) {
                location.href = `${root}project/gamas/${id}/${status_id}`
            } else {
                location.href = `${root}project/${id}/${status_id}`
            }
        },
        error: function (xhr) {
            removeLoading('Upload Foto')
            let err = xhr.responseJSON.errors
            let msg = xhr.responseJSON.message
            // console.log(err)
            if (err.file) {
                $('#file').addClass('is-invalid')
                $('#file-feedback').html('Pilih file')
            }
        }
    })
})
