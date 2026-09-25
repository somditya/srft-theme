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
            <h1 class="page-banner-title"><?php echo __('Management', 'srft-theme'); ?></h1>
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

        <aside class="widget" role="complementary" style="line-height: 1.5; margin-top: 5.5rem;">
                
                <h2 id="Download pdfs"><?php echo __('Rules, Policies & Governance', 'srft-theme'); ?></h2>
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
    echo '<ul style="list-style-type: none; padding-left: 0;">';
    while ($download_post->have_posts()) {
        $download_post->the_post(); 
        
        // FIX: Use get_post_meta instead of get_field
        $file_id = get_post_meta(get_the_ID(), 'document', true);
        $document_category = get_post_meta(get_the_ID(), 'document-category', true);
        $document_description = get_field('document_description');
        
        // Handle array format for document-category
        if (is_array($document_category)) {
            $document_category = $document_category['value'] ?? '';
        }
        
        // Check if category is Statutory and file exists
        if ($document_category === 'Statutory' && $file_id) {
            $file_url = wp_get_attachment_url((int)$file_id);
            
            if ($file_url) {
                $file_size = @filesize(get_attached_file($file_id));
                $file_type_info = wp_check_filetype($file_url);
                $file_type = isset($file_type_info['ext']) ? strtoupper($file_type_info['ext']) : 'Unknown';
                $file_size_mb = ($file_size !== false) ? size_format($file_size, 2) : 'Unknown';
                ?>
                <li style="margin-bottom: 1rem;">
                    <a href="<?php echo esc_url($file_url); ?>" target="_blank" rel="noopener noreferrer">
                        <?php echo esc_html(get_the_title()); ?> 
                        (<?php echo esc_html($file_size_mb); ?>)
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 68 68" fill="none" title="PDF icon"><path fill-rule="evenodd" clip-rule="evenodd" d="M15.13 47.8714C12.7254 46.6379 9.88617 46.145 7.0975 46.4771H0V67.9281H5.6525V59.741H8.075C10.5846 59.9579 13.1063 59.4402 15.215 58.2752C17.0049 56.9837 17.9917 55.0731 17.8925 53.0912C18.025 51.0785 16.9966 49.1354 15.13 47.8714ZM10.5825 55.701C9.51486 56.0964 8.34103 56.2445 7.1825 56.1301H5.525V50.0523H7.1825C8.38607 49.9447 9.6003 50.144 10.6675 50.6243C11.6614 51.2066 12.2246 52.1813 12.155 53.1984C12.2838 54.2239 11.6623 55.213 10.5825 55.701ZM30.0475 46.4771H22.9925V67.9281H29.75C33.1938 68.2116 36.6618 67.653 39.7375 66.3193C43.1218 64.1975 44.9299 60.7346 44.4975 57.2026C44.7508 54.1767 43.4692 51.2021 40.97 49.0155C37.8829 46.9686 33.9459 46.0537 30.0475 46.4771ZM35.6575 63.0659C33.8869 63.9031 31.8595 64.2766 29.835 64.1384H28.73V50.2668H29.75C33.32 50.2668 34.7225 50.5528 36.125 51.6254C37.8271 53.1161 38.7062 55.1399 38.5475 57.2026C38.7661 59.4349 37.6898 61.6187 35.6575 63.0659ZM50.7025 67.9281H56.44V58.9544H68V55.1648H56.44V50.2668H68V46.4771H50.7025V67.9281ZM46.75 0H0V39.3268H8.5V32.1765V28.4226V7.15033H43.2225L59.5 20.8432V28.4226V32.1765V39.3268H68V17.8758L46.75 0Z" fill="#5d3e00"></path></svg>
                    </a>
                </li>
                <?php
            }
        }
    }
    echo '</ul>';
} else {
    echo '<p>' . __('No posts found in the specified category.', 'srft-theme') . '</p>';
}

