<?php 

/*
Template Name: Admisison PG
 */
get_header();
$post_id = get_the_ID();
$catslug = get_the_category($post_id);
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>
    <main>
      <section  class="cine-header" style="--bg-img: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <h1 class="page-banner-title"><?php echo __('Admission', 'srft-theme'); ?></h1>  
        </div>
      </section>

    <section  id="skip-to-content" class="cine-detail">
      
      <aside class="leftnav" role="complementary" aria-label="Notification & Downloadable Materials">

    <!-- Navigation Section -->
    <nav class="childnavs" aria-label="<?php echo __('Admission Menu', 'srft-theme'); ?>">
        <?php
        $current_language = get_locale();
        $menu_name = ($current_language === 'hi_IN') ? 'hindi_admission_menu' : 'english_admission_menu';
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

    <!-- Prospectus Downloads -->
    <section class="widget" aria-labelledby="prospectus-heading">
        <h3 id="prospectus-heading"><?php echo __('Download Prospectus', 'srft-theme'); ?></h3>
        <?php 
        $catslg = ($current_language === 'en_US') ? 'document-en' : 'document-hi';
        $download_post = new WP_Query([
            'post_type' => 'document',
            'tax_query' => [[
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $catslg,
            ]],
            'posts_per_page' => -1,
        ]);

        if ($download_post->have_posts()) {
            echo '<ul style="list-style: none; padding-left: 0;">';
            while ($download_post->have_posts()) {
                $download_post->the_post();
                $document_file = get_field('document');
                $document_category = get_field('document-category');
                if ($document_category === 'Prospectus' && $document_file) {
                    $file_url = $document_file['url'];
                    $file_id = $document_file['ID'];
                    $file_size = @filesize(get_attached_file($file_id));
                    $file_type_info = wp_check_filetype($file_url);
                    $file_type = strtoupper($file_type_info['ext'] ?? 'Unknown');
                    $file_size_mb = $file_size ? size_format($file_size, 2) : 'Unknown';
                    ?>
                    <li>
                        <a href="<?php echo esc_url($file_url); ?>" target="_blank" rel="noopener">
                            <?php echo esc_html(get_the_title()); ?>
                            (<?php echo esc_html($file_type); ?> - <?php echo esc_html($file_size_mb); ?>)
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="PDF, opens in a new tab" style="vertical-align: middle;" />
                        </a>
                    </li>
                <?php }
            }
            echo '</ul>';
        } else {
            echo '<p>' . __('No prospectus available.', 'srft-theme') . '</p>';
        }
        wp_reset_postdata();
        ?>
    </section>

    <!-- Admission Notification -->
    <section class="widget" aria-labelledby="admission-notice-heading">
        <h3 id="admission-notice-heading"><?php echo __('Admission Notification', 'srft-theme'); ?></h3>
        <?php
        $catslug = ($current_language === 'hi_IN') ? 'admission-hi' : 'admission-en';
        $admission_post = new WP_Query([
            'post_type' => 'admission',
            'tax_query' => [[
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $catslug,
            ]],
            'posts_per_page' => -1,
        ]);

        if ($admission_post->have_posts()) {
            echo '<ul style="list-style: none; padding-left: 0;">';
            while ($admission_post->have_posts()) {
                $admission_post->the_post();
                ?>
                <li style="margin-bottom: 10px;">
                    <a href="<?php the_permalink(); ?>" target="_blank">
                        <?php the_title(); ?>
                    </a>
                </li>
            <?php }
            echo '</ul>';
        } else {
            echo '<p>' . __('No admission notifications available.', 'srft-theme') . '</p>';
        }
        wp_reset_postdata();
        ?>
    </section>

    <!-- Sample Question Papers -->
    <section class="widget" aria-labelledby="question-papers-heading">
        <h3 id="question-papers-heading"><?php echo __('Sample Question Papers', 'srft-theme'); ?></h3>
        <?php 
        $download_post = new WP_Query([
            'post_type' => 'document',
            'tax_query' => [[
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $catslg,
            ]],
            'posts_per_page' => -1,
        ]);

        if ($download_post->have_posts()) {
            echo '<ul style="list-style: none; padding-left: 0;">';
            while ($download_post->have_posts()) {
                $download_post->the_post(); 
                $document_file = get_field('document');
                $document_category = get_field('document-category');
                if ($document_category === 'Question Paper' && $document_file) {
                    $file_url = $document_file['url'];
                    $file_id = $document_file['ID'];
                    $file_size = @filesize(get_attached_file($file_id));
                    $file_type_info = wp_check_filetype($file_url);
                    $file_type = strtoupper($file_type_info['ext'] ?? 'Unknown');
                    $file_size_mb = $file_size ? size_format($file_size, 2) : 'Unknown';
                    ?>
                    <li style="margin-bottom: 10px;">
                        <a href="<?php echo esc_url($file_url); ?>" target="_blank" rel="noopener">
                            <?php echo esc_html(get_the_title()); ?>
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="PDF, opens in a new tab"" style="vertical-align: middle;" />
                            <?php echo __('Download', 'srft-theme'); ?> (<?php echo esc_html($file_size_mb); ?>)
                        </a>
                    </li>
                <?php }
            }
            echo '</ul>';
        } else {
            echo '<p>' . __('No question papers found.', 'srft-theme') . '</p>';
        }
        wp_reset_postdata();
        ?>
    </section>
