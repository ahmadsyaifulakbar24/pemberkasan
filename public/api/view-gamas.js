// directur
if (role == 200) {
    $('.compose').remove()
}
// manager
else if (role == 201) {
    $('#btn-edit').removeClass('hide')
    if (status_id == 8) {
        $('#btn-accept').removeClass('hide')
    }
}
//leader
else if (role == 202) {
    if (status_id == 2 || status_id == 3 || status_id == 4) {
        $('#btn-accept').removeClass('hide')
    }
}

if (localStorage.getItem('select') != null) {
	if (localStorage.getItem('select') == 'photo') {
		$('#photo').show()
        $('#document').hide()
        $('#select-type select').val('photo')
    } else {
        $('#photo').hide()
        $('#document').show()
        $('#select-type select').val('document')
	}
}

if (status_id == 9) {
	$('#btn-photo').remove()
	$('#btn-document').remove()
	$('#select-type select').append(`<option value="mapping">Mapping</option>`)
}

let project

$.ajax({
    url: `${api_url}project/get/${id}`,
    type: 'GET',
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token)
    },
    success: function (result) {
        let value = result.data
        // console.log(value)
        if (value.type.id == 11) {
            if (status_id == value.status.id) {
            	project = value.name
                $('.project').html(value.name)
		        $('#project').html(value.status.status_project)
		        $('#btn-edit').attr('href', `${root}project/${value.id}`)
		        $('#btn-project').attr('href', `${root}project/team/${value.id}`)
                localStorage.setItem('type_id', value.type.id)
            } else {
                location.href = `${root}project/gamas/${value.id}/${value.status.id}`
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
    url: api_url + 'history_project/' + id,
    type: 'GET',
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Bearer " + token)
    },
    success: function (result) {
        let value = result.data
        // console.log(value)
        let append
        $.each(value, function (index, value) {
        	// console.log(value)
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
                        <small class="text-capitalize">${history_project(value.status_project.status_project, value.status_project.status_project)}</small>
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
            xhr.setRequestHeader("Authorization", "Bearer " + token)
        },
        success: function (result) {
            let type_file, keterangan
            let total = 1
            let total_image = 0
            let total_document = 0
            if (result.data.length > 0) {
                $.each(result.data, function (index, value) {
                	// console.log(value)
                    if (value.file_type == 'image') {
	                	action = ``
	                	if (role != '200') {
	                		action = `<div class="ml-auto text-right col-xl-4 col-3 pr-0" data-id="${value.id}" data-name="${value.file_name}">
	                			<a href="${root}edit/photo/${value.id}" class="text-dark mr-3"><i class="mdi mdi-18px mdi-pencil pr-0"></i></a>
	                			<i class="mdi mdi-18px mdi-trash-can-outline pr-0 trash-photo" role="button"></i>
	            			</div>`
	                	}
	                    append = `<div class="col-xl-4 col-md-6 mb-3">
	                		<div class="card card-height" title="${value.file_name}">
		                		<div class="card-header d-flex align-items-center">
			                		<div class="text-truncate">${value.file_name}</div>
			                		${action}
		                		</div>
		                		<img src="${value.file_url}" class="card-img-top card-img border-bottom" role="button">
	                		</div>
	            		</div>`
	                    $('#photo .row').append(append)
	                    total_image++
	                } else {
	                    value.keterangan != null ? keterangan = value.keterangan : keterangan = ''
	                    if (role == '201') {
	                        append = `<tr data-id="${value.id}" data-name="${value.file_name}">
	                            <td class="text-center">${total}.</td>
	                            <td class="text-truncate"><a href="${root}edit/document/${value.id}">${value.file_name}</a></td>
	                            <td class="text-truncate"><a href="${value.file_url}" target="_blank" class="btn btn-sm btn-outline-primary">Download</a></td>
	                            <td class="text-truncate">${keterangan}</td>
	                            <td class="text-truncate">${hidden_project(value.hidden)}</td>
	                            <td><i class="mdi mdi-trash mdi-trash-can-outline mdi-18px pr-0 trash-document" role="button"></i></td>
	                        </tr>`
	                        $('#table').append(append)
	                        $('.directur').remove()
	                        total++
	                        total_document++
	                    } else if (role == '202') {
	                    	if (value.hidden == false) {
	                            append = `<tr data-id="${value.id}" data-name="${value.file_name}">
		                            <td class="text-center">${total}.</td>
		                            <td class="text-truncate"><a href="${root}edit/document/${value.id}">${value.file_name}</a></td>
		                            <td class="text-truncate"><a href="${value.file_url}" target="_blank" class="btn btn-sm btn-outline-primary">Download</a></td>
		                            <td class="text-truncate">${keterangan}</td>
		                            <td><i class="mdi mdi-trash mdi-trash-can-outline mdi-18px pr-0 trash-document" role="button"></i></td>
		                        </tr>`
	                            $('#table').append(append)
	                            total++
	                            total_document++
	                        }
	                        $('.manager').remove()
	                    } else if (role == '200') {
	                        append = `<tr>
	                            <td class="text-center">${total}.</td>
	                            <td class="text-truncate">${value.file_name}</td>
	                            <td class="text-truncate"><a href="${value.file_url}" target="_blank" class="btn btn-sm btn-outline-primary">Download</a></td>
	                            <td class="text-truncate">${keterangan}</td>
	                            <td></td>
	                        </tr>`
	                        $('#table').append(append)
	                        $('.manager').remove()
	                        total++
	                        total_document++
	                    }
	                }
                })
                if (total_image < 1) {
                    $('#photo-empty').show()
                } else {
                    $('#btn-golive').hide()
                }
                if (total_document < 1) {
                    $('#document .card').hide()
                    $('#document-empty').show()
                }
                $('table').addClass('table-middle')
                $('.omzetting').remove()
            } else {
                $('#card').hide()
                $('#empty').show()
                $('#title-empty').prepend(localStorage.getItem('empty_status'))
                $('#icon-empty').addClass(status_project_icon(parseInt(localStorage.getItem('empty_status_id'))))
            }
        }
    })
	if (status_id == 9) {
		$.ajax({
            url: `${api_url}file_manager/${id}/image_by_project`,
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer " + token)
            },
            success: function(result) {
                let append, type_file, keterangan, download = 0
                if (result.data.length > 0) {
                    $.each(result.data, function(index, value) {
                        // console.log(value)
                        if (value.file_status != null) {
                            active = 'card-active'
                            if (value.file_status == 'before') {
                                before = 'selected'
                                after = ''
                            } else {
                                before = ''
                                after = 'selected'
                            }
                        } else {
                            active = ''
                            before = ''
                            after = ''
                        }
                        // index == 0 ? $(`#status_project${value.status_project.id}`).empty() : ''
                        role == '200' ? disabled = 'disabled' : disabled = ''
                        append = `<div class="col-xl-4 col-6 mb-3 col-card">
                    		<div class="card card-height ${active}" title="${value.file_name}" data-id="${value.id}">
	                     		<img src="${value.file_url}" class="card-img-top card-mapping border-bottom" role="button">
	                     		<div class="card-body p-0 d-flex align-items-end">
	                     			<select class="custom-select border-0 file_status" role="button" data-id=${value.id} ${disabled}>
	                     				<option disabled selected>Pilih Status</option>
	                     				<option value="before" ${before}>Before</option>
	                     				<option value="after" ${after}>After</option>
	                     			</select>
	                     		</div>
                    		</div>
                    	</div>`
                        $(`#mapping .row`).append(append)
                    })
                } else {
                    $('#card').hide()
                    $('#empty').show()
                    $('#title-empty').prepend(localStorage.getItem('empty_status'))
                    $('#icon-empty').addClass(status_project_icon(parseInt(localStorage.getItem('empty_status_id'))))
                }
            }
        })
	}
}

