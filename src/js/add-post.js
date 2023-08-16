const formOpen = () => {
    const btnFormOpen = document.querySelectorAll('#btn-add-post-form-open')
    if ( btnFormOpen.length > 0 ) {
        const buttonsGroupPost = document.querySelectorAll('.buttons-group-post button')
        const companyName = document.querySelector('#company-name')
        btnFormOpen.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                btn.nextElementSibling.classList.add('active')
            })
        });
    }
}
formOpen()

const headTitleName = () => {
    const archiveAuthor = document.querySelector('.archive.author')
    if ( archiveAuthor ) {
        const formAddRequest = document.querySelector('form#form-add-request')
        const postTitle = document.querySelectorAll('#post_title')
        const jobTitle = document.querySelectorAll('#job_title')
        if ( !formAddRequest && postTitle.length > 0 ) {
            postTitle.forEach((item) => {
                item.addEventListener('input', (e) => {
                    item.form.previousElementSibling.children[0].children[0].innerText = item.value
                })
            });
        }
        if ( jobTitle.length > 0 ) {
            jobTitle.forEach((item) => {
                item.addEventListener('input', (e) => {
                    if ( item.value.length > 0 ) {
                        item.form.previousElementSibling.children[0].children[1].classList.add('active')
                    } else {
                        item.form.previousElementSibling.children[0].children[1].classList.remove('active')
                    }
                    item.form.previousElementSibling.children[0].children[2].innerText = item.value
                })
            });
        }
    }

}
headTitleName()

const formAddPost = () => {
    const buttonsGroupPost = document.querySelectorAll('.buttons-group-post.add-post button')
    if ( buttonsGroupPost.length > 0 ) {
        const companyName = document.querySelector('#company-name')
        const titleAddForm = document.querySelector('#head-title-add-form span')
        buttonsGroupPost.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                if ( btn.id == 'btn-cancel-post-form' ) {
                    e.preventDefault();
                    btn.parentElement.parentElement.parentElement.classList.remove('active')
                    btn.parentElement.parentElement.reset();
                    btn.parentElement.parentElement.previousElementSibling.children[0].children[0].innerText = btn.dataset.title
                    btn.parentElement.parentElement.previousElementSibling.children[0].children[1].classList.remove('active')
                    btn.parentElement.parentElement.previousElementSibling.children[0].children[2].innerText = ''
                    // titleAddForm.innerText = 'New company'
                } else if ( btn.id == 'btn-cancel-post-form-request' ) {
                    btn.parentElement.parentElement.reset();
                } else if ( btn.id == 'btn-save-post-form' ) {
                    e.preventDefault();
                    if ( inputValidate(btn.parentElement.parentElement) ) {
                        const formAuthorNonce = document.querySelector('form#author_nonce')
                        let formNonce = new FormData(formAuthorNonce);
                        let formData = new FormData(btn.parentElement.parentElement);
                        formData.append('action', 'press_net_add_post');
                        for(let [name, value] of formNonce) {
                            formData.append(name, value);
                            // console.dir(`${name} = ${value}`); // key1=value1, потом key2=value2
                        }
                        jQuery(document).ready( function($){
                            $.ajax({
                                type: 'POST',
                                url: '/wp-admin/admin-ajax.php',
                                processData: false,
                                contentType: false,
                                data: formData,
                                success: function(data){
                                    // console.dir(data);
                                    // let data_fin = JSON.parse(data)
                                    // console.dir(data);
                                    setTimeout( () => {
                                        location.reload();
                                    }, 1000);
                                },
                                error: () => {
                                    console.log('Ошибка отправки.');
                                }
                            });
                        })
                    } else {
                        console.dir('Field is required');
                    }
                }
            })
        });
    }
}
formAddPost()

const formEditOpen = () => {
    const btnFormEditOpen = document.querySelectorAll('#btn-edit-post-form-open')
    if ( btnFormEditOpen.length > 0 ) {
        const buttonsGroupPost = document.querySelectorAll('.buttons-group-post button')
        btnFormEditOpen.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                btn.parentElement.parentElement.nextElementSibling.classList.toggle('active')
            })
        });
    }
}
formEditOpen()

const formEditPost = () => {
    const buttonsGroupPost = document.querySelectorAll('.buttons-group-post.edit-post button')
    if ( buttonsGroupPost.length > 0 ) {
        buttonsGroupPost.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                if ( btn.id == 'btn-cancel-post-form' ) {
                    e.preventDefault();
                } else if ( btn.id == 'btn-edit-post-form' ) {
                    e.preventDefault();
                    if ( inputValidate(btn.parentElement.parentElement) ) {
                        const formAuthorNonce = document.querySelector('form#author_nonce')
                        let formNonce = new FormData(formAuthorNonce);
                        let formData = new FormData(btn.parentElement.parentElement);
                        formData.append('action', 'press_net_edit_post');
                        for(let [name, value] of formNonce) {
                            formData.append(name, value);
                        }
                        jQuery(document).ready( function($){
                            $.ajax({
                                type: 'POST',
                                url: '/wp-admin/admin-ajax.php',
                                processData: false,
                                contentType: false,
                                data: formData,
                                success: function(data){
                                    // console.dir(data);
                                    btn.parentElement.parentElement.classList.remove('active')
                                    btn.parentElement.parentElement.nextElementSibling.classList.add('active')
                                    setTimeout( () => {
                                        btn.parentElement.parentElement.nextElementSibling.classList.remove('active')
                                    }, 3000);
                                    // let data_fin = JSON.parse(data)
                                    // console.dir(data);
                                },
                                error: () => {
                                    console.log('Ошибка отправки.');
                                }
                            });
                        })
                    } else {
                        console.dir('Field is required');
                    }
                }
            })
        });
    }
}
formEditPost()

