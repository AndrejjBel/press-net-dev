import {genPassword} from './gen-pass.js';
const authForm = () => {
    const userLogin = document.querySelector('#user_login')
    const userPass = document.querySelector('#user_pass')
    const wpSubmit = document.querySelector('#wp-submit')
    if (userLogin) {
        userLogin.addEventListener('input', (e) => {
            if (userLogin.value.length > 0 &&  userPass.value.length > 0) {
                wpSubmit.disabled = false
                wpSubmit.style.opacity = 1
                wpSubmit.style.cursor = 'pointer'
                wpSubmit.style.pointerEvents = 'auto'
                wpSubmit.classList.add("button-sliding-icon")
            } else {
                wpSubmit.disabled = true
                wpSubmit.style.opacity = ''
                wpSubmit.style.cursor = ''
                wpSubmit.style.pointerEvents = ''
                wpSubmit.classList.remove("button-sliding-icon")
            }
        })

        userPass.addEventListener('input', (e) => {
            if (userLogin.value.length > 0 &&  userPass.value.length > 0) {
                wpSubmit.disabled = false
                wpSubmit.style.opacity = 1
                wpSubmit.style.cursor = 'pointer'
                wpSubmit.style.pointerEvents = 'auto'
                wpSubmit.classList.add("button-sliding-icon")
            } else {
                wpSubmit.disabled = true
                wpSubmit.style.opacity = ''
                wpSubmit.style.cursor = ''
                wpSubmit.style.pointerEvents = ''
                wpSubmit.classList.remove("button-sliding-icon")
            }
        })
    }
}
authForm()

const forgotPassUser = () => {
    const userEmail = document.querySelector('#user_email')
    const submitForgotPassword = document.querySelector('#forgot-password')
    const emaiWarningInput = document.querySelector('.user-email-forgot .warning-input')
    const forgotPasswordNonce = document.querySelector('#exchange_forgot_password')
    const formContent = document.querySelector('.form-content')
    const forgotPasswordEnd = document.querySelector('.forgot-password-end')
    const warningLogin = document.querySelector('.warning-text')

    if (submitForgotPassword) {
        userEmail.addEventListener('input', (e) => {
            if ( emailValidation(userEmail.value) ) {
                submitForgotPassword.disabled = false
                emaiWarningInput.classList.remove("active")
                submitForgotPassword.classList.add("button-sliding-icon")
                submitForgotPassword.style.opacity = 1
                submitForgotPassword.style.cursor = 'pointer'
                submitForgotPassword.style.pointerEvents = 'auto'
            } else {
                submitForgotPassword.disabled = true
                emaiWarningInput.classList.add("active")
                submitForgotPassword.classList.remove("button-sliding-icon")
                submitForgotPassword.style.opacity = ''
                submitForgotPassword.style.cursor = ''
                submitForgotPassword.style.pointerEvents = ''
            }
        })

        submitForgotPassword.addEventListener('click', (e) => {
            console.log('Yes');
            let userEmailVal = userEmail.value
            let nonce = forgotPasswordNonce.value
            if ( userEmailVal ) {
                jQuery(document).ready( function($){
                    $.ajax({
                        type: 'POST',
                        url: '/wp-admin/admin-ajax.php',
                        data: {
                            action: 'emailverifi',
                            "email_forgot": userEmailVal,
                            "nonce": nonce
                        },
                        success: function(data){
                            let data_fin = JSON.parse(data)
                            if (data_fin.class == 'errors') {
                                console.dir(data_fin.no_user);
                                warningLogin.classList.add("active")
                                userEmail.value = ''
                            } else {
                                console.dir(data_fin.class);
                                console.dir(data_fin.error_send_mail);
                                // formContent.style.display = 'none'
                                warningLogin.classList.remove("active")
                                forgotPasswordEnd.style.display = 'block'
                            }
                            //location.reload();
                            //popupAddReviews.classList.remove('popup--opened')
                        },
                        error: () => {
                            console.log('Ошибка отправки.');
                        }
                    })
                })
            }
        })
    }

}
forgotPassUser()

