function get_project() {
    $.ajax({
        url: api_url + 'project/get/' + id,
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function (result) {
            let value = result.data
            // console.log(value)
            $('#name').val(value.name)
            $('#type_id').val(value.type.id)
            $('#keterangan').val(value.keterangan)

            $('#data').show()
            $('#loading').remove()
        },
        error: function (xhr) {
            if (xhr.responseJSON.message == "Trying to get property 'id' of non-object") {
                window.history.back()
            }
        }
    })
}

$.ajax({
    url: api_url + 'param/type_project',
    type: 'GET',
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
    },
    success: function (result) {
        // console.log(result)
        let append
        $.each(result.data, function (index, value) {
            append = `<option value="${value.id}">${value.type_project}</option>`
            $('#type_id').append(append)
        })
        get_project()
    }
})

$('#form').submit(function (e) {
    $('.is-invalid').removeClass('is-invalid')
    e.preventDefault()
    addLoading()

    $.ajax({
        url: `${api_url}project/${id}/update`,
        type: 'PATCH',
        data: {
            name: $('#name').val(),
            type_id: $('#type_id').val(),
            keterangan: $('#keterangan').val()
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function (result) {
            let value = result.data
            // console.log(value)
            if (value.type.id != 11) {
                location.href = `${root}project/${value.id}/1`
            } else {
                location.href = `${root}project/gamas/${value.id}/15`
            }
        },
        error: function (xhr) {
            removeLoading('Simpan')
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