wp_reset_postdata();
?>
        </aside>    
        </div>

        <div class="main-content" role="main">
            <div>
                <h2 class="page-header-text"><?php echo __('Administrative Structure', 'srft-theme'); ?></h2>
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
                <h3><?php echo __('Society', 'srft-theme'); ?></h3>
            </div>
            <section style="margin-bottom: 4rem;">
                <div><h4><?php echo __('Composition', 'srft-theme'); ?></h4></div>
                <div>
                    <?php
                    // Retrieve and display the society part of the page content
                    $society = get_post_meta(get_the_ID(), 'Society', true);
                    echo $society;
                    ?>
                </div>
                <div><h4><?php echo __('Present Member of the Society', 'srft-theme'); ?></h4></div>
                    <div class="table-container">
                        <table style="width: 100%;">
                        <caption class="sr-only"> Table listing the current members of the society </caption>    
                        <thead>    
                        <tr class="Rtable-row Rtable-row--head">
                            <th class="Rtable-cell slno-cell column-heading" scope="col"><?php echo __('SL.No.', 'srft-theme'); ?></th>
                            <th class="Rtable-cell name-cell column-heading" scope="col"><?php echo __('Name', 'srft-theme'); ?></th>
                            <th class="Rtable-cell designation-cell column-heading" scope="col"><?php echo __('Designation', 'srft-theme'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
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
                            <tr class="Rtable-row">
                                <td class="Rtable-cell slno-cell">
                                    <div class="Rtable-cell--content"><?php echo $count; ?></div>
                                </td>
                                <th class="Rtable-cell name-cell" scope="row">
                                    <div class="Rtable-cell--content"><?php the_title(); ?></div>
                                </th>
                                <td class="Rtable-cell designation-cell">
                                    <div class="Rtable-cell--content"><?php echo get_post_meta(get_the_ID(), 'Designation', true); ?></div>
                                </td>
                            </tr>
                        <?php
                            $count++;
                            endwhile;
                            wp_reset_postdata(); // Reset the post data
                        else :
                            echo '<p>No posts found in this category.</p>';
                        endif;
                        ?>  
                    </tbody>
                    </table>
                    </div>
                    <!-- Use a CSS grid for layout -->
            </section>     

            <div>
                <h3><?php echo __('Executive Council', 'srft-theme'); ?></h3>
            </div>
            <section style="margin-bottom: 4rem;">
                <div><h4><?php echo __('Composition of the Executive Council', 'srft-theme'); ?></h4></div>
                <div style="margin-bottom: 1.5rem;">
                    <?php
                    // Retrieve and display the governing council part of the page content
                    $council = get_post_meta(get_the_ID(), 'GC', true);
                    echo $council;
                    ?>
                </div>
                <div><h4><?php echo __('Present Member of the Interim Executive Council', 'srft-theme'); ?></h4></div>
                    <div class="table-container">
                        <table style="width: 100%;">
                            <caption class="sr-only">Table listing the present members of the interim executive council </caption>
                        <thead>
                        <tr class="Rtable-row Rtable-row--head">
                            <th class="Rtable-cell slno-cell column-heading" scope="col"><?php echo __('SL.No.', 'srft-theme'); ?></th>
                            <th class="Rtable-cell name-cell column-heading" scope="col"><?php echo __('Name', 'srft-theme'); ?></th>
                            <th class="Rtable-cell designation-cell column-heading" scope="col"><?php echo __('Designation', 'srft-theme'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($current_language === 'en_US') {
                            $catslug='gcmember-en'; 
                        } else {
                            $catslug='gcmember-hi';
                        }
                       $category_posts = new WP_Query(array(
    'category_name'  => $catslug, // Your category slug
    'posts_per_page' => -1,
    'meta_key'       => 'order', // Custom field key (case-sensitive)
    'orderby'        => 'meta_value_num', // Use meta_value if not numeric
    'order'          => 'ASC' // or 'DESC'
));
                        $count = 1; // Initialize the serial number
                        if ($category_posts->have_posts()) :
                            while ($category_posts->have_posts()) : $category_posts->the_post();
                        ?>
                            <tr class="Rtable-row">
                                <td class="Rtable-cell slno-cell">
                                    <div class="Rtable-cell--content"><?php echo $count; ?></div>
                                </td>
                                <th class="Rtable-cell name-cell" scope="row">
                                    <div class="Rtable-cell--content"><?php the_title(); ?></div>
                                </th>
                                <td class="Rtable-cell designation-cell">
                                    <div class="Rtable-cell--content"><?php echo get_post_meta(get_the_ID(), 'Designation', true); ?></div>
                                </td>
                            </tr>
                        <?php
                            $count++;
                            endwhile;
                            wp_reset_postdata(); // Reset the post data
                        else :
                            echo '<p>No posts found in this category.</p>';
                        endif;
                        ?>  
                    </tbody>
                    </table>
                    </div>
                    <!-- Use a CSS grid for layout -->
            </section>

            <div>
                <h3><?php echo __('Academic Council', 'srft-theme'); ?></h3>
            </div>
            <section style="margin-bottom: 4rem;">
                <div><h4><?php echo __('Composition of the Academic Council', 'srft-theme'); ?></h4></div>
                <div style="margin-bottom: 1.5rem;">
                    <?php
                    // Retrieve and display the academic council part of the page content
                    $acouncil = get_post_meta(get_the_ID(), 'AC', true);
                    echo $acouncil;
                    ?>
                </div>
                <div><h4><?php echo __('Present Member of the Academic Council', 'srft-theme'); ?></h4></div>
                    <div class="table-container">
                        <table style="width: 100%">
                                                  <caption class="sr-only">Table listing the present members of the academic council </caption>    
                        <tr class="Rtable-row Rtable-row--head">
                            <th class="Rtable-cell slno-cell column-heading"><?php echo __('SL.No.', 'srft-theme'); ?></th>
                            <th class="Rtable-cell name-cell column-heading"><?php echo __('Name', 'srft-theme'); ?></th>
                            <th class="Rtable-cell designation-cell column-heading"><?php echo __('Designation', 'srft-theme'); ?></th>
                        </tr>
                        <tbody>
                        <?php
if ($current_language === 'en_US') {
    $catslug = 'acmember-en'; 

    // Define priority for English designations
    $designation_order = array(
        'Vice-Chancellor' => 1,
        'Dean (Films) -In-charge' => 2,
        'Dean (Film), SRFTI' => 3,
        'Dean (EDM), SRFTI' => 4,
        'Dean, FTII-Itanagar' => 5,
        'Professor, SRFTI-Film Wing' => 6,
        'Professor, SRFTI-EDM Wing' => 7,
        'Professor, FTII-Itanagar' => 8,
        'Associate Professor, SRFTI-Film Wing' => 9,
        'Associate Professor, SRFTI-EDM Wing' => 10,
        'Associate Professor, FTII-Itanagar' => 11,
        'Asssistant Professor, SRFTI-Film Wing' => 12,
        'Asssistant Professor, SRFTI-EDM Wing' => 13,
        'Asssistant Professor, FTII-Itanagar' => 14,
        'External Expert' => 15,
        'Registrar' => 16,
        'Student'=>17
    );

} else {
    $catslug = 'acmember-hi'; 

    // Define priority for Hindi designations
    $designation_order = array(
'कुलपति'=> 1,  
'डीन (फिल्म्स) – प्रभारी' => 2,   
'डीन (फिल्म), एसआरएफटीआई'  => 3,  
'डीन (ईडीएम), एसआरएफटीआई'  => 4, 
'डीन (फिल्म), एफटीआईआई – ईटानगर' => 5,    
'प्रोफेसर, एसआरएफटीआई – फिल्म विंग'=> 6,
'प्रोफेसर, एसआरएफटीआई – ईडीएम विंग'=> 7,
'प्रोफेसर, एफटीआईआई – ईटानगर'=>8,
'एसोसिएट प्रोफेसर, एसआरएफटीआई – फिल्म विंग'=>9,
'एसोसिएट प्रोफेसर, एसआरएफटीआई – ईडीएम विंग'=>10,
'एसोसिएट प्रोफेसर, एफटीआईआई – ईटानगर'=>11,
'सहायक प्रोफेसर, एसआरएफटीआई – फिल्म विंग'  => 12,   
'सहायक प्रोफेसर, एसआरएफटीआई – ईडीएम विंग विंग'  => 13, 
'सहायक प्रोफेसर, एफटीआईआई – ईटानगर'  => 14, 
'बाहरी विशेषज्ञ' => 15,  
'रजिस्ट्रार' => 16, 
'छात्र'  => 17 
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
        <tr class="Rtable-row">
            <td class="Rtable-cell slno-cell">
                <div class="Rtable-cell--content"><?php echo $count; ?></div>
            </td>
            <th class="Rtable-cell name-cell" scope="row">
                <div class="Rtable-cell--content"><?php echo $post['title']; ?></div>
            </th>
            <td class="Rtable-cell designation-cell">
                <div class="Rtable-cell--content"><?php echo $post['designation']; ?></div>
            </td>
        </tr>
        <?php
        $count++; // Increment the serial number
    }
    wp_reset_postdata(); // Reset the post data

else :
    echo '<p>No posts found in this category.</p>';
endif;
?>
</tbody>
</table>

                    </div>
                    <!-- Use a CSS grid for layout -->
            </section>
        </div>
    </section>
</main>   
    <?php get_footer(); ?>
