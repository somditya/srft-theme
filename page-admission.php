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
    <div class="container-aligned">
    <div class="breadcrumbs-wrapper">
    <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>' );
            }
    ?>
   </div>
   </div>
    <section  id="skip-to-content" class="cine-detail">
      
    <div class="leftnav" aria-labelledby="sidebar-region">
    <!--<h2 id="sidebar-heading" class="sr-only">Admission Related Information </h2>
     Navigation Section -->
    <nav class="childnavs" aria-label="<?php echo __('Admission', 'srft-theme'); ?>">
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
    
    <aside role="complementary">
    <!-- Prospectus Downloads -->
    <div class="widget">
        <h2><?php echo __('Download Prospectus', 'srft-theme'); ?></h2>
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
                        <a href="<?php echo esc_url($file_url); ?>" target="_blank" rel="noopener" title="opens in a new tab">
                            <?php echo esc_html(get_the_title()); ?>
                            (<?php echo esc_html($file_type); ?> - <?php echo esc_html($file_size_mb); ?>)
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="pdf" style="vertical-align: middle;" />
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
    </div>

    <!-- Admission Notification -->
    <div class="widget">
        <h2><?php echo __('Admission Notification', 'srft-theme'); ?></h2>
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
    </div>

    <!-- Sample Question Papers -->
    <div class="widget">
        <h2><?php echo __('Sample Question Papers', 'srft-theme'); ?></h2>
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
                        <a href="<?php echo esc_url($file_url); ?>" target="_blank" rel="noopener" title="pdf opens in a new window">
                            <?php echo esc_html(get_the_title()); ?>
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="" style="vertical-align: middle;" />
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
    </div>
    </aside>
    </div>


    <div class="main-content">
        <div  class="page-title">
          <div><h2 class="page-header-text"><?php echo __('Programme Overview', 'srft-theme'); ?></h2></div>
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
 
        <h3><?php echo __('Master of Fine Arts in Cinema', 'srft-theme'); ?> </h3>
        <p><?php echo __('The programme is a 1-Year Bridge Programme + 2-Year Master of Fine Arts(MFA) Programme', 'srft-theme'); ?></p>   
        <br role="presentation"/>
        <div id="accordionGroup" class="accordion">
        
         <h4>
         <button type="button" aria-expanded="true" class="accordion-trigger" aria-controls="sect1" id="accordion1id">
         <span class="accordion-title">
         <?php echo __('Specialization offered', 'srft-theme'); ?>
         <span class="accordion-icon"></span>
         </span>
         </button>
         </h4>
        
        <div id="sect1" role="region" aria-labelledby="accordion1id" class="accordion-panel">
        <div>
         <?php echo get_post_meta(get_the_ID(), 'SpecializationCinema', true); ?>  
        </div>
        </div>
        
        <h4>
        <button type="button" aria-expanded="false" class="accordion-trigger" aria-controls="sect2" id="accordion2id">
        <span class="accordion-title">
        <?php echo __('No. of students', 'srft-theme'); ?>
        <span class="accordion-icon"></span>
        </span>
        </button>
        </h4>
        
        <div id="sect2" role="region" aria-labelledby="accordion2id" class="accordion-panel" hidden="">
        <div>
        <?php echo get_post_meta(get_the_ID(), 'StudentCinema', true); ?>
        </div>
        </div>
        
        <h4>
        <button type="button" aria-expanded="false" class="accordion-trigger" aria-controls="sect3" id="accordion3id">
        <span class="accordion-title">
        <?php echo __('Duration', 'srft-theme');  ?>
        <span class="accordion-icon"></span>
        </span>
        </button>
        </h4>
        
        <div id="sect3" role="region" aria-labelledby="accordion3id" class="accordion-panel" hidden="">
        <div>
        <?php echo __(' 1-Year Bridge Programme + 2-Year MFA', 'srft-theme'); ?>  
        </div>
        </div>

        <h4>
        <button type="button" aria-expanded="false" class="accordion-trigger" aria-controls="sect4" id="accordion4id">
        <span class="accordion-title">
        <?php echo __('Essential Qualifications', 'srft-theme'); ?>
        <span class="accordion-icon"></span>
        </span>
        </button>
        </h4>
        
        <div id="sect4" role="region" aria-labelledby="accordion4id" class="accordion-panel" hidden="">
        <div>
        <?php echo get_post_meta(get_the_ID(), 'QualificationCinema', true); ?>  
        </div>
        </div>

       </div>

      <br role="presentation"/>
       <h3><?php echo __('Master of Fine Arts in EDM', 'srft-theme'); ?> </h3>
      <div>
        <p><?php echo __('The programme is a 2-Year Master of Fine Arts(MFA) Programme', 'srft-theme'); ?></p>
        <br/>
        
<div id="accordionGroup" class="accordion">
  <h4>
    <button type="button" aria-expanded="true" class="accordion-trigger" aria-controls="sect5" id="accordion5id">
      <span class="accordion-title">
       <?php echo __('Specialization offered', 'srft-theme'); ?>
        <span class="accordion-icon"></span>
      </span>
    </button>
  </h4>
  <div id="sect5" role="region" aria-labelledby="accordion1id" class="accordion-panel">
    <div>
    <?php echo get_post_meta(get_the_ID(), 'SpecializationEDM', true); ?>  
      
    </div>
  </div>
  <h3>
    <button type="button" aria-expanded="false" class="accordion-trigger" aria-controls="sect6" id="accordion6id">
      <span class="accordion-title">
        <?php echo __('No. of students', 'srft-theme'); ?>
        <span class="accordion-icon"></span>
      </span>
    </button>
  </h3>
  <div id="sect6" role="region" aria-labelledby="accordion2id" class="accordion-panel" hidden="">
    <div>
      <?php echo get_post_meta(get_the_ID(), 'StudentEDM', true); ?>
    </div>
  </div>
  <h3>
    <button type="button" aria-expanded="false" class="accordion-trigger" aria-controls="sect7" id="accordion7id">
      <span class="accordion-title">
                <?php echo __('Duration', 'srft-theme');  ?>
        <span class="accordion-icon"></span>
      </span>
    </button>
  </h3>
  <div id="sect7" role="region" aria-labelledby="accordion7id" class="accordion-panel" hidden="">
    <div>
    <?php echo __('2-Year MFA', 'srft-theme'); ?>  
    </div>
  </div>

  <h3>
    <button type="button" aria-expanded="false" class="accordion-trigger" aria-controls="sect8" id="accordion8id">
      <span class="accordion-title">
                <?php echo __('Essential Qualifications', 'srft-theme'); ?>
        <span class="accordion-icon"></span>
      </span>
    </button>
  </h3>
  <div id="sect8" role="region" aria-labelledby="accordion8id" class="accordion-panel" hidden="">
    <div>
    <?php echo get_post_meta(get_the_ID(), 'QualificationEDM', true); ?>  
    </div>
  </div>
</div>

      </div>
</section>

      
      </div>
      
        
      </section>
      </main>      
    <?php get_footer();  ?>