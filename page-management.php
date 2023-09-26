<?php
/*
Template Name: Management
 */
get_header(); 
$post_id = get_the_ID();
$page_content = apply_filters('the_content', $post->post_content);
?>
<main>
      <body>
      <section class="cine-header">
        <div class="page-banner">
          <div class="page-banner-title">About SRFTI</div>
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
          <li>Regulations</li>
          <li>Service By-laws</li>
          <li>Service By-laws</li>
          <li>Service By-laws</li>
        </ul>   
        </div>
        </div>

        <div class="main-content">
    <div>
        <p class="page-header-text"><?php echo __('Administrative Structure', 'srft-theme'); ?></p>
    </div>  
    <section class="sub-intro" style="margin-bottom: 4rem;">
        <div class="sub-intro-text" style="max-width: 100%;">
            <div class="sub-intro-text-description">
                <?php
                // Retrieve and display the introduction of the page content
                $intro = get_post_meta(get_the_ID(), 'Admin_Intro', true);
                echo $intro;
                ?>
            </div>
        </div>
    </section>

    <div>
        <p class="page-header-text"><?php echo __('Society', 'srft-theme' ); ?></p>
    </div>
    <section style="margin-bottom: 4rem;">
        <div>
            <?php
            // Retrieve and display the society part of the page content
            $society = get_post_meta(get_the_ID(), 'Society', true);
            echo $society;
            ?>
        </div>
    </section>      

    <div>
        <p class="page-header-text"><?php echo __('Governing Council', 'srft-theme' ); ?></p>
    </div>
    <section style="margin-bottom: 4rem;">
        <div>
            <?php
            // Retrieve and display the Governing Council part of the page content
            $gc = get_post_meta(get_the_ID(), 'GC', true);
            echo $gc;
            ?>
        </div>
    </section>
    <div>
        <p class="page-header-text"><?php echo __('Standing Finance Council', 'srft-theme' ); ?></p>
    </div>
    <section style="margin-bottom: 4rem;">
        <div>
            <?php
            // Retrieve and display the Governing Council part of the page content
            $sfc = get_post_meta(get_the_ID(), 'SFC', true);
            echo $sfc;
            ?>
        </div>
    </section>
    <div>
        <p class="page-header-text"><?php echo __('Academic Council', 'srft-theme' ); ?></p>
    </div>
    <section style="margin-bottom: 4rem;">
        <div>
            <?php
            // Retrieve and display the Governing Council part of the page content
            $ac = get_post_meta(get_the_ID(), 'AC', true);
            echo $ac;
            ?>
        </div>
    </section>
</div>
        
</main>

 
    <?php
get_footer(); 
?>