const rememberPassUser = () => {
    const rememberPasswordForm = document.querySelector('#remember-password-form')
    if (rememberPasswordForm) {
        const newUserPass = document.querySelector('#new_user_pass')
        const newUserPassRepeat = document.querySelector('#new_user_pass_repeat')
        const rememberPasswordSubmit = document.querySelector('#remember-password')

        const passRegSpan = document.querySelector('#pass-reg-span')
        const passRegRepSpan = document.querySelector('#pass-reg-rep-span')
        const passRegSpanRegex = document.querySelector('#pass-reg-span-regex')
        const passRegRepSpanRegex = document.querySelector('#pass-reg-rep-span-regex')
        const btnGeneratePassword = document.querySelector('#generate-password')
        const nonce = document.querySelector('#new_user_pass_nonce')

        newUserPass.addEventListener('input', (e) => {
            if ( userPassValidation(newUserPass.value) ) {
                rememberPasswordSubmit.disabled = false
                passRegSpanRegex.classList.remove("active")
            } else {
                rememberPasswordSubmit.disabled = true
                passRegSpanRegex.classList.add("active")
            }
        })

        newUserPass.addEventListener('input', (e) => {
            if ( userPassValidation(newUserPass.value) && newUserPass.value == newUserPassRepeat.value ) {
                rememberPasswordSubmit.disabled = false
                rememberPasswordSubmit.classList.add("button-sliding-icon")
                rememberPasswordSubmit.style.opacity = 1
                rememberPasswordSubmit.style.cursor = 'pointer'
                rememberPasswordSubmit.style.pointerEvents = 'auto'
            } else {
                rememberPasswordSubmit.disabled = true
                rememberPasswordSubmit.classList.remove("button-sliding-icon")
                rememberPasswordSubmit.style.opacity = ''
                rememberPasswordSubmit.style.cursor = ''
                rememberPasswordSubmit.style.pointerEvents = ''
            }
        })

        newUserPassRepeat.addEventListener('input', (e) => {
            if ( newUserPass.value == newUserPassRepeat.value ) {
                rememberPasswordSubmit.disabled = false
                passRegRepSpanRegex.classList.remove("active")
            } else {
                rememberPasswordSubmit.disabled = true
                passRegRepSpanRegex.classList.add("active")
            }
        })

        newUserPassRepeat.addEventListener('input', (e) => {
            if ( userPassValidation(newUserPass.value) && newUserPass.value == newUserPassRepeat.value ) {
                rememberPasswordSubmit.disabled = false
                rememberPasswordSubmit.classList.add("button-sliding-icon")
                rememberPasswordSubmit.style.opacity = 1
                rememberPasswordSubmit.style.cursor = 'pointer'
                rememberPasswordSubmit.style.pointerEvents = 'auto'
            } else {
                rememberPasswordSubmit.disabled = true
                rememberPasswordSubmit.classList.remove("button-sliding-icon")
                rememberPasswordSubmit.style.opacity = ''
                rememberPasswordSubmit.style.cursor = ''
                rememberPasswordSubmit.style.pointerEvents = ''
            }
        })

        btnGeneratePassword.addEventListener('click', (e) => {
            e.preventDefault();
            // genpass(12, 3, '#new_user_pass', '#new_user_pass_repeat')
            let newPasswordVal = genPassword.get( 12, 1, 1, 1);
            newUserPass.value = newPasswordVal
            newUserPassRepeat.value = newPasswordVal
            rememberPasswordSubmit.disabled = false
            rememberPasswordSubmit.classList.add("button-sliding-icon")
            rememberPasswordSubmit.style.opacity = 1
            rememberPasswordSubmit.style.cursor = 'pointer'
            rememberPasswordSubmit.style.pointerEvents = 'auto'
            passRegSpanRegex.classList.remove("active")
            passRegRepSpanRegex.classList.remove("active")
        })

        rememberPasswordSubmit.addEventListener('click', (e) => {
            e.preventDefault();
            if ( newUserPass.value == newUserPassRepeat.value ) {
                let key = getParameter( "key" )
                let login = getParameter( "login" )
                jQuery(document).ready( function($){
                    $.ajax({
                        type: 'POST',
                        url: '/wp-admin/admin-ajax.php',
                        data: {
                            action: 'new_user_pass',
                            "key": key,
                            "login": login,
                            "pass": newUserPass.value,
                            "nonce": nonce.value
                        },
                        success: function(data){
                            let data_fin = JSON.parse(data)
                            if (data_fin.class == 'errors') {
                                console.dir(data_fin);
                                for (var key in data_fin) {
                                    if (key !== 'class') {
                                        document.querySelector('.notif-custom-reg').insertAdjacentHTML('beforeend', `
                                        <div class="notification closeable error">
                                        <p>${data_fin[key]}</p>
                                        <a class="close" href="#"></a>
                                        </div>`)
                                    }
                                }
                            } else {
                                console.dir(data_fin);
                                for (var key in data_fin) {
                                    if (key !== 'class') {
                                        document.querySelector('.notif-custom-reg').insertAdjacentHTML('beforeend', `
                                        <div class="notification closeable success">
                                        <p>${data_fin[key]}</p>
                                        <a class="close" href="#"></a>
                                        </div>`)
                                    }
                                }
                                setTimeout( () => {
                                    document.location.href = '/login';
                                }, 4000);
                            }
                            //location.reload();
                            //popupAddReviews.classList.remove('popup--opened')
                        },
                        error: () => {
                            console.log('Send error.');
                        }
                    })
                })
            } else {
                rememberPasswordSubmit.disabled = true
                passRegRepSpanRegex.style.display = 'block'
            }

        })
    }

}
rememberPassUser()

