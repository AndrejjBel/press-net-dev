const checkboxLabelCheck = () => {
    const checkboxInputs = document.querySelectorAll('form .checkbox input')
    if ( checkboxInputs.length > 0 ) {
        checkboxInputs.forEach((input) => {
            input.addEventListener('change', function() {
                if ( input.checked == true ) {
                    input.previousElementSibling.children[0].classList.add('active')
                    input.previousElementSibling.children[0].children[0].classList.add('active')
                    if ( input.id == 'new_company' || input.id == 'new_media' ) {
                        input.parentElement.parentElement.nextElementSibling.classList.add('active')
                        input.parentElement.previousElementSibling.style.opacity = 0.2
                        setRequired( input.parentElement.parentElement.nextElementSibling, input.parentElement.previousElementSibling );
                    }
                } else {
                    input.previousElementSibling.children[0].classList.remove('active')
                    input.previousElementSibling.children[0].children[0].classList.remove('active')
                    if ( input.id == 'new_company' || input.id == 'new_media' ) {
                        input.parentElement.parentElement.nextElementSibling.classList.remove('active')
                        input.parentElement.previousElementSibling.style.opacity = ''
                        removeRequired( input.parentElement.parentElement.nextElementSibling, input.parentElement.previousElementSibling );
                    }
                }
            })
        });
    }
}
checkboxLabelCheck()

const passwordVision = () => {
    const inputWithIcon = document.querySelectorAll('form .input-with-icon')
    if ( inputWithIcon.length > 0 ) {
        const icons = document.querySelectorAll('form .input-with-icon svg')
        const input = document.querySelector('form .input-with-icon input')
        icons.forEach((icon) => {
            icon.addEventListener('click', function() {
                if ( icon.classList.contains('is-title') ) {
                    if ( icon.parentElement.children[1].type == 'password' ) {
                        icon.parentElement.children[1].type = 'text'
                    } else {
                        icon.parentElement.children[1].type = 'password'
                    }
                    icon.parentElement.children[2].classList.toggle('active')
                    icon.parentElement.children[3].classList.toggle('active')
                } else {
                    if ( icon.parentElement.children[0].type == 'password' ) {
                        icon.parentElement.children[0].type = 'text'
                    } else {
                        icon.parentElement.children[0].type = 'password'
                    }
                    icon.parentElement.children[1].classList.toggle('active')
                    icon.parentElement.children[2].classList.toggle('active')
                }
            })
        });
    }
}
passwordVision()

const regTypeAccountChange = () => {
    const toggleButtons = document.querySelectorAll('button.toggle-button')
    if ( toggleButtons.length > 0 ) {
        const inputTypeAccount = document.querySelector('input#account_type')
        const accountTypeForm = document.querySelectorAll('.account-type-form')
        const accountTypeFormInput = document.querySelectorAll('.account-type-form input')
        const accountTypeFormInputCheckbox = document.querySelectorAll('.account-type-form input[type="checkbox"]')
        toggleButtons.forEach((item) => {
            item.addEventListener('click', function() {
                toggleButtons.forEach((item) => {
                    item.classList.remove('active')
                })
                item.classList.add('active')
                inputTypeAccount.value = item.id
                accountTypeForm.forEach((item) => {
                    item.classList.remove('active')
                });
                accountTypeFormInput.forEach((item) => {
                    if ( item.id !== 'new_company' && item.id !== 'new_media' ) {
                        item.value = ''
                    }
                });

                document.querySelector('#form-'+item.id).classList.add('active')
                accountTypeFormInputCheckbox.forEach((input) => {
                    input.checked = false
                    input.previousElementSibling.children[0].classList.remove('active')
                    input.previousElementSibling.children[0].children[0].classList.remove('active')
                    input.parentElement.parentElement.nextElementSibling.classList.remove('active')
                    removeRequiredType( input.parentElement.parentElement.nextElementSibling, input.parentElement.previousElementSibling );
                });

            })
        });
    }
}
regTypeAccountChange()

function checkboxLabelCheckGroup(checkboxGroupClass) {
    const checkboxDiv = document.querySelectorAll('.'+checkboxGroupClass+' input')
    if ( checkboxDiv.length > 0 ) {
        checkboxDiv.forEach((item) => {
            item.addEventListener('change', function() {
                if ( item.checked == true ) {
                    item.previousElementSibling.children[0].classList.add('active')
                    item.previousElementSibling.children[0].children[0].classList.add('active')
                } else {
                    item.previousElementSibling.children[0].classList.remove('active')
                    item.previousElementSibling.children[0].children[0].classList.remove('active')
                }
            })
        });
    }
}
checkboxLabelCheckGroup('checkbox-group');

