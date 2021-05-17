get_data()

function get_data(page) {
    let url, user_leader_id
    if (role == 1 || role == 100 || role == 200 || role == 201) {
        url = `${api_url}project/get`
    } else {
        url = `${api_url}project/get_by_leader`
        user_leader_id = user
        $('.compose').remove()
    }
    $.ajax({
        url: url,
        type: 'GET',
        data: {
            user_leader_id: user_leader_id,
            page: page
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function (result) {
            $('#table').html('')
            $('#loading').hide()
            if (result.data.length > 0) {
                $('#data').show()
                let append, link, trash
                let from = result.meta.from
                $.each(result.data, function (index, value) {
		            // console.log(value)
                    if (value.type.type_project == 'Gamas') {
                        link = `${root}project/gamas/${value.id}/${value.status.id}`
                    } else {
                        link = `${root}project/${value.id}/${value.status.id}`
                        // if (value.type.id != 10) {
                        //     if (value.status.id == 9) {
                        //         link = `${root}project/${value.id}/7`
                        //     } else {
                        //         link = `${root}project/${value.id}/${value.status.id}`
                        //     }
                        // } else {
                        //     if (value.status.id == 9) {
                        //         link = `${root}project/${value.id}/8`
                        //     } else {
                        //         link = `${root}project/${value.id}/${value.status.id}`
                        //     }
                        // }
                    }
                    if (role == 1 || role == 100 || role == 201) {
                        if (value.status.id == 1 || value.status.id == 8) {
                            trash = `<i class="mdi mdi-trash mdi-trash-can-outline mdi-18px pr-0 trash" role="button"></i>`
                        } else {
                            trash = ``
                        }
                    } else {
                        trash = ``
                        $('.compose').remove()
                    }
                    append = `<tr data-id="${value.id}" data-name="${value.name}">
						<td class="text-center">${from}.</td>
						<td class="text-truncate" id="name${value.id}"><a href="${link}">${value.name}</a></td>
						<td class="text-truncate">${value.type.type_project}</td>
						<td>${value.keterangan}</td>
						<td class="text-truncate text-capitalize" id="status${value.id}">${value.status.status_project}</td>
		        		<td class="text-truncate"><a href="${root}project/team/${value.id}" class="btn btn-sm btn-outline-primary">Team Project</a></td>
						<td id="trash${value.id}">${trash}</td>
					</tr>`
                    $('#table').append(append)
                    from++
                })
                pagination(result.links, result.meta, result.meta.path)
            } else {
                $('#empty').show()
            }
        },
        error: function (xhr, status) {
            setTimeout(function () {
                get_data(page)
            }, 1000)
        }
    })
}

$(document).on('click', '.trash', function () {
    $('#modal-delete').modal('show')
    let id = $(this).closest('tr').data('id')
    let name = $(this).closest('tr').data('name')
    $('#delete').data('id', id)
    $('.project').html(name)
})

$('#delete').click(function () {
    $('#data').hide()
    $('#loading').show()
    $(this).attr('disabled', true)
    let id = $(this).data('id')
    $.ajax({
        url: api_url + 'project/' + id + '/delete',
        type: 'DELETE',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function (result) {
            get_data()
            $('#delete').attr('disabled', false)
            $('#modal-delete').modal('hide')
        }
    })
})

$('.page').click(function () {
    if (!$(this).is('.active, .disabled')) {
        let page = $(this).data('id')
        $('#table').html('')
        $('#pagination').hide()
        $('#loading').show()
        get_data(page)
    }
})