const regUser = () => {
    const loginRegisterPage = document.querySelector('#register-page')
    if (loginRegisterPage) {
        const firstName = document.querySelector('#first_name')
        const firstNameWarningInput = document.querySelector('.user-first-name .warning-input')

        const lastName = document.querySelector('#last_name')
        const lastNameWarningInput = document.querySelector('.user-last-name .warning-input')

        const emailAddress = document.querySelector('#email_register')
        const emaiWarningInput = document.querySelector('.user-email-register .warning-input')

        const password = document.querySelector('#password_register')
        const passRegSpanRegex = document.querySelector('#pass-reg-span-regex')

        const nonce = document.querySelector('#exchange_register')
        const registerAccountSubmit = document.querySelector('#register-account-submit')

        const regEnd = document.querySelector('.reg-end')
        const welcomeText = document.querySelector('.reg-page .reg-end')
        const form = document.querySelector('form#register-account-form')

        const btnGeneratePassword = document.querySelector('#generate-password')

        const checkPrivacyText = document.querySelector('#privacy-text')
        const checkPrivacyTextWarn = document.querySelector('.checkbox-privacy-text-warning')

        emailAddress.addEventListener('input', (e) => {
            if ( emailValidation(emailAddress.value) ) {
                emaiWarningInput.classList.remove("active")
                emailAddress.style.border = ''
            } else {
                emaiWarningInput.classList.add("active")
            }
        })

        password.addEventListener('input', (e) => {
            if ( userPassValidation(password.value) ) {
                passRegSpanRegex.classList.remove("active")
                password.style.border = ''
            } else {
                passRegSpanRegex.classList.add("active")
            }
        })

        btnGeneratePassword.addEventListener('click', (e) => {
            e.preventDefault();
            // genpass(12, 4, '#password_register', '')
            password.value = genPassword.get( 12, 1, 1, 1);
            passRegSpanRegex.classList.remove("active")
            password.style.border = ''
        })

        form.querySelectorAll('input').forEach((item) => {
            item.addEventListener('input', (e) => {
                item.style.border = ''
            })
        });

        registerAccountSubmit.addEventListener('click', (e) => {
            e.preventDefault();
            const formInputs = document.querySelectorAll('form#register-account-form input[required]')
            const formInputsAll = document.querySelectorAll('form#register-account-form input')
            const emailAddresVal = document.querySelector('#email_register')
            const passwordVal = document.querySelector('#password_register')

            // console.dir(formValidate(formInputs, emailAddresVal, passwordVal));

            if ( formValidate(formInputs, emailAddresVal, passwordVal) == true ) {
                // console.dir('Yes');

                let formData = new FormData(form);
                formData.append('action', 'press_net_register');
                // console.dir(Array.from(formData));

                jQuery(document).ready( function($){
                    $.ajax({
                        type: 'POST',
                        url: '/wp-admin/admin-ajax.php',
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(data){
                            console.dir(data);
                            let data_fin = JSON.parse(data)
                            if (data_fin.class == 'errors') {
                                for (var key in data_fin) {
                                    if (key !== 'class') {
                                        // console.log(key + ': ' + data_fin[key]);
                                        document.querySelector('.notif-custom-reg').insertAdjacentHTML('beforeend', `
                                        <div class="notification closeable error">
                                        <p>${data_fin[key]}</p>
                                        <a class="close" href="#"></a>
                                        </div>`)
                                    }
                                }
                                let aCloseNotifys = document.querySelectorAll('.notif-custom-reg .notification a.close')
                                setTimeout( () => {
                                    let notifys = document.querySelectorAll('.notif-custom-reg .notification')
                                    for ( const elem of notifys ) {
                                        elem.remove()
                                    }
                                    location.reload();
                                }, 10000);
                            } else {
                                welcomeText.classList.add("active")
                                form.reset();
                                formCheckboxFalse(form);
                                // form.style.display = 'none'
                            }
                        },
                        error: () => {
                            console.log('Ошибка отправки.');
                        }
                    });
                });
            } else {
                console.dir('No');
            }

            if ( checkPrivacyText.checked ) {
                // if (password.value === passwordRepeat.value ) {
                //     let emailAddressVal = emailAddress.value
                //     let passwordVal = password.value
                //     let nonceVal = nonce.value

                // } else {
                //     passRegRepSpanRegex.style.display = 'block'
                // }
            } else {
                checkPrivacyTextWarn.style.display = 'block'
            }

        })

    }
}
regUser()

