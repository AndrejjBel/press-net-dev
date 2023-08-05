const regEmployee = () => {
    const buttonsGroupPost = document.querySelectorAll('.buttons-group-post.add-post button')
    if ( buttonsGroupPost.length > 0 ) {
        const companyName = document.querySelector('#company-name')
        const titleAddForm = document.querySelector('#head-title-add-form span')
        buttonsGroupPost.forEach((btn) => {
            // console.dir(btn.parentElement.parentElement);

            btn.addEventListener('click', (e) => {
                if ( btn.id == 'btn-cancel-employee-form' ) {
                    e.preventDefault();
                    btn.parentElement.parentElement.parentElement.classList.remove('active')
                    btn.parentElement.parentElement.reset();
                    btn.parentElement.parentElement.previousElementSibling.children[0].children[0].innerText = btn.dataset.title
                    btn.parentElement.parentElement.previousElementSibling.children[0].children[1].classList.remove('active')
                    btn.parentElement.parentElement.previousElementSibling.children[0].children[2].innerText = ''
                } else if ( btn.id == 'btn-save-employee-form' ) {
                    e.preventDefault();
                    if ( employeeInputValidate(btn.parentElement.parentElement) ) {
                        const formAuthorNonce = document.querySelector('form#author_nonce')
                        let formNonce = new FormData(formAuthorNonce);
                        let formData = new FormData(btn.parentElement.parentElement);
                        formData.append('action', 'press_net_register_employee');
                        for(let [name, value] of formNonce) {
                            formData.append(name, value);
                            // console.dir(`${name} = ${value}`); // key1=value1, потом key2=value2
                        }
                        addFormNameInputRequired(btn.parentElement.parentElement.querySelectorAll('*[required]'), formData);
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
regEmployee()

const employeeImageUpload = () => {
    const inputEmployeeImage = document.querySelector('#employee_image_upload')
    if ( inputEmployeeImage ) {
        result = inputEmployeeImage.previousElementSibling.children[0]
        inputEmployeeImage.addEventListener('change', (e) => {
            employeeImageChange(inputEmployeeImage, result);
        })
    }
}
employeeImageUpload()

function employeeImageChange(input, result) {
    FReader = new FileReader();
    FReader.onload = function(e) {
        result.src = e.target.result;
    };
    var file = input.files[0];
    FReader.readAsDataURL(file);
}

function employeeInputValidate(form) {
    const formInputs = form.querySelectorAll('*[required]')
    let inputsNoVal = 0;
    formInputs.forEach((input) => {
        if ( !input.value ) {
            ++inputsNoVal
            input.parentElement.nextElementSibling.classList.add('active')
        } else {
            input.parentElement.nextElementSibling.classList.remove('active')
        }
    });
    if ( inputsNoVal > 0 ) {
        return false;
    } else {
        return true;
    }
}

function addFormNameInputRequired(inputsRequired, formData) {
    let inputs_req = [];
    for (const node of inputsRequired) {
        inputs_req.push(node.name);
    }
    let ir = inputs_req.join(',')
    formData.append('inputs_required', ir);
}
