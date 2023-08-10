const filtr = () => {}

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

const filtrOptionsCheckHandle = () => {
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
filtrOptionsCheckHandle()

function inputsChecked(inputs, check) {
    for (const item of inputs) {
        if ( check == 1 ) {
            item.children[0].checked = true
        } else if ( check == 0 ) {
            item.children[0].checked = false
        }
    }
}
