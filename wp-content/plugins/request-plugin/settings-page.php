<?php
/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */

/**
 * custom option and settings
 */
function request_settings_init() {
    // register a new setting for "request" page
    register_setting( 'request', 'request_options' );

    // register a new section in the "request" page
    add_settings_section(
        'request_section_developers',
        __( 'Add your request', 'request' ),
        'request_section_developers_cb',
        'request'
    );

    // register a new field in the "request_section_developers" section, inside the "request" page
    add_settings_field(
        'request_field_priority', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __( 'Priority', 'request' ),
        'request_field_priority_cb',
        'request',
        'request_section_developers',
        [
            'label_for' => 'request_field_priority',
            'class' => 'request_row',
            'request_custom_data' => 'custom',
        ]
    );
}

/**
 * register our request_settings_init to the admin_init action hook
 */
//add_action( 'admin_init', 'request_settings_init' );

/**
 * custom option and settings:
 * callback functions
 */

// developers section cb

// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function request_section_developers_cb( $args ) {
    ?>
    <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Add your request in the form', 'request' ); ?></p>
    <?php
}

// pill field cb

// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: label_for, class.
// the "label_for" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.
function request_field_priority_cb( $args ) {
    // get the value of the setting we've registered with register_setting()
    $options = get_option( 'request_options' );
    // output the field

    /*   $args = array(
           'posts_per_page' => 10,
           'post_type'      => 'request',
           'order'          => 'ASC',
           'orderby'        => 'name',
       );

       $query = new WP_Query($args);

       if ( $query->have_posts() ) {
           while ( $query->have_posts() ) {
               $query->the_post();
               $description_field = get_field_object('description');
               $author_field = get_field_object('author');
               $priority_field = get_field_object('priority');

               echo '<h2>' . $description_field['label']. '</h2>';
               echo '<p>' . the_field('description') . '</p>';
               echo '<h2>' . $author_field['label']. '</h2>';
               echo '<p>' . the_field('author') . '</p>';
               echo '<h2>' . $priority_field['label']. '</h2>';
               echo '<p>' . the_field('priority') . '</p>';
           }
       } else {

       }

       wp_reset_postdata();*/
    ?>
    <!--<select id="<?php /*echo esc_attr( $args['label_for'] ); */?>"
            data-custom="<?php /*echo esc_attr( $args['request_custom_data'] ); */?>"
            name="request_options[<?php /*echo esc_attr( $args['label_for'] ); */?>]"
    >
        <option value="low" <?php /*echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'low', false ) ) : ( '' ); */?>>
            <?php /*esc_html_e( 'Low', 'request' ); */?>
        </option>
        <option value="high" <?php /*echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'high', false ) ) : ( '' ); */?>>
            <?php /*esc_html_e( 'High', 'request' ); */?>
        </option>
        <option value="urgent" <?php /*echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'urgent', false ) ) : ( '' ); */?>>
            <?php /*esc_html_e( 'Urgent', 'request' ); */?>
        </option>
    </select>-->
    <!-- <p class="description">
        <?php /*esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'request' ); */?>
    </p>-->
    <!--<p class="description">
        <?php /*esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'request' ); */?>
    </p>-->
    <?php
}

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

function request_options_page_html() {

    $args = array(
        'posts_per_page' => 10,
        'post_type'      => 'request',
        'order'          => 'ASC',
        'orderby'        => 'name',
    );

    $query = new WP_Query($args);
    $i = 0;
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            if ( $i == 0 ) {
                $description_field = get_field_object('description');
                $author_field = get_field_object('author');
                $priority_field = get_field_object('priority');
                ?>
                <table style="cellspacing="2" border="1" cellpadding="5" width="600"">
                <tr>
                    <th><?php echo 'Title'; ?></th>
                    <th><?php echo $description_field['label']; ?></th>
                    <th><?php echo $author_field['label']; ?></th>
                    <th><?php echo $priority_field['label']; ?></th>
                    <th><?php echo 'Actions'; ?></th>
                </tr>
                <?php
            } else {
            }
            ?>
            <tr>
                <td><?php echo get_the_title(); ?></td>
                <td><?php echo the_field('description'); ?></td>
                <td><?php echo the_field('author'); ?></td>
                <td><?php echo the_field('priority'); ?></td>
                <td><button>Delete</button></td>
            </tr>
            <?php
            $i++;
        }
        ?>
        </table>
        <?php
    }
    wp_reset_postdata();?>

    <h1>Add your request:</h1>
    <div style="width: 100px">
        <form action="" method="post">
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
            <input id="submit-form-button" type="submit" value="Add Queries">
        </form>
    </div>
    <?php
};

//add_action('admin_print_scripts', 'my_action_javascript'); // такое подключение будет работать не всегда
//------------запрос с данными (data)
add_action('admin_print_footer_scripts', 'my_action_javascript', 99);
function my_action_javascript() {
    ?>
    <script>
        jQuery(document).ready(function($) {
            $("#submit-form-button").click(function () {
                var title = $("#title-field").val();
                var author = $("#author-field").val();
                var message = $("#message-field").val();
                var select = $("#select-field").val();

                var data = {
                    action: 'my_action',
                    title: title,
                    author: author,
                    message: message,
                    select: select,
                };
                // с версии 2.8 'ajaxurl' всегда определен в админке
                jQuery.post( ajaxurl, data, function(response) {
                    alert('Your request sent successful');
                });
            });
        });
    </script>
    <?php
}
//--------что нужно делать:
add_action( 'wp_ajax_my_action', 'my_action_callback' );
function my_action_callback() {
    //вывести информацию в таблицу
    $post_data = array(
        'post_author'   => 'author',
        'post_content' => '123',//message
        'post_title'    => wp_strip_all_tags( $_POST['title'] ),
        'post_type' => 'request',
        'post_status'   => 'publish',
    );
    wp_insert_post( $post_data );//вставить в wp пост с массивом данных выше
    wp_die(); // выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
}