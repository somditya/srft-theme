<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>
<div data-scroll-container>
<main>
      <body>
      <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
      <div class="page-banner">
        <div class="page-banner-title"><?php echo __('Connect With Us', 'srft-theme' ); ?></div>
      </div>
     </section>

<section class="cine-detail">

<div class="leftnav">
  <div class="widget" style="line-height: 1.5">
  <strong><p><?php echo __('Satyajit Ray Film &amp; Television Institute' , 'srft-theme');?></p></strong>
  <p><?php echo __('E.M.Byepass Road, P.O. Panchasayar','srft-theme') ?></p>
  <p><?php echo __('Kolkata-700094', 'srft-theme');?> </p>

  <p><?php echo __('Phone-(033)2432 8355/8356/9300', 'srft-theme'); ?></p>
  <?php echo __('Fax - (033)2432-0723/9436', 'srft-theme'); ?>
</div>
</div>

<div class="main-content">
  <section class="page-title">
          <div>
            </p>
            <?php echo '<p class="page-header-text">' . esc_html($post->post_title) . '</p>';?>
          </div>
  </section>

  <section style="margin-bottom: 2rem;">
    <div><?php  echo wp_kses_post($post->post_content); ?></div>   
</section>
  <section class="one-flex" style="margin-top: 5rem; margin-bottom: 10rem;">
        <div class="accordian">
          <ul>
            <li>
              <input type="checkbox" checked>
              <i></i>
              <h2><?php echo __('Contact a Section', 'srft-theme' ); ?></h2>
              <p>
                <?php echo get_post_meta(get_the_ID(), 'Sections', true); ?>
              </p>
            </li>
          </ul>

            <ul>
              <li>
                <input type="checkbox" checked>
                <i></i>
                <h2><?php echo __('Directories and Listings', 'srft-theme' ); ?></h2>
                <p>
                <?php echo get_post_meta(get_the_ID(), 'Directories', true); ?>
                </p>
              </li>
            </ul>

              <ul>
                <li>
                  <input type="checkbox" checked>
                  <i></i>
                  <h2><?php echo __('Quick Links', 'srft-theme' ); ?></h2>
                  <p>
                  <?php echo get_post_meta(get_the_ID(), 'Quicklinks', true); ?>
                  </p>
                </li>
              </ul>
          </div>
          </section>


<div>
        <p class="page-header-text"><?php echo __('Location & Directions', 'srft-theme'); ?></p>
    </div> 

<div class="contaactus_map"><iframe title="Map to Satyajit Ray Film &amp; Television Institute" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=SRFTI,+Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;aq=0&amp;oq=srfti+kolkata&amp;sll=37.0625,-95.677068&amp;sspn=37.462243,86.572266&amp;ie=UTF8&amp;hq=SRFTI,&amp;hnear=Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;t=m&amp;ll=22.486017,88.394934&amp;spn=0.008074,0.012007&amp;output=embed" width="100%" height="750" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>
<small><a style="color: #0000ff; text-align: left;" href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=SRFTI,+Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;aq=0&amp;oq=srfti+kolkata&amp;sll=37.0625,-95.677068&amp;sspn=37.462243,86.572266&amp;ie=UTF8&amp;hq=SRFTI,&amp;hnear=Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;t=m&amp;ll=22.486017,88.394934&amp;spn=0.008074,0.012007">View Larger Map</a></small></div>

</div>
        
</main>

<?php get_footer(); ?>

