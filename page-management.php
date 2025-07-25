<?php
/*
Template Name: Management
 */
get_header(); 
$post_id = get_the_ID();
$page_content = apply_filters('the_content', $post->post_content);
?>

<main>
    <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
            <h2 class="page-banner-title"><?php echo __('Management', 'srft-theme'); ?></h2>
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
                <?php 
                if ($current_language === 'en_US') {
                    $catslug = 'document-en'; 
                } else {
                    $catslug = 'document-hi';
                }

                $download_post = new WP_Query(array(
                    'post_type' => 'document',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'slug',
                            'terms'    => $catslug,
                        ),
                    ),
                    'posts_per_page' => -1,       
                ));

                if ($download_post->have_posts()) {
                    echo '<ul style="list-style-type: none">';
                    while ($download_post->have_posts()) {
                        $download_post->the_post(); 
                        
                        // ACF Fields
                        $document_file = get_field('document');
                        $document_category = get_field('document-category'); // Returns an array with URL and other data
                        $document_description = get_field('document_description');
                        if ($document_category === 'Statutory') {
                        if ($document_file) :
                            // Get the file URL, file size, and file type (mime type)
                            $file_url = $document_file['url'];
                            $file_id = $document_file['ID'];
                            $file_size = @filesize(get_attached_file($file_id)); // Suppress errors with @
                            $file_type_info = wp_check_filetype($file_url);
                            $file_type = isset($file_type_info['ext']) ? strtoupper($file_type_info['ext']) : 'Unknown';
                            $file_size_mb = ($file_size !== false) ? size_format($file_size, 2) : 'Unknown'; // Convert file size to MB with 2 decimal points
                            ?>

                            <li>
                                <a href="<?php echo esc_url($file_url); ?>">
                                    <?php echo esc_html(get_the_title()); ?> 
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="Download" style="vertical-align: middle;" />
                                    (<?php echo __('Download', 'srft-theme');?> &nbsp;- <?php echo esc_html($file_size_mb); ?>)
                                </a>
                            </li>

                        <?php endif; 
                    } }
                    echo '</ul>';
                } else {
                    echo __('No posts found in the specified category.', 'srft-theme');
                }

                wp_reset_postdata(); // Reset after custom query
                ?>
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
                <p class="page-header-text"><?php echo __('Administrative Structure', 'srft-theme'); ?></p>
            </div>  
            <?php wp_reset_postdata(); ?> 
            <div class="sub-intro" style="margin-bottom: 4rem;">
                <div class="sub-intro-text" style="max-width: 100%;">
                    <div class="sub-intro-text-description">
                        <?php
                        // Retrieve and display the introduction of the page content
                        $intro = get_post_meta(get_the_ID(), 'Admin_Intro', true);
                        echo $intro;
                        ?>
                    </div>
                </div>
            </div>
           
            <div>
                <h4><?php echo __('Society', 'srft-theme'); ?></h4>
            </div>
            <section style="margin-bottom: 4rem;">
                <div><h3><?php echo __('Composition', 'srft-theme'); ?></h3></div>
                <div>
                    <?php
                    // Retrieve and display the society part of the page content
                    $society = get_post_meta(get_the_ID(), 'Society', true);
                    echo $society;
                    ?>
                </div>
                <div><h3><?php echo __('Present Member', 'srft-theme'); ?></h3></div>
                <div class="wrapper">
                    <div class="Rtable Rtable--5cols Rtable--collapse">
                        <div class="Rtable-row Rtable-row--head">
                            <div class="Rtable-cell slno-cell column-heading"><?php echo __('SL.No.', 'srft-theme'); ?></div>
                            <div class="Rtable-cell name-cell column-heading"><?php echo __('Name', 'srft-theme'); ?></div>
                            <div class="Rtable-cell designation-cell column-heading"><?php echo __('Designation', 'srft-theme'); ?></div>
                        </div>
                        <?php
                        if ($current_language === 'en_US') {
                            $catslug='societymember-en'; 
                        } else {
                            $catslug='societymember-hi';
                        }
                        $category_posts = new WP_Query(array(
                            'category_name' => $catslug, // Replace with your category slug
                            'posts_per_page' => -1 // Display all posts in the category
                        ));
                        
                        $count = 1; // Initialize the serial number
                        if ($category_posts->have_posts()) :
                            while ($category_posts->have_posts()) : $category_posts->the_post();
                        ?>
                            <div class="Rtable-row">
                                <div class="Rtable-cell slno-cell">
                                    <div class="Rtable-cell--content"><?php echo $count; ?></div>
                                </div>
                                <div class="Rtable-cell name-cell">
                                    <div class="Rtable-cell--content"><?php the_title(); ?></div>
                                </div>
                                <div class="Rtable-cell designation-cell">
                                    <div class="Rtable-cell--content"><?php echo get_post_meta(get_the_ID(), 'Designation', true); ?></div>
                                </div>
                            </div>
                        <?php
                            $count++;
                            endwhile;
                            wp_reset_postdata(); // Reset the post data
                        else :
                            echo '<p>No posts found in this category.</p>';
                        endif;
                        ?>  
                    </div>
                    <!-- Use a CSS grid for layout -->
                </div>
            </section>     

            <div>
                <h4><?php echo __('Governing Council', 'srft-theme'); ?></h4>
            </div>
            <section style="margin-bottom: 4rem;">
                <div><h3><?php echo __('Composition', 'srft-theme'); ?></h3></div>
                <div style="margin-bottom: 1.5rem;">
                    <?php
                    // Retrieve and display the governing council part of the page content
                    $council = get_post_meta(get_the_ID(), 'GC', true);
                    echo $council;
                    ?>
                </div>
                <div><h3><?php echo __('Present Member', 'srft-theme'); ?></h3></div>
                <div class="wrapper">
                    <div class="Rtable Rtable--5cols Rtable--collapse">
                        <div class="Rtable-row Rtable-row--head">
                            <div class="Rtable-cell slno-cell column-heading"><?php echo __('SL.No.', 'srft-theme'); ?></div>
                            <div class="Rtable-cell name-cell column-heading"><?php echo __('Name', 'srft-theme'); ?></div>
                            <div class="Rtable-cell designation-cell column-heading"><?php echo __('Designation', 'srft-theme'); ?></div>
                        </div>
                        <?php
                        if ($current_language === 'en_US') {
                            $catslug='gcmember-en'; 
                        } else {
                            $catslug='gcmember-hi';
                        }
                        $category_posts = new WP_Query(array(
                            'category_name' => $catslug, // Replace with your category slug
                            'posts_per_page' => -1 // Display all posts in the category
                        ));
                        
                        $count = 1; // Initialize the serial number
                        if ($category_posts->have_posts()) :
                            while ($category_posts->have_posts()) : $category_posts->the_post();
                        ?>
                            <div class="Rtable-row">
                                <div class="Rtable-cell slno-cell">
                                    <div class="Rtable-cell--content"><?php echo $count; ?></div>
                                </div>
                                <div class="Rtable-cell name-cell">
                                    <div class="Rtable-cell--content"><?php the_title(); ?></div>
                                </div>
                                <div class="Rtable-cell designation-cell">
                                    <div class="Rtable-cell--content"><?php echo get_post_meta(get_the_ID(), 'Designation', true); ?></div>
                                </div>
                            </div>
                        <?php
                            $count++;
                            endwhile;
                            wp_reset_postdata(); // Reset the post data
                        else :
                            echo '<p>No posts found in this category.</p>';
                        endif;
                        ?>  
                    </div>
                    <!-- Use a CSS grid for layout -->
                </div>
            </section>

            <div>
                <h4><?php echo __('Academic Council', 'srft-theme'); ?></h4>
            </div>
            <section style="margin-bottom: 4rem;">
                <div><h3><?php echo __('Composition', 'srft-theme'); ?></h3></div>
                <div style="margin-bottom: 1.5rem;">
                    <?php
                    // Retrieve and display the academic council part of the page content
                    $acouncil = get_post_meta(get_the_ID(), 'AC', true);
                    echo $acouncil;
                    ?>
                </div>
                <div><h3><?php echo __('Present Member', 'srft-theme'); ?></h3></div>
                <div class="wrapper">
                    <div class="Rtable Rtable--5cols Rtable--collapse">
                        <div class="Rtable-row Rtable-row--head">
                            <div class="Rtable-cell slno-cell column-heading"><?php echo __('SL.No.', 'srft-theme'); ?></div>
                            <div class="Rtable-cell name-cell column-heading"><?php echo __('Name', 'srft-theme'); ?></div>
                            <div class="Rtable-cell designation-cell column-heading"><?php echo __('Designation', 'srft-theme'); ?></div>
                        </div>
                        <?php
