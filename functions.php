<?php
/**
 * Functions and definitions
 *
 * Theme function file
 */

// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twenty_twenty_one_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'Video' );

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'twentytwentyone' ),
				'footer'  => esc_html__( 'Secondary menu', 'twentytwentyone' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		$background_color = get_theme_mod( 'background_color', 'D1E4DD' );
		if ( 127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex( $background_color ) ) {
			add_theme_support( 'dark-editor-style' );
		}

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ( $is_IE ) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style( $editor_stylesheet_path );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Extra small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XS', 'Font size', 'twentytwentyone' ),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__( 'Small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'twentytwentyone' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'M', 'Font size', 'twentytwentyone' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'twentytwentyone' ),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'twentytwentyone' ),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'twentytwentyone' ),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'twentytwentyone' ),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
		);

		// Editor color palette.
		$black     = '#000000';
		$dark_gray = '#28303D';
		$gray      = '#39414D';
		$green     = '#D1E4DD';
		$blue      = '#D1DFE4';
		$purple    = '#D1D1E4';
		$red       = '#E4D1D1';
		$orange    = '#E4DAD1';
		$yellow    = '#EEEADD';
		$white     = '#FFFFFF';

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Black', 'twentytwentyone' ),
					'slug'  => 'black',
					'color' => $black,
				),
				array(
					'name'  => esc_html__( 'Dark gray', 'twentytwentyone' ),
					'slug'  => 'dark-gray',
					'color' => $dark_gray,
				),
				array(
					'name'  => esc_html__( 'Gray', 'twentytwentyone' ),
					'slug'  => 'gray',
					'color' => $gray,
				),
				array(
					'name'  => esc_html__( 'Green', 'twentytwentyone' ),
					'slug'  => 'green',
					'color' => $green,
				),
				array(
					'name'  => esc_html__( 'Blue', 'twentytwentyone' ),
					'slug'  => 'blue',
					'color' => $blue,
				),
				array(
					'name'  => esc_html__( 'Purple', 'twentytwentyone' ),
					'slug'  => 'purple',
					'color' => $purple,
				),
				array(
					'name'  => esc_html__( 'Red', 'twentytwentyone' ),
					'slug'  => 'red',
					'color' => $red,
				),
				array(
					'name'  => esc_html__( 'Orange', 'twentytwentyone' ),
					'slug'  => 'orange',
					'color' => $orange,
				),
				array(
					'name'  => esc_html__( 'Yellow', 'twentytwentyone' ),
					'slug'  => 'yellow',
					'color' => $yellow,
				),
				array(
					'name'  => esc_html__( 'White', 'twentytwentyone' ),
					'slug'  => 'white',
					'color' => $white,
				),
			)
		);

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => esc_html__( 'Purple to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'purple-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'yellow-to-purple',
				),
				array(
					'name'     => esc_html__( 'Green to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'green-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to green', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
					'slug'     => 'yellow-to-green',
				),
				array(
					'name'     => esc_html__( 'Red to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'red-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'yellow-to-red',
				),
				array(
					'name'     => esc_html__( 'Purple to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'purple-to-red',
				),
				array(
					'name'     => esc_html__( 'Red to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'red-to-purple',
				),
			)
		);

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if ( is_customize_preview() ) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support( 'starter-content', twenty_twenty_one_get_starter_content() );
		}

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for link color control.
		add_theme_support( 'link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );

		// Remove feed icon link from legacy RSS widget.
		add_filter( 'rss_widget_feed_link', '__return_empty_string' );
	}
}
add_action( 'after_setup_theme', 'twenty_twenty_one_setup' );

/**
 * Registers widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'twentytwentyone' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twenty_twenty_one_widgets_init' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twenty_twenty_one_content_width', 750 );
}
add_action( 'after_setup_theme', 'twenty_twenty_one_content_width', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global bool       $is_IE
 * @global WP_Scripts $wp_scripts
 *
 * @return void
 */

