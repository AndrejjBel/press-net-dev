const renderTermsItems = () => {
    const authorPrimary = document.querySelector('#author-primary')
    if ( authorPrimary ) {
        const optionsMediaCat = document.querySelectorAll('.field-select__options.media-cat')
        const companyName = document.querySelector('#company_name')
        const optionsMedia = document.querySelector('.field-select__options.options-media')
        const mediaName = document.querySelector('#media_name')
        let dataJs = '';
        // receivingTerms(dataJs);
        console.dir(dataJs);

        // optionsMediaCat.forEach((item) => {
        //     receivingTerms('mass-media-cat', companyName, item);
        // });

        // receivingTerms('media-cat', companyName, optionsMediaCat);
        // receivingTerms('media', mediaName, optionsMedia);
    }
}
renderTermsItems();

function receivingTerms(dataJs) { // termSlug, input, itemDiv
    const authorPrimary = document.querySelector('#author-primary')
    if ( authorPrimary ) {
        jQuery(document).ready( function($){
            $.ajax({
                url: "/wp-admin/admin-ajax.php",
                method: 'post',
                data: {
                    action: 'press_net_post_list_json',
                    term_slug: termSlug
                },
                success: function (data) {
                    console.dir(data);
                    let dataJs = JSON.parse(data);
                    // return data;
                    // renderFiltrTermsItems(dataJs, itemDiv);
                    // filtrTermsItemsSearch(input, dataJs, itemDiv);
                },
                error: function (jqXHR, text, error) {}
            });
        });
    }
}

function renderFiltrTermsItems(items, itemDiv) {
    itemDiv.innerHTML = '';
    if ( items ) {
        items.forEach((item) => {
            itemDiv.insertAdjacentHTML(
                "beforeend",
                `<span data-post-id="${item.term_id}">${item.term_name}</span>`
            )
        });
    } else {
        itemDiv.insertAdjacentHTML(
            "beforeend",
            `<span data-post-id="no">No items</span>`
        );
    }
    fieldTermsSelectProces( itemDiv.children );
}

function filtrTermsItemsSearch(input, items, itemDiv) {
    const inputIt = input
    if (input) {
        inputIt.addEventListener('input', (e) => {
            const newItems = items.filter((item) => {
                return item.title.toLowerCase().includes(e.target.value.toLowerCase())
            })
            renderFiltrTermsItems(newItems, itemDiv);
        })
    }
}

function fieldTermsSelectProces( items ) {
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
