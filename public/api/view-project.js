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
        $('#name').html(value.name)
        $('#project').html(value.status.status_project)
        $('#edit_project').attr('href', `${root}project/${value.id}`)
        $('#team_project').attr('href', `${root}project/team/${value.id}`)
        localStorage.setItem('type_id', value.type.id)
        if (value.type.id == 12 || value.type.id == 13 || value.type.id == 14) {
            if (status_id > 0 && status_id <= 7) {
                if (status_id > value.status.id) {
                    window.history.back()
                }
            } else {
                window.history.back()
            }
        }
        else if (value.type.id == 10) {
            if (status_id > 0 && status_id <= 8) {
                if (status_id > value.status.id) {
                    window.history.back()
                }
            } else {
                window.history.back()
            }
        }
        else {
            window.history.back()
        }
        if (value.status.id != 1) $('#edit_project').remove()
        if (status_id != value.status.id) $('#btn-accept').remove()
        if (status_id == 8) {
            $('.compose a').html('<i class="mdi mdi-plus mdi-18px"></i> Upload Omzetting')
            $('.compose a').attr('href', `${root}upload/omzetting/${id}`)
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
    url: api_url + 'param/status_project',
    type: 'GET',
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
    },
    success: function (result) {
        // console.log(result)
        let append, active
        $.each(result.data, function (index, value) {
            if (value.id != 9) {
                status_id == value.id ? active = 'active' : active = 'text-secondary'
                append = `<li class="nav-item">
                    <a href="${root}project/${id}/${value.id}" class="nav-link d-flex align-items-center ${active}" role="button">
                        <i class="mdi ${status_project(value.id)} mdi-18px"></i>
                        <span>${value.status_project}</span>
                    </a>
                </li>`
                if (localStorage.getItem('type_id') == 10 || value.id != 8) $('#status_project').append(append)
                if (status_id == value.id) {
                    localStorage.setItem('empty_status_id', value.id)
                    localStorage.setItem('empty_status', value.status_project)
                }
            }
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
    if (status_id != 8) {
        $.ajax({
            url: api_url + 'file_manager/' + id + '/by_project',
            type: 'GET',
            data: {
                status_project_id: status_id
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
            },
            success: function (result) {
                let value = result.data
                // console.log(value)
                let append, type_file, keterangan
                if (value.length > 0) {
                    $.each(value, function (index, value) {
                        value.type_file != null ? type_file = value.type_file : type_file = ''
                        value.keterangan != null ? keterangan = value.keterangan : keterangan = ''
                        append = `<tr data-id="${value.id}" data-name="${value.file_name}">
                            <td class="text-center">${index + 1}.</td>
                            <td class="text-truncate"><a href="${root}dokumen/${value.id}">${value.file_name}</a></td>
                            <td class="text-truncate"><a href="${value.file_url}" target="_blank" class="btn btn-sm btn-outline-primary">Download</a></td>
                            <td class="text-truncate text-capitalize">${type_file}</td>
                            <td class="text-truncate">${keterangan}</td>
                            <td><i class="mdi mdi-trash mdi-trash-can-outline mdi-18px pr-0 trash" role="button"></i></td>
                        </tr>`
                        $('#table').append(append)
                    })
                    $('table').addClass('table-middle')
                    $('.omzetting').remove()
                } else {
                    $('#card').hide()
                    $('#empty').show()
                    $('#title-empty').prepend(localStorage.getItem('empty_status'))
                    $('#icon-empty').addClass(status_project(parseInt(localStorage.getItem('empty_status_id'))))
                }
            }
        })
    } else {
        $.ajax({
            url: api_url + 'omzetting/' + id + '/by_project',
            type: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
            },
            success: function (result) {
                let value = result.data
                // console.log(value)
                let append, internet_number
                if (value.length > 0) {
                    $.each(value, function (index, value) {
                        internet_number = ''
                        $.each(value.internet_number, function (index, values) {
                            internet_number += `<li>${values.internet_number}</li>`
                        })
                        append = `<tr data-id="${value.id}" data-name="${value.id_valins}">
                            <td class="text-center">${index + 1}.</td>
                            <td class="text-truncate"><a href="${root}omzetting/${value.id}">${value.id_valins}</a></td>
                            <td class="text-truncate">${value.label_odp}</td>
                            <td class="text-truncate"><ul class="pl-3">${internet_number}</ul></td>
                            <td><i class="mdi mdi-trash mdi-trash-can-outline mdi-18px pr-0 trash-omzetting" role="button"></i></td>
                        </tr>`
                        $('#table').append(append)
                    })
                    $('.not_omzetting').remove()
                } else {
                    $('#card').hide()
                    $('#empty').show()
                    $('#title-empty').prepend(localStorage.getItem('empty_status'))
                    $('#icon-empty').addClass(status_project(parseInt(localStorage.getItem('empty_status_id'))))
                }
            }
        })
    }
}

$(document).ajaxStop(function () {
    $('#data').show()
    $('#loading').remove()
})

$(document).on('click', '.trash', function () {
    $('#modal-delete').modal('show')
    let id = $(this).closest('tr').data('id')
    let name = $(this).closest('tr').data('name')
    $('#delete').data('id', id)
    $('#body-delete').html(name)
})

$(document).on('click', '.trash-omzetting', function () {
    $('#modal-omzetting').modal('show')
    let id = $(this).closest('tr').data('id')
    let name = $(this).closest('tr').data('name')
    $('#delete-omzetting').data('id', id)
    $('#body-omzetting').html(name)
})

$('#delete').click(function () {
    let id = $(this).data('id')
    $(this).attr('disabled', true)
    $.ajax({
        url: api_url + 'file_manager/' + id + '/delete',
        type: 'DELETE',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function (result) {
            $('#table').empty()
            get_data()
            $('#modal-delete').modal('hide')
            $('#delete').attr('disabled', false)
        }
    })
})

$('#delete-omzetting').click(function () {
    let id = $(this).data('id')
    $(this).attr('disabled', true)
    $.ajax({
        url: api_url + 'omzetting/' + id + '/delete',
        type: 'DELETE',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function (result) {
            $('#table').empty()
            get_data()
            $('#modal-omzetting').modal('hide')
            $('#delete-omzetting').attr('disabled', false)
        }
    })
})

$('#accept').click(function () {
    $.ajax({
        url: api_url + 'project/' + id + '/accept_status',
        type: 'PATCH',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function (result) {
            let value = result.data
            // console.log(value)
            $('#accept').attr('disabled', true)
            if (value.type.id == 12 || value.type.id == 13 || value.type.id == 14 && value.status.id == 9) {
                location.href = `${root}project/${value.id}/7`
            }
            else if (value.type.id == 10 & value.status.id == 9) {
                location.href = `${root}project/${value.id}/8`
            }
            else {
                location.href = `${root}project/${value.id}/${value.status.id}`
            }
        }
    })
})

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
