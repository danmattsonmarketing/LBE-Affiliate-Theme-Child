<?php
require 'theme_update_check.php';
$MyUpdateChecker = new ThemeUpdateChecker(
    'womness',
    'https://kernl.us/api/v1/theme-updates/5a615b8ad3a06a26c3e3d01e/'
);
// $MyUpdateChecker->license = "aKernlLicenseKey";  <---- optional
// $MyUpdateChecker->remoteGetTimeout = 5; <---- optional

?>
<?php
/**
 * Theme settings
 */
add_theme_support( 'post-thumbnails' );


add_filter( 'wp_title', 'womness_hack_wp_title_for_home' );
 
/**
 * Customize the title for the home page, if one is not set.
 *
 * @param string $title The original title.
 * @return string The title to use.
 */
function womness_hack_wp_title_for_home( $title )
{
  if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
    $title = get_bloginfo( 'description' );
  }
  return $title;
}


class womness_general_settings {
    function womness_general_settings( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'womness_logo', 'esc_attr' );
        register_setting( 'general', 'womness_logo_size', 'esc_attr' );
        register_setting( 'general', 'womness_color_scheme', 'esc_attr' );
        register_setting( 'general', 'womness_disclaimer', 'esc_attr' );
        register_setting( 'general', 'womness_copyright', 'esc_attr' );
        register_setting( 'general', 'womness_pagination_home', 'esc_attr' );

        add_settings_field('womness_logo', '<label for="womness_logo">'.__('Site Logo (url)' , 'womness_logo' ).'</label>' , array(&$this, 'fields_logo_html') , 'general' );
        add_settings_field('womness_logo_size', '<label for="womness_logo_size">'.__('Logo Size (image)' , 'womness_logo_size' ).'</label>' , array(&$this, 'fields_logo_size_html') , 'general' );
        add_settings_field('womness_color_scheme', '<label for="womness_color_scheme">'.__('Color Scheme' , 'womness_color_scheme' ).'</label>' , array(&$this, 'fields_colorscheme_html') , 'general' );
        add_settings_field('womness_pagination_home', '<label for="womness_pagination_home">'.__('Show pagination in front page' , 'womness_pagination_home' ).'</label>' , array(&$this, 'fields_pagination_home_html') , 'general' );
        add_settings_field('womness_disclaimer', '<label for="womness_disclaimer">'.__('Disclaimer' , 'womness_disclaimer' ).'</label>' , array(&$this, 'fields_disclaimer_html') , 'general' );
        add_settings_field('womness_copyright', '<label for="womness_copyright">'.__('Copyright text' , 'womness_copyright' ).'</label>' , array(&$this, 'fields_copyright_html') , 'general' );        
    }
    function fields_logo_html() {
        $value = get_option( 'womness_logo', '' );
        echo '<input type="text" id="womness_logo" name="womness_logo" class="regular-text" value="' . $value . '" />';
    }
    function fields_logo_size_html() {
        $value = get_option( 'womness_logo_size', '' );
        ?>
        <select id="womness_logo_size" name="womness_logo_size">
            <option value="small" <?php selected( $value, 'small' ); ?>>small</option>
            <option value="medium" <?php selected( $value, 'medium' ); ?>>medium</option>
            <option value="large" <?php selected( $value, 'large' ); ?>>large</option>
        </select>
        <?php
    }
    function fields_pagination_home_html() {
        $value = get_option( 'womness_pagination_home', '' );
        ?>
        <select id="womness_pagination_home" name="womness_pagination_home">
            <option value="yes" <?php selected( $value, 'yes' ); ?>>yes</option>
            <option value="no" <?php selected( $value, 'no' ); ?>>no</option>
        </select>
        <?php
    }
    function fields_colorscheme_html() {
    	$value = get_option( 'womness_color_scheme', '' );
    	?>
    	<select id="womness_color_scheme" name="womness_color_scheme">
    		<option value="" <?php selected( $value, '' ); ?>>default</option>
    		<option value="1" <?php selected( $value, '1' ); ?>>Flying Pony</option>
    		<option value="2" <?php selected( $value, '2' ); ?>>take me as i am *</option>
    		<option value="3" <?php selected( $value, '3' ); ?>>eight eighty eight</option>
    		<option value="4" <?php selected( $value, '4' ); ?>>bubblegum</option>
    		<option value="5" <?php selected( $value, '5' ); ?>>mid autumn</option>
    		<option value="6" <?php selected( $value, '6' ); ?>>june</option>
    		<option value="7" <?php selected( $value, '7' ); ?>>I'm lovin' it</option>
            <option value="8" <?php selected( $value, '8' ); ?>>(???)</option>
            <option value="9" <?php selected( $value, '9' ); ?>>(? ” ?)</option>
            <option value="10" <?php selected( $value, '10' ); ?>>Nobody ? Sugar</option>
            <option value="11" <?php selected( $value, '11' ); ?>>Fired. Now What?</option>
            <option value="12" <?php selected( $value, '12' ); ?>>Luv Deficit Disorder</option>
            <option value="13" <?php selected( $value, '13' ); ?>>Sugar Martini</option>
            <option value="14" <?php selected( $value, '14' ); ?>>Identity Theft</option>
            <option value="15" <?php selected( $value, '15' ); ?>>the aftermath *</option>
            <option value="16" <?php selected( $value, '16' ); ?>>Freebies: SugarCubes</option>
            <option value="17" <?php selected( $value, '17' ); ?>>Monster Hearts Me!</option>
            <option value="18" <?php selected( $value, '18' ); ?>>(((( ♫ ))))</option>
            <option value="19" <?php selected( $value, '19' ); ?>>You're My Sugar Rush</option>
            <option value="20" <?php selected( $value, '20' ); ?>>(s e x ' n . r o l l)</option>
    	</select>
    	<?php
    }
    function fields_disclaimer_html() {
        $value = get_option( 'womness_disclaimer', '' );
        echo '<textarea style="width: 400px; height: 300px" id="womness_disclaimer" name="womness_disclaimer">' . $value . '</textarea>';
    }
    function fields_copyright_html() {
        $value = get_option( 'womness_copyright', '' );
        echo '<input type="text" id="womness_copyright" name="womness_copyright" class="regular-text" value="' . $value . '" />';
    }
}
$new_general_setting = new womness_general_settings();

