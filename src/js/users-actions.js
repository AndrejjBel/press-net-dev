const subscribePost = () => {
    const subscribeBtns = document.querySelectorAll('.js-btn-subscribe')
    if ( subscribeBtns.length > 0 ) {
        subscribeBtns.forEach((btn) => {
            btn.addEventListener('click', function() {
                btn.style.pointerEvents = 'none'

                const formAll = document.querySelector('#form-all')
                let formData = new FormData(formAll);
                formData.append('action', 'subscribe_user_post');
                formData.append('post_id', btn.dataset.post);
                formData.append('post_type', btn.dataset.postType);

                jQuery(document).ready( function($){
                    $.ajax({
                        url: "/wp-admin/admin-ajax.php",
                        method: 'post',
                        processData: false,
                        contentType: false,
                        data: formData,
                        beforeSend: function () {
                            // Outputting text while sending
                        },
                        success: function (data) {
                            data = JSON.parse(data)
                            if ( data.class == 'success' ) {
                                // console.dir('Yes');
                                if ( btn.dataset.subscr == 'single' ) {
                                    btn.querySelectorAll('span.subscr').forEach((item) => {
                                        item.classList.toggle('active');
                                    });
                                } else if ( btn.dataset.subscr == 'archive' ) {
                                    btn.classList.toggle('active');
                                    if ( btn.title == 'Subscribe to this media' ) {
                                        btn.title = 'Unfollow this media';
                                    } else if ( btn.title == 'Unfollow this media' ) {
                                        btn.title = 'Subscribe to this media';
                                    }

                                    if ( btn.title == 'Subscribe to this request' ) {
                                        btn.title = 'Unfollow this request';
                                    } else if ( btn.title == 'Unfollow this request' ) {
                                        btn.title = 'Subscribe to this request';
                                    }
                                }

                            } else {
                                console.dir(data);
                            }
                        },
                        error: function (jqXHR, text, error) {
                            // Send error text output
                            console.log('Ошибка отправки.');
                        }
                    });
                });

                btn.style.pointerEvents = ''
            })
        });

    }
}
subscribePost()

const favoritesPost = () => {
    const favoritesBtns = document.querySelectorAll('.js-btn-favorites')
    if ( favoritesBtns.length > 0 ) {
        favoritesBtns.forEach((btn) => {
            btn.addEventListener('click', function() {
                btn.style.pointerEvents = 'none'

                const formAll = document.querySelector('#form-all')
                let formData = new FormData(formAll);
                formData.append('action', 'favorites_user_post');
                formData.append('post_id', btn.dataset.post);
                formData.append('post_type', btn.dataset.postType);

                jQuery(document).ready( function($){
                    $.ajax({
                        url: "/wp-admin/admin-ajax.php",
                        method: 'post',
                        processData: false,
                        contentType: false,
                        data: formData,
                        beforeSend: function () {
                            // Outputting text while sending
                        },
                        success: function (data) {
                            data = JSON.parse(data)
                            if ( data.class == 'success' ) {
                                // console.dir('Yes');

                                btn.classList.toggle('active');
                                if ( btn.title == 'To favorites' ) {
                                    btn.title = 'Remove from favorites';
                                } else if ( btn.title == 'Remove from favorites' ) {
                                    btn.title = 'To favorites';
                                }
                            } else {
                                console.dir(data);
                            }
                        },
                        error: function (jqXHR, text, error) {
                            // Send error text output
                            console.log('Ошибка отправки.');
                        }
                    });
                });

                btn.style.pointerEvents = ''
            })
        });

    }
}
favoritesPost()

function subscribeUserPost(btn){
    const formAll = document.querySelector('#form-all')
    let formData = new FormData(formAll);
    formData.append('action', 'subscribe_user_post');
    formData.append('post_id', btn.dataset.post);

    jQuery(document).ready( function($){
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            method: 'post',
            processData: false,
            contentType: false,
            data: formData,
            beforeSend: function () {
                // Outputting text while sending
            },
            success: function (data) {
                data = JSON.parse(data)
                if ( data.class == 'success' ) {
                    // console.dir('Yes');
                    // document.querySelector('.modal__title').style.display = 'none'
                    // document.querySelector('.request-call-form').innerHTML = '<h3>Thank you, we will contact you shortly!</h3>'
                }
            },
            error: function (jqXHR, text, error) {
                // Send error text output
            }
        });
    });
}

const assignWork = () => {
    const assignWorkBtns = document.querySelectorAll('.js-assign-work')
    if ( assignWorkBtns.length > 0 ) {
        assignWorkBtns.forEach((btn) => {
            btn.addEventListener('click', function() {
                modal = document.querySelector('.modal[data-modal="' + btn.dataset.modal + '"]');
                modal.querySelector('button').dataset.post = btn.dataset.post
            })
        });
    }
}
assignWork()

const sortActionsBtns = () => {
    const sortingBtn = document.querySelector('.sorting-requests')
    if ( sortingBtn ) {
        sortingBtn.addEventListener('click', function() {
            sortingBtn.children[1].classList.toggle('active')
        })
        document.addEventListener('click', function(e) {
            const sBtn = e.composedPath().includes(sortingBtn);
            const sOptions = e.composedPath().includes(sortingBtn.children[1]);
            if ( !sBtn && !sOptions ) {
                sortingBtn.children[1].classList.remove('active');
            }
        });
        document.addEventListener('keyup', function (e) {
            var key = e.keyCode;
            if (key == 27) {
                if ( sortingBtn ) {
                    sortingBtn.children[1].classList.remove('active');
                }
            };
        }, false);
    }
}
sortActionsBtns()

const markAllReadActions = () => {
    const markAllReadBtn = document.querySelector('.mark-all-read')
    const markReadBtns = document.querySelectorAll('.mark-read')
    if ( markAllReadBtn ) {
        markAllReadBtn.addEventListener('click', function(e) {
            const formAll = document.querySelector('#form-all')
            let formData = new FormData(formAll);
            formData.append('action', 'mark_all_read');
            formData.append('mark_all', 'yes');
            markReadAjax( formData, markAllReadBtn, markReadBtns );
        });
        markReadBtns.forEach((btn) => {
            btn.addEventListener('click', function(e) {
                const formAll = document.querySelector('#form-all')
                let formData = new FormData(formAll);
                formData.append('action', 'mark_all_read');
                formData.append('post_id', btn.dataset.post);
                markReadAjax( formData, btn, '' );
            });
        });
    }
}
markAllReadActions()

function markReadAjax( formData, btn, btns ) {
    jQuery(document).ready( function($){
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            method: 'post',
            processData: false,
            contentType: false,
            data: formData,
            beforeSend: function () {
                // Outputting text while sending
            },
            success: function (data) {
                data = JSON.parse(data)
                if ( data.class == 'success' ) {
                    // console.dir('Yes');
                    if ( btns ) {
                        btn.classList.add('active');
                        btns.forEach((btn) => {
                            btn.classList.add('active');
                            if ( btn.title == 'Mark as read' ) {
                                btn.title = 'Mark as unread';
                            } else if ( btn.title == 'Mark as unread' ) {
                                btn.title = 'Mark as read';
                            }
                        });
                    } else {
                        btn.classList.toggle('active');
                        if ( btn.title == 'Mark as read' ) {
                            btn.title = 'Mark as unread';
                        } else if ( btn.title == 'Mark as unread' ) {
                            btn.title = 'Mark as read';
                        }
                    }
                } else {
                    console.dir(data);
                }
            },
            error: function (jqXHR, text, error) {
                // Send error text output
                console.log('Ошибка отправки.');
            }
        });
    });
}
