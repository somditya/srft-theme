<?php
/**
 * SRFTI Cookie Consent Banner
 * DBIM 3.0 + GIGW 3.0 + DPDP Act 2023
 * Theme : srfti-theme
 */

if ( defined( 'ABSPATH' ) === false ) {
    exit;
}
?>

<div
    id="srfti-cookie-banner"
    class="srfti-cookie-banner"
    role="dialog"
    aria-modal="true"
    aria-labelledby="cookie-banner-title"
    aria-describedby="cookie-banner-description"
>

    <div class="cookie-banner-container">

        <div class="cookie-banner-content">

            <div class="cookie-banner-icon" aria-hidden="true">
                <svg width="42" height="42" viewBox="0 0 48 48" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="24" r="24" fill="#A6E1DA"/>
                    <path d="M24 10C18.5 10 14 14.5 14 20V23C14 30 18.2 36.3 24 38C29.8 36.3 34 30 34 23V20C34 14.5 29.5 10 24 10Z"
                          fill="#005B5C"/>
                    <path d="M20.5 24L23.5 27L28.5 21"
                          stroke="white"
                          stroke-width="2.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="cookie-banner-text">

                <h2 id="cookie-banner-title">
                    <?php _e('Cookie Consent', 'srft-theme'); ?>
                </h2>

                <p id="cookie-banner-description">
                    <?php _e(
                        'SRFTI uses essential cookies to make this website function properly. With your permission, we also use functional, analytics and social media cookies to improve your browsing experience, remember your preferences and measure website performance. You may accept all cookies, reject all optional cookies or customise your preferences. Your consent can be changed at any time from Cookie Settings.',
                        'srft-theme'
                    ); ?>
                </p>

                <!--<div class="cookie-banner-links">
                    <a href="<?php echo esc_url(home_url('/website-policy')); ?>#cookie-policy">
                        <?php _e('Read Cookie Policy', 'srft-theme'); ?>
                    </a>
                </div>-->

            </div>
        </div>

        <div class="cookie-banner-actions">

           <button
    id="cookie-customize-btn"
    class="cookie-btn cookie-btn-outline"
    type="button"
    onclick="var m = document.getElementById('srfti-cookie-modal'); if(m) { m.removeAttribute('hidden'); m.style.display='flex'; } else { alert('ERROR: The modal HTML is missing! Check your cookie-settings-modal.php file.'); }"
>
    <?php _e('Cookie Settings', 'srft-theme'); ?>
</button>

            <button
                id="cookie-reject-btn"
                class="cookie-btn cookie-btn-secondary"
                type="button"
            >
                <?php _e('Deny All', 'srft-theme'); ?>
            </button>

            <button
                id="cookie-accept-btn"
                class="cookie-btn cookie-btn-primary"
                type="button"
            >
                <?php _e('Accept All', 'srft-theme'); ?>
            </button>

        </div>

    </div>

</div>

<!-- Floating Cookie Settings Button -->
<button
    id="cookie-floating-settings"
    class="cookie-floating-settings"
    aria-label="<?php esc_attr_e('Cookie Settings', 'srft-theme'); ?>"
>

    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 2L14.09 4.26L17 4L17.74 6.91L20.65 7.65L20 10.56L22.26 12L20 13.44L20.65 16.35L17.74 17.09L17 20L14.09 19.74L12 22L9.91 19.74L7 20L6.26 17.09L3.35 16.35L4 13.44L1.74 12L4 10.56L3.35 7.65L6.26 6.91L7 4L9.91 4.26L12 2Z"
              fill="#005B5C"/>
        <circle cx="12" cy="12" r="3" fill="white"/>
    </svg>

    <span><?php _e('Cookie Settings', 'srft-theme'); ?></span>

</button>