/** 
 * Styles and scripts
 */
function womness_scripts() {
    wp_enqueue_style( 'style-womness', get_template_directory_uri().'/css/styles-res.css' );
    wp_enqueue_style( 'menu-womness', get_template_directory_uri().'/css/menumaker.css' );
    //wp_enqueue_script( 'script-womness', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );

    $value = get_option( 'womness_color_scheme', '' );
    if ($value) {
    	wp_enqueue_style( 'color-scheme-womness', get_template_directory_uri().'/color-schemes/'.$value.'.css' );
    }

    wp_enqueue_script( 'menu-womness', get_template_directory_uri().'/js/menumaker.js', array( 'jquery' ) );
    wp_enqueue_script( 'main-womness', get_template_directory_uri().'/js/main.js', array( 'menu-womness' ) );
}
add_action( 'wp_enqueue_scripts', 'womness_scripts' );


/**
 * Menues 
 */
register_nav_menus( array(
	'womness_top_menu' => 'Top Navigation Menu',
	'womness_main_menu' => 'Main Navigation Menu',
    'womness_footer_menu' => 'Footer Navigation Menu',
) );


/**
 * Sidebars
 */
register_sidebar( array(
    'name'          => __( 'Homepage Sidebar', 'womness' ),
    'id'            => 'womness-homepage-sidebar',
    'description'   => '',
    'class'         => '',
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget'  => '</li>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>' 
));

register_sidebar( array(
    'name'          => __( 'Homepage Bottom Area', 'womness' ),
    'id'            => 'womness-homepage-bottom-sidebar',
    'description'   => '',
    'class'         => '',
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget'  => '</li>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>' 
));