if ($current_language === 'en_US') {
    $catslug = 'acmember-en'; 

    // Define priority for English designations
    $designation_order = array(
        'President' => 1,
        'Director' => 2,
        'Dean (Film), SRFTI' => 3,
        'Dean (EDM), SRFTI' => 4,
        'Dean (Film), FTII' => 5,
        'Dean (TV), FTII' => 6,
        'Registrar, SRFTI' => 7,
        'External Expert' => 8,
        'Alumni' => 7
        
    );

} else {
    $catslug = 'acmember-hi'; 

    // Define priority for Hindi designations
    $designation_order = array(
        'अध्यक्ष' => 1, // President
        'निदेशक' => 2, // Director
        'डीन (फिल्म्स), एसआरएफटीआई' => 3, // Dean (Film)
        'डीन (ईडीएम), एसआरएफटीआई' => 4, // Dean (TV)
        'डीन (फिल्म्स), एफटीआईआई' => 5, // Dean (Film)
        'डीन (टीवी), एफटीआईआई' => 6, // Dean (TV)
        'रजिस्ट्रार, एसआरएफटीआई' => 7, // Registrar
        'पूर्व छात्र' => 7, // Alumni
        'बाहरी विशेषज्ञ' => 6 // External Expert
    );
}

// Fetch posts
$category_posts = new WP_Query(array(
    'category_name' => $catslug, // Your category slug
    'posts_per_page' => -1, // Display all posts in the category
    'orderby' => 'date', // Default sorting by date
    'order' => 'ASC', // Sorting order (ascending or descending, depending on your requirement)
));

