<?php
/*
Template Name: Annual Report
*/
get_header();
$post_id = get_the_ID();
$catslug = get_the_category($post_id);
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>

<main>
    <section class="cine-header">
        <div class="page-banner">
            <div class="page-banner-title"><?php echo __('About SRFTI', 'srft-theme'); ?></div>
        </div>
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
                <p class="page-header-text"><?php echo __('Annual Reports', 'srft-theme'); ?></p>
            </div>
            <section style="margin-top: 4rem;">
                <div class="wrapper" style="text-align: left;">
                    <div class="Rtable Rtable--5cols Rtable--collapse">
                        <div class="Rtable-row Rtable-row--head">
                            <div class="Rtable-cell slno-cell column-heading"><?php echo __('SL.No.', 'srft-theme'); ?></div>
                            <div class="Rtable-cell committee-cell column-heading"><?php echo __('Title', 'srft-theme'); ?></div>
                            <div class="Rtable-cell composition-cell column-heading"><?php echo __('Details', 'srft-theme'); ?></div>
                        </div>
                        <?php
                        if ($current_language === 'en_US') {
                            $catslug = 'annualreport-en';
                        } else {
                            $catslug = 'annualreport-hi';
                        }
                        $category_posts = new WP_Query(array(
                            'category_name' => $catslug,
                        ));
                        $count = 1; // Initialize the serial number

                        if ($category_posts->have_posts()) :
                            while ($category_posts->have_posts()) : $category_posts->the_post();
                                {
                                    $post_content = get_post_field('post_content', get_the_ID());
                                   
                                    // Parse the content to extract Gutenberg block data
                                    preg_match('/href=["\'](https?:\/\/[^"\']+\.pdf)["\']/', $post_content, $matches);


                                  
                                    ?>
                                    <div class="Rtable-row">
                                        <div class="Rtable-cell slno-cell">
                                            <div class="Rtable-cell--content "><?php echo $count; ?></div>
                                        </div>

                                        <div class="Rtable-cell committee-cell">
                                            <div class="Rtable-cell--content "><?php echo get_the_title(); ?></div>
                                        </div>

                                        <div class="Rtable-cell composition-cell">
                                            <div class="Rtable-cell--content ">
                                                <?php if (!empty($matches[1])) {
                                                 $file_url = esc_url($matches[1]);
                                                echo '<a href="' . $file_url . '">Download File</a>';
                                                    } else {
                                                echo 'File link not found in the content.';
                                            } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $count++;
                                }
                            endwhile;
                            wp_reset_postdata(); // Reset the post data
                        else :
                            echo '<p>No posts found in this category.</p>';
                        endif;
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </section>
</main>
