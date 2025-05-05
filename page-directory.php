<?php
/*
Template Name: Directory
*/
get_header(); 
$post_id = get_the_ID();
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>

<main>
    <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
            <h2 class="page-banner-title"><?php echo __('Directory', 'srft-theme'); ?></h2>
        </div>
    </section>

    <section id="skip-to-content" class="cine-detail">
        <div class="leftnav">
            <div class="childnavs">
                <?php
                $current_language = get_locale();
                $menu_name = ($current_language === 'hi_IN') ? 'hindi_admin_menu' : 'english_admin_menu';
                $current_page_title = get_the_title();

                class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
                    public function start_lvl(&$output, $depth = 0, $args = null) {
                        $output .= '<ul class="submenu">';
                    }
                    public function start_el(&$output, $item, $depth = 0, $args = null, $current_object_id = 0) {
                        global $current_page_title;
                        $is_current = ($item->title === $current_page_title) ? 'active' : '';
                        $output .= '<li class="childnav-list-item ' . $is_current . '">';
                        $output .= '<a class="item" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
                    }
                    public function end_el(&$output, $item, $depth = 0, $args = null) {
                        $output .= '</li>';
                    }
                    public function end_lvl(&$output, $depth = 0, $args = null) {
                        $output .= '</ul>';
                    }
                }

                wp_nav_menu(array(
                    'menu' => $menu_name,
                    'container' => false,
                    'menu_class' => 'childnav-lists',
                    'walker' => new Custom_Walker_Nav_Menu(),
                ));
                ?>
            </div>

            <div class="widget" style="line-height: 1.5; margin-top: 1rem;">
                <!-- Optional widget content -->
            </div>
        </div>

        <div class="main-content">
            <div>      
                <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                }
                ?>
            </div>

            <section style="margin-bottom: 4rem;">
                <?php
                $departments = array(
                    'Office of the Director',
                    'Office of the Dean',
                    'Office of the Registrar',
                    'Direction & Screenplay Writing',
                    'Cinematography',
                    'Editing',
                    'Sound Recording & Design',
                    'Producing for Film & Television',
                    'Animation Cinema',
                    'EDM Media Management',
                    'Cinematography for EDM',
                    'Direction & Producing for EDM',
                    'Editing for EDM',
                    'Sound for EDM',
                    'Writing for EDM',
                    'Library',
                    'Tutorial',
                    'Film Library & Auditorium',
                    'Information Technology',
                    'Administration',
                    'Accounts',
                    'Purchase & Store',
                    'Maintennace',
                    'Hostel',
                    'Guest House',
                    'Security',
                    'Reception & Information',
                    'Medical',
                    'Other Facilities',
                );

                $post_types = array('faculty', 'nonfaculty');

                foreach ($departments as $department) {
                    $has_posts = false;
                    ob_start(); // Start capturing output

                    foreach ($post_types as $post_type) {
                        $query = new WP_Query(array(
                            'post_type' => $post_type,
                            'posts_per_page' => -1,
                            'meta_query' => array(
                                array(
                                    'key' => 'faculty-department',
                                    'value' => $department,
                                    'compare' => '='
                                )
                            ),
                            'meta_key' => 'faculty-category',
                            'orderby' => 'meta_value',
                            'order' => 'ASC'
                        ));

                        if ($query->have_posts()) {
                            $has_posts = true;
                            $count = 1;
                            while ($query->have_posts()) {
                                $query->the_post();
                                $designation = get_field('Faculty-Designation');
                                $roomno = get_field('Room-No');
                                $epbxno = get_field('Epbx-No');                
                                $email = get_field('Email-Id');
                                $phone = get_field('Office-No');
                                ?>
                                <div class="Rtable-row">
                                    <div class="Rtable-cell slno-cell"><div class="Rtable-cell--content"><?php echo $count++; ?></div></div>
                                    <div class="Rtable-cell name-cell"><div class="Rtable-cell--content"><?php the_title(); ?></div></div>
                                    <div class="Rtable-cell designation-cell"><div class="Rtable-cell--content"><?php echo esc_html($designation); ?></div></div>
                                    <div class="Rtable-cell email-cell"><div class="Rtable-cell--content"><?php echo esc_html($roomno); ?></div></div>
                                    <div class="Rtable-cell phone-cell"><div class="Rtable-cell--content"><?php echo esc_html($phone); ?></div></div>
                                    <div class="Rtable-cell phone-cell"><div class="Rtable-cell--content"><?php echo esc_html($epbxno); ?></div></div>
                                    <div class="Rtable-cell phone-cell"><div class="Rtable-cell--content"><?php echo esc_html($email); ?></div></div>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                        }
                    }

                    $output = ob_get_clean();

                    if ($has_posts) {
                        echo '<h2>' . esc_html($department) . '</h2>';
                        echo '<div class="Rtable Rtable--header">';
                        echo '<div class="Rtable-row">';
                        echo '<div class="Rtable-cell slno-cell"><strong>Sl. No.</strong></div>';
                        echo '<div class="Rtable-cell name-cell"><strong>Name</strong></div>';
                        echo '<div class="Rtable-cell designation-cell"><strong>Designation</strong></div>';
                        echo '<div class="Rtable-cell email-cell"><strong>Room No.</strong></div>';
                        echo '<div class="Rtable-cell phone-cell"><strong>Phone</strong></div>';
                        echo '<div class="Rtable-cell phone-cell"><strong>EPBX</strong></div>';
                        echo '<div class="Rtable-cell phone-cell"><strong>Email</strong></div>';
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="Rtable">';
                        echo $output;
                        echo '</div>';
                    }
                }
                ?>
            </section>
        </div> <!-- closes .main-content -->
    </section> <!-- closes .cine-detail -->
<!-- closes main -->

<?php get_footer(); ?>
