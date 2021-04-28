$.ajax({
    url: api_url + 'param/type_project',
    type: 'GET',
    beforeSend: function(xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
    },
    success: function(result) {
        // console.log(result)
        let append
        $.each(result.data, function(index, value) {
            append = `<option value="${value.id}">${value.type_project}</option>`
            $('#type_id').append(append)
        })
        $('#data').show()
        $('#loading').remove()
    }
})

$('#form').submit(function(e) {
    $('.is-invalid').removeClass('is-invalid')
    e.preventDefault()
    addLoading()

    let formData = new FormData()
    formData.append('name', $('#name').val())
    formData.append('type_id', $('#type_id').val())
    formData.append('keterangan', $('#keterangan').val())

    $.ajax({
        url: api_url + 'project/create',
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function(result) {
            location.href = root + 'osp'
        },
        error: function(xhr) {
            removeLoading('Buat Project')
            let err = xhr.responseJSON.errors
            // console.log(err)
            if (err.name) {
                $('#name').addClass('is-invalid')
                $('#name-feedback').html('Masukkan nama project')
            }
            if (err.type_id) {
                $('#type_id').addClass('is-invalid')
                $('#type_id-feedback').html('Pilih tipe project')
            }
            if (err.keterangan) {
                $('#keterangan').addClass('is-invalid')
                $('#keterangan-feedback').html('Masukkan keterangan')
            }
        }
    })
})
