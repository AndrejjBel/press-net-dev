import {subscribePost, favoritesPost, markAllReadActions} from './users-actions.js';
const filtr = () => {
    const archiveFilter = document.querySelector('.archive-filter')
    if ( archiveFilter ) {
        const optionsTypeInputs = document.querySelectorAll('.filtr-options.type input')
        const optionsCatInputs = document.querySelectorAll('.filtr-options.categories input')
        const optionsSortInputs = document.querySelectorAll('.sorting-requests__options input')
        const buttonFavorites = document.querySelector('.archive-filter__item button#favorites')
        const formAll = document.querySelector('#form-all')
        let taxs = null;
        let types = null;
        optionsTypeInputs.forEach((input) => {
            input.addEventListener('click', function() {
                let taxs = [];
                let types = [];
                let formData = new FormData(formAll);
                formData.append('action', 'filtr_requests');
                catInputsCheckType(types);
                formData.append('request_type', types.join(','));
                catInputsCheck(taxs);
                if ( taxs ) {
                    formData.append('categories', taxs.join(','));
                }
                filtrAjaxData(formData);
            })
        });
        optionsCatInputs.forEach((input) => {
            input.addEventListener('change', function() {
                let taxs = [];
                let types = [];
                let formData = new FormData(formAll);
                formData.append('action', 'filtr_requests');
                if ( input.dataset.child == 1 ) {
                    formData.append('tax_parent', 1);
                }
                filtrOptionsCheckHand(input);
                catInputsCheck(taxs);
                if ( taxs ) {
                    formData.append('categories', taxs.join(','));
                }
                catInputsCheckType(types);
                if ( types ) {
                    formData.append('request_type', types.join(','));
                }
                filtrAjaxData(formData);
            })
        });
        optionsSortInputs.forEach((input) => {
            input.addEventListener('change', function() {
                sortInputsCheck(optionsSortInputs, this);
                let taxs = [];
                let types = [];
                let formData = new FormData(formAll);
                formData.append('action', 'filtr_requests');
                formData.append('sort', input.value);
                catInputsCheck(taxs);
                if ( taxs ) {
                    formData.append('categories', taxs.join(','));
                }
                catInputsCheckType(types);
                if ( types ) {
                    formData.append('request_type', types.join(','));
                }
                filtrAjaxData(formData);
            })
        });
        buttonFavorites.addEventListener('click', function() {
            buttonFavorites.classList.toggle('active')
            let taxs = [];
            let types = [];
            let formData = new FormData(formAll);
            formData.append('action', 'filtr_requests');
            if ( buttonFavorites.classList.contains('active') ) {
                formData.append('favorites', 1);
            }
            catInputsCheck(taxs);
            if ( taxs ) {
                formData.append('categories', taxs.join(','));
            }
            catInputsCheckType(types);
            if ( types ) {
                formData.append('request_type', types.join(','));
            }
            filtrAjaxData(formData);
        });
    }
}
filtr()

function filtrOptionsBtns(btn) {
    const filtrBtn = document.querySelector(btn)
    if ( filtrBtn ) {
        filtrBtn.addEventListener('click', function() {
            filtrBtn.parentElement.children[1].classList.toggle('active')
        })
        document.addEventListener('click', function(e) {
            const sBtn = e.composedPath().includes(filtrBtn);
            const sOptions = e.composedPath().includes(filtrBtn.parentElement.children[1]);
            if ( !sBtn && !sOptions ) {
                filtrBtn.parentElement.children[1].classList.remove('active');
            }
        });
        document.addEventListener('keyup', function (e) {
            var key = e.keyCode;
            if (key == 27) {
                if ( filtrBtn ) {
                    filtrBtn.parentElement.children[1].classList.remove('active');
                }
            };
        }, false);
    }
}
filtrOptionsBtns('#categories');
filtrOptionsBtns('#type');


