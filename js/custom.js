function receivingPost(postType, orderbyCust, orderCust, input, itemDiv) {
    const registerPage = document.querySelector('#register-page')
    if ( registerPage ) {
        jQuery(document).ready( function($){
            $.ajax({
                url: "/wp-admin/admin-ajax.php",
                method: 'post',
                data: {
                    action: 'press_net_post_list_json',
                    post_type: postType,
                    orderby: orderbyCust,
                    order: orderCust
                },
                success: function (data) {
                    let dataJs = JSON.parse(data);
                    renderFiltrItems(dataJs, itemDiv);
                    filtrItemsSearch(input, dataJs, itemDiv);
                },
                error: function (jqXHR, text, error) {}
            });
        });
    }
}

const renderItems = () => {
    const registerPage = document.querySelector('#register-page')
    if ( registerPage ) {
        const optionsCompany = document.querySelector('.field-select__options.options-company')
        const companyName = document.querySelector('#company_name')
        const optionsMedia = document.querySelector('.field-select__options.options-media')
        const mediaName = document.querySelector('#media_name')
        receivingPost('company', '', '', companyName, optionsCompany);
        receivingPost('mass-media', '', '', mediaName, optionsMedia);
    }
}
renderItems();

function renderFiltrItems(items, itemDiv) {
    itemDiv.innerHTML = '';
    if ( items ) {
        items.forEach((item) => {
            itemDiv.insertAdjacentHTML(
                "beforeend",
                `<span data-post-id="${item.id}">${item.title}</span>`
            )
        });
    } else {
        itemDiv.insertAdjacentHTML(
            "beforeend",
            `<span data-post-id="no">No items</span>`
        );
    }
    fieldSelectProces( itemDiv.children );
}

function filtrItemsSearch(input, items, itemDiv) {
    const inputIt = input
    if (input) {
        inputIt.addEventListener('input', (e) => {
            const newItems = items.filter((item) => {
                return item.title.toLowerCase().includes(e.target.value.toLowerCase())
            })
            renderFiltrItems(newItems, itemDiv);
        })
    }
}

function fieldSelectProces( items ) {
    for (const node of items) {
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
}
