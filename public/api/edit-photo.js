localStorage.setItem('select', 'photo')

let project_id,
	status_project_id

$.ajax({
    url: `${api_url}file_manager/${id}/get`,
    type: 'GET',
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
    },
    success: function (result) {
        let value = result.data
        // console.log(value)
        project_id = value.project_id
        status_project_id = value.status_project.id
        addStagingFile(value.file_name, value.file_name.split('.').pop())

        $('#card').show()
        $('#loading').remove()
    }
})

$('#form').submit(function (e) {
    $('.is-invalid').removeClass('is-invalid')
    e.preventDefault()
    addLoading()

    let formData = new FormData()
    formData.append('status_project_id', status_project_id)
    if (file_name != null) formData.append('file_name', file_name)
    if (file != null) formData.append('file', file)

    $.ajax({
        url: `${api_url}file_manager/${id}/update`,
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function (result) {
            // console.log(result)
            if (localStorage.getItem('type_id') == 11) {
                location.href = `${root}project/gamas/${project_id}/${status_project_id}`
            } else {
                location.href = `${root}project/${project_id}/${status_project_id}`
            }
        },
        error: function (xhr) {
            removeLoading('Upload Dokumen')
            let err = xhr.responseJSON.errors
            console.log(err)
            // if (err.file_name) {
            //     $('#file_name').addClass('is-invalid')
            //     $('#file_name-feedback').html('Masukkan nama file')
            // }
            if (err.file) {
                $('#file').addClass('is-invalid')
                $('#file-feedback').html('Masukkan file')
            }
        }
    })
})