function sortActionsBtns(btn) {
    const sortingBtn = document.querySelector(btn)
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
sortActionsBtns('.sorting-requests');

const filtrOptionsExpandClick = () => {
    const expandItems = document.querySelectorAll('.filtr-options__expand')
    if ( expandItems.length > 0 ) {
        expandItems.forEach((item) => {
            item.addEventListener('click', function(e) {
                item.children[0].classList.toggle('active')
                item.nextElementSibling.classList.toggle('active')
                item.previousElementSibling.classList.toggle('active')
            })
        });
    }
}
filtrOptionsExpandClick()

function  filtrOptionsCheckHandle() {
    const parentOptions = document.querySelectorAll('.filtr-options__parent')
    const childrenOptions = document.querySelectorAll('.filtr-options__children')
    if ( parentOptions.length > 0 ) {
        parentOptions.forEach((option) => {
            option.children[0].addEventListener('change', function(e) {
                let parent = option.dataset.parent
                if ( parent ) {
                    let child = document.querySelector('.filtr-options__children[data-parent="'+parent+'"]')
                    if ( option.children[0].checked == true ) {
                        inputsChecked(child.children, 1);
                    } else {
                        inputsChecked(child.children, 0);
                    }
                }
            })
        });

    }
}
// filtrOptionsCheckHandle()

function  filtrOptionsCheckHand(option) {
    let parent = option.parentElement.dataset.parent
    if ( parent ) {
        let child = document.querySelector('.filtr-options__children[data-parent="'+parent+'"]')
        if ( option.checked == true ) {
            inputsChecked(child.children, 1);
        } else {
            inputsChecked(child.children, 0);
        }
    }
}

function inputsChecked(inputs, check) {
    for (const item of inputs) {
        if ( check == 1 ) {
            item.children[0].checked = true
        } else if ( check == 0 ) {
            item.children[0].checked = false
        }
    }
}

function filtrAjaxData(formData) {
    (function($){
        $.ajax({
            type: 'POST',
            url: '/wp-admin/admin-ajax.php',
            processData: false,
            contentType: false,
            data: formData,
            success: function(data) {
                let data_json = JSON.parse(data);
                filtrAjaxRender(data_json);
            }
        });
    })(jQuery);
}

function catInputsCheck(taxs) {
    const optionsCatInputs = document.querySelectorAll('.filtr-options.categories input')
    optionsCatInputs.forEach((input) => {
        if ( input.checked == true ) {
            taxs.push(input.value);
        }
    });
}

function catInputsCheckType(types) {
    const optionsCatInputs = document.querySelectorAll('.filtr-options.type input')
    optionsCatInputs.forEach((input) => {
        if ( input.checked == true ) {
            types.push(input.value);
        }
    });
}

function sortInputsCheck(inputs, inputAct) {
    inputs.forEach((input) => {
        if ( input != inputAct ) {
            input.checked == false
        }
    });
}

function filtrAjaxRender(data) {
    const archivePosts = document.querySelector('.archive-posts')
    // console.log(JSON.parse(data.posts));
    // console.log(JSON.parse(data.posts_query)); Math.ceil(data.posts_query.length/10)

    let postsObj = JSON.parse(data.posts);

    archivePosts.innerHTML = ''

    postsObj.forEach((post) => {
        archivePosts.insertAdjacentHTML(
            "beforeend",
            `<div class="archive-posts__item">
                <div class="archive-posts__item__logo">
                    <svg width="32" height="32" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="60" height="60" fill="white"/>
                        <circle cx="30" cy="30" r="30" fill="#EFF4FA"/>
                        <path d="M22.2724 29.6914H16.169V37.9819C16.169 40.169 17.9491 42 20.1871 42H38.294C41.1422 42 43.431 39.7112 43.431 36.8629V18.4H22.2724V29.6914ZM18.0509 38.0328V31.5733H22.2724V37.9819C22.2724 39.1517 21.306 40.0672 20.1871 40.0672C19.0681 40.0672 18.0509 39.2026 18.0509 38.0328ZM24.1543 20.2819H41.4983V36.8629C41.4983 38.6431 40.0233 40.1181 38.2431 40.1181H23.544C23.9509 39.5078 24.1543 38.7957 24.1543 38.0328V30.6578V29.6914V20.2819Z" fill="#BDC2C9"/>
                        <path d="M28.5285 25.3681H33.0043C33.5129 25.3681 33.9707 24.9612 33.9707 24.4017C33.9707 23.8422 33.5129 23.4862 33.0043 23.4862H28.5285C28.0198 23.4862 27.5621 23.8931 27.5621 24.4526C27.5621 25.0121 27.969 25.3681 28.5285 25.3681Z" fill="#BDC2C9"/>
                        <path d="M28.5285 29.0302H37.2767C37.7854 29.0302 38.2431 28.6233 38.2431 28.0638C38.2431 27.5043 37.8362 27.0974 37.2767 27.0974H28.5285C28.0198 27.0974 27.5621 27.5043 27.5621 28.0638C27.5621 28.6233 27.969 29.0302 28.5285 29.0302Z" fill="#BDC2C9"/>
                        <path d="M28.5285 32.6922H37.2767C37.7854 32.6922 38.2431 32.2853 38.2431 31.7259C38.2431 31.1664 37.8362 30.7595 37.2767 30.7595H28.5285C28.0198 30.7595 27.5621 31.1664 27.5621 31.7259C27.5621 32.2853 27.969 32.6922 28.5285 32.6922Z" fill="#BDC2C9"/>
                        <path d="M28.5285 36.3543H37.2767C37.7854 36.3543 38.2431 35.9474 38.2431 35.3879C38.2431 34.8284 37.8362 34.4216 37.2767 34.4216H28.5285C28.0198 34.4216 27.5621 34.8284 27.5621 35.3879C27.5621 35.9474 27.969 36.3543 28.5285 36.3543Z" fill="#BDC2C9"/>
                    </svg>
                </div>
                <div class="archive-posts__item__title requests">
                    <span class="request-title">
                        <a href="${post.url}" class="archive-posts__item__link" title="Go to ${post.title}">${post.title}</a>
                    </span>
                    <div class="requests-media-meta">
                        <a href="${post.media_parent_url}" title="Go to ${post.media_parent_title}">${post.media_parent_title}, ${post.media_parent_city}</a>
                        <span class="requests-media-meta__date">${post.post_date}</span>
                    </div>
                </div>
                <div class="archive-posts__item__meta requests">
                    <span class="archive-posts__item__meta__deadline" title="Time to deadline">
                        ${post.deadline}
                    </span>
                </div>
                <div class="archive-posts__item__buttons">
                    <button type="button" name="button" title="${post.meta_btn_subs.title}"
                        class="js-btn-subscribe${post.meta_btn_subs.btn_class}"
                        data-post="${post.id}" data-post-type="subscribe_request" data-subscr="archive">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 20a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM4 4a16 16 0 0 1 16 16M4 11a9 9 0 0 1 9 9"></path>
                        </svg>
                    </button>
                    <button type="button" name="button" title="${post.meta_btn_fav.title}"
                        class="js-btn-favorites${post.meta_btn_fav.btn_class}"
                        data-post="${post.id}" data-post-type="favorites_request">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 4h6a2 2 0 0 1 2 2v14l-5-3-5 3V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                    <button type="button" name="button" title="${post.meta_btn_read.title}"
                        class="mark-read${post.meta_btn_read.btn_class}" data-post="${post.id}">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="m5 12 5 5L20 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>
            </div>`
        );
    });
    subscribePost();
    markAllReadActions();
    favoritesPost();
}
