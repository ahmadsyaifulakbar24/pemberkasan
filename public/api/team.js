if (role == 200 || role == 202) $('.compose').remove()

get_data()

function get_data(page) {
    $.ajax({
        url: api_url + 'team_project/' + id,
        type: 'GET',
        data: {
            page: page
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function (result) {
            // console.log(result)
            $('#table').html('')
            $('#loading').hide()
            if (result.data.length > 0) {
                $('#data').show()
                let append
                $.each(result.data, function (index, value) {
                    append = `<tr data-id="${value.team.id}" data-name="${value.team.name}">
						<td class="text-center" width="10">${index + 1}.</td>
						<td class="text-truncate" id="name${value.team.id}">
                            <img src="${value.team.profile_photo_url}" class="rounded-circle mr-3" width="30">${value.team.name}
                        </td>
						<td class="text-truncate">${role_project(value.team.role_id)}</td>
                        <td></td>
					</tr>`
                    $('#table').append(append)
                })
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

function get_search(search) {
    $.ajax({
        url: api_url + 'user/search',
        type: 'GET',
        data: {
            search: search,
            user_role: 202
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function (result) {
            // console.log(result.data)
            if (result.data.length > 0) {
                if (search.length > 0) {
                    $('#leader').html('')
                    $('#leader').removeClass('hide')
                    $('#empty-leader').addClass('hide')
                    $('#state-leader').addClass('hide')
                    let append = ''
                    $.each(result.data, function (index, value) {
                        append = `<div class="btn btn-sm btn-link btn-block font-weight-bold text-dark text-left select-leader mt-0 mb-2" data-id="${value.id}" data-name="${value.name}">
                            <img src="${value.profile_photo_url}" class="rounded-circle mr-3" width="30">${value.name} <span class="text-secondary">(${role_project(value.role.id)})</span>
                        </div>`
                        $('#leader').append(append)
                    })
                } else {
                    $('#leader').html('')
                    $('#leader').addClass('hide')
                    $('#empty-leader').addClass('hide')
                    $('#state-leader').removeClass('hide')
                }
            } else {
                $('#leader').html('')
                $('#leader').addClass('hide')
                $('#empty-leader').removeClass('hide')
                $('#state-leader').addClass('hide')
            }
            $('#loading-leader').addClass('hide')
        },
        error: function (xhr, status) {
            setTimeout(function () {
                get_search(search)
            }, 1000)
        }
    })
}

$('#search-leader').keyup(function () {
    let val = $(this).val()
    if (val.length > 0) {
        $('#leader').html('')
        $('#leader').addClass('hide')
        $('#state-leader').addClass('hide')
        $('#empty-leader').addClass('hide')
        $('#loading-leader').removeClass('hide')
    } else {
        $('#leader').html('')
        $('#leader').addClass('hide')
        $('#state-leader').removeClass('hide')
        $('#empty-leader').addClass('hide')
        $('#loading-leader').addClass('hide')
    }
})
$('#search-leader').keyup(delay(function (e) {
    let val = $(this).val()
    val.length > 0 ? get_search(val) : ''
}, 500))

$(document).on('click', '.select-leader', function () {
    let id = $(this).data('id')
    let name = $(this).data('name')
    $('#accept').data('id', id)
    $('.leader').html(name)
    $('#modal-leader').modal('hide')
    $('#modal-accept').modal('show')
})

$('#modal-leader').on('show.bs.modal', function (e) {
    $('#search-leader').val('')
    $('#leader').html('')
    $('#leader').addClass('hide')
    $('#state-leader').removeClass('hide')
    $('#empty-leader').addClass('hide')
    $('#loading-leader').addClass('hide')
})

$('#modal-leader').on('shown.bs.modal', function (e) {
    $('#search-leader').focus()
})

$('#back').on('click', function (e) {
    $('#modal-leader').modal('show')
})

$('#accept').click(function () {
    $('#data').hide()
    $('#empty').hide()
    $('#loading').show()
    $(this).attr('disabled', true)
    let team_id = $(this).data('id')
    $('.modal').modal('hide')
    $.ajax({
        url: api_url + 'team_project/' + id + '/create',
        type: 'POST',
        data: {
            team_id: team_id,
            parent_user_id: localStorage.getItem('user')
        },
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function (result) {
            // console.log(result)
            get_data()
            $('#accept').attr('disabled', false)
            $('#modal-delete').modal('hide')
        }
    })
})
