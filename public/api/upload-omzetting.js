$.ajax({
    url: api_url + 'project/get/' + id,
    type: 'GET',
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
    },
    success: function (result) {
        let value = result.data
        // console.log(value)
        $('#card').show()
        $('#loading').remove()
        addItem(1)
    },
    error: function (xhr) {
        if (xhr.responseJSON.message == "Trying to get property 'id' of non-object") {
            window.history.back()
        }
    }
})

$('#add').click(function () {
    let length = $('.form-item').length + 1
    addItem(length)
})

$(document).on('click', '.close', function () {
    if ($('.form-item').length > 1) {
        $(this).parents('.form-item').slideUp('fast', function () {
            $(this).remove()
            $('.internet_number').each(function (i, o) {
                $(this).html((i + 1) + ')')
            })
            let length = $('.form-item').length + 1
            length == 1 ? addItem(length) : ''
        })
    }
})

function addItem(id) {
    let append = `<div class="form-group form-item row">
        <label class="col-lg-4 col-sm-5 col-form-label text-secondary">Internet Number</label>
        <div class="col-lg-7 col-sm-6 col-11">
            <div class="close form-close" title="Hapus">
                <i class="mdi mdi-trash-can-outline mdi-18px pr-0"></i>
            </div>
            <input class="form-control internet_number" data-id="${id}">
            <div class="invalid-feedback">Masukkan internet number</div>
        </div>
    </div>`
    $('#data').append(append)
    if (id != 1) $('#data').find('.form-item').last().hide().slideDown('fast')
}

$('#form').submit(function (e) {
    e.preventDefault()
    let items = []
    let error = false
    let id_valins = $('#id_valins').val()
    let label_odp = $('#label_odp').val()
    $('.is-invalid').removeClass('is-invalid')
    $('.form-item').each(function (index, value) {
        items.push({
            internet_number: $('.internet_number[data-id="' + (index + 1) + '"]').val()
        })
    })
    $.each(items, function (index, value) {
        if (value.internet_number == '') {
            $('.internet_number[data-id="' + (index + 1) + '"]').addClass('is-invalid')
            error = true
        }
    })
    if (id_valins == '') {
        $('#id_valins').addClass('is-invalid')
        error = true
    }
    if (label_odp == '') {
        $('#label_odp').addClass('is-invalid')
        error = true
    }
    // console.clear()
    // $.each(items, function (index, value) {
    //     console.log(value)
    // })
    if (error == false) {
        addLoading()
        $.ajax({
            url: api_url + 'omzetting/' + id + '/create',
            type: 'POST',
            data: {
                id_valins: id_valins,
                label_odp: label_odp,
                omzetting: items
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
            },
            success: function (result) {
                // console.log(result)
                location.href = `${root}project/${id}/7`
            }
        })
    }
})