$(document).ajaxStop(function () {
    $('#data').show()
    $('#loading').remove()
})

$('#accept').click(function () {
    $.ajax({
        url: `${api_url}project/${id}/accept_status`,
        type: 'PATCH',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token)
        },
        success: function (result) {
            let value = result.data
            // console.log(value)
            $('#accept').attr('disabled', true)
            location.href = `${root}project/gamas/${id}/9`
        }
    })
})

$('#select-type select').change(function() {
    $('#photo').hide()
    $('#document').hide()
    $('#mapping').hide()
    $('#btn-mapping').hide()
    if ($(this).val() == 'photo') {
        localStorage.setItem('select', 'photo')
        $('#photo').show()
    } else if ($(this).val() == 'document') {
        localStorage.setItem('select', 'document')
        $('#document').show()
    } else {
        $('#mapping').show()
	    $('#btn-mapping').show()
    }
})

$(document).on('click', '.trash-photo', function() {
    $('#modal-delete').modal('show')
    let id = $(this).closest('.ml-auto').data('id')
    let name = $(this).closest('.ml-auto').data('name')
    $('#delete').data('id', id)
    $('#body-delete').html(`foto <b>${name}</b>`)
})

$(document).on('click', '.trash-document', function() {
    $('#modal-delete').modal('show')
    let id = $(this).closest('tr').data('id')
    let name = $(this).closest('tr').data('name')
    $('#delete').data('id', id)
    $('#body-delete').html(`dokumen <b>${name}</b>`)
})

