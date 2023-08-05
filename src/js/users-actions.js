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
                                console.dir('Yes');
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
                    console.dir('Yes');
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