register_sidebar( array(
	'name'          => __( 'Single Page Sidebar', 'womness' ),
	'id'            => 'womness-page-sidebar',
	'description'   => '',
    'class'         => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' 
));

register_sidebar( array(
	'name'          => __( 'Single Post Sidebar', 'womness' ),
	'id'            => 'womness-post-sidebar',
	'description'   => '',
    'class'         => '',
	'before_widget' => '<li id="%1$s" class="widget %2$s">',
	'after_widget'  => '</li>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>' 
));


/**
 * Widgets
 */

class Womness_AWeberWidget extends WP_Widget {

    function __construct() {
        // Instantiate the parent object
        parent::__construct( false, 'AWeber Sign-up Vertical Form [LBE]' );
    }

    function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $subtitle = apply_filters( 'widget_title', $instance['subtitle'] );
        $image = $instance['image'];
        $text = $instance['text'];
        $list = $instance['list'];
        $btn = $instance['btn'];
        ?>
        <div class="content-pad AWeberWebformPlugin_printWidget widget">
          <div class="flt-right margin-10bot">
            <h2><?php echo $title; ?></h2>
            <p><?php echo $subtitle; ?></p>
          </div>
          <div class="flt-left "> 
            <?php
            if ($image) { ?>
                <img src="<?php echo $image; ?>" alt="" width="300" height="402" class="imgresponsive">
                <?php 
            }
            ?>
          </div>

          <div class="flt-right margin-10top">
            <p>
                <?php 
                if ($text) {
                    echo $text;
                }
                ?>
              <form method="post" accept-charset="UTF-8" action="https://www.aweber.com/scripts/addlead.pl">
                    <input type="hidden" name="listname" value="<?php echo $list; ?>">
                    <input type="hidden" name="redirect" value="http://www.aweber.com/thankyou-coi.htm?m=text">
                    <input type="hidden" name="meta_adtracking" value="My_Web_Form">
                    <input type="hidden" name="meta_message" value="1">
                    <input type="hidden" name="meta_required" value="name,email">

                    <input type="text" class="subscribe-textarea" name="name" id="newsletter-name" placeholder="First Name">
                    <input type="text" class="subscribe-textarea" name="email" id="newsletter-email" placeholder="Email Address">
                    <input type="submit" class="subscribe-submit" value="<?php echo $btn; ?>">
              </form>
            </p>
            <p style="font-size:13px; color:#5F5F5F;">Your privacy is important to us.
              We never send spam.</p>
          </div>
          <div class="clearfix"></div>
        </div>
        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['subtitle'] = ( ! empty( $new_instance['subtitle'] ) ) ? strip_tags( $new_instance['subtitle'] ) : '';
        $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
        $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
        $instance['list'] = ( ! empty( $new_instance['list'] ) ) ? $new_instance['list'] : '';
        $instance['btn'] = ( ! empty( $new_instance['btn'] ) ) ? $new_instance['btn'] : '';
        return $instance;
    }

    function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ]; }
        else { $title = __( 'New Title', 'womness' ); }

        if ( isset( $instance[ 'subtitle' ] ) ) { $subtitle = $instance[ 'subtitle' ]; }
        else { $subtitle = __( 'Subtitle', 'womness' ); }

        if ( isset( $instance[ 'image' ] ) ) { $image = $instance[ 'image' ]; }
        else { $image = __( '', 'womness' ); }

        if ( isset( $instance[ 'text' ] ) ) { $text = $instance[ 'text' ]; }
        else { $text = __( '', 'womness' ); }

        if ( isset( $instance[ 'list' ] ) ) { $list = $instance[ 'list' ]; }
        else { $list = __( '', 'womness' ); }

        if ( isset( $instance[ 'btn' ] ) ) { $btn = $instance[ 'btn' ]; }
        else { $btn = __( 'JOIN NOW!', 'womness' ); }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Subtitle:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image URL:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_attr( $image ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text:' ); ?></label> 
            <textarea rows="10" class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_attr( $text ); ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'btn' ); ?>"><?php _e( 'Submit button text:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'btn' ); ?>" name="<?php echo $this->get_field_name( 'btn' ); ?>" type="text" value="<?php echo esc_attr( $btn ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'list' ); ?>"><?php _e( 'List ID:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'list' ); ?>" name="<?php echo $this->get_field_name( 'list' ); ?>" type="text" value="<?php echo esc_attr( $list ); ?>" />
        </p>
        <?php 
    }
}


