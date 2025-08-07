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

    <div class="container-aligned">
    <div class="breadcrumbs-wrapper">
    <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>' );
            }
    ?>
   </div>
   </div>

    <section id="skip-to-content" class="cine-detail">
        <div class="leftnav">
        <nav class="childnavs" aria-label="<?php echo __('About Us Sub-Menu Section', 'srft-theme'); ?>">
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
            </nav>

            <aside class="widget" role="complementary" style="line-height: 1.5; margin-top: 3rem;" >
            <h2 id="institute's address"><?php echo __('Communication Address', 'srft-theme'); ?></h2>
                        
                          <p><?php echo __('Satyajit Ray Film & Television Institute', 'srft-theme'); ?></p>
                          <p><?php echo __('E.M. Bypass Road, Panchasayar', 'srft-theme'); ?></p>
                          <p><?php echo __('Kolkata-700094', 'srft-theme'); ?></p>
                          <p><?php echo __('West Bengal', 'srft-theme'); ?></p>
                          <p><?php echo __('Phone:', 'srft-theme'); ?><span> 91-33-2432-8355, 2432-8356, 2432-9300 </span></p>
                          <p><?php echo __('email:', 'srft-theme'); ?><span> contact[at]srfti[dot]ac[dot]in</span></p>
                        
            </aside>
        </div>

        <div class="main-content" role="main">

            <div>
                <h2 class="page-header-text" style="margin-top: 2rem;"><?php echo __('Department-wise Staff Contact Information', 'srft-theme'); ?></h2>
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
                                    <tr class="Rtable-row">
                                        <!--div class="Rtable-cell slno-cell"><div class="Rtable-cell--content"><?php echo $count++; ?></div></!--div>-->
                                        <td class="Rtable-cell cell-width-25-percent"><div class="Rtable-cell--content"><?php the_title(); ?></div></td>
                                        <td class="Rtable-cell cell-width-25-percent"><div class="Rtable-cell--content"><?php echo esc_html($designation); ?></div></td>
                                        <td class="Rtable-cell cell-width-15-percent"><div class="Rtable-cell--content"><?php echo esc_html($phone); ?></div></td>
                                        <td class="Rtable-cell cell-width-10-percent"><div class="Rtable-cell--content"><?php echo esc_html($epbxno); ?></div></td>
                                        <td class="Rtable-cell cell-width-25-percent"><div class="Rtable-cell--content"><?php echo esc_html($email); ?></div></td>
                                    </tr>
                                    <?php
                                }
                                wp_reset_postdata();
                            }
                        }

                        $output = ob_get_clean();

                        if ($has_posts) {
                            echo '<h3>' . esc_html($department) . '</h3>';
                            echo '<div class="wrapper">';
                            echo '<div class="Rtable Rtable--6cols Rtable--collapse">';
                            echo '<table style="width: 100%;">';
                            echo '<caption class="sr-only">table showing directory information of the'. esc_html($department) .  '</caption>';
                            echo '<thead>';
                            echo '<tr class="Rtable-row Rtable-row--head">';
                            //echo '<div class="Rtable-cell slno-cell column-heading">Sl. No.</strong></div>';
                            echo '<th class="Rtable-cell cell-width-25-percent column-heading" scope="col">' . __('Name', 'srft-theme') . '</th>';
                            echo '<th class="Rtable-cell cell-width-25-percent column-heading" scope="col">'. __('Designation', 'srft-theme') . '</th>';
                            echo '<th class="Rtable-cell cell-width-15-percent column-heading" scope="col">'. __('Phone', 'srft-theme') . '</th>';
                            echo '<th class="Rtable-cell cell-width-10-percent column-heading" scope="col">'. __('EPBX', 'srft-theme') . '</th>';
                            echo '<th class="Rtable-cell cell-width-25-percent column-heading" scope="col">'. __('Email', 'srft-theme') . '</th>';
                            echo '</tr>';
                            echo  '</thead>';
                            echo '<tbody>';
                            echo $output;
                            echo '</tbody>';
                            echo '</table>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                    ?>
           </div>
              </section>

<?php get_footer(); ?>