const formDeletePost = () => {
    const btnDeletePost = document.querySelectorAll('#btn-delete-post-form-open')
    if ( btnDeletePost.length > 0 ) {
        const form = document.querySelector('form#author_nonce')
        btnDeletePost.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                console.dir(btn.dataset.post);
                let formData = new FormData(form);
                formData.append('action', 'press_net_delete_post');
                formData.append('post_id', btn.dataset.post);
                jQuery(document).ready(function($){
                    $.ajax({
                        type: 'POST',
                        url: '/wp-admin/admin-ajax.php',
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(data) {
                            console.log(data);
                            btn.parentElement.parentElement.parentElement.remove();
                            // var data_json = JSON.parse(data);
                            // console.log(data_json);
                            // location.reload();
                        }
                    });
                });
            })
        });
    }
}
formDeletePost()

const formAddPortfolio = () => {
    const formAddRequest = document.querySelector('form#form-add-request')
    const buttonsGroupPost = document.querySelectorAll('.buttons-group-post.add-port button')
    if ( buttonsGroupPost.length > 0 ) {
        const companyName = document.querySelector('#company-name')
        const titleAddForm = document.querySelector('#head-title-add-form span')
        buttonsGroupPost.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                if ( btn.id == 'btn-cancel-port-form' ) {
                    e.preventDefault();
                    btn.parentElement.parentElement.parentElement.classList.remove('active')
                    btn.parentElement.parentElement.reset();
                    btn.parentElement.parentElement.previousElementSibling.children[0].children[0].innerText = btn.dataset.title
                    btn.parentElement.parentElement.previousElementSibling.children[0].children[1].classList.remove('active')
                    btn.parentElement.parentElement.previousElementSibling.children[0].children[2].innerText = ''
                    // titleAddForm.innerText = 'New company'
                } else if ( btn.id == 'btn-save-port-form' ) {
                    e.preventDefault();
                    if ( inputValidate(btn.parentElement.parentElement) ) {
                        const formAuthorNonce = document.querySelector('form#author_nonce')
                        let formNonce = new FormData(formAuthorNonce);
                        let formData = new FormData(btn.parentElement.parentElement);
                        formData.append('action', 'press_net_add_portfolio');
                        for(let [name, value] of formNonce) {
                            formData.append(name, value);
                            // console.dir(`${name} = ${value}`); // key1=value1, потом key2=value2
                        }
                        jQuery(document).ready( function($){
                            $.ajax({
                                type: 'POST',
                                url: '/wp-admin/admin-ajax.php',
                                processData: false,
                                contentType: false,
                                data: formData,
                                success: function(data){
                                    // console.dir(data);
                                    // let data_fin = JSON.parse(data)
                                    // console.dir(data);
                                    setTimeout( () => {
                                        location.reload();
                                    }, 1000);
                                },
                                error: () => {
                                    console.log('Ошибка отправки.');
                                }
                            });
                        })
                    } else {
                        console.dir('Field is required');
                    }
                }
            })
        });
    }
}
formAddPortfolio()

const formEditPortfolio = () => {
    const buttonsGroupPost = document.querySelectorAll('.buttons-group-post.edit-post-portfolio button')
    if ( buttonsGroupPost.length > 0 ) {
        buttonsGroupPost.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                if ( btn.id == 'btn-cancel-post-form' ) {
                    e.preventDefault();
                } else if ( btn.id == 'btn-edit-post-form' ) {
                    e.preventDefault();
                    if ( inputValidate(btn.parentElement.parentElement) ) {
                        const formAuthorNonce = document.querySelector('form#author_nonce')
                        let formNonce = new FormData(formAuthorNonce);
                        let formData = new FormData(btn.parentElement.parentElement);
                        formData.append('action', 'press_net_edit_portfolio');
                        for(let [name, value] of formNonce) {
                            formData.append(name, value);
                        }
                        jQuery(document).ready( function($){
                            $.ajax({
                                type: 'POST',
                                url: '/wp-admin/admin-ajax.php',
                                processData: false,
                                contentType: false,
                                data: formData,
                                success: function(data){
                                    btn.parentElement.parentElement.classList.remove('active')
                                    btn.parentElement.parentElement.nextElementSibling.classList.add('active')
                                    setTimeout( () => {
                                        btn.parentElement.parentElement.nextElementSibling.classList.remove('active')
                                    }, 3000);
                                    // let data_fin = JSON.parse(data)
                                    // console.dir(data);
                                },
                                error: () => {
                                    console.log('Ошибка отправки.');
                                }
                            });
                        })
                    } else {
                        console.dir('Field is required');
                    }
                }
            })
        });
    }
}
formEditPortfolio()

