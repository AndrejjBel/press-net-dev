const userAvatar = () => {
    const formAvatarUpload = document.querySelector('form#user_avatar_upload')
    if ( formAvatarUpload ) {
        const inputImageUpload = document.querySelector('#my_image_upload')
        inputImageUpload.addEventListener('change', function(e) {
            e.preventDefault();
            let formData = new FormData(formAvatarUpload);
            formData.append('action', 'press_net_avatar_upload');
            jQuery(document).ready( function($){
                $.ajax({
                    type: 'POST',
                    url: '/wp-admin/admin-ajax.php',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(data){
                        console.dir(data);
                        // let data_fin = JSON.parse(data)
                        // console.dir(data);
                    },
                    error: () => {
                        console.log('Ошибка отправки.');
                    }
                });
            })
        })
        FReader = new FileReader();
        FReader.onload = function(e) {
            document.querySelector('#result').src = e.target.result;
        };
        document.querySelector('#my_image_upload').addEventListener('change', loadImageFile);
        function loadImageFile() {
            var file = document.querySelector('#my_image_upload').files[0];
            FReader.readAsDataURL(file);
            // document.querySelector('.avatar-upload__img-prev svg').style.display = 'none'
            // document.querySelector('#result').style.display = 'block'
        }
    }
}
userAvatar()

const userAvatarDelete = () => {
    const buttonImageDelete = document.querySelector('#button-image-delete')
    if ( buttonImageDelete ) {
        const formAvatarUpload = document.querySelector('form#user_avatar_upload')
        buttonImageDelete.addEventListener('click', (e) => {
            e.preventDefault();
            let formData = new FormData(formAvatarUpload);
            formData.append('action', 'press_net_avatar_delete');
            jQuery(document).ready( function($){
                $.ajax({
                    type: 'POST',
                    url: '/wp-admin/admin-ajax.php',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(data){
                        console.dir(data);
                        document.querySelector('#result').src = '/defolt-no-user.svg';
                        // let data_fin = JSON.parse(data)
                        // console.dir(data);
                    },
                    error: () => {
                        console.log('Ошибка отправки.');
                    }
                });
            })
        })
    }
}
userAvatarDelete()

const userProfileNav = () => {
    const profileNav = document.querySelector('#profile-nav')
    if ( profileNav ) {
        const profileNavLinks = document.querySelectorAll('#profile-nav a')
        const tabs = document.querySelectorAll('.author-wrap__main-your-office__content__tab')
        profileNavLinks.forEach((link) => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                let atrHref = link.dataset.tab;
                let params = '?tab=' + atrHref;
                updateURL(params);
                let tabActyve = document.querySelector('.author-wrap__main-your-office__content__tab#'+atrHref)
                userProfileLincs(profileNavLinks, link, '');
                userProfileTab(tabs, tabActyve);
                tabs.forEach((tab) => {
                    if ( tab.id !== 'about') {
                        let tabsChildActive = tab.querySelectorAll('.active')
                        tabsChildActive.forEach((item) => {
                            item.classList.remove("active")
                        });

                    }
                });
            })
        });
        let params = (new URL(document.location)).searchParams;
        let paramTab = params.get('tab');
        if ( paramTab ) {
            let tabActyveLoc = document.querySelector('.author-wrap__main-your-office__content__tab#'+paramTab)
            userProfileLincs(profileNavLinks, '', paramTab);
            userProfileTab(tabs, tabActyveLoc);
        }
    }
}
userProfileNav()

const userProfileEdit = () => {
    const authorLkSubmit = document.querySelector('#author-lk-submit')
    if ( authorLkSubmit ) {
        const formAboutFields = document.querySelector('form.about-fields')
        const formInputs = formAboutFields.querySelectorAll('input[required]')
        const formInputsCheck = formAboutFields.querySelectorAll('input[type="checkbox"]')
        const formTextarea = formAboutFields.querySelector('textarea')
        formInputs.forEach((input) => {
            input.addEventListener('input', (e) => {
                if ( input.value.length > 0 ) {
                    authorLkSubmit.style.pointerEvents = 'auto'
                }
            })
        });
        formTextarea.addEventListener('input', (e) => {
            if ( formTextarea.value.length > 0 ) {
                authorLkSubmit.style.pointerEvents = 'auto'
            }
        })
        formInputsCheck.forEach((inputCheck) => {
            inputCheck.addEventListener('change', (e) => {
                authorLkSubmit.style.pointerEvents = 'auto'
            })
        });
        authorLkSubmit.addEventListener('click', (e) => {
            e.preventDefault();
            let inputsNo = 0;
            formInputs.forEach((input) => {
                if ( input.value.length > 0 ) {
                    input.parentElement.nextElementSibling.classList.remove("active")
                } else {
                    input.parentElement.nextElementSibling.classList.add("active")
                    ++inputsNo
                }
            });
            if ( inputsNo == 0 ) {
                console.dir(formAboutFields);
                let formData = new FormData(formAboutFields);
                formData.append('action', 'user_profile_edits');
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
                                        console.log(key + ': ' + data_fin[key]);
                                        document.querySelector('.notif-custom-reg').insertAdjacentHTML('beforeend', `
                                        <div class="notification closeable error">
                                        <p>${data_fin[key]}</p>
                                        <a class="close" href="#"></a>
                                        </div>`)

                                        if (key == 'types_error') {
                                            document.querySelector('#types_error').classList.add("active")
                                        } else {
                                            document.querySelector('#types_error').classList.remove("active")
                                        }
                                    }
                                }
                                // setTimeout( () => {
                                //     let notifys = document.querySelectorAll('.notif-custom-reg .notification')
                                //     for ( const elem of notifys ) {
                                //         elem.remove()
                                //     }
                                //     location.reload();
                                // }, 5000);
                            } else {
                                console.dir(data_fin.class);
                                document.querySelector('.notif-custom-reg').insertAdjacentHTML('beforeend', `
                                <div class="notification closeable success">
                                <p>${data_fin['success-end']}</p>
                                <a class="close" href="#"></a>
                                </div>`)
                                setTimeout( () => {
                                    let notifys = document.querySelectorAll('.notif-custom-reg .notification')
                                    for ( const elem of notifys ) {
                                        elem.remove()
                                    }
                                    location.reload();
                                }, 5000);
                                // welcomeText.classList.add("active")
                                // form.style.display = 'none'
                                // regEnd.style.display = 'block'
                            }
                        },
                        error: () => {
                            console.log('Ошибка отправки.');
                        }
                    });
                })
            } else {
                console.log(inputsNo);
            }
        })
    }
}
userProfileEdit()

