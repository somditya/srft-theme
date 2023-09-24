<?php
/*
Template Name: About

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
              <a class="item"><?php echo __('Administrative Structure', 'srft-theme'); ?></a>
              </li>
              <li class="childnav-list-item">
                <a class="item"><?php echo __('Organization Structure', 'srft-theme'); ?></a>
                </li>
                <li class="childnav-list-item">
                  <a class="item"><?php echo __('Important Committee', 'srft-theme'); ?></a>
                </li>
                <li class="childnav-list-item">
                  <a class="item"><?php echo __('Annual Reports', 'srft-theme'); ?></a>
                </li>
          </ul>
        </div>
        <!--<div class="widget">
         
        </div> --->
        </div>

        <div class="main-content">
          
           
              <p class="page-header-text"><?php echo __('A brief history', 'srft-theme'); ?></p>
          <section class="sub-intro">
            <div class="sub-intro-images" >
            <div>
              <img  src="<?php bloginfo('template_url'); ?>/images/Ray-by-Nemai-Ghosh-1024x677.jpg" width="500px;" alt="Black and white photo of Satyajit Ray holding a film camera" >
            </div>
            </div>
            <div class="sub-intro-text" >
             <!--<div class="sub-intro-text-head"><?php echo __('History', 'srft-theme'); ?></div>-->
            
             <div class="sub-intro-text-description" >
             <?php echo $page_content; ?>

            </div>
            </div>
          </section>

          <div>
              <p class="page-header-text"><?php echo __('History Snapshots', 'srft-theme' ); ?></p>
            </div>
        <scction class="one-flex" >
        <div class="container">
	<div class="gallery">
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-01.jpg" target="_blanK" class="single-image" />
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-02.jpg" target="_blanK" class="single-image" />	
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-03.jpg" target="_blanK" class="single-image" />
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-04.jpg" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-05.jpg" target="_blanK" class="single-image" />
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-06.jpg" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-07.jpg" target="_blanK" class="single-image" />
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-08.jpg" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-09.jpg" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-10.jpg" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-11.jpg" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-12.jpg" target="_blanK" class="single-image" />
 
	</div> 
</div>
 

        </scction>
        <div><p class="page-header-text"><?php echo __('Explore Our Story', 'srft-theme' ); ?></p></div>
        <scction class="one-flex" style="margin: 10px;" >
          <video autoplay="false" class="homepage-masthead__video" id="homepage-masthead__video" loop="true" muted="true" playsinline="true" poster="#" width="100%">
            <source src="<?php bloginfo('template_url'); ?>/videos/intro.mp4" type="video/mp4">
          </video>
        </scction>
        <section>

        </section>
    </main>

    <div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="modal-body">
      <!-- Modal content goes here -->
    </div>
  </div>
</div>
    <?php
get_footer(); 
?>