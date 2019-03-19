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

        jQuery.post( ajax_name, data, function (response) {
            if (response.success) {
                var requestRow =
                    '<tr class="request-row" id="' + response.data.id_post + '">' +
                        '<td>' + title + '</td>' +
                        '<td>' + author + '</td>' +
                        '<td>' + message + '</td>' +
                        '<td>' + select + '</td>' +
                    '</tr>';

                $(requestRow).insertAfter("#tableHeader");
                alert('Your request sent successful');
            } else {
                alert('Fill out all items in the form');
            }
            $("#request-form")[0].reset();
        })
    }));
});