const fieldSelectProcessing = () => {
    const fieldSelectAll = document.querySelectorAll('form .field-select')
    if ( fieldSelectAll.length > 0 ) {
        fieldSelectAll.forEach((item) => {
            item.children[0].addEventListener('focus', function() {
                item.children[1].classList.add('active')
            })
            item.children[0].addEventListener('blur', function() {
                item.children[1].classList.remove('active')
            })
            for (const node of item.children[1].children) {
                node.addEventListener('click', function() {
                    node.parentElement.previousElementSibling.value = node.innerText
                    if ( node.dataset.termId ) {
                        node.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.value = node.dataset.termId
                    }
                    if ( node.dataset.postId ) {
                        node.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.value = node.dataset.postId
                    }
                })
            }
        });
    }
}
fieldSelectProcessing()

const inputSearchIcons = () => {
    const inputSearchGroup = document.querySelectorAll('.input-search-group')
    if ( inputSearchGroup.length > 0 ) {
        inputSearchGroup.forEach((item) => {
            item.children[0].addEventListener('input', function() {
                if ( item.children[0].value ) {
                    item.children[1].classList.add('active')
                } else {
                    item.children[1].classList.remove('active')
                }
            })
            item.children[1].addEventListener('click', function() {
                item.children[0].value = ''
                item.children[1].classList.remove('active')
            })
        });
    }
}
inputSearchIcons()

function setRequired( inputsDivForm, inputsDivName ) {
    let inputsForm = inputsDivForm.querySelectorAll('input')
    inputsForm.forEach((input) => {
        if ( input.dataset.required == 'required' ) {
            input.setAttribute('required', 'required');
        }
    });
    let inputsName = inputsDivName.querySelectorAll('input')
    inputsName.forEach((input) => {
        if ( input.id !== 'new_company' && input.id !== 'new_media' ) {
            input.value = ''
        }
        input.removeAttribute('required');
        input.style.pointerEvents = 'none'
        input.style.border = ''
        if ( input.parentElement.nextElementSibling.nextElementSibling ) {
            input.parentElement.nextElementSibling.nextElementSibling.classList.remove("active")
        }
    });
}

function removeRequired( inputsDiv, inputsDivName ) {
    let inputs = inputsDiv.querySelectorAll('input')
    inputs.forEach((input) => {
        input.removeAttribute('required');
    });
    let inputsName = inputsDivName.querySelectorAll('input')
    inputsName.forEach((input) => {
        if ( input.id !== 'new_company' && input.id !== 'new_media' ) {
            input.value = ''
        }
        input.setAttribute('required', 'required');
        input.style.pointerEvents = ''
    });
}

function removeRequiredType( inputsDiv, inputsDivName ) {
    let inputs = inputsDiv.querySelectorAll('input')
    inputs.forEach((input) => {
        input.removeAttribute('required');
    });
    let inputsName = inputsDivName.querySelectorAll('input')
    inputsName.forEach((input) => {
        if ( input.id !== 'new_company' && input.id !== 'new_media' ) {
            input.value = ''
            input.style.pointerEvents = ''
        }
        input.removeAttribute('required');
    });
}

function mediaLogoDownload() { // imgResult, inputUpload
    const mediaLogoInputs = document.querySelectorAll('input[name="my_image_upload"]')
    mediaLogoInputs.forEach((input) => {
        let reader = input.previousElementSibling.dataset.read
        reader = new FileReader();
        reader.onload = function(e) {
            input.previousElementSibling.src = e.target.result;
        };
        input.addEventListener('change', loadImageFile);
        function loadImageFile() {
            var file = input.files[0];
            reader.readAsDataURL(file);
        }
    });

    // const logoResult = document.querySelector(imgResult)
    // const inputMediaLogo = document.querySelector(inputUpload)
    // let reader = logoResult.dataset.read
    // reader = new FileReader();
    // reader.onload = function(e) {
    //     logoResult.src = e.target.result;
    // };
    // inputMediaLogo.addEventListener('change', loadImageFile);
    // function loadImageFile() {
    //     var file = inputMediaLogo.files[0];
    //     reader.readAsDataURL(file);
    // }
}
mediaLogoDownload();