class Womness_AWeberWidget_2 extends WP_Widget {

    function __construct() {
        // Instantiate the parent object
        parent::__construct( false, 'AWeber Sign-up Horizontal Form [LBE]' );
    }

    function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $image = $instance['image'];
        $text = $instance['text'];
        $list = $instance['list'];
        $btn = $instance['btn'];
        ?>

        <div id="signup">
          <div class="signup-img"><img src="<?php echo $image; ?>" alt="" width="287" height="400" class="imgresponsive"/></div>
          <div class="signup-forms">
            <div class="signup-content">
                <h2><?php echo $title; ?></h2>
                <?php 
                if ($text) {
                    echo $text;
                }
                ?>
            </div>
            <div>
                <form method="post" accept-charset="UTF-8" action="https://www.aweber.com/scripts/addlead.pl">
                    <input type="hidden" name="listname" value="<?php echo $list; ?>">
                    <input type="hidden" name="redirect" value="http://www.aweber.com/thankyou-coi.htm?m=text">
                    <input type="hidden" name="meta_adtracking" value="My_Web_Form">
                    <input type="hidden" name="meta_message" value="1">
                    <input type="hidden" name="meta_required" value="name,email">
                    <input name="name" type="text" id="membership-name" class="membership-textarea" placeholder="Enter Your First Name" style="margin-right:10px;">
                    <input name="email" type="text" id="membership-email" class="membership-textarea"  placeholder="Enter Your Email Address">

            </div>
            <div class="signup-submit">
              <input name="submit" type="submit" class="membership-submit" id="submit" value="<?php echo $btn; ?>">
              </form>
              <span style="font-size:13px; color:#5F5F5F;">We will not sell/rent your email address</span>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>

        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
        $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
        $instance['list'] = ( ! empty( $new_instance['list'] ) ) ? $new_instance['list'] : '';
        $instance['btn'] = ( ! empty( $new_instance['btn'] ) ) ? $new_instance['btn'] : '';
        return $instance;
    }

    function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ]; }
        else { $title = __( 'New Title', 'womness' ); }

        if ( isset( $instance[ 'image' ] ) ) { $image = $instance[ 'image' ]; }
        else { $image = __( '', 'womness' ); }

        if ( isset( $instance[ 'text' ] ) ) { $text = $instance[ 'text' ]; }
        else { $text = __( '', 'womness' ); }

        if ( isset( $instance[ 'list' ] ) ) { $list = $instance[ 'list' ]; }
        else { $list = __( '', 'womness' ); }

        if ( isset( $instance[ 'btn' ] ) ) { $btn = $instance[ 'btn' ]; }
        else { $btn = __( 'JOIN NOW!', 'womness' ); }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image URL:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_attr( $image ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text:' ); ?></label> 
            <textarea rows="10" class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_attr( $text ); ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'btn' ); ?>"><?php _e( 'Submit button text:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'btn' ); ?>" name="<?php echo $this->get_field_name( 'btn' ); ?>" type="text" value="<?php echo esc_attr( $btn ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'list' ); ?>"><?php _e( 'List ID:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'list' ); ?>" name="<?php echo $this->get_field_name( 'list' ); ?>" type="text" value="<?php echo esc_attr( $list ); ?>" />
        </p>
        <?php 
    }
}

class Womness_VideoWidget extends WP_Widget {

