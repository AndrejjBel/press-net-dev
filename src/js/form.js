const callForm = () => {
    const formCall = document.querySelector('form.call-form')
    if ( formCall ) {
        const submitCall = document.querySelector('#submit-call')
        const phoneCall = document.querySelector('#phone_mask_call')
        const climatNonce = document.querySelector('#climat-nonce')
        phoneCall.addEventListener('input', () => {
            if ( phoneCall.value.length >= 17 ) {
                phoneCall.style.border = ''
            } else {
                phoneCall.style.border = '1px solid red'
            }
        })
        submitCall.addEventListener('click', function() {
            if ( phoneCall.value.length >= 17 ) {
                phoneCall.style.border = ''

                let nonceVal = climatNonce.value
                let formData = new FormData(formCall);
                formData.append('action', 'call_form_submit');
                formData.append('nonce', nonceVal);
                jQuery(document).ready( function($){
                    $.ajax({
                        url: "/wp-admin/admin-ajax.php",
                        method: 'post',
                        processData: false,
                        contentType: false,
                        data: formData,
                        beforeSend: function () {
                            // Вывод текста в процессе отправки
                        },
                        success: function (data) {
                            data = JSON.parse(data)
                            if ( data.class == 'success' ) {
                                document.querySelector('.modal__title').style.display = 'none'
                                document.querySelector('.request-call-form').innerHTML = '<h3>Thank you, we will contact you shortly!</h3>'
                            }
                        },
                        error: function (jqXHR, text, error) {
                            // Вывод текста ошибки отправки
                            //$(".question-popup").html(error);
                        }
                    });
                });
            } else {
                phoneCall.style.border = '1px solid red'
            }
        })
    }
}
callForm()

const contactForm = () => {
    const formCall = document.querySelector('form.contact-form')
    if ( formCall ) {
        const submitBtn = document.querySelector('#submit-contact-form')
        const phone = document.querySelector('#phone_mask')
        const name = document.querySelector('#name')
        const climatNonce = document.querySelector('#climat-nonce')
        const loader = document.querySelector('#js-loader')
        phone.addEventListener('input', () => {
            if ( phone.value.length >= 17 ) {
                phone.style.border = ''
            } else {
                phone.style.border = '1px solid red'
            }
        })
        name.addEventListener('input', () => {
            if ( name.value.length > 0 ) {
                name.style.border = ''
            } else {
                name.style.border = '1px solid red'
            }
        })
        submitBtn.addEventListener('click', function() {
            if ( name.value.length > 0 && phone.value.length >= 17 ) {
                let nonceVal = climatNonce.value
                let formData = new FormData(formCall);
                formData.append('action', 'order_calculation');
                formData.append('nonce', nonceVal);
                loader.classList.remove("no-active")
                jQuery(document).ready( function($){
                    $.ajax({
                        url: "/wp-admin/admin-ajax.php",
                        method: 'post',
                        processData: false,
                        contentType: false,
                        data: formData,
                        beforeSend: function () {
                            //loader.classList.remove("no-active")
                        },
                        success: function (data) {
                            //data = JSON.parse(data)
                            console.dir(data);
                            if ( data == 'success' ) {
                                formCall.innerHTML = '<h3>Спасибо, Мы свяжемся с Вами в ближайшее время!</h3>'
                            }
                        },
                        error: function (jqXHR, text, error) {
                            // Вывод текста ошибки отправки
                            //$(".question-popup").html(error);
                        }
                    });
                });
            } else if ( !name.value.length && phone.value.length >= 17 ) {
                name.style.border = '1px solid red'
            } else if ( phone.value.length < 17 && name.value.length > 0 ) {
                phone.style.border = '1px solid red'
            } else {
                name.style.border = '1px solid red'
                phone.style.border = '1px solid red'
            }
        })
    }
}
contactForm()

const fileDownload = () => {
    let inputs = document.querySelectorAll('.input__file');
    if ( inputs ) {
        Array.prototype.forEach.call(inputs, function (input) {
            let label = input.nextElementSibling,
            labelVal = label.querySelector('.input__file-button-text').innerText;

            input.addEventListener('change', function (e) {
                let countFiles = '';
                if (this.files && this.files.length >= 1)
                countFiles = this.files.length;

                if (countFiles)
                label.querySelector('.input__file-button-text').innerText = input.files[0].name //'Выбрано файлов: ' + countFiles;
                else
                label.querySelector('.input__file-button-text').innerText = labelVal;
                // console.dir(input.files[0].name);
            });
        });
    }
}
fileDownload()
