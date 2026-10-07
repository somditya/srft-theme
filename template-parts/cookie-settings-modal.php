<?php
/**
 * SRFTI Cookie Settings Modal
 * Single Column Stacked Layout
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
        <button
            id="close-cookie-modal"
            class="cookie-modal-close-btn"
            type="button"
            aria-label="<?php esc_attr_e( 'Close Dialog', 'srft-theme' ); ?>"
        >
            <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
                focusable="false"
            >
                <path d="M18 6L6 18M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Header / Intro -->
        <div class="cookie-modal-header-simple">

            <h2
                id="cookie-settings-title"
                class="sr-only"
            >
                <?php esc_html_e( 'Cookie Settings', 'srft-theme' ); ?>
            </h2>

            <p class="cookie-intro-text">
                <?php
                esc_html_e(
                    'Welcome to the Cookie Settings page, where you have the power to tailor your browsing experience. Here, you\'ll find detailed information about the cookies we use, categorized as "Essential" and "Optional." Make informed choices that align with your privacy preferences.',
                    'srft-theme'
                );
                ?>
            </p>

        </div>

        <!-- Body / Toggles -->
        <div class="cookie-modal-body-simple">

            <!-- ESSENTIAL COOKIES -->
            <h3 class="cookie-section-title">
                <?php esc_html_e( 'ESSENTIAL COOKIES', 'srft-theme' ); ?>
            </h3>

            <!-- Session Cookies -->
            <div class="cookie-toggle-row">

                <div class="cookie-toggle-text">

                    <h4 id="label-session">
                        <?php esc_html_e( 'Session Cookies', 'srft-theme' ); ?>
                    </h4>

                    <p class="cookie-sub-desc">
                        <?php
                        esc_html_e(
                            'Ensures user session persistence, allowing seamless navigation on the website.',
                            'srft-theme'
                        );
                        ?>
                        <br>
                        <em>
                            <?php
                            esc_html_e(
                                '(Essential for site functionality)',
                                'srft-theme'
                            );
                            ?>
                        </em>
                    </p>

                </div>

                <div class="cookie-toggle-control">

                    <span
                        class="toggle-label"
                        aria-hidden="true"
                    >
                        <?php esc_html_e( 'Off', 'srft-theme' ); ?>
                    </span>

                    <label
                        class="cookie-toggle"
                        for="session-cookies-toggle"
                    >
                        <input
                            type="checkbox"
                            id="session-cookies-toggle"
                            role="switch"
                            checked
                        >

                        <span class="sr-only">
                            <?php esc_html_e( 'Session Cookies', 'srft-theme' ); ?>
                        </span>

                        <span
                            class="cookie-toggle-slider"
                            aria-hidden="true"
                        ></span>
                    </label>

                    <span
                        class="toggle-label"
                        aria-hidden="true"
                    >
                        <?php esc_html_e( 'On', 'srft-theme' ); ?>
                    </span>

                </div>

            </div>

            <!-- Persistent Cookies -->
            <div class="cookie-toggle-row">

                <div class="cookie-toggle-text">

                    <h4 id="label-persistent">
                        <?php esc_html_e( 'Persistent cookies', 'srft-theme' ); ?>
                    </h4>

                    <p class="cookie-sub-desc">
                        <?php
                        esc_html_e(
                            'Remembers user preferences, such as language and region settings, for a personalized browsing experience.',
                            'srft-theme'
                        );
                        ?>
                        <br>
                        <em>
                            <?php
                            esc_html_e(
                                '(Personalization)',
                                'srft-theme'
                            );
                            ?>
                        </em>
                    </p>

                </div>

                <div class="cookie-toggle-control">

                    <span
                        class="toggle-label"
                        aria-hidden="true"
                    >
                        <?php esc_html_e( 'Off', 'srft-theme' ); ?>
                    </span>

                    <label
                        class="cookie-toggle"
                        for="persistent-cookies-toggle"
                    >
                        <input
                            type="checkbox"
                            id="persistent-cookies-toggle"
                            role="switch"
                            checked
                        >

                        <span class="sr-only">
                            <?php esc_html_e( 'Persistent cookies', 'srft-theme' ); ?>
                        </span>

                        <span
                            class="cookie-toggle-slider"
                            aria-hidden="true"
                        ></span>
                    </label>

                    <span
                        class="toggle-label"
                        aria-hidden="true"
                    >
                        <?php esc_html_e( 'On', 'srft-theme' ); ?>
                    </span>

                </div>

            </div>

            <!-- OPTIONAL COOKIES -->
            <h3 class="cookie-section-title mt-4">
                <?php esc_html_e( 'OPTIONAL COOKIES', 'srft-theme' ); ?>
            </h3>

            <!-- Preference / Functionality Cookies -->
            <div class="cookie-toggle-row">

                <div class="cookie-toggle-text">

                    <h4 id="label-preference">
                        <?php
                        esc_html_e(
                            'Preference/functionality cookies',
                            'srft-theme'
                        );
                        ?>
                    </h4>

                    <p class="cookie-sub-desc">
                        <?php
                        esc_html_e(
                            'Remembers user preferences, such as language and region settings, for a personalized browsing experience.',
                            'srft-theme'
                        );
                        ?>
                        <br>
                        <em>
                            <?php
                            esc_html_e(
                                '(Personalization)',
                                'srft-theme'
                            );
                            ?>
                        </em>
                    </p>

                </div>

                <div class="cookie-toggle-control">

                    <span
                        class="toggle-label"
                        aria-hidden="true"
                    >
                        <?php esc_html_e( 'Off', 'srft-theme' ); ?>
                    </span>

                    <label
                        class="cookie-toggle"
                        for="optional-cookies-toggle"
                    >
                        <input
                            type="checkbox"
                            id="optional-cookies-toggle"
                            role="switch"
                        >

                        <span class="sr-only">
                            <?php
                            esc_html_e(
                                'Preference/functionality cookies',
                                'srft-theme'
                            );
                            ?>
                        </span>

                        <span
                            class="cookie-toggle-slider"
                            aria-hidden="true"
                        ></span>
                    </label>

                    <span
                        class="toggle-label"
                        aria-hidden="true"
                    >
                        <?php esc_html_e( 'On', 'srft-theme' ); ?>
                    </span>

                </div>

            </div>

        </div>

        <!-- Footer -->
        <div class="cookie-modal-footer-simple">

            <button
                id="save-cookie-prefs-btn"
                class="cookie-btn cookie-btn-dark"
                type="button"
            >
                <?php esc_html_e( 'SAVE PREFERENCES', 'srft-theme' ); ?>
            </button>

        </div>

    </div>
</div>