    function __construct() {
        // Instantiate the parent object
        parent::__construct( false, 'Image Widget + Button [LBE]' );
    }

    function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $image = $instance['image'];
        $text = $instance['text'];
        $btn = $instance['btn'];
        $link = $instance['link'];
        ?>

        <div class="content-pad" style="border:1px solid #F0F0F0;">
          <div class="flt-right margin-10bot">
            <h2 style="text-align:center"><?php echo $title; ?></h2>
          </div>
          <div class="flt-left"><img src="<?php echo $image; ?>" alt="" width="720" height="437" class="imgresponsive"></div>
          <div class="flt-right margin-10top">
            <p><?php echo $text; ?></p>
            <a href="<?php echo $link; ?>" class="watch-btn"><?php echo $btn; ?></a>
          </div>
          <div class="clearfix"></div>
        </div>

        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
        $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
        $instance['btn'] = ( ! empty( $new_instance['btn'] ) ) ? $new_instance['btn'] : '';
        $instance['link'] = ( ! empty( $new_instance['link'] ) ) ? $new_instance['link'] : '';
        return $instance;
    }

    function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ]; }
        else { $title = __( 'New Title', 'womness' ); }

        if ( isset( $instance[ 'image' ] ) ) { $image = $instance[ 'image' ]; }
        else { $image = __( '', 'womness' ); }

        if ( isset( $instance[ 'text' ] ) ) { $text = $instance[ 'text' ]; }
        else { $text = __( '', 'womness' ); }

        if ( isset( $instance[ 'btn' ] ) ) { $btn = $instance[ 'btn' ]; }
        else { $btn = __( 'JOIN NOW!', 'womness' ); }

        if ( isset( $instance[ 'link' ] ) ) { $link = $instance[ 'link' ]; }
        else { $link = __( '', 'womness' ); }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image URL:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_attr( $image ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text:' ); ?></label> 
            <textarea rows="10" class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_attr( $text ); ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'btn' ); ?>"><?php _e( 'Button text:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'btn' ); ?>" name="<?php echo $this->get_field_name( 'btn' ); ?>" type="text" value="<?php echo esc_attr( $btn ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Button link:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
        </p>
        <?php 
    }
}


class Womness_FlutterMailWidget extends WP_Widget {

    function __construct() {
        // Instantiate the parent object
        parent::__construct( false, 'FlutterMail Sign-up Vertical Form [LBE]' );
    }

    function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $subtitle = apply_filters( 'widget_title', $instance['subtitle'] );
        $image = $instance['image'];
        $text = $instance['text'];
        $list = $instance['list'];
        $apikey = $instance['apikey'];
        $btn = $instance['btn'];
        ?>
        <div class="content-pad AWeberWebformPlugin_printWidget widget">
          <div class="flt-right margin-10bot">
            <h2><?php echo $title; ?></h2>
            <p><?php echo $subtitle; ?></p>
          </div>
          <div class="flt-left "> 
            <?php
            if ($image) { ?>
                <img src="<?php echo $image; ?>" alt="" width="300" height="402" class="imgresponsive">
                <?php 
            }
            ?>
          </div>

          <div class="flt-right margin-10top">
            <p>
                <?php 
                if ($text) {
                    echo $text;
                }

