$('#form').submit(function(e) {
    // console.clear()
    $('.is-invalid').removeClass('is-invalid')
    e.preventDefault()
    addLoading()
    let formData = new FormData()
    let old_password = $('#password').val()
    let password = $('#npassword').val()
    let password_confirmation = $('#cpassword').val()
    formData.append('old_password', old_password)
    formData.append('password', password)
    formData.append('password_confirmation', password_confirmation)
    $.ajax({
        url: api_url + 'reset_password',
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem('token'))
        },
        success: function(result) {
            // console.log(response)
            customAlert('success', 'Password berhasil diubah')
            removeLoading('Ubah Password')
            $('input').val('')
        },
        error: function(xhr) {
            let err = xhr.responseJSON.errors
            console.log(xhr)
            if(err) {
                if (err.old_password) {
                    if (err.old_password == 'The old password field is required.') {
                        $('#password').addClass('is-invalid')
                        $('#password-feedback').html('Masukkan password lama')
                    }
                }
                if (err.password) {
                    if (err.password == 'The password field is required.') {
                        $('#npassword').addClass('is-invalid')
                        $('#npassword-feedback').html('Masukkan password baru')
                    } else if (err.password == 'The password must be at least 8 characters.') {
                        $('#npassword').addClass('is-invalid')
                        $('#npassword-feedback').html('Password minimal 8 karakter')
                    } else if (err.password == 'The password confirmation does not match.') {
                        $('#cpassword').addClass('is-invalid')
                        $('#cpassword-feedback').html('Konfirmasi password dengan benar')
                    }
                }
                if (err.password_confirmation) {
                    if (err.password_confirmation == 'The password confirmation field is required.') {
                        $('#cpassword').addClass('is-invalid')
                        $('#cpassword-feedback').html('Masukkan konfirmasi password')
                    }
                }
            }
            else if (xhr.responseJSON.data.message == 'old password is wrong') {
                $('#password').addClass('is-invalid')
                $('#password-feedback').html('Password lama salah')
            }
            removeLoading('Ubah Password')
        }
    })
})
