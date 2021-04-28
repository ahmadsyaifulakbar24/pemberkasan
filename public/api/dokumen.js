let status_project_id

$.ajax({
    url: api_url + 'file_manager/' + id + '/get',
    type: 'GET',
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
    },
    success: function (result) {
        let value = result.data
        console.log(value)
        status_project_id = value.status_project.id
        $('#file_name').val(value.file_name.replace(/\.[^/.]+$/, ""))
        addStagingFile(value.file_name, value.file_name.split('.').pop())
        if (value.type_file != null) $('#type_file').val(value.type_file)
        $('#keterangan').val(value.keterangan)

        $('#card').show()
        $('#loading').remove()
    }
})

$('#form').submit(function (e) {
    $('.is-invalid').removeClass('is-invalid')
    e.preventDefault()
    addLoading()

    let formData = new FormData()
    let file_name = $('#file_name').val()
    let type_file = $('#type_file').val()
    let keterangan = $('#keterangan').val()

    formData.append('status_project_id', status_project_id)
    formData.append('file_name', file_name)
    if (file != null) formData.append('file', file)
    if (type_file != 'Kosong') formData.append('type_file', type_file)
    if (keterangan != null) formData.append('keterangan', keterangan)

    $.ajax({
        url: api_url + 'file_manager/' + id + '/update',
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function (result) {
            console.log(result)
            if (localStorage.getItem('type_id') == 11) {
                location.href = `${root}project/gamas/${id}/${status_id}`
            } else {
                location.href = `${root}project/${id}/${status_id}`
            }
        },
        error: function (xhr) {
            removeLoading('Upload Dokumen')
            let err = xhr.responseJSON.errors
            // console.log(err)
            if (err.file_name) {
                $('#file_name').addClass('is-invalid')
                $('#file_name-feedback').html('Masukkan nama file')
            }
            if (err.file) {
                $('#file').addClass('is-invalid')
                $('#file-feedback').html('Masukkan file')
            }
        }
    })
})