                if (!empty($_POST['fluttermail_name'])) {
                    $apiurl = 'https://em.fluttermail.com';
                    $params = array(
                        'api_key'      => $apikey,
                        'api_action'   => 'subscriber_add',
                        'api_output'   => 'serialize',
                    );
                    // Define the data
                    $post = array(
                        'email'                    => $_POST['fluttermail_email'],
                        'first_name'               => $_POST['fluttermail_name'],
                        'p['.$list.']'                  => $list, // List ID
                        'status['.$list.']'              => 1, // 1: active, 2: unsubscribed
                    );

                    // Converts the input fields to the proper format
                    $query = "";
                    foreach( $params as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
                    $query = rtrim($query, '& ');

                    $data = "";
                    foreach( $post as $key => $value ) $data .= $key . '=' . urlencode($value) . '&';
                    $data = rtrim($data, '& ');

                    // clean up the url
                    $apiurl = rtrim($apiurl, '/ ');

                    $api = $apiurl . '/admin/api.php?' . $query;

                    $request = curl_init($api);
                    curl_setopt($request, CURLOPT_HEADER, 0);
                    curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($request, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
                    $response = (string)curl_exec($request);
                    curl_close($request);

                    ?>
                    <p>
                        Thank you for suscribing! You will start receiving news form us.
                    </p>
                    <?php
                }
                ?>
              <form method="post" accept-charset="UTF-8" action="">
                    <input type="text" class="subscribe-textarea" name="fluttermail_name" id="newsletter-name" placeholder="First Name">
                    <input type="text" class="subscribe-textarea" name="fluttermail_email" id="newsletter-email" placeholder="Email Address">
                    <input type="submit" class="subscribe-submit" value="<?php echo $btn; ?>">
              </form>
            </p>
            <p style="font-size:13px; color:#5F5F5F;">Your privacy is important to us.
              We never send spam.</p>
          </div>
          <div class="clearfix"></div>
        </div>
        <?php
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['subtitle'] = ( ! empty( $new_instance['subtitle'] ) ) ? strip_tags( $new_instance['subtitle'] ) : '';
        $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
        $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
        $instance['list'] = ( ! empty( $new_instance['list'] ) ) ? $new_instance['list'] : '';
        $instance['apikey'] = ( ! empty( $new_instance['apikey'] ) ) ? $new_instance['apikey'] : '';
        $instance['btn'] = ( ! empty( $new_instance['btn'] ) ) ? $new_instance['btn'] : '';
        return $instance;
    }

    function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) { $title = $instance[ 'title' ]; }
        else { $title = __( 'New Title', 'womness' ); }

        if ( isset( $instance[ 'subtitle' ] ) ) { $subtitle = $instance[ 'subtitle' ]; }
        else { $subtitle = __( 'Subtitle', 'womness' ); }

        if ( isset( $instance[ 'image' ] ) ) { $image = $instance[ 'image' ]; }
        else { $image = __( '', 'womness' ); }

        if ( isset( $instance[ 'text' ] ) ) { $text = $instance[ 'text' ]; }
        else { $text = __( '', 'womness' ); }

        if ( isset( $instance[ 'list' ] ) ) { $list = $instance[ 'list' ]; }
        else { $list = __( '', 'womness' ); }

        if ( isset( $instance[ 'apikey' ] ) ) { $apikey = $instance[ 'apikey' ]; }
        else { $apikey = __( '', 'womness' ); }

        if ( isset( $instance[ 'btn' ] ) ) { $btn = $instance[ 'btn' ]; }
        else { $btn = __( 'JOIN NOW!', 'womness' ); }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Subtitle:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image URL:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_attr( $image ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text:' ); ?></label> 
            <textarea rows="10" class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_attr( $text ); ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'btn' ); ?>"><?php _e( 'Submit button text:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'btn' ); ?>" name="<?php echo $this->get_field_name( 'btn' ); ?>" type="text" value="<?php echo esc_attr( $btn ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'list' ); ?>"><?php _e( 'List ID:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'list' ); ?>" name="<?php echo $this->get_field_name( 'list' ); ?>" type="text" value="<?php echo esc_attr( $list ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'apikey' ); ?>"><?php _e( 'API Key:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'apikey' ); ?>" name="<?php echo $this->get_field_name( 'apikey' ); ?>" type="text" value="<?php echo esc_attr( $apikey ); ?>" />
        </p>
        <?php 
    }
}

function womness_register_widgets() {
    register_widget( 'Womness_AWeberWidget' );
    register_widget( 'Womness_AWeberWidget_2' );
    register_widget( 'Womness_VideoWidget' );
    register_widget( 'Womness_FlutterMailWidget' );
}

add_action( 'widgets_init', 'womness_register_widgets' );

