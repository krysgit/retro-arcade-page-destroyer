<?php
/*
Plugin Name: Retro Arcade Page Destroyer
Plugin URI: https://github.com/krysgit/retro-arcade-page-destroyer
Description: Turn your site into a retro arcade shooter. Destroy webpage contents with your ship. A modernized fork compatible with PHP 8+. Use shortcode [asteroids] or the widget to launch.
Version: 1.0.0
Author: Krystalia Saldari
Author URI: https://github.com/krysgit
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: retro-arcade-page-destroyer
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Retro_Arcade_Page_Destroyer_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_retro_arcade',
			'description' => __( 'Play retro arcade shooter and destroy page elements', 'retro-arcade-page-destroyer' ),
		);
		$control_ops = array( 'width' => 500, 'height' => 350 );
		parent::__construct( 'retro_arcade_destroyer', __( 'Retro Arcade Destroyer', 'retro-arcade-page-destroyer' ), $widget_ops, $control_ops );
	}

	public function widget( $args, $options ) {
		$options = wp_parse_args( (array) $options, array(
			'title'        => '',
			'text'         => 'Controls: Use Arrow Keys or WASD to navigate, Spacebar to shoot, and Esc to quit.',
			'bullet-color' => false,
			'show'         => 'all',
			'slug'         => '',
			'button-opt'   => 'push-1',
			'image-opt'    => 'none',
			'background'   => false,
			'filter'       => false,
		) );

		$asteroids_title = apply_filters( 'widget_title', empty( $options['title'] ) ? '' : $options['title'], $options, $this->id_base );
		$asteroids_text  = ! empty( $options['text'] ) ? $options['text'] : '';
		$asteroids_link  = '<p style="font-size: 70%; text-align: right;">By <a href="http://electrictreehouse.com" rel="noopener noreferrer">Eric</a> and <a href="https://github.com/erkie/erkie.github.com" rel="noopener noreferrer">Erik</a></p>';

		$plugin_url = plugins_url( 'gears/', __FILE__ );

		$asteroids_bk          = esc_url( $plugin_url . 'asteroids-bk.jpg' );
		$asteroids_mainimage   = esc_url( $plugin_url . 'asteroids-image.jpg' );
		$asteroids_rocketimage = esc_url( $plugin_url . 'asteroids-rocket.png' );
		$asteroids_nohoverimage= esc_url( $plugin_url . 'asteroids.jpg' );
		$asteroids_hoverimage  = esc_url( $plugin_url . 'asteroids-hover.jpg' );
		$asteroids_arcadered   = esc_url( $plugin_url . 'arcade-red.png' );
		$asteroids_arcadeyellow= esc_url( $plugin_url . 'arcade-yellow.png' );
		$asteroids_arcadeblack = esc_url( $plugin_url . 'arcade-black.gif' );

		if ( ! empty( $options['bullet-color'] ) ) {
			$address         = esc_url( $plugin_url . 'play-asteroids-yellow.min.js' );
			$asteroids_start = "startAsteroids('yellow','" . esc_js( $address ) . "');";
		} else {
			$address         = esc_url( $plugin_url . 'play-asteroids.min.js' );
			$asteroids_start = "startAsteroids('','" . esc_js( $address ) . "');";
		}

		$asteroids_show      = $options['show'];
		$asteroids_slug      = trim( $options['slug'] );
		$asteroids_buttonopt = $options['button-opt'];
		$asteroids_imageopt  = $options['image-opt'];

		$should_display = false;
		switch ( $asteroids_show ) {
			case 'all':
			case '':
				$should_display = true;
				break;
			case 'front':
				$should_display = is_front_page();
				break;
			case 'post':
				$should_display = ! empty( $asteroids_slug ) ? is_single( explode( ',', $asteroids_slug ) ) : is_single();
				break;
			case 'category':
				$should_display = ! empty( $asteroids_slug ) ? is_category( explode( ',', $asteroids_slug ) ) : is_category();
				break;
			case 'page':
				$should_display = ! empty( $asteroids_slug ) ? is_page( explode( ',', $asteroids_slug ) ) : is_page();
				break;
		}

		if ( ! $should_display ) {
			return;
		}

		echo wp_kses_post( $args['before_widget'] );

		if ( ! empty( $asteroids_title ) ) {
			echo wp_kses_post( $args['before_title'] ) . esc_html( $asteroids_title ) . wp_kses_post( $args['after_title'] );
		}

		if ( ! empty( $options['background'] ) ) {
			echo '<div style="background-image: url(' . esc_url( $asteroids_bk ) . '); padding:20px 10px;">';
			echo '<div style="text-align:center; color:#fff;">';
		} else {
			echo '<div>';
		}

		include( plugin_dir_path( __FILE__ ) . 'gears/run-asteroids.php' );

		if ( ! empty( $asteroids_text ) ) {
			$formatted_text = ! empty( $options['filter'] ) ? wpautop( $asteroids_text ) : $asteroids_text;
			echo '<div class="asteroidswidget">' . wp_kses_post( $formatted_text ) . '</div>';
		}

		if ( ! empty( $options['background'] ) ) {
			echo '</div></div>';
		} else {
			echo '</div>';
		}

		if ( is_front_page() ) {
			echo wp_kses_post( $asteroids_link );
		}

		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $newoptions, $oldoptions ) {
		$options = $oldoptions;
		$options['title']        = sanitize_text_field( $newoptions['title'] );
		$options['text']         = current_user_can( 'unfiltered_html' ) ? $newoptions['text'] : wp_filter_post_kses( $newoptions['text'] );
		$options['filter']       = ! empty( $newoptions['filter'] );
		$options['bullet-color'] = ! empty( $newoptions['bullet-color'] );
		$options['background']   = ! empty( $newoptions['background'] );
		$options['button-opt']   = sanitize_key( $newoptions['button-opt'] );
		$options['image-opt']    = sanitize_key( $newoptions['image-opt'] );
		$options['show']         = sanitize_key( $newoptions['show'] );
		$options['slug']         = sanitize_text_field( $newoptions['slug'] );
		return $options;
	}

	public function form( $options ) {
		$options = wp_parse_args( (array) $options, array(
			'title'        => '',
			'text'         => '',
			'button-opt'   => 'push-1',
			'image-opt'    => 'none',
			'show'         => 'all',
			'slug'         => '',
			'filter'       => false,
			'bullet-color' => false,
			'background'   => false,
		) );

		$title = $options['title'];
		$text  = $options['text'];
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'retro-arcade-page-destroyer' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
    
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'Description / Instructions:', 'retro-arcade-page-destroyer' ); ?></label>
			<textarea class="widefat" rows="4" cols="22" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_textarea( $text ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'filter' ) ); ?>">
				<input id="<?php echo esc_attr( $this->get_field_id( 'filter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'filter' ) ); ?>" type="checkbox" <?php checked( $options['filter'] ); ?> />
				<?php esc_html_e( 'Auto-Format Text', 'retro-arcade-page-destroyer' ); ?>
			</label><br>
    
			<label for="<?php echo esc_attr( $this->get_field_id( 'bullet-color' ) ); ?>">
				<input id="<?php echo esc_attr( $this->get_field_id( 'bullet-color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'bullet-color' ) ); ?>" type="checkbox" <?php checked( $options['bullet-color'] ); ?> />
				<?php esc_html_e( 'Change Bullet Color to Yellow', 'retro-arcade-page-destroyer' ); ?>
			</label><br>
    
			<label for="<?php echo esc_attr( $this->get_field_id( 'background' ) ); ?>">
				<input id="<?php echo esc_attr( $this->get_field_id( 'background' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background' ) ); ?>" type="checkbox" <?php checked( $options['background'] ); ?> />
				<?php esc_html_e( 'Add Background', 'retro-arcade-page-destroyer' ); ?>
			</label>
		</p>
    
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image-opt' ) ); ?>"><?php esc_html_e( 'Show Image Option: ', 'retro-arcade-page-destroyer' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'image-opt' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image-opt' ) ); ?>" class="widefat">
				<option value="none" <?php selected( $options['image-opt'], 'none' ); ?>><?php esc_html_e( 'None', 'retro-arcade-page-destroyer' ); ?></option>
				<option value="image-1" <?php selected( $options['image-opt'], 'image-1' ); ?>><?php esc_html_e( 'Arcade Target', 'retro-arcade-page-destroyer' ); ?></option>
				<option value="image-2" <?php selected( $options['image-opt'], 'image-2' ); ?>><?php esc_html_e( 'Hover', 'retro-arcade-page-destroyer' ); ?></option>
				<option value="image-3" <?php selected( $options['image-opt'], 'image-3' ); ?>><?php esc_html_e( 'Rocket', 'retro-arcade-page-destroyer' ); ?></option>
				<option value="image-4" <?php selected( $options['image-opt'], 'image-4' ); ?>><?php esc_html_e( 'Red Arcade', 'retro-arcade-page-destroyer' ); ?></option>
				<option value="image-5" <?php selected( $options['image-opt'], 'image-5' ); ?>><?php esc_html_e( 'Yellow Arcade', 'retro-arcade-page-destroyer' ); ?></option>
			</select>
		</p>
                    
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'button-opt' ) ); ?>"><?php esc_html_e( 'Use Button or Text Link: ', 'retro-arcade-page-destroyer' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'button-opt' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'button-opt' ) ); ?>" class="widefat">
				<option value="none" <?php selected( $options['button-opt'], 'none' ); ?>><?php esc_html_e( 'None', 'retro-arcade-page-destroyer' ); ?></option>
				<option value="push-1" <?php selected( $options['button-opt'], 'push-1' ); ?>><?php esc_html_e( 'Push Button 1', 'retro-arcade-page-destroyer' ); ?></option>
				<option value="text-1" <?php selected( $options['button-opt'], 'text-1' ); ?>><?php esc_html_e( 'Text Link 1', 'retro-arcade-page-destroyer' ); ?></option>
			</select>
		</p>
            
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show' ) ); ?>"><?php esc_html_e( 'Display only on:', 'retro-arcade-page-destroyer' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'show' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'show' ) ); ?>" class="widefat">
				<option value="all" <?php selected( $options['show'], 'all' ); ?>><?php esc_html_e( 'All', 'retro-arcade-page-destroyer' ); ?></option>
				<option value="front" <?php selected( $options['show'], 'front' ); ?>><?php esc_html_e( 'Front Page', 'retro-arcade-page-destroyer' ); ?></option>
				<option value="post" <?php selected( $options['show'], 'post' ); ?>><?php esc_html_e( 'Post(s)', 'retro-arcade-page-destroyer' ); ?></option>
				<option value="category" <?php selected( $options['show'], 'category' ); ?>><?php esc_html_e( 'Category', 'retro-arcade-page-destroyer' ); ?></option>
				<option value="page" <?php selected( $options['show'], 'page' ); ?>><?php esc_html_e( 'Page(s)', 'retro-arcade-page-destroyer' ); ?></option>
			</select>
		</p>
    
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'slug' ) ); ?>"><?php esc_html_e( 'Slug, Title, or ID (Comma Separated):', 'retro-arcade-page-destroyer' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'slug' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'slug' ) ); ?>" value="<?php echo esc_attr( $options['slug'] ); ?>" />
		</p>
		<?php
	}
}

add_action( 'widgets_init', function() {
	register_widget( 'Retro_Arcade_Page_Destroyer_Widget' );
} );

// Enqueue Frontend Script
function retro_arcade_enqueue_scripts() {
	wp_enqueue_script(
		'retro-arcade-start',
		plugins_url( 'gears/start-asteroids-function.js', __FILE__ ),
		array(),
		'1.0.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'retro_arcade_enqueue_scripts' );

// Shortcode Support
// Shortcode Support with Attributes
function retro_arcade_shortcode_handler( $atts ) {
	$atts = shortcode_atts(
		array(
			'image'        => 'none',    // image-1, image-2, image-3, image-4, image-5, image-6 ή none
			'button'       => 'push-1',  // push-1, text-1 ή none
			'bullet_color' => '',        // yellow ή κενό
		),
		$atts,
		'asteroids'
	);

	$plugin_url = plugins_url( 'gears/', __FILE__ );

	$asteroids_bk          = esc_url( $plugin_url . 'asteroids-bk.jpg' );
	$asteroids_mainimage   = esc_url( $plugin_url . 'asteroids-image.jpg' );
	$asteroids_rocketimage = esc_url( $plugin_url . 'asteroids-rocket.png' );
	$asteroids_nohoverimage= esc_url( $plugin_url . 'asteroids.jpg' );
	$asteroids_hoverimage  = esc_url( $plugin_url . 'asteroids-hover.jpg' );
	$asteroids_arcadered   = esc_url( $plugin_url . 'arcade-red.png' );
	$asteroids_arcadeyellow= esc_url( $plugin_url . 'arcade-yellow.png' );
	$asteroids_arcadeblack = esc_url( $plugin_url . 'arcade-black.gif' );

	if ( 'yellow' === sanitize_key( $atts['bullet_color'] ) ) {
		$address         = esc_url( $plugin_url . 'play-asteroids-yellow.min.js' );
		$asteroids_start = "startAsteroids('yellow','" . esc_js( $address ) . "');";
	} else {
		$address         = esc_url( $plugin_url . 'play-asteroids.min.js' );
		$asteroids_start = "startAsteroids('','" . esc_js( $address ) . "');";
	}

	$asteroids_buttonopt = sanitize_key( $atts['button'] );
	$asteroids_imageopt  = sanitize_key( $atts['image'] );

	ob_start();
	include plugin_dir_path( __FILE__ ) . 'gears/run-asteroids.php';
	return ob_get_clean();
}
add_shortcode( 'asteroids', 'retro_arcade_shortcode_handler' );
add_shortcode( 'retro_arcade', 'retro_arcade_shortcode_handler' );