$('#delete').click(function() {
    let id = $(this).data('id')
    $(this).attr('disabled', true)
    $.ajax({
        url: `${api_url}file_manager/${id}/delete`,
        type: 'DELETE',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token)
        },
        success: function(result) {
            $('#photo .row').empty()
            $('#table').empty()
            get_data()
            $('#modal-delete').modal('hide')
            $('#delete').attr('disabled', false)
        }
    })
})

$(document).on('click', '.card-img', function() {
    let src = $(this).attr('src')
    $('#modal-photo').modal('show')
    $('.photo').attr('src', src)
})

$(document).on('click', '.card-mapping', function() {
    if (role != '200') {
        if ($(this).parents('.card').hasClass('card-active')) {
            $(this).parents('.card').removeClass('card-active')
            $(this).parents('.card').find('select').removeClass('is-invalid')
        } else {
            $(this).parents('.card').addClass('card-active')
        }
    }
})

$(document).on('click', '#btn-mapping', function() {
    let error = false
    let image_mapping = []
    $('.is-invalid').removeClass('is-invalid')
    $('.card-active').each(function(index, value) {
        image_mapping.push({
            file_manager_id: $(this).data('id'),
            file_status: $(this).find('select').val()
        })
    })
    $.each(image_mapping, function(index, value) {
        if (value.file_status == null) {
            $(`.file_status[data-id="${value.file_manager_id}"]`).addClass('is-invalid')
            error = true
        }
    })
    // console.clear()
    // console.log(image_mapping)
    if (image_mapping.length > 0) {
        if (error == false) {
            $.ajax({
                url: `${api_url}file_manager/${id}/image_mapping`,
                type: 'POST',
                data: {
                    image_mapping: image_mapping
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer " + token)
                },
                success: function(result) {
                    // console.log(result)
                    download_mapping()
                }
            })
        }
    } else {
        customAlert('warning', 'Pilih foto terlebih dahulu')
    }
})

function download_mapping() {
    $.ajax({
        url: `${api_url}file_manager/${id}/image_by_project`,
        type: 'GET',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token)
        },
        success: function(result) {
            $('#before').empty()
            $('#after').empty()
            $.each(result.data, function(index, value) {
                if (value.file_status != null) {
                    append = `<div class="col-6 mb-4">
            			<img src="${value.file_url}" alt="${value.file_name}" class="img-fluid border">
            		</div>`
                    $(`#${value.file_status}`).append(append)
                }
            })
            let filename = `Mapping ${project}.pdf`
            let element = $('#content-mapping').html()

            let opt = {
                margin: [0.3, 0.3],
                filename: filename,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            }
            html2pdf().from(element).set(opt).toPdf().get('pdf').then(function(pdf) {
                var totalPages = pdf.internal.getNumberOfPages()
                for (i = 1; i <= totalPages; i++) {
                    pdf.setPage(i)
                    pdf.setFontSize(9)
                    pdf.text(i + ' / ' + totalPages, (pdf.internal.pageSize.getWidth() - 0.8), (pdf.internal.pageSize.getHeight() - 0.8))
                }
            }).save()
            customAlert('success', 'Berhasil unduh PDF')
        }
    })
}