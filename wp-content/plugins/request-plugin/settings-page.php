<?php
/**
 * top level menu
 */
function request_options_page() {
    // add top level menu page
    add_menu_page(
        'Request plugin',
        'Request Options',
        'manage_options',
        'request',
        'request_options_page_html'
    );
}
add_action( 'admin_menu', 'request_options_page' );

//view queries in table on settings page
function request_options_page_html() {

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
            <th>Actions</th>
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
                <td><button class="deleteQueryButton">Delete</button></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
    }
    wp_reset_postdata();?>

    <!--Request form-->
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
};

/** Register Scripts. */
add_action( 'admin_enqueue_scripts', 'add_my_scripts', 100 );
function add_my_scripts() {

    /** Add JavaScript Functions File */
    wp_enqueue_script( 'functions-js', plugins_url('functions.js', __FILE__) , array( 'jquery' ), '1.0', true );

    /** Localize Scripts */
    wp_localize_script( 'functions-js', 'ajax_name', array(
        'url' => admin_url('admin-ajax.php'),
    ) );
}

//send data
add_action( 'wp_ajax_add_new_request', 'add_new_request_callback' );
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
}

//delete data
add_action( 'wp_ajax_my_delete_post', 'my_delete_post_callback' );
function my_delete_post_callback(){
    $id_post = $_POST['id'];
    wp_delete_post( $id_post, 'false');
    die();
}

//front-page
add_filter('template_include', 'request_template');
function request_template( $template ) {

    if( is_page('request-page') ){
        $template = plugin_dir_path( __FILE__ ) .'/front-plugin-page.php';
    };
    return $template;
}