<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
/**define( 'DB_NAME', 'u963641889_3Gesh' ); */
define( 'DB_NAME', 'u963641889_stage' );
/** Database username */
/**define( 'DB_USER', 'u963641889_VrqI2' );*/
define( 'DB_USER', 'u963641889_srfti' );
/** Database password */
/**define( 'DB_PASSWORD', 'RUiviqvnYb' ); */
define( 'DB_PASSWORD', 'Gr@dient#94' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '@H:#$_W]`/]`+%f;*R!{#U+#/]lUkn%EaS,PH<<ZeOOu3P=jL@iU[e ub$prl&V5' );
define( 'SECURE_AUTH_KEY',   'BeoI|aAWt8N,BHC<w[iN#Fut_s7de}S{vL0S1x6iV|-158jX]W@lP9fI, V5_VON' );
define( 'LOGGED_IN_KEY',     'k$=bjdCnFi43ch-;Db`WrBP4wR>7{^>TY-L],>I}ls?V9}L%Xu4X58pfB-SIXYX+' );
define( 'NONCE_KEY',         '*.H%zb40hF[8*9KZA0GFrx@|L-vsv.nOcWZ7>_rPb{/|h-H<wlLA.i%@?=Xlx%l&' );
define( 'AUTH_SALT',         'I_d(=nM-yN-yJOz8hcW`~!#j0g#)eBy*lImXL7F2nflF?xV?{M7b+RjSI9O=0]z!' );
define( 'SECURE_AUTH_SALT',  'GED,[O=vRqHkvH2@`A[P8~]KO-fH .0o]OG.N8`~H<#Q4)+3NCZn:5y1-5nJ/qrp' );
define( 'LOGGED_IN_SALT',    '@&Wh(T2|W|RVLf#38dSwR5pAwnqOd=Ty5gpQ,-]e,([yo|`_8!v!V?b|U&;tQPuH' );
define( 'NONCE_SALT',        '!c^;<!lqO{tF{=j_c^1eYv/ohlS&bKtNTRnx_U!(-`d*Fl3t)y|18S5*3[1a 4#G' );
define( 'WP_CACHE_KEY_SALT', 'pD|y+EB*l<1|i_|Y><<Z(Xf +o~ggV;xTx(:@5W}A6r=Xksm*XJY3_>3<U|r9pEy' );
define( 'WP_HOME', 'https://staging.srfti.ac.in/' );
define( 'WP_SITEURL', 'https://staging.srfti.ac.in/' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
*/ 
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false);
}

/*define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
*/

define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
