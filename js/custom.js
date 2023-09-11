var dataMedia = [];
var dataFormat;

function receivingTerms() {
    const authorPrimary = document.querySelector('#author-primary')
    if ( authorPrimary ) {
        const optionsMediaCat = document.querySelectorAll('.field-select__options.media-cat .field-select__options__wrap')
        jQuery(document).ready( function($){
            $.ajax({
                url: "/wp-admin/admin-ajax.php",
                method: 'post',
                data: {
                    action: 'press_net_post_list_json',
                    term_slug: 1
                },
                success: function (data) {
                    let dataJs = JSON.parse(data);
                    renderFiltrTermsItems(JSON.parse(dataJs.media), optionsMediaCat);
                },
                error: function (jqXHR, text, error) {}
            });
        });
    }
}
// receivingTerms();

function dataSet(data) {
    dataFormat = data.format;
}

function renderFiltrTermsItems(items, itemDiv) {
    itemDiv.forEach((item) => {
        item.innerHTML = '';
        if ( items ) {
            items.forEach((itemEl) => {
                item.insertAdjacentHTML(
                    "beforeend",
                    `<div class="option-tag" data-id="tag${itemEl.term_id}${item.dataset.post}">
        			    <input type="checkbox" name="${itemEl.term_name}" id="tag${itemEl.term_id}${item.dataset.post}" value="${itemEl.term_id}" />
        			    <label for="tag${itemEl.term_id}${item.dataset.post}">${itemEl.term_name}</label>
        			</div>`
                )
            });
        } else {
            item.insertAdjacentHTML(
                "beforeend",
                `<span data-post-id="no">No items</span>`
            );
        }
        fieldTermsSelectProces( item.children );
        filtrTermsItemsSearch(item.previousElementSibling, items, item);
    });
}

function filtrTermsItemsSearch(input, items, itemDiv) {
    const inputIt = input
    console.log(inputIt);
    if (input) {
        inputIt.addEventListener('input', (e) => {
            const newItems = items.filter((item) => {
                return item.term_name.toLowerCase().includes(e.target.value.toLowerCase())
            })
            // renderFiltrTermsItems(newItems, itemDiv);
            itemDiv.innerHTML = '';
            newItems.forEach((itemEl) => {
                itemDiv.insertAdjacentHTML(
                    "beforeend",
                    `<div class="option-tag" data-id="tag${itemEl.term_id}${itemDiv.dataset.post}">
        			    <input type="checkbox" name="${itemEl.term_name}" id="tag${itemEl.term_id}${itemDiv.dataset.post}" value="${itemEl.term_id}" />
        			    <label for="tag${itemEl.term_id}${itemDiv.dataset.post}">${itemEl.term_name}</label>
        			</div>`
                )
            });
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
