function receivingPost(postType, orderbyCust, orderCust) {
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
                // dataType: "json",
                success: function (data) {
                    console.dir(data);
                    // localStorage.setItem('glempAll', JSON.stringify(data));
                },
                error: function (jqXHR, text, error) {}
            });
        });
    }
}
// receivingPost('company', '', '');
// receivingPost('mass-media', '', '');