$posts = array(); // Initialize an array to store posts

if ($category_posts->have_posts()) :
    while ($category_posts->have_posts()) : $category_posts->the_post();
        // Get the custom field 'Designation'
        $designation = get_post_meta(get_the_ID(), 'Designation', true);

        // If designation is not set, provide a fallback
        if (!$designation) {
            $designation = 'Unknown';
        }

        // Store post details with priority
        $posts[] = array(
            'title' => get_the_title(),
            'designation' => $designation,
            'priority' => $designation_order[$designation] ?? PHP_INT_MAX // Assign priority
        );
    endwhile;

    // Sort posts by priority
    usort($posts, function ($a, $b) {
        return $a['priority'] <=> $b['priority'];
    });

    // Display the sorted posts
    $count = 1; // Initialize serial number
    foreach ($posts as $post) {
        ?>
        <div class="Rtable-row">
            <div class="Rtable-cell slno-cell">
                <div class="Rtable-cell--content"><?php echo $count; ?></div>
            </div>
            <div class="Rtable-cell name-cell">
                <div class="Rtable-cell--content"><?php echo $post['title']; ?></div>
            </div>
            <div class="Rtable-cell designation-cell">
                <div class="Rtable-cell--content"><?php echo $post['designation']; ?></div>
            </div>
        </div>
        <?php
        $count++; // Increment the serial number
    }
    wp_reset_postdata(); // Reset the post data

else :
    echo '<p>No posts found in this category.</p>';
endif;
?>


                    </div>
                    <!-- Use a CSS grid for layout -->
                </div>
            </section>
        </div>
    </section>
    <?php get_footer(); ?>
