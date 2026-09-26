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
            <h1 class="page-banner-title"><?php echo __('Directory', 'srft-theme'); ?></h1>
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
        <nav class="childnavs" aria-label="<?php echo __('About Us', 'srft-theme'); ?>">
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
    $is_current = ($item->title === $current_page_title);
    $active_class = $is_current ? 'active' : '';
    $aria_current = $is_current ? ' aria-current="page"' : '';

    $output .= '<li class="childnav-list-item ' . $active_class . '">';
    $output .= '<a class="item" href="' . esc_url($item->url) . '"' . $aria_current . '>' . esc_html($item->title) . '</a>';
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
                                        <th class="Rtable-cell cell-width-25-percent" scope="row"><div class="Rtable-cell--content"><?php the_title(); ?></div></th>
                                        <td class="Rtable-cell cell-width-25-percent"><div class="Rtable-cell--content"><?php echo esc_html($designation); ?></div></td>
                                        <td class="Rtable-cell cell-width-15-percent"><div class="Rtable-cell--content"><svg width="16" height="16" viewBox="0 0 68 68" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M62.0104 66C54.9158 66 47.7882 64.3504 40.6278 61.0513C33.4679 57.7522 26.8894 53.0984 20.8922 47.0899C14.8957 41.0808 10.2478 34.502 6.94871 27.3534C3.64957 20.2055 2 13.0842 2 5.98965C2 4.84957 2.37647 3.89961 3.12941 3.13976C3.88235 2.37992 4.82353 2 5.95294 2H18.2315C19.1821 2 20.0207 2.31028 20.7473 2.93082C21.4739 3.55075 21.936 4.31686 22.1336 5.22918L24.2918 16.3059C24.4411 17.3336 24.4097 18.2168 24.1976 18.9553C23.9849 19.6938 23.6035 20.314 23.0532 20.816L14.3586 29.28C15.7578 31.8425 17.3565 34.2667 19.1548 36.5525C20.9525 38.8376 22.8988 41.0202 24.9939 43.1002C27.0595 45.1664 29.2555 47.0852 31.5821 48.8565C33.9087 50.6278 36.421 52.2761 39.1191 53.8014L47.5671 45.28C48.1562 44.667 48.8696 44.2372 49.7073 43.9906C50.5443 43.7446 51.4143 43.6844 52.3172 43.8099L62.7708 45.9388C63.7214 46.1898 64.4973 46.6748 65.0984 47.3939C65.6995 48.1129 66 48.9286 66 49.8409V62.0471C66 63.1765 65.6201 64.1176 64.8602 64.8706C64.1004 65.6235 63.1504 66 62.0104 66ZM11.6866 23.9369L18.4056 17.5078C18.5261 17.4111 18.6045 17.2784 18.6409 17.1096C18.6773 16.9409 18.6714 16.784 18.6231 16.6391L16.9864 8.22588C16.938 8.03326 16.8536 7.88863 16.7332 7.792C16.6127 7.69537 16.4558 7.64706 16.2626 7.64706H8.21176C8.06682 7.64706 7.94604 7.69537 7.84941 7.792C7.75341 7.88863 7.70541 8.00941 7.70541 8.15435C7.89804 10.7269 8.31906 13.3402 8.96847 15.9944C9.61725 18.6491 10.5233 21.2966 11.6866 23.9369ZM44.4395 56.4725C46.9349 57.6358 49.5376 58.5252 52.2475 59.1407C54.9581 59.7556 57.4908 60.1211 59.8456 60.2372C59.9906 60.2372 60.1114 60.1889 60.208 60.0922C60.3046 59.9956 60.3529 59.8748 60.3529 59.7299V51.8099C60.3529 51.6166 60.3046 51.4598 60.208 51.3393C60.1114 51.2188 59.9667 51.1344 59.7741 51.0861L51.8682 49.4786C51.7233 49.4303 51.5965 49.4243 51.488 49.4607C51.3795 49.4971 51.2646 49.5755 51.1435 49.696L44.4395 56.4725Z" fill="#000000"/>
</svg><?php echo esc_html($phone); ?></div></td>
                                        <td class="Rtable-cell cell-width-10-percent"><div class="Rtable-cell--content"><?php echo esc_html($epbxno); ?></div></td>
                                        <td class="Rtable-cell cell-width-25-percent"><div class="Rtable-cell--content"> &nbsp;  <svg xmlns="http://www.w3.org/2000/svg" height="18" width="24" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M140-160q-24 0-42-18t-18-42v-520q0-24 18-42t42-18h680q24 0 42 18t18 42v520q0 24-18 42t-42 18H140Zm340-302L140-685v465h680v-465L480-462Zm0-60 336-218H145l335 218ZM140-685v-55 520-465Z"/></svg><?php echo esc_html($email); ?></div></td>
                                    </tr>
                                    <?php
                                }
                                wp_reset_postdata();
                            }
                        }

                        $output = ob_get_clean();

                        if ($has_posts) {
                            echo '<h3>' . esc_html($department) . '</h3>';
                            echo '<div class="table-container">';
                            echo '<table>';
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
                        }
                    }
                    ?>
           </div>
              </section>

<?php get_footer(); ?>
