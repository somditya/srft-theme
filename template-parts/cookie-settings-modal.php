<?php
/**
 * SRFTI Cookie Settings Modal (Single Column Stacked Layout)
 */
if ( defined( 'ABSPATH' ) === false ) {
    exit;
}
?>
<div 
    id="srfti-cookie-modal" 
    class="cookie-modal-overlay" 
    role="dialog" 
    aria-modal="true" 
    aria-labelledby="cookie-settings-title" 
    tabindex="-1"
    hidden
>
    <div class="cookie-modal-container">
        
        <!-- Close Button -->
        <button id="close-cookie-modal" class="cookie-modal-close-btn" aria-label="<?php esc_attr_e('Close Dialog', 'srft-theme'); ?>">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M18 6L6 18M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Header / Intro -->
        <!-- Header / Intro -->
        <div class="cookie-modal-header-simple">
            <h2 id="cookie-settings-title" class="sr-only" style="display:none;"><?php _e('Cookie Settings', 'srft-theme'); ?></h2>
            <p class="cookie-intro-text">
                <?php _e('Welcome to the Cookie Settings page, where you have the power to tailor your browsing experience. Here, you\'ll find detailed information about the cookies we use, categorized as "Essential" and "Optional." Make informed choices that align with your privacy preferences. For more details, please read our', 'srft-theme'); ?> 
                <a href="<?php echo esc_url(home_url('/website-policy')); ?>#cookie-policy" class="cookie-policy-link">
                    <?php _e('Cookie Policy', 'srft-theme'); ?>
                </a>.
            </p>
        </div>  

        <!-- Body / Toggles -->
        <div class="cookie-modal-body-simple">
            
            <!-- ESSENTIAL COOKIES SECTION -->
            <h3 class="cookie-section-title"><?php _e('ESSENTIAL COOKIES', 'srft-theme'); ?></h3>
            
            <!-- Session Cookies -->
            <div class="cookie-toggle-row">
                <div class="cookie-toggle-text">
                    <h4 id="label-session"><?php _e('Session Cookies', 'srft-theme'); ?></h4>
                    <p class="cookie-sub-desc"><?php _e('Ensures user session persistence, allowing seamless navigation on the website.', 'srft-theme'); ?><br><em><?php _e('(Essential for site functionality)', 'srft-theme'); ?></em></p>
                </div>
                <div class="cookie-toggle-control">
                    <span class="toggle-label" aria-hidden="true"><?php _e('Off', 'srft-theme'); ?></span>
                    <label class="cookie-toggle">
                        <input type="checkbox" id="session-cookies-toggle" role="switch" aria-labelledby="label-session" checked>
                        <span class="cookie-toggle-slider"></span>
                    </label>
                    <span class="toggle-label" aria-hidden="true"><?php _e('On', 'srft-theme'); ?></span>
                </div>
            </div>

            <!-- Persistent Cookies -->
            <div class="cookie-toggle-row">
                <div class="cookie-toggle-text">
                    <h4 id="label-persistent"><?php _e('Persistent cookies', 'srft-theme'); ?></h4>
                    <p class="cookie-sub-desc"><?php _e('Remembers user preferences, such as language and region settings, for a personalized browsing experience.', 'srft-theme'); ?><br><em><?php _e('(Personalization)', 'srft-theme'); ?></em></p>
                </div>
                <div class="cookie-toggle-control">
                    <span class="toggle-label" aria-hidden="true"><?php _e('Off', 'srft-theme'); ?></span>
                    <label class="cookie-toggle">
                        <input type="checkbox" id="persistent-cookies-toggle" role="switch" aria-labelledby="label-persistent" checked>
                        <span class="cookie-toggle-slider"></span>
                    </label>
                    <span class="toggle-label" aria-hidden="true"><?php _e('On', 'srft-theme'); ?></span>
                </div>
            </div>

            <!-- OPTIONAL COOKIES SECTION -->
            <h3 class="cookie-section-title mt-4"><?php _e('OPTIONAL COOKIES', 'srft-theme'); ?></h3>
            
            <!-- Preference/Functionality Cookies -->
            <div class="cookie-toggle-row">
                <div class="cookie-toggle-text">
                    <h4 id="label-preference"><?php _e('Preference/functionality cookies', 'srft-theme'); ?></h4>
                    <p class="cookie-sub-desc"><?php _e('Remembers user preferences, such as language and region settings, for a personalized browsing experience.', 'srft-theme'); ?><br><em><?php _e('(Personalization)', 'srft-theme'); ?></em></p>
                </div>
                <div class="cookie-toggle-control">
                    <span class="toggle-label" aria-hidden="true"><?php _e('Off', 'srft-theme'); ?></span>
                    <label class="cookie-toggle">
                        <input type="checkbox" id="optional-cookies-toggle" role="switch" aria-labelledby="label-preference">
                        <span class="cookie-toggle-slider"></span>
                    </label>
                    <span class="toggle-label" aria-hidden="true"><?php _e('On', 'srft-theme'); ?></span>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <div class="cookie-modal-footer-simple">
            <button id="save-cookie-prefs-btn" class="cookie-btn cookie-btn-dark" type="button"><?php _e('SAVE PREFERENCES', 'srft-theme'); ?></button>
        </div>

    </div>
</div>