const userProfileThemes = () => {
    const btnAddThemes = document.querySelectorAll('.user-themes__add-item')
    if ( btnAddThemes.length > 0 ) {
        btnAddThemes.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                btn.previousElementSibling.classList.toggle('active')
                btn.previousElementSibling.children[0].focus();
            })
        });
    }

    const inputThemes = document.querySelectorAll('input#themes')
    if ( inputThemes.length > 0 ) {
        const divThemes = document.querySelector('.user-themes__items')
        inputThemes.forEach((input) => {
            input.addEventListener('input', (e) => {
                if ( input.value.length > 0 ) {
                    input.nextElementSibling.classList.add('active')
                } else {
                    input.nextElementSibling.classList.remove('active')
                }
            })

            input.nextElementSibling.addEventListener('click', (e) => {
                userAddThemes(input, input.parentElement.previousElementSibling);
                userEditThemes(input.parentElement.nextElementSibling.nextElementSibling.nextElementSibling);
            })
        });
    }
}
userProfileThemes()

function userDeleteThemes(divThemes) {
    const btnDeleteThemes = document.querySelectorAll('.user-themes__items__item svg')
    if ( btnDeleteThemes.length > 0 ) {
        btnDeleteThemes.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                btn.parentElement.remove();
                userEditThemes(divThemes.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling);
                document.querySelector('#author-lk-submit').style.pointerEvents = 'auto'
            })
        });
    }
}
userDeleteThemes(document.querySelector('.user-themes__items'))

function userAddThemes(input, divThemes) {
    divThemes.insertAdjacentHTML(
        'beforeend',
        `<div class="user-themes__items__item">
            <span>${input.value}</span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <title>Delete a theme</title>
                <path d="M18 6L6 18" stroke="#2F54EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M6 6L18 18" stroke="#2F54EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>`)
        input.value = ''
        userDeleteThemes(divThemes);
}

function userEditThemes(elem) {
    const spanThemes = document.querySelectorAll('.user-themes__items__item span')
    if ( spanThemes.length > 0 ) {
        const inputThemesEdit = document.querySelector('input#user_themes_edit')
        let allThemes = [];
        spanThemes.forEach((span) => {
            allThemes.push(span.innerText);
        });
        elem.value = allThemes.join(',')
        document.querySelector('#author-lk-submit').style.pointerEvents = 'auto'
    }
}

const parentUserDelete = () => {
    const btnDeleteParentUser = document.querySelectorAll('#btn-delete-parent-user')
    if ( btnDeleteParentUser.length > 0 ) {
        btnDeleteParentUser.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const formAuthorNonce = document.querySelector('form#author_nonce')
                let formNonce = new FormData(formAuthorNonce);
                formNonce.append('action', 'parent_user_delete');
                formNonce.append('user_id', btn.dataset.user);
                jQuery(document).ready( function($){
                    $.ajax({
                        type: 'POST',
                        url: '/wp-admin/admin-ajax.php',
                        processData: false,
                        contentType: false,
                        data: formNonce,
                        success: function(data){
                            console.dir(data);
                            btn.parentElement.remove();
                        },
                        error: () => {
                            console.log('Ошибка отправки.');
                        }
                    });
                })
            })
        });
    }
}
parentUserDelete()

function userProfileTab(tabs, tabActyve) {
    tabs.forEach((tab) => {
        tab.classList.remove('active')
    });
    if ( tabActyve ) {
        tabActyve.classList.add('active')
    }
}

function userProfileLincs(links, linkActyve, tab) {
    if ( tab ) {
        if (links) {
            links.forEach((link) => {
                link.classList.remove('active')
            });
        }
        document.querySelector('a[data-tab="'+tab+'"]').classList.add('active')
        console.log(document.querySelector('#profile-nav a[data-tab="'+tab+'"]'));
    } else {
        if (links) {
            links.forEach((link) => {
                link.classList.remove('active')
            });
        }
        if ( linkActyve ) {
            linkActyve.classList.add('active')
        }
    }
}

function updateURL(params) {
    if (history.pushState) {
        var baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        var newUrl = baseUrl + params;
        history.pushState(null, null, newUrl);
    }
    else {
        console.warn('History API not supported');
    }
}
