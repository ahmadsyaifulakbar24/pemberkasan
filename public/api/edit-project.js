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

$('#form').submit(function (e) {
    $('.is-invalid').removeClass('is-invalid')
    e.preventDefault()
    addLoading()

    $.ajax({
        url: `${api_url}project/${id}/update`,
        type: 'PATCH',
        data: {
            name: $('#name').val(),
            keterangan: $('#keterangan').val()
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function (result) {
            let value = result.data
            // console.log(value)
            if (value.type.id != 11) {
                location.href = `${root}project/${value.id}/${value.status.id}`
            } else {
                location.href = `${root}project/gamas/${value.id}/${value.status.id}`
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
            if (err.keterangan) {
                $('#keterangan').addClass('is-invalid')
                $('#keterangan-feedback').html('Masukkan keterangan')
            }
        }
    })
})
