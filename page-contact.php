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
           
                    <h2><?php echo __('Satyajit Ray Film & Television Institute', 'srft-theme'); ?></h2>
                         <p><span><svg width="24" height="36" viewBox="0 0 55 68" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M27.418 33.5303C29.093 33.5303 30.525 32.9339 31.714 31.7409C32.9036 30.548 33.4984 29.114 33.4984 27.4391C33.4984 25.7641 32.9019 24.3319 31.7089 23.1423C30.516 21.9533 29.0818 21.3587 27.4062 21.3587C25.7313 21.3587 24.2993 21.9552 23.1103 23.1482C21.9207 24.3411 21.3259 25.7753 21.3259 27.4509C21.3259 29.1258 21.9224 30.5578 23.1153 31.7468C24.3083 32.9358 25.7425 33.5303 27.418 33.5303ZM27.4121 59.28C33.9986 53.3837 39.0389 47.7282 42.533 42.3133C46.0271 36.8985 47.7742 32.1559 47.7742 28.0855C47.7742 21.9479 45.8243 16.9023 41.9245 12.9486C38.0247 8.99496 33.1872 7.01812 27.4121 7.01812C21.6371 7.01812 16.7996 8.99496 12.8998 12.9486C9.00001 16.9023 7.05011 21.9479 7.05011 28.0855C7.05011 32.1559 8.79716 36.8985 12.2913 42.3133C15.7854 47.7282 20.8257 53.3837 27.4121 59.28ZM27.4121 66C18.9392 58.6583 12.5856 51.8258 8.35135 45.5025C4.11712 39.1786 2 33.3729 2 28.0855C2 20.3162 4.51299 14.0263 9.53897 9.21576C14.5655 4.40525 20.5232 2 27.4121 2C34.301 2 40.2588 4.40525 45.2853 9.21576C50.3113 14.0263 52.8243 20.3162 52.8243 28.0855C52.8243 33.3729 50.7072 39.1786 46.4729 45.5025C42.2387 51.8258 35.8851 58.6583 27.4121 66Z" fill="#555"/>
</svg></span><?php echo __('E.M. Bypass Road, Panchasayar', 'srft-theme'); ?></p>
        <p><?php echo __('Kolkata-700094', 'srft-theme'); ?></p>
        <p><?php echo __('West Bengal', 'srft-theme'); ?></p>
        <p><span><svg width="24" height="24" viewBox="0 0 68 68" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M62.0104 66C54.9158 66 47.7882 64.3504 40.6278 61.0513C33.4679 57.7522 26.8894 53.0984 20.8922 47.0899C14.8957 41.0808 10.2478 34.502 6.94871 27.3534C3.64957 20.2055 2 13.0842 2 5.98965C2 4.84957 2.37647 3.89961 3.12941 3.13976C3.88235 2.37992 4.82353 2 5.95294 2H18.2315C19.1821 2 20.0207 2.31028 20.7473 2.93082C21.4739 3.55075 21.936 4.31686 22.1336 5.22918L24.2918 16.3059C24.4411 17.3336 24.4097 18.2168 24.1976 18.9553C23.9849 19.6938 23.6035 20.314 23.0532 20.816L14.3586 29.28C15.7578 31.8425 17.3565 34.2667 19.1548 36.5525C20.9525 38.8376 22.8988 41.0202 24.9939 43.1002C27.0595 45.1664 29.2555 47.0852 31.5821 48.8565C33.9087 50.6278 36.421 52.2761 39.1191 53.8014L47.5671 45.28C48.1562 44.667 48.8696 44.2372 49.7073 43.9906C50.5443 43.7446 51.4143 43.6844 52.3172 43.8099L62.7708 45.9388C63.7214 46.1898 64.4973 46.6748 65.0984 47.3939C65.6995 48.1129 66 48.9286 66 49.8409V62.0471C66 63.1765 65.6201 64.1176 64.8602 64.8706C64.1004 65.6235 63.1504 66 62.0104 66ZM11.6866 23.9369L18.4056 17.5078C18.5261 17.4111 18.6045 17.2784 18.6409 17.1096C18.6773 16.9409 18.6714 16.784 18.6231 16.6391L16.9864 8.22588C16.938 8.03326 16.8536 7.88863 16.7332 7.792C16.6127 7.69537 16.4558 7.64706 16.2626 7.64706H8.21176C8.06682 7.64706 7.94604 7.69537 7.84941 7.792C7.75341 7.88863 7.70541 8.00941 7.70541 8.15435C7.89804 10.7269 8.31906 13.3402 8.96847 15.9944C9.61725 18.6491 10.5233 21.2966 11.6866 23.9369ZM44.4395 56.4725C46.9349 57.6358 49.5376 58.5252 52.2475 59.1407C54.9581 59.7556 57.4908 60.1211 59.8456 60.2372C59.9906 60.2372 60.1114 60.1889 60.208 60.0922C60.3046 59.9956 60.3529 59.8748 60.3529 59.7299V51.8099C60.3529 51.6166 60.3046 51.4598 60.208 51.3393C60.1114 51.2188 59.9667 51.1344 59.7741 51.0861L51.8682 49.4786C51.7233 49.4303 51.5965 49.4243 51.488 49.4607C51.3795 49.4971 51.2646 49.5755 51.1435 49.696L44.4395 56.4725Z" fill="#555"/>
</svg></span>91-33-2432-8355, 2432-8356, 2432-9300</p>
        <p><span><svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="24px" fill="#555"><path d="M140-160q-24 0-42-18t-18-42v-520q0-24 18-42t42-18h680q24 0 42 18t18 42v520q0 24-18 42t-42 18H140Zm340-302L140-685v465h680v-465L480-462Zm0-60 336-218H145l335 218ZM140-685v-55 520-465Z"/></svg> </span>contact[at]srfti[dot]ac[dot]in</p>

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
