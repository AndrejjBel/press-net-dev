const renderPostItems = () => {
    const registerPage = document.querySelector('#register-page')
    if ( registerPage ) {
        const optionsCompany = document.querySelector('.field-select__options.options-company')
        const companyName = document.querySelector('#company_name')
        const optionsMedia = document.querySelector('.field-select__options.options-media')
        const mediaName = document.querySelector('#media_name')
        receivingPost('company', '', '', companyName, optionsCompany);
        receivingPost('media', '', '', mediaName, optionsMedia);
    }
}
renderPostItems();

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

jQuery(document).ready( function($){
    $(".suggest").suggestions({
        token: "69cff3e74a71d5ece8579d27a89e9532c70bcbf5",
        type: "ADDRESS",
        hint: "Select an option or continue typing",
        language: "en",
        bounds: "city-settlement",
        constraints: {
            locations: { country: "*" }
        },
        noSuggestionsHint: "Unknown city",
        onSelect: function(suggestion) {
            // console.log("data", suggestion);
            var sugJson = JSON.stringify(suggestion);
            $(this).next().next().val(sugJson);
            // $('.addr0').val(suggestion.unrestricted_value);
            // $('.addr2').val(suggestion.data.country);
            // $('.addr3').val(suggestion.data.city);
            // $('.addr10').val(suggestion.data.geo_lat + ',' + suggestion.data.geo_lon);
        }
    });
});
