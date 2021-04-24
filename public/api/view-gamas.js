if (role == 200) {
    $('#edit_project').remove()
    $('#btn-accept').remove()
    $('.compose').remove()
}
else if (role == 202) {
    $('#edit_project').remove()
}

$.ajax({
    url: api_url + 'project/get/' + id,
    type: 'GET',
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
    },
    success: function (result) {
        let value = result.data
        // console.log(value)
        if (value.type.id == 11) {
            if (status_id == value.status.id) {
                $('#name').html(value.name)
                $('#project').html(value.status.status_project)
                $('#edit_project').attr('href', `${root}project/${value.id}`)
                $('#team_project').attr('href', `${root}project/team/${value.id}`)
                localStorage.setItem('type_id', value.type.id)
            } else {
                window.history.back()
            }
        } else {
            window.history.back()
        }
    },
    error: function (xhr) {
        if (xhr.responseJSON.message == "Trying to get property 'id' of non-object") {
            window.history.back()
        }
    }
})

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
    }
})

$.ajax({
    url: api_url + 'history_project/' + id,
    type: 'GET',
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
    },
    success: function (result) {
        let value = result.data
        // console.log(value)
        let append
        $.each(value, function (index, value) {
            let border = (index != 0) ? 'border-right' : ''
            let date = value.created_at.substr(0, 10)
            let time = value.created_at.substr(11, 8)
            append = `<div class="row">
                    <div class="col-auto text-center flex-column d-sm-flex px-1">
                        <div class="m-2">
                            <i class="mdi mdi-checkbox-blank-circle mdi-18px pr-0" style="color:#dee2e6"></i>
                        </div>
                        <div class="row" style="height:45px;margin:-15px">
                            <div class="col ${border}">&nbsp;</div>
                            <div class="col">&nbsp;</div>
                        </div>
                    </div>
                    <div class="col col-xl-10 pl-0" style="padding-top:11px">
                        <div class="d-flex flex-column align-items-start">
                            <small class="text-secondary">${date} ${time}</small>
                            <small class="text-capitalize">${history_project(value.type, value.status_project.status_project)}</small>
                        </div>
                    </div>
                </div>`
            $('#history').prepend(append)
        })
    }
})

get_data()

function get_data() {
    $.ajax({
        url: api_url + 'file_manager/' + id + '/by_project',
        type: 'GET',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function (result) {
            let value = result.data
            // console.log(value)
            let append, type_file, keterangan
            if (value.length > 0) {
                $.each(value, function (index, value) {
                    // if (value.status_project.id == status_id) {
                    value.type_file != null ? type_file = value.type_file : type_file = ''
                    value.keterangan != null ? keterangan = value.keterangan : keterangan = ''
                    append = `<tr data-id="${value.id}" data-name="${value.file_name}">
                            <td class="text-center">${index + 1}.</td>
                            <td class="text-truncate"><a href="${root}dokumen/${id}/${value.status_project.id}/${value.id}">${value.file_name}</a></td>
                            <td class="text-truncate"><a href="${value.file_url}" target="_blank" class="btn btn-sm btn-outline-primary">Download</a></td>
                            <td class="text-truncate text-capitalize">${type_file}</td>
                            <td class="text-truncate">${keterangan}</td>
                            <td class="text-truncate">${value.status_project.status_project}</td>
                            <td><i class="mdi mdi-trash mdi-trash-can-outline mdi-18px pr-0" role="button" data-toggle="modal" data-target="#modal-delete"></i></td>
                        </tr>`
                    // }
                    $('#table').append(append)
                })
            } else {
                $('#card').hide()
                $('#empty').show()
            }
        }
    })
}

$(document).ajaxStop(function () {
    $('#data').show()
    $('#loading').remove()
})

let totalDelete = []
$(document).on('click', '.mdi-trash', function () {
    let id = $(this).closest('tr').data('id')
    let name = $(this).closest('tr').data('name')
    totalDelete = []
    totalDelete.push(id)
    $('#btn-delete').data('id', id)
    $('.modal-body').html('Anda yakin ingin menghapus dokumen <b>' + name + '</b>?')
})

$('#delete').click(function () {
    del(totalDelete)
    $('#modal-delete').modal('hide')
})

function del(idDelete) {
    let length = totalDelete.length
    $.each(idDelete, function (index, value) {
        $.ajax({
            url: api_url + 'file_manager/' + value + '/delete',
            type: 'DELETE',
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
            },
            success: function (result) {
                $('#table').empty()
                get_data()
            }
        })
    })
}

if (window.innerWidth < 992) {
    $('#status').collapse('hide')
}
$(window).resize(function () {
    if (window.innerWidth < 992) {
        $('#status').collapse('hide')
    } else {
        $('#status').collapse('show')
    }
})
