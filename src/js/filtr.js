const filtr = () => {
    const archiveFilter = document.querySelector('.archive-filter')
    if ( archiveFilter ) {
        const optionsTypeInputs = document.querySelectorAll('.filtr-options.type input')
        const optionsCatInputs = document.querySelectorAll('.filtr-options.categories input')
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
                let rt = localStorage.getItem('request_type');
                if ( rt ) {
                    formData.append('request_type', rt);
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

function filtrAjaxRender(data) {
    console.log(JSON.parse(data.posts));
    console.log(JSON.parse(data.posts_query));
}
