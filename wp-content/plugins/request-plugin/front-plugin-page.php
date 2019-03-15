<?php
/*
Template Name: Request template front page
*/
wp_head();

/*add_action( 'wp_enqueue_scripts', 'add_my_scripts_for_front', 999);
function add_my_scripts_for_front() {
        wp_enqueue_script( 'functions', plugin_dir_path( __FILE__) . 'functions.js', array('jQuery'), '1.0', true );
}*/
add_action('wp_ajax_send_myajax_data', 'myajax_data');
add_action('wp_ajax_nopriv_send_myajax_data', 'myajax_data');
function myajax_data () {
    /** Localize Scripts */
    wp_localize_script('WP-landing-theme-script', 'ajax_name', array(
        'url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_footer', 'my_action_javascript', 599); // для фронта
function my_action_javascript() {
    ?>
    <script type="text/javascript" >
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
                        '<td><button class="deleteQueryButton">Delete</button></td>' +
                        '</tr>';

                    $(requestRow).insertAfter("#tableHeader");

                });

                alert('Your request sent successful');
                $("#request-form")[0].reset();
            }));

        });
    </script>
    <?php
}


?>
    <script>

    </script>
<?php


//view queries in table on front page
    $args = array(
        'posts_per_page' => 20,
        'post_type'      => 'request',
        'post_status'    => 'publish',
        'order'          => 'DESC',
        'orderby'        => 'meta_value_num',
        'meta_key'       => 'priority',
    );
    ?>
    <table id="requestTable" style="cellspacing="2" border="1" cellpadding="5" width="600"">
    <tr id="tableHeader">
        <th>Title</th>
        <th>Author</th>
        <th>Description</th>
        <th>Priority</th>
    </tr>
    <?php
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <tr  class="request-row" id="<?php the_ID(); ?>">
                <td><?php echo get_the_title(); ?></td>
                <td><?php echo get_field('author'); ?></td>
                <td><?php echo get_field('message'); ?></td>
                <td><?php echo get_field('priority'); ?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }
    wp_reset_postdata();?>

    <h1>Add your request:</h1>
    <div style="width: 100px">
        <form id="request-form" action="" method="post">
            <label>Title
                <input type="text" name="title" id="title-field" value="title" required>
            </label>
            <label>Author
                <input type="text" name="author" id="author-field" value="author" required>
            </label>
            <label>Message
                <textarea name="" id="message-field" cols="30" rows="10"></textarea>
            </label>
            <div>
                <select name="select" id="select-field">
                    <option value="0">Low</option>
                    <option value="1">High</option>
                    <option value="2">Urgent</option>
                </select>
            </div>
            <button id="submitFormButton" value="Add Queries" type='submit'>Add Queries</button>
        </form>

    </div>
<?php

/*add_action( 'wp_ajax_add_new_request', 'add_new_request_callback' );
function add_new_request_callback() {
    $post_data = array(
        'post_author' => $_POST['author'],
        'message' =>  $_POST['message'],
        'post_title'    => $_POST['title'],
        'select'    => $_POST['select'],
        'post_type' => 'request',
        'post_status'   => 'publish',
        'id_post' => $_POST['id'],
    );
    $post_id = wp_insert_post( $post_data );

    //update author field
    update_field( 'field_5c7e6fccbd44a', $_POST['author'], $post_id );
    //update message field
    update_field( 'field_5c7e6f8bbd449', $_POST['message'], $post_id );
    //update priority field
    update_field( 'field_5c7e6fe8bd44b', $_POST['select'], $post_id );

    $return = array(
        'id_post' => $post_id,
    );
    wp_send_json_success( $return, '200' );

    wp_die();
}*/





wp_footer();
?>