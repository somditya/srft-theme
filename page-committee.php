<?php
/*
Template Name: committee

 */
get_header(); 
$post_id = get_the_ID();
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();

?>
<main>
      <body>
      <section class="cine-header">
        <div class="page-banner">
          <div class="page-banner-title"><?php echo __('About SRFTI', 'srft-theme' ); ?></div>
      </section>

      <section class="cine-detail">
        <div class="leftnav">
          <!--<div>
          <p class="office-header-text">Management</p>-->
          <!--<div class="ftest">Satyajit Ray Film & Television Institute</div>-
        </div>-->
        <div class="childnavs">
          <ul class="childnav-lists">
            <li class="childnav-list-item">
              <a class="item"><?php echo __('About', 'srft-theme'); ?></a>
            </li>
            <li class="childnav-list-item">
              <a class="item"><?php echo __('The Leaderships', 'srft-theme'); ?></a>
            </li>
            <li class="childnav-list-item">
              <a class="item"><?php echo __('Management', 'srft-theme'); ?></a>
              </li>
              <li class="childnav-list-item">
                <a class="item"><?php echo __('Organization Structure', 'srft-theme'); ?></a>
                </li>
                <li class="childnav-list-item">
                  <a class="item"><?php echo __('Important Committees', 'srft-theme'); ?></a>
                </li>
                <li class="childnav-list-item">
                  <a class="item"><?php echo __('Annual Reports', 'srft-theme'); ?></a>
                </li>
          </ul>
        </div>
        
        <div class="widget" style="line-height: 1.5">
        <ul style="list-style-type: none ">
          <li><?php echo __('Memorandum of Association', 'srft-theme' ); ?>  <img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li> 
          <li><?php echo __('Academic Bye-Laws ', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li>
          <li><?php echo __('Financial Bye-Laws', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li>
          <li><?php echo __('Service By-laws', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li>
        </ul>   
        </div>
        </div>

        <div class="main-content">
    <div>
        <p class="page-header-text"><?php echo __('Administrative Structure', 'srft-theme'); ?></p>
    </div>  
<section style="margin-bottom: 4rem;">    
      <div class="wrapper">
              <div class="Rtable Rtable--5cols Rtable--collapse">
                <div class="Rtable-row Rtable-row--head">
                  <div class="Rtable-cell slno-cell column-heading"><?php echo __('SL.No.', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell committee-cell column-heading"><?php echo __('Committee', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell composition-cell column-heading"><?php echo __('Composition', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell tenure-cell column-heading"><?php echo __('Tenure', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell openmeeting-cell column-heading"><?php echo __('Whether Meeting of these committees open to public', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell openminutes-cell column-heading"><?php echo __('Whether minutes of the meetings accessible for public', 'srft-theme' ); ?></div>
                </div>
                <?php
                
               

                  $args = array(
                    'category_name' => $catslug, // Specify the category by slug
                    'posts_per_page' => 1, // Limit to one post
                    'orderby' => 'modified', //  Order by modification date (most recently updated)
                    'order' => 'DESC', // Display in descending order (latest first)
                );
                  
                $category_posts = new WP_Query(array(
                      'category_name' => $catslug, // Replace with your category slug
                  ));  
                  
                $count = 1; // Initialize the serial number/
             if ($category_posts->have_posts()) :
              while ($category_posts->have_posts()) :$category_posts->the_post();
            ?>
            
                 
                <div class="Rtable-row">
                  <div class="Rtable-cell slno-cell">
                    <div class="Rtable-cell--content "><?php echo $count; ?></div>
                  </div>
                  <div class="Rtable-cell committee-cell">
                    <div class="Rtable-cell--content "><?php echo get_post_meta(get_the_ID(), 'Committee', true); ?></div>
                  </div>
                  <div class="Rtable-cell composition-cell">
                    <div class="Rtable-cell--content "><?php echo get_post_meta(get_the_ID(), 'Composition', true); ?></div>
                  </div>
                  <div class="Rtable-cell tenure-cell">
                    <div class="Rtable-cell--content "><?php echo get_post_meta(get_the_ID(), 'Tenure', true); ?></div>
                  </div>
                  <div class="Rtable-cell openmeeting-cell">
                    <div class="Rtable-cell--content "><?php echo get_post_meta(get_the_ID(), 'OpenMeeting', true); ?></div>
                  </div>
                  <div class="Rtable-cell openminutes-cell">
                    <div class="Rtable-cell--content "><?php echo get_post_meta(get_the_ID(), 'OpenMinutes', true); ?></div>
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