</aside>

    <div class="main-content" >
        <div>     
           <?php
            if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
      ?></div>
        <div  class="page-title">
          <div><p class="page-header-text"><?php echo __('Programme Overview', 'srft-theme'); ?></p></div>
        </div>
        <div class="sub-intro">
          <div class="sub-intro-images">
           <div>
            <img class="intro-images" src="<?php bloginfo('template_url'); ?>/images/srfti-front.jpg"
                 alt="SRFTI Entrance">
           </div>
          </div>
          <div class="sub-intro-text">
           <div class="sub-intro-text-head"><?php echo get_post_meta(get_the_ID(), 'SubIntro', true); ?></div>
          
           <div class="sub-intro-text-description">
           <?php echo get_post_meta(get_the_ID(), 'SubIntroDescription', true); ?>
          </div>
          </div>
        </div>
        <section class="section-home">
  <div class="tabs">
    <div class="tab-2">
      <label for="tab2-1"><?php echo __('Master of Fine Arts in Cinema', 'srft-theme'); ?></label>
      <input id="tab2-1" name="tabs-two" type="radio" checked="checked">
      <div>
        <p><?php echo __('The programme is a 1-Year Bridge Programme + 2-Year Master of Fine Arts(MFA) Programme', 'srft-theme'); ?></p>   
        <br/><br/>
        <div class="accordian">
          <ul>
            <li>
              <input type="checkbox" checked aria-label="<?php echo __('Show or hide Duration for Cinema Programme', 'srft-theme'); ?>">
              <i></i>
              <h2><?php echo __('Duration', 'srft-theme'); ?></h2>
              <p><?php echo __(' 1-Year Bridge Programme + 2-Year MFA', 'srft-theme'); ?></p>
            </li>
          </ul>
          <ul>
            <li>
              <input type="checkbox" aria-label="<?php echo __('Show or hide Number of students for Cinema Programme', 'srft-theme'); ?>" checked>
              <i></i>
              <h2><?php echo __('No. of students', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'StudentCinema', true); ?>     
            </li>
          </ul>
          <ul>
            <li>
              <input type="checkbox" aria-label="<?php echo __('Show or hide Specialization for Cinema Programme', 'srft-theme'); ?>" checked>
              <i></i>
              <h2><?php echo __('Specialization offered', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'SpecializationCinema', true); ?>
            </li>
          </ul>
          <!--<ul>
            <li>
              <input type="checkbox" aria-label="<?php echo __('Show or hide Course structure for Cinema Programme', 'srft-theme'); ?>" checked>
              <i></i>
              <h2><?php echo __('Course Structure', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'CourseCinema', true); ?>
            </li>
          </ul>-->
          <ul>
            <li>
              <input type="checkbox" aria-label="<?php echo __('Show or hide Essential Qualification for Cinema Programme', 'srft-theme'); ?>" checked>
              <i></i>
              <h2><?php echo __('Essential Qualifications', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'QualificationCinema', true); ?>
            </li>
          </ul>
        </div>
      </div>
    </div> <!-- Closing .tab-2 -->

    <div class="tab-2">
      <label for="tab2-2"><?php echo __('Master of Fine Arts in EDM', 'srft-theme'); ?></label>
      <input id="tab2-2" name="tabs-two" type="radio">
      <div>
        <p><?php echo __('The programme is a 2-Year Master of Fine Arts(MFA) Programme', 'srft-theme'); ?></p>
        <br/><br/>
        <div class="accordian">
          <ul>
            <li>
              <input type="checkbox" aria-label="<?php echo __('Show or hide Duration for EDM Programme', 'srft-theme'); ?>" checked>
              <i></i>
              <h2><?php echo __('Duration', 'srft-theme'); ?></h2>
              <p><?php echo __('2-Year MFA', 'srft-theme'); ?></p>
            </li>
          </ul>
          <ul>
            <li>
              <input type="checkbox" checked aria-label="<?php echo __('Show or hide No. of Student for EDM Programme', 'srft-theme'); ?>">
              <i></i>
              <h2><?php echo __('No. of students', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'StudentEDM', true); ?>    
            </li>
          </ul>
          <ul>
            <li>
              <input type="checkbox" checked aria-label="<?php echo __('Show or hide Specialization for EDM Programme', 'srft-theme'); ?>">
              <i></i>
              <h2><?php echo __('Specialization offered', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'SpecializationEDM', true); ?>    
            </li>
          </ul>
          <!--<ul>
            <li>
              <input type="checkbox" checked aria-label="<?php echo __('Show or hide Course structure for EDM Programme', 'srft-theme'); ?>">
              <i></i>
              <h2><?php echo __('Course Structure', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'CourseEDM', true); ?>   
            </li>
          </ul>-->
          <ul>
            <li>
              <input type="checkbox" checked aria-label="<?php echo __('Show or hide Essential Qualification for EDM Programme', 'srft-theme'); ?>">
              <i></i>
              <h2><?php echo __('Essential Qualifications', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'QualificationEDM', true); ?> 
            </li>
          </ul>
        </div>
      </div>
    </div> <!-- Closing .tab-2 -->
  </div> <!-- Closing .tabs -->
</section>

      
      </div>
      
        
      </section>
    <?php get_footer();  ?>