<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>
<main>
    <section  class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
            <h1 class="page-banner-title"><?php echo __('Connect With Us', 'srft-theme'); ?></h1>
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
            <div class="widget" style=" margin-top: 10px;    line-height: 1.5">
           
                   <h2 id="institute-address">
        <?php echo esc_html__( 'Communication Address', 'srft-theme' ); ?>
    </h2>

    <p>
        <strong>
            <?php echo esc_html__( 'Satyajit Ray Film & Television Institute', 'srft-theme' ); ?>
        </strong>
    </p>

   <div class="contact-details">

    <!-- Address -->
    <div class="contact-row">
        <span class="location-icon" aria-hidden="true"></span>

        <span class="sr-only">
            <?php echo esc_html__('Address:', 'srft-theme'); ?>
        </span>

        <span class="contact-value">
            <?php echo esc_html__('E.M. Bypass Road, Panchasayar', 'srft-theme'); ?><br>
            <?php echo esc_html__('Kolkata-700094', 'srft-theme'); ?><br>
            <?php echo esc_html__('West Bengal', 'srft-theme'); ?>
        </span>
    </div>


    <!-- Phone -->
    <div class="contact-row">
        <span class="phone-icon" aria-hidden="true"></span>

        <span class="sr-only">
            <?php echo esc_html__('Phone:', 'srft-theme'); ?>
        </span>

        <span class="contact-value">
            +91-33-2432-8355,
            2432-8356,
            2432-9300
        </span>
    </div>


    <!-- Email -->
    <div class="contact-row">
        <span class="email-icon" aria-hidden="true"></span>

        <span class="sr-only">
            <?php echo esc_html__('Email:', 'srft-theme'); ?>
        </span>

        <span class="contact-value">
                contact[at]srfti[dot]ac[dot]in
        </span>
    </div>

</div>


            </div>
        </div>

        <div class="main-content">
            <section class="page-title">
                <div>
                    <h2 class="page-header-text"><?php echo esc_html($post->post_title); ?></h2>
                </div>
            </section>


            <section style="margin-bottom: 2rem;">
            <div style="margin-bottom: 2rem;">
                <div><?php echo wp_kses_post($post->post_content); ?></div>
            </div>
            
            <div>
                    <div class="accordian">        
                            <h2 ><?php echo __('Contact a Section', 'srft-theme'); ?></h2>
                    </div>
                    <p><?php echo get_post_meta(get_the_ID(), 'Sections', true); ?></p>
                    <br role="presentation">

                    <div>
                            <div class="accordian">        
                            <h2><?php echo __('Directories and Listings', 'srft-theme'); ?></h2>
                            </div>
                            <p><?php echo str_replace('{site_url}', get_site_url(), get_post_meta(get_the_ID(), 'Directories', true)); ?></p>
                    </div>
                    <br role="presentation">
                    <div>   
                            <div class="accordian">        
                            <h2><?php echo __('Quick Links', 'srft-theme'); ?></h2>
                            <div>
                            <p><?php echo str_replace('{site_url}', get_site_url(), get_post_meta(get_the_ID(), 'Quicklinks', true)); ?></p>
                    </div>
                    <br role="presentation">

            </div>
            </section>

            <div>
                <p class="page-header-text"><?php echo __('Location & Directions', 'srft-theme'); ?></p>
            </div>
        </div>

        
    </section>
    <div class="contaactus_map">
    <a href="#after-map" class="skip-link">Skip interactive map</a>
    <iframe                  
        aria-label="Location of Satyajit Ray Film & Television Institute, Pancha Sayar, Kolkata"                  
        src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=SRFTI,+Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;aq=0&amp;oq=srfti+kolkata&amp;sll=37.0625,-95.677068&amp;sspn=37.462243,86.572266&amp;ie=UTF8&amp;hq=SRFTI,&amp;hnear=Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;t=m&amp;ll=22.486017,88.394934&amp;spn=0.008074,0.012007&amp;output=embed"                  
        height="750"                  
        style="border:0; width:100%;"                  
        allowfullscreen                  
        loading="lazy">            
    </iframe>
    <div id="after-map"></div>                  
    <small>
        <a style="color: #0000ff; text-align: left;" 
           href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=SRFTI,+Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;aq=0&amp;oq=srfti+kolkata&amp;sll=37.0625,-95.677068&amp;sspn=37.462243,86.572266&amp;ie=UTF8&amp;hq=SRFTI,&amp;hnear=Pancha+Sayar,+Kolkata,+West+Bengal,+India&amp;t=m&amp;ll=22.486017,88.394934&amp;spn=0.008074,0.012007">
            Open in Google Maps
        </a>
    </small>     
</div>
</main>   
<?php get_footer(); ?>
