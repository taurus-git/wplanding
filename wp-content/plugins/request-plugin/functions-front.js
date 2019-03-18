jQuery(document).ready(function($) {
    //send form data
    $("#request-form").on( "submit", (function ( event ) {
        event.preventDefault();

        var title = $("#title-field").val();
        var author = $("#author-field").val();
        var message = $("#message-field").val();
        var select = $("#select-field").val();

        var data = {
            action: 'add_new_request',
            author: author,
            message: message,
            title: title,
            select: select,
        };

        jQuery.post( ajax_name, data, function(response) {
            var requestRow =
                '<tr class="request-row" id="' + response.data.id_post + '">' +
                '<td>' +  title + '</td>' +
                '<td>' +  author + '</td>' +
                '<td>' +  message + '</td>' +
                '<td>' +  select + '</td>' +
                '</tr>';

            $(requestRow).insertAfter("#tableHeader");

        });

        alert('Your request sent successful');
        $("#request-form")[0].reset();
    }));
    //remove post
    $('#requestTable').on('click', ".deleteQueryButton", function(){
        var post = $(this).closest('.request-row');
        var id = post.attr('id');
        var data = {
            action: 'my_delete_post',
            id: id,
        };

        jQuery.post( ajax_name, data, function(response) {
            alert('Your request deleted');
            post.remove();
        });
    })

});
