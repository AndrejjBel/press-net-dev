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
                    item.children[0].children[0].style.opacity = ''
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

const fieldSelectProcessingOneselect = () => {
    const fieldSelectAll = document.querySelectorAll('form .field-select.one')
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
fieldSelectProcessingOneselect()

const fieldSelectProcessingMultiselect = () => {
    const fieldSelectAll = document.querySelectorAll('form .field-select.multi')
    if ( fieldSelectAll.length > 0 ) {
        fieldSelectAll.forEach((item) => {
            if ( item.children[0].children[1] ) {
                item.children[0].children[1].addEventListener('click', function() {
                    item.children[1].classList.toggle('active')
                    if ( item.children[1].classList.contains('active') ) {
                        item.children[0].children[1].children[0].style.transform = 'rotate(180deg)';
                    } else {
                        item.children[0].children[1].children[0].style.transform = '';
                    }
                });
            } else {
                item.children[0].addEventListener('click', function() {
                    item.children[1].classList.toggle('active')
                    if ( item.children[1].classList.contains('active') ) {
                        item.children[0].children[1].children[0].style.transform = 'rotate(180deg)';
                    } else {
                        item.children[0].children[1].children[0].style.transform = '';
                    }
                });
            }

            document.addEventListener('click', function(e) {
                const sBtn = e.composedPath().includes(item.children[0]);
                const sOptions = e.composedPath().includes(item.children[1]);
                if ( !sBtn && !sOptions ) {
                    item.children[1].classList.remove('active');
                    if ( item.children[1].classList.contains('active') ) {
                        item.children[0].children[1].children[0].style.transform = 'rotate(180deg)';
                    } else {
                        item.children[0].children[1].children[0].style.transform = '';
                    }
                }
            });
            document.addEventListener('keyup', function (e) {
                var key = e.keyCode;
                if (key == 27) {
                    if ( item.children[1] ) {
                        item.children[1].classList.remove('active');
                        if ( item.children[1].classList.contains('active') ) {
                            item.children[0].children[1].children[0].style.transform = 'rotate(180deg)';
                        } else {
                            item.children[0].children[1].children[0].style.transform = '';
                        }
                    }
                };
            }, false);
            for (const node of item.children[1].children) {
                if ( node.className == 'option-tag' ) {
                    node.children[0].addEventListener('change', function() {
                        let tagId = [];
                        clickTags(item.children[1].children, tagId, item.children[0].children[0]);
                        resultTagsClose(item.children[1], item.children[1].children, item.children[0].children[0].children, tagId);
                        node.parentElement.previousElementSibling.value = node.innerText
                        node.parentElement.nextElementSibling.value = tagId.join(',');
                        if ( node.dataset.termId ) {
                            node.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.value = node.dataset.termId
                        }
                        if ( node.dataset.postId ) {
                            node.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.value = node.dataset.postId
                        }
                    });
                };
            };
        });
    }
}
fieldSelectProcessingMultiselect()

function clickTags(options, tagId, result) {
    result.innerHTML = '<div class="results-wrap__results__label"><span>'+result.dataset.type+':</span></div>';
    let icon = `<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="#8c8c8c">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7071 0.292893C14.0976 0.683417 14.0976 1.31658 13.7071 1.70711L1.70711 13.7071C1.31658 14.0976 0.683417 14.0976 0.292893 13.7071C-0.0976311 13.3166 -0.0976311 12.6834 0.292893 12.2929L12.2929 0.292893C12.6834 -0.0976311 13.3166 -0.0976311 13.7071 0.292893Z" fill="black"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L13.7071 12.2929C14.0976 12.6834 14.0976 13.3166 13.7071 13.7071C13.3166 14.0976 12.6834 14.0976 12.2929 13.7071L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z" fill="black"/>
        </svg>`
    for (const node of options) {
        if ( node.className == 'option-tag' ) {
            if ( node.children[0].checked == true ) {
                tagId.push(node.children[0].value);
                result.insertAdjacentHTML(
                    "beforeend",
                    `<span class="option-result" id="${node.children[0].id}">${node.children[0].name}${icon}</span>`
                );
            }
        };
    };
}

function renderTags(options, result) {
    result.innerHTML = '';
    let icon = `<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="#8c8c8c">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7071 0.292893C14.0976 0.683417 14.0976 1.31658 13.7071 1.70711L1.70711 13.7071C1.31658 14.0976 0.683417 14.0976 0.292893 13.7071C-0.0976311 13.3166 -0.0976311 12.6834 0.292893 12.2929L12.2929 0.292893C12.6834 -0.0976311 13.3166 -0.0976311 13.7071 0.292893Z" fill="black"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L13.7071 12.2929C14.0976 12.6834 14.0976 13.3166 13.7071 13.7071C13.3166 14.0976 12.6834 14.0976 12.2929 13.7071L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z" fill="black"/>
        </svg>`
    for (const node of options) {
        if ( node.className == 'option-tag' ) {
            if ( node.children[0].checked == true ) {
                result.insertAdjacentHTML(
                    "beforeend",
                    `<span id="${node.children[0].id}">${node.children[0].name}${icon}</span>`
                );
            };
        };
    };
}

const tagsClose = () => {
    const resultsWrap = document.querySelectorAll('.results-wrap__results')
    if ( resultsWrap.length > 0 ) {
        resultsWrap.forEach((item) => {
            for (const el of item.children) {
                if ( el.className == 'option-result' ) {
                    // console.dir(el);
                    el.children[0].addEventListener('click', function() {
                        el.remove();
                        document.querySelector('input[id="'+el.id+'"]').checked = false
                        let tagIds = []
                        for (const node of item.parentElement.nextElementSibling.children) {
                            if ( node.className == 'option-tag' ) {
                                if ( node.children[0].checked == true ) {
                                    tagIds.push(node.children[0].value);
                                };
                            };
                        };
                        item.parentElement.nextElementSibling.nextElementSibling.value = tagIds.join(',');

                    });
                };
            };
        });
    }
}
tagsClose();

function resultTagsClose(optionsDiv, options, result, tagId) {
    if ( result.length > 0 ) {
        for (const node of result) {
            node.children[0].addEventListener('click', function() {
                node.remove();
                document.querySelector('input[id="'+node.id+'"]').checked = false
                let tagIds = []
                for (const node of options) {
                    if ( node.className == 'option-tag' ) {
                        if ( node.children[0].checked == true ) {
                            tagIds.push(node.children[0].value);
                        };
                    };
                };
                optionsDiv.nextElementSibling.value = tagIds.join(',');
            });
        };
    } else {
        result.parentElement.innerHTML = '<div class="results-wrap__results__label">Subjects:</div>';
    }
}

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