/*function srfti_scripts() {

	wp_enqueue_style( 'style', get_stylesheet_uri());
  wp_enque_script('jquery');
	wp_enque_script('srfti-counterup', get_template_directory_uri(). '/assets/js/jquery.counterup.js');
	wp_enque_script('srfti-waypoints', get_template_directory_uri(). '/assets/js/jquery.waypoints.js');

} add_action('wp_enqueue_scripts', 'srft_scripts');

*/
 function twenty_twenty_one_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ( $is_IE ) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get( 'Version' ) );
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	// RTL styles.
	wp_style_add_data( 'twenty-twenty-one-style', 'rtl', 'replace' );

	// Print styles.
	wp_enqueue_style( 'twenty-twenty-one-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
	wp_add_inline_script(
		'twenty-twenty-one-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script(
			'twenty-twenty-one-primary-navigation-script',
			get_template_directory_uri() . '/assets/js/primary-navigation.js',
			array( 'twenty-twenty-one-ie11-polyfills' ),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}

	// Responsive embeds script.
	wp_enqueue_script(
		'twenty-twenty-one-responsive-embeds-script',
		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
		array( 'twenty-twenty-one-ie11-polyfills' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_scripts' );

/**
 * Enqueues block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
 function twentytwentyone_block_editor_script() {

	wp_enqueue_script( 'twentytwentyone-editor', get_theme_file_uri( '/assets/js/editor.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwentyone_block_editor_script' );

/**
 * Fixes skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty-One 1.0
 * @deprecated Twenty Twenty-One 1.9 Removed from wp_print_footer_scripts action.
 *
 * @link https://git.io/vWdr2
 */



function twenty_twenty_one_skip_link_focus_fix() {

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	} else {
		// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
		?>
		<script>
		/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
		</script>
		<?php
	}
}
/* wp_admin_disable_autocomplete*/

function disable_wp_admin_autocomplete() {
?>
<script>
	document.addEventListener ("DOMContentLoaded", function()
{
	var passInput=document.getElementById("user_pass");
	var userInput=document.getElementById("user_login"); 
  if (passInput) passInput.setAttribute("autocomplete", "off");
	if (userInput) userInput.setAttribute("autocomplete", "off");
});
</script>
<?php	
}
add_action ('login_head', 'disable_wp_admin_autocomplete');

remove_action('do_robots', 'do_robots');


function add_search_button_title_script() {
	?>
	<script>
	document.addEventListener("DOMContentLoaded", function () {
			function addSearchButtonTitle() {
					document.querySelectorAll(".is-search-submit").forEach(function (button) {
							if (!button.hasAttribute("title")) {
									button.setAttribute("title", "Search");
							}
					});
			}

			// Run once on page load
			addSearchButtonTitle();

			// Observe DOM changes for dynamically added buttons
			new MutationObserver(function () {
					addSearchButtonTitle();
			}).observe(document.body, { childList: true, subtree: true });
	});
	</script>
	<?php
}
add_action('wp_footer', 'add_search_button_title_script', 100);

function ivory_search_modification() {
	?>
	<script>
	document.addEventListener("DOMContentLoaded", function () {
			// Function to remove type="text/css" from style tags
			function removeStyleType() {
					document.querySelectorAll('style').forEach(function (style) {
							if (style.getAttribute("type") === "text/css") {
									style.removeAttribute("type");
							}
					});
			}

			// Function to add title attribute to search button
			function addSearchButtonTitle() {
					document.querySelectorAll(".is-search-submit").forEach(function (button) {
							if (!button.hasAttribute("title")) {
									button.setAttribute("title", "Search");
							}
					});
			}

			// Run both functions on page load
			removeStyleType();
			addSearchButtonTitle();

			// More aggressive MutationObserver to detect all new elements
			const observer = new MutationObserver(function (mutations) {
					mutations.forEach(function (mutation) {
							mutation.addedNodes.forEach(function (node) {
									if (node.nodeType === 1) { // Ensure it's an element node
											if (node.tagName === "STYLE" && node.getAttribute("type") === "text/css") {
													node.removeAttribute("type");
											}
											if (node.classList.contains("is-search-submit")) {
													node.setAttribute("title", "Search");
											}
									}
							});
					});
			});

			observer.observe(document.body, { childList: true, subtree: true });
	});
	</script>
	<?php
}
add_action('wp_footer', 'ivory_search_modification', 100);



function custom_wp_login_form( $args ) {
    $args['value_remember'] = false; // Disable "Remember Me"
    return $args;
}
add_filter( 'login_form_defaults', 'custom_wp_login_form' );

function remove_remember_me_checkbox() {
	echo "<style>#rememberme {display: none !important;}</style>";
}
add_action('login_head', 'remove_remember_me_checkbox');


/* This function helps ContactForm7 name field validation */
function custom_cf7_validate_name($result, $tag) {
	$tag_name = $tag['name'];

	if ($tag_name === 'your-name') {
			$value = isset($_POST[$tag_name]) ? sanitize_text_field($_POST[$tag_name]) : '';

			if (!preg_match("/^[A-Za-z\s]+$/", $value)) {
					$result->invalidate($tag, "Only letters and spaces are allowed in the name field.");
			}
	}

	return $result;
}
add_filter('wpcf7_validate_text', 'custom_cf7_validate_name', 10, 2);
add_filter('wpcf7_validate_text*', 'custom_cf7_validate_name', 10, 2);


/* This function outputs the url and the size of ACF filed document */

function display_selected_documents($atts) {
	// Remove wpautop filter to prevent auto <br> insertion
	remove_filter('the_content', 'wpautop');
	
	$atts = shortcode_atts(
			array(
					'id' => '', // Post ID
			), 
			$atts
	);

	$post_id = intval($atts['id']); // Ensure it's an integer

	if (!$post_id) {
			return '<p>Invalid post ID.</p>';
	}

	$post = get_post($post_id);
	if (!$post) {
			return '<p>No document found.</p>';
	}

	// Fetch ACF fields
	$document_file = get_field('document', $post_id);
	$document_description = get_field('document_description', $post_id);

	if (!$document_file) {
			return '<p>No document file found.</p>';
	}

	// Get file URL, ID, and size
	$file_url = $document_file['url'];
	$file_id = $document_file['ID'];
	$file_size = @filesize(get_attached_file($file_id)); // Suppress errors with @

	if (!function_exists('convertFileSizeToMB')) {
			function convertFileSizeToMB($bytes) {
					return ($bytes !== false) ? number_format($bytes / 1048576, 2) . ' MB' : 'Unknown';
			}
	}

	$file_size_mb = convertFileSizeToMB($file_size);
	$file_type_info = wp_check_filetype($file_url);
	$file_type = isset($file_type_info['ext']) ? strtoupper($file_type_info['ext']) : 'Unknown';

	// Generate the output
	ob_start();
	?>
	<a href="<?php echo esc_url($file_url); ?>" title="<?php echo esc_attr($document_description); ?>" target="_blank" style="text-decoration: none; "><?php echo esc_html(get_the_title($post_id)); ?> (<?php echo __('Download', 'srft-theme'); ?> - <?php echo esc_html($file_size_mb); ?>)&nbsp;<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="pdf" style="display: inline-block; vertical-align: middle;"></a><?php
	$output = ob_get_clean();
	
	// Reapply wpautop filter to avoid affecting other content
	//add_filter('the_content', 'wpautop');

	return $output;
}

// Register the shortcode
add_shortcode('selected_document', 'display_selected_documents');





// Add custom fields to REST API response
// Add custom fields to REST API response
function add_custom_fields_to_json($data, $post, $request) {
	// Define an array of custom field names you want to include
	$custom_field_names = array(
			'Designation',
			'Department',	
			'Tender-Corrigendum',
			'Tender-Doc',
			'Tender-Extension',
			'Tender-ID',
			'Tender-Submission-Date'
			// Add more custom field names as needed
	);

	// Loop through the custom field names and include their values in the JSON response
	foreach ($custom_field_names as $field_name) {
			$custom_field_value = get_post_meta($post->ID, $field_name, true);
			$data->data[$field_name] = $custom_field_value;
	}

	return $data;
}

function acf_rest_api_init() {
	// Replace 'your_post_type' with your custom post type slug
	$post_types = array( 'document', 'tender', 'vacancy', 'admission' ,'faculty', 'announcement', 'news', 'award' );

	foreach ( $post_types as $post_type ) {
			register_rest_field( $post_type, 'acf', array(
					'get_callback'    => 'acf_rest_api_get_fields',
					'schema'          => null,
			) );
	}
}
add_action( 'rest_api_init', 'acf_rest_api_init' );

function acf_rest_api_get_fields( $object, $field_name, $request ) {
	return get_fields( $object['id'] );
}

add_filter('rest_prepare_post', 'add_custom_fields_to_json', 10, 3);
	
add_filter('acf/settings/remove_wp_meta_box', '__return_false'); /* To enable the default custom field while enabling the ACF features */


function enqueue_recaptcha_script() {
	wp_enqueue_script('google-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_recaptcha_script');




/**
 * Enqueues non-latin language styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages() {
	$custom_css = twenty_twenty_one_get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twenty-twenty-one-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages' );

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueues scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init() {
	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_enqueue_script(
		'twentytwentyone-customize-preview',
		get_theme_file_uri( '/assets/js/customize-preview.js' ),
		array( 'customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_preview_init', 'twentytwentyone_customize_preview_init' );

/**
 * Enqueues scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts() {

	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts' );

/**
 * Calculates classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes() {
	/**
	 * Filters the classes for the main <html> element.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @param string The list of classes. Default empty string.
	 */
	$classes = apply_filters( 'twentytwentyone_html_classes', '' );
	if ( ! $classes ) {
		return;
	}
	echo 'class="' . esc_attr( $classes ) . '"';
}



function register_custom_menu() {
	register_nav_menu('custom-menu', __('Custom Menu'));
}
add_action('init', 'register_custom_menu');


function add_categories_to_pages() {
	register_taxonomy_for_object_type('category', 'page');
}
add_action('init', 'add_categories_to_pages');

apply_filters( 'loginpress_remember_me', true );

/*function srft_theme_load_theme_textdomain() {
	load_theme_textdomain( 'srft-theme', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'srft_theme_load_theme_textdomain' );
*/
/**
 * Adds "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class() {
	?>
	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}
	</script>
	<?php
}
add_action( 'wp_footer', 'twentytwentyone_add_ie_class' );

if ( ! function_exists( 'wp_get_list_item_separator' ) ) :
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 *
	 * @since 6.0.0
	 */
	function wp_get_list_item_separator() {
		/* translators: Used between list items, there is a space after the comma. */
		return __( ', ', 'twentytwentyone' );
	}
endif;

/*function custom_post_type_news() {
	register_post_type('news', array(
			'labels' => array(
					'name' => __('News'),
					'singular_name' => __('News'),
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'news'),
	));
}
add_action('init', 'custom_post_type_news');*/

add_filter('wpseo_breadcrumb_links', 'custom_menu_based_breadcrumbs');

function custom_menu_based_breadcrumbs($links) {
    $menu_locations = ['primary', 'footer'];
    $menu_locations_array = get_nav_menu_locations();
    $current_id = get_the_ID();
    $custom_breadcrumbs = [];

    // Update the home label based on locale
    $home_text = (get_locale() === 'hi_IN') ? 'घर' : $links[0]['text'];
    $links[0]['text'] = $home_text;

    foreach ($menu_locations as $menu_location) {
        if (!isset($menu_locations_array[$menu_location])) {
            continue;
        }

        $menu_id = $menu_locations_array[$menu_location];
        $menu_items = wp_get_nav_menu_items($menu_id);

        if (!$menu_items) continue;

        // Build lookup for menu items
        $menu_items_by_id = [];
        foreach ($menu_items as $item) {
            $menu_items_by_id[$item->ID] = $item;
        }

        // Find matching menu item
        foreach ($menu_items as $menu_item) {
            if ((int)$menu_item->object_id === $current_id) {
                // Recurse up menu parents
                $breadcrumb_stack = [];

                $current_menu_item = $menu_item;
                while ($current_menu_item && $current_menu_item->menu_item_parent != 0) {
                    $parent = $menu_items_by_id[$current_menu_item->menu_item_parent];
                    array_unshift($breadcrumb_stack, [
                        'url' => $parent->url,
                        'text' => $parent->title,
                    ]);
                    $current_menu_item = $parent;
                }

                // Add current item
                $breadcrumb_stack[] = [
                    'url' => '',
                    'text' => $menu_item->title,
                ];

                $custom_breadcrumbs = array_merge($custom_breadcrumbs, $breadcrumb_stack);
                break 2;
            }
        }
    }

    // Handle custom post type "faculty"
    if (get_post_type() === 'faculty') {
        $faculty_page = get_page_by_path('faculty'); 
        $faculty_archive_link = $faculty_page ? get_permalink($faculty_page) : site_url('/faculty/');
        array_unshift($custom_breadcrumbs, [
            'url' => $faculty_archive_link,
            'text' => (get_locale() === 'hi_IN') ? 'प्रशिक्षक' : 'Faculty',
        ]);
    }

    // Prepend home
    array_unshift($custom_breadcrumbs, $links[0]);

    return $custom_breadcrumbs;
}



function get_menu_ancestors_excluding_links($menu_item, $menu_items) {
	$ancestors = array();
	while ($menu_item->menu_item_parent != 0) {
			foreach ($menu_items as $item) {
					if ($item->ID == $menu_item->menu_item_parent) {
							$ancestors[] = array(
									'url' => is_custom_link($item) ? '' : $item->url, // No hyperlink for custom links
									'text' => $item->title,
							);
							$menu_item = $item;
							break;
					}
			}
	}
	return array_reverse($ancestors);
}

// Helper function to check if a menu item is a custom link
function is_custom_link($menu_item) {
	return $menu_item->type === 'custom';
}



function display_global_latest_date() {
	// Query to get the latest modified post from all post types
	$args = [
			'post_type'      => ['post','document', 'tender', 'vacancy', 'admission' ,'faculty', 'announcement', 'news', 'award', 'photo'], // Add all relevant custom post types here
			'posts_per_page' => 1,
			'orderby'        => 'modified',
			'order'          => 'DESC',
	];

	$query = new WP_Query($args);

	if ($query->have_posts()) {
			$query->the_post();

			// Get the latest modified date
			$latest_date = get_the_modified_date();

			// Reset post data
			wp_reset_postdata();

			// Return the formatted output
			return '<p class="global-latest-date">' . __('Last updated on', 'srft-theme') . ': ' . esc_html($latest_date) . '</p>';
	} else {
			return '<p class="global-latest-date">' . __('No posts available.', 'srft-theme') . '</p>';
	}
}

// Create a shortcode to use this function in posts or pages
add_shortcode('global_latest_date', 'display_global_latest_date');



function get_file_details_by_id() {
	$attachment_id = isset($_GET['attachment_id']) ? intval($_GET['attachment_id']) : 0;
	if (!$attachment_id) {
			wp_send_json_error('Invalid attachment ID');
	}

	$file_details = get_file_details($attachment_id);

	if (!$file_details) {
			wp_send_json_error('Attachment not found');
	}

	wp_send_json_success($file_details);
}
add_action('wp_ajax_get_file_details', 'get_file_details_by_id');
add_action('wp_ajax_nopriv_get_file_details', 'get_file_details_by_id');


function admin_bar(){

  if(is_user_logged_in()){
    add_filter( 'show_admin_bar', '__return_true' , 1000 );
  }
}
add_action('init', 'admin_bar' );

function enqueue_scrollmagic() {
	wp_enqueue_script('gsap', 'https://unpkg.com/gsap@3.9.0/dist/gsap.min.js', array(), null, true);
	wp_enqueue_script('scrollmagic', 'https://unpkg.com/scrollmagic@2.0.7/scrollmagic/minified/ScrollMagic.min.js', array('gsap'), null, true);
	wp_enqueue_script('scrollmagic-gsap', 'https://unpkg.com/scrollmagic@2.0.7/scrollmagic/minified/plugins/animation.gsap.min.js', array('scrollmagic'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_scrollmagic');


// Function to remove the plugin-specific cookie
function remove_plugin_specific_cookie() {
    // Check if the cookie for the plugin path exists
    if (isset($_COOKIE['wordpress_sec_64791470c9047c046d3c80ab7a1e18c5'])) {
        // Check the path in which the cookie was set
        $plugin_path = '/wp-content/plugins'; // The path where the unwanted cookie is being set
        $admin_path = '/wp-admin'; // The path for the admin panel cookie (we want to keep this intact)

        // Only remove the plugin-specific cookie if we're not in the /wp-admin path
        if (strpos($_SERVER['REQUEST_URI'], $plugin_path) !== false) {
            // Expire the plugin cookie, specifically for the /wp-content/plugins path
            setcookie('wordpress_sec_64791470c9047c046d3c80ab7a1e18c5', '', time() - 3600, '/wp-content/plugins');
        }
    }
}
add_action('init', 'remove_plugin_specific_cookie');



function set_custom_template($single_template) {
	global $post;

	if ($post->post_type == 'news') {
			$single_template = dirname(__FILE__) . '/single-news.php';
	}

	return $single_template;
}

add_filter('single_template', 'set_custom_template');
add_post_type_support( 'page', 'excerpt' );

function increase_postmeta_form_limit() {
	return 120;
}
add_filter('postmeta_form_limit', 'increase_postmeta_form_limit');


add_filter('render_block_data', function($parsed_block) {
	if (isset($parsed_block['innerContent'])) {
			foreach ($parsed_block['innerContent'] as &$innerContent) {
					if (empty($innerContent)) {
							continue;
					}

					$innerContent = do_shortcode($innerContent);
			}
	}

	if (isset($parsed_block['innerBlocks'])) {
			foreach ($parsed_block['innerBlocks'] as $key => &$innerBlock) {
					if (! empty($innerBlock['innerContent'])) {
							foreach ($innerBlock['innerContent'] as &$innerContent) {
									if (empty($innerContent)) {
											continue;
									}

									$innerContent = do_shortcode($innerContent);
							}
					}
			}
	}

	return $parsed_block;
}, 10, 1);