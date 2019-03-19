<?php
wp_head();

//view queries in table on front page
$args = array(
    'posts_per_page' => 20,
    'post_type'      => 'request',
    'post_status'    => 'publish',
    'order'          => 'DESC',
    'orderby'        => 'meta_value_num date',
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
    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();?>
            <tr  class="request-row" id="<?php the_ID(); ?>">
                <td><?php echo get_the_title(); ?></td>
                <td><?php echo get_field('author'); ?></td>
                <td><?php echo get_field('message'); ?></td>
                <td><?php echo get_field('priority'); ?></td>
            </tr>
            <?php endwhile; ?>
    </table>
    <?php
    endif;
    wp_reset_postdata(); ?>

    <!--Request form-->
    <h1>Add your request:</h1>
    <div style="width: 400px">
        <form id="request-form" action="" method="post">
            <label>Title
                <input type="text" name="title" id="title-field" value="title">
            </label>
            <label>Author
                <input type="text" name="author" id="author-field" value="author">
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
                <button id="submitFormButton" value="Add Queries" type="submit">Add Queries</button>
            </div>
        </form>
    </div>
<?php

/** Register Scripts. */
wp_enqueue_script('functions-front', plugins_url('functions-front.js', __FILE__), array('jquery'), '', 'true' );

wp_localize_script( 'functions-front', 'ajax_name', array(
    'url' => admin_url('admin-ajax.php'),
) );

//Bootstrap files
wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
// Add JavaScript Bootstrap Files
wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array( 'jquery'), '1.0', true );
wp_enqueue_script( 'bootstrap-bundle-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js' , array( 'jquery'), '1.0', true );

//send data
add_action( 'wp_ajax_add_new_request_front', 'add_new_request_callback_front' );
function add_new_request_callback_front(){
    $post_data = array(
        'post_title' => $_POST['title'],
        'post_type' => 'request',
        'post_status' => 'publish',
    );
    if ( empty( ( $_POST['title'] ) &&
                ( $_POST['author'] ) &&
                ( $_POST['message'] ) ) ) {
        echo "Please fill in all items in the form!";
        wp_die();
    } else {
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
    }
}
wp_footer();
?>