function formValidate(formInputs, emailInput, passInput) {
    let inputsValue = 0
    formInputs.forEach((input) => {
        if ( input.type !== 'checkbox' ) {
            if ( input.value ) {
                ++inputsValue
            } else {
                input.style.border = '1px solid var(--orange-color)'
                if ( input.id == 'company_id' || input.id == 'media_id' ) {
                    console.dir(input);
                    input.style.border = ''
                    input.previousElementSibling.classList.add("active")
                }
            }
        }
        if ( input.id == 'privacy-text' ) {
            if ( input.checked == true ) {
                input.nextElementSibling.classList.remove("active")
                ++inputsValue
            } else {
                input.nextElementSibling.classList.add("active")
            }
        }
    });
    // console.dir(formInputs.length);
    // console.dir(inputsValue);
    if ( formInputs.length == inputsValue && emailValidation(emailInput.value) && userPassValidation(passInput.value) ) {
        return true;
    } else {
        return false;
    }
}

function formCheckboxFalse(form) {
    let formInputs =  form.querySelectorAll('input[type="checkbox"]')
    let formActive =  form.querySelectorAll('.checkbox .active')
    formInputs.forEach((input) => {
        input.checked = false
    });
    formActive.forEach((item) => {
        item.classList.remove("active")
    });
    form.querySelector('.new-company-form').classList.remove("active")
    form.querySelector('.new-media-form').classList.remove("active")
    form.querySelectorAll('.field-group').forEach((item) => {
        item.style.opacity = ''
        if ( item.children[1].children[0] ) {
            item.children[1].children[0].style.pointerEvents = ''
        }
    });
}

function getParameter(key) {
    let address = window.location.search
    let parameterList = new URLSearchParams(address)
    return parameterList.get(key)
}

function emailValidation(value) {
    let txt = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return txt.test(value);
}

function userNicValidation(value) {
    let txt = /^[a-zA-Z0-9_-\s]{3,15}$/;
    return txt.test(value);
}

function userFullNicValidation(value) {
    let txt = /^[a-zA-Zа-яА-Я0-9_-\s]{3,60}$/;
    return txt.test(value);
}

function userPassValidation(value) { // ((?=.*\\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})
    let txt = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/;
    return txt.test(value);
}


function genpass(passlen, passwstrength, elem, elemRepeat) {
    var chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var numbers_chars = '0123456789';
    var special_chars = '!@#$%^&*()';
    var extra_special_chars = '[]{}<>~+=/?|';  // '-_[]{}<>~`+=,.;:/?|'

    xchars = chars;
    if(passwstrength == 2) xchars += special_chars;
    if(passwstrength == 3) xchars += special_chars + extra_special_chars;
    if(passwstrength == 4) xchars += special_chars + numbers_chars + extra_special_chars;

    password='';

    for ( i=0; i<passlen; i++ )
    password += xchars.charAt(Math.floor(Math.random()*xchars.length));

    var parts = password.match(/.{1,3}/g);
    new_password = parts.join("-");

    document.querySelector(elem).value = new_password;
    if ( elemRepeat ) {
        document.querySelector(elemRepeat).value = new_password;
    }
}
