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

            <div class="widget" style="line-height: 1.5; margin-top: 3rem;">
            <h3><?php echo __('Satyajit Ray Film & Television Institute', 'srft-theme'); ?></h3>
                        <ul>
                          <li><?php echo __('E.M. Bypass Road, Panchasayar', 'srft-theme'); ?></li>
                          <li><?php echo __('Kolkata-700094', 'srft-theme'); ?></li>
                          <li><?php echo __('West Bengal', 'srft-theme'); ?></li>
                          <li><?php echo __('Phone:', 'srft-theme'); ?><span> 91-33-2432-8355, 2432-8356, 2432-9300 </span></li>
                          <li><?php echo __('email:', 'srft-theme'); ?><span> contact[at]srfti[dot]ac[dot]in</span></li>
                        </ul>
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

            <div>
                <h2 class="page-header-text" style="margin-top: 2rem;"><?php echo __('Directory', 'srft-theme'); ?></h2>
            </div>

            <div style="margin-bottom: 6rem;">
                <?php
                $departments = array(
                    'Office of the Vice-Chancellor' => __('Office of the Vice-Chancellor', 'srft-theme'),
                    'Office of the Dean' => __('Office of the Dean', 'srft-theme'),
                    'Office of the Registrar' => __('Office of the Registrar', 'srft-theme'),
                    'Direction & Screenplay Writing' => __('Direction & Screenplay Writing', 'srft-theme'),
                    'Cinematography' => __('Cinematography', 'srft-theme'),
                    'Editing' => __('Editing', 'srft-theme'),
                    'Sound Recording & Design' => __('Sound Recording & Design', 'srft-theme'),
                    'Producing for Film & Television' => __('Producing for Film & Television', 'srft-theme'),
                    'Animation Cinema' => __('Animation Cinema', 'srft-theme'),
                    'EDM Management' => __('EDM Management', 'srft-theme'),
                    'Cinematography for EDM' => __('Cinematography for EDM', 'srft-theme'),
                    'Direction & Producing for EDM' => __('Direction & Producing for EDM', 'srft-theme'),
                    'Editing for EDM' => __('Editing for EDM', 'srft-theme'),
                    'Sound for EDM' => __('Sound for EDM', 'srft-theme'),
                    'Writing for EDM' => __('Writing for EDM', 'srft-theme'),
                    'Library' => __('Library', 'srft-theme'),
                    'Tutorial' => __('Tutorial', 'srft-theme'),
                    'Film Library & Auditorium' => __('Film Library & Auditorium', 'srft-theme'),
                    'Information Technology' => __('Information Technology', 'srft-theme'),
                    'Administration' => __('Administration', 'srft-theme'),
                    'Accounts' => __('Accounts', 'srft-theme'),
                    'Purchase & Store' => __('Purchase & Store', 'srft-theme'),
                    'Maintenance' => __('Maintenance', 'srft-theme'),
                    'Hostel' => __('Hostel', 'srft-theme'),
                    'Guest House' => __('Guest House', 'srft-theme'),
                    'Security' => __('Security', 'srft-theme'),
                    'Reception & Information' => __('Reception & Information', 'srft-theme'),
                    'Medical' => __('Medical', 'srft-theme'),
                    'Other Facilities' => __('Other Facilities', 'srft-theme'),
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
                                $phone = get_field('Office-Number');
                                ?>
                                <div class="Rtable-row">
                                    <!--div class="Rtable-cell slno-cell"><div class="Rtable-cell--content"><?php echo $count++; ?></div></!--div>-->
                                    <div class="Rtable-cell id-cell"><div class="Rtable-cell--content"><?php the_title(); ?></div></div>
                                    <div class="Rtable-cell id-cell"><div class="Rtable-cell--content"><?php echo esc_html($designation); ?></div></div>
                                    <div class="Rtable-cell composition-cell"><div class="Rtable-cell--content"><?php echo esc_html($phone); ?></div></div>
                                    <div class="Rtable-cell slno-cell"><div class="Rtable-cell--content"><?php echo esc_html($epbxno); ?></div></div>
                                    <div class="Rtable-cell composition-cell"><div class="Rtable-cell--content"><?php echo esc_html($email); ?></div></div>
                                </div>
                                <?php
                            }
                            wp_reset_postdata();
                        }
                    }

                    $output = ob_get_clean();

                    if ($has_posts) {
                        echo '<h2>' . esc_html($department) . '</h2>';
                        echo '<div class="wrapper">';
                        echo '<div class="Rtable Rtable--6cols Ratble--collapse">';
                        echo '<div class="Rtable-row Rtable-row--head">';
                        //echo '<div class="Rtable-cell slno-cell column-heading">Sl. No.</strong></div>';
                        echo '<div class="Rtable-cell id-cell column-heading">' . __('Name', 'srft-theme') . '</div>';
                        echo '<div class="Rtable-cell id-cell column-heading">'. __('Designation', 'srft-theme') . '</div>';
                        echo '<div class="Rtable-cell composition-cell column-heading">'. __('Phone', 'srft-theme') . '</div>';
                        echo '<div class="Rtable-cell slno-cell column-heading">'. __('EPBX', 'srft-theme') . '</div>';
                        echo '<div class="Rtable-cell composition-cell column-heading">'. __('Email', 'srft-theme') . '</div>';
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="Rtable">';
                        echo $output;
                        echo '</div>';
                    }
                }
                ?>
           </div>
              </section>

<?php get_footer(); ?>
