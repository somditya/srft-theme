<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>
<main>
    <section  class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
            <h2 class="page-banner-title"><?php echo __('Connect With Us', 'srft-theme'); ?></h2>
        </div>
    </section>

    <section id="skip-to-content" class="cine-detail">
        <div class="leftnav">
            <div class="widget" style=" margin-top: 10px;    line-height: 1.5">
           
                    <h3><?php echo __('Satyajit Ray Film & Television Institute', 'srft-theme'); ?></h3>
                        <ul>
                          <li><?php echo __('E.M. Bypass Road, Panchasayar', 'srft-theme'); ?></li>
                          <li><?php echo __('Kolkata-700094', 'srft-theme'); ?></li>
                          <li><?php echo __('West Bengal', 'srft-theme'); ?></li>
                          <li><?php echo __('Phone:', 'srft-theme'); ?><span> 91-33-2432-8355, 2432-8356, 2432-9300 </span></li>
                          <li><?php echo __('email:', 'srft-theme'); ?><span> contact[at]srfti[dot]ac[dot]in</span></li>
                        </ul>
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
            <section class="page-title">
                <div>
                    <h2 class="page-header-text"><?php echo esc_html($post->post_title); ?></h2>
                </div>
            </section>


            <section class="one-flex1" style="margin-top: 5rem; margin-bottom: 10rem;">
            <div style="margin-bottom: 2rem;">
                <div><?php echo wp_kses_post($post->post_content); ?></div>
            </div>
            
            <div class="accordian">
                    <ul>
                        <li>
                            
                            
                            <h2><?php echo __('Contact a Section', 'srft-theme'); ?></h2>
                            <p><?php echo get_post_meta(get_the_ID(), 'Sections', true); ?></p>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            
                            
                            <h2><?php echo __('Directories and Listings', 'srft-theme'); ?></h2>
                            <p><?php echo str_replace('{site_url}', get_site_url(), get_post_meta(get_the_ID(), 'Directories', true)); ?></p>
                        </li>
                    </ul>
                    <ul>
                        <li>   
                            <h2><?php echo __('Quick Links', 'srft-theme'); ?></h2>
                            <p><?php echo str_replace('{site_url}', get_site_url(), get_post_meta(get_the_ID(), 'Quicklinks', true)); ?></p>
                        </li>
                    </ul>
            </div>
            </section>

            <div>
                <p class="page-header-text"><?php echo __('Location & Directions', 'srft-theme'); ?></p>
            </div>
        </div>

        
    </section>
    <div class="contaactus_map">
            <iframe 
                title="Map to Satyajit Ray Film & Television Institute" 
                src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=SRFTI,+Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;aq=0&amp;oq=srfti+kolkata&amp;sll=37.0625,-95.677068&amp;sspn=37.462243,86.572266&amp;ie=UTF8&amp;hq=SRFTI,&amp;hnear=Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;t=m&amp;ll=22.486017,88.394934&amp;spn=0.008074,0.012007&amp;output=embed" 
                height="750" 
                style="border:0; width:100%;" 
                allowfullscreen 
                loading="lazy">
           </iframe>

                <small><a style="color: #0000ff; text-align: left;" href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=SRFTI,+Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;aq=0&amp;oq=srfti+kolkata&amp;sll=37.0625,-95.677068&amp;sspn=37.462243,86.572266&amp;ie=UTF8&amp;hq=SRFTI,&amp;hnear=Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;t=m&amp;ll=22.486017,88.394934&amp;spn=0.008074,0.012007">View Larger Map</a></small>
    </div>
<?php get_footer(); ?>