const formDeletePortfolio = () => {
    const btnDeletePost = document.querySelectorAll('#btn-delete-post-form-open-portfolio')
    if ( btnDeletePost.length > 0 ) {
        btnDeletePost.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                const formAuthorNonce = document.querySelector('form#author_nonce')
                let formNonce = new FormData(formAuthorNonce);
                let formData = new FormData(btn.parentElement.parentElement.nextElementSibling);
                formData.append('action', 'press_net_delete_portfolio');
                for(let [name, value] of formNonce) {
                    formData.append(name, value);
                }
                jQuery(document).ready(function($){
                    $.ajax({
                        type: 'POST',
                        url: '/wp-admin/admin-ajax.php',
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(data) {
                            console.log(data);
                            btn.parentElement.parentElement.parentElement.remove();
                            // var data_json = JSON.parse(data);
                            // console.log(data_json);
                            // location.reload();
                        }
                    });
                });
            })
        });
    }
}
formDeletePortfolio()

function btnCancelEditPost(divButtons) {
    if ( divButtons ) {
        const btnCancelEditPost = divButtons.querySelectorAll('#btn-cancel-edit-post-form')
        if ( btnCancelEditPost.length > 0 ) {
            btnCancelEditPost.forEach((btn) => {
                btn.addEventListener('click', (e) => {
                    btn.form.querySelectorAll('input').forEach((input) => {
                        if ( input.id !== 'post_type' && input.name !== 'my_image_upload' ) {
                            input.value = input.attributes.value.value
                        }
                    });
                    btn.form.previousElementSibling.children[0].children[0].innerText = btn.form[0].attributes.value.value
                    if ( btn.form.previousElementSibling.children[0].children[2] ) {
                        btn.form.previousElementSibling.children[0].children[2].innerText = btn.form[1].attributes.value.value
                    }
                    setTimeout( () => {
                        btn.form.classList.remove('active')
                    }, 400);
                })
            });
        }
    }
}
btnCancelEditPost(document.querySelector('.author-wrap__main-your-office')); // author-wrap__main-your-office

function inputValidate(form) {
    const formInputs = form.querySelectorAll('*[required]')
    let inputsNoVal = 0;
    formInputs.forEach((input) => {
        if ( !input.value ) {
            ++inputsNoVal
            input.parentElement.nextElementSibling.classList.add('active')
        } else {
            if ( input.value == 0 ) {
                ++inputsNoVal
                input.parentElement.nextElementSibling.classList.add('active')
            } else if ( input.value == 'Need to publish media' ) {
                ++inputsNoVal
                input.parentElement.nextElementSibling.classList.add('active')
            }  else {
                input.parentElement.nextElementSibling.classList.remove('active')
            }
        }
    });
    if ( inputsNoVal > 0 ) {
        return false;
    } else {
        return true;
    }
    // console.dir(inputsNoVal);
}

const formEditPostRequest = () => {
    const formEditRequest = document.querySelector('form#form-edit-request')
    if ( formEditRequest ) {
        const btnEdit = document.querySelector('#btn-edit-post-form')
        btnEdit.addEventListener('click', (e) => {
            e.preventDefault();
            if ( inputValidate(btnEdit.parentElement.parentElement) ) {
                const formAll = document.querySelector('#form-all')
                let formNonce = new FormData(formAll);
                let formData = new FormData(btnEdit.parentElement.parentElement);
                formData.append('action', 'edit_post_page');
                for(let [name, value] of formNonce) {
                    formData.append(name, value);
                }

                jQuery(document).ready(function($){
                    $.ajax({
                        type: 'POST',
                        url: '/wp-admin/admin-ajax.php',
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(data) {
                            console.log(data);
                            let data_json = JSON.parse(data);
                            if ( data_json.success == 'Success' ) {
                                window.location.href = data_json.url;
                            }
                            // console.log(data_json.url);
                            // window.location.href = data_json.url;
                        }
                    });
                });

            } else {
                console.dir('Field is required');
            }
        })
    }
}
formEditPostRequest()

const formDeleteLogo = () => {
    const logoDeleteBtns = document.querySelectorAll('form #button-logo-delete')
    if ( logoDeleteBtns.length > 0 ) {
        logoDeleteBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                btn.parentElement.previousElementSibling.children[0].src = '/wp-content/themes/press-net/img/icons/media-logo-no.svg';
                btn.nextElementSibling.value = 'yes'
                btn.remove();
            })
        });
    }
}
formDeleteLogo()
