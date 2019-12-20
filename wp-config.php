<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'prettyBougie_wp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'QH*%^O[Qe8?F&alaFz8qB=w-n{ROUGWo/zM2#yAYd0)Sl:>7-C@BLZ^icn?PEl.1' );
define( 'SECURE_AUTH_KEY',  'BWo@W9SE-#8 .@;St/Lk*+fi~%jud9ybpFm*ZI*IwzmH 7&Qf7jvoMs1X;D;fP C' );
define( 'LOGGED_IN_KEY',    'tLT%JNFI~%0;fX{&RNDun)-1=Xv/#R jklFXr1b_t,`sFh3>zY-2o{):96cjxJ`C' );
define( 'NONCE_KEY',        '037rl*ke?1G&jy73/76ecLM m(M-c_!q~jQ<grFB?XaIkQ2v:6nkVg5[~yJN1C&A' );
define( 'AUTH_SALT',        'LknF)Tge[#U |YQ:Ubr&X2xM&xTM0K~>*),e i<hg4(9IgII?EzC7+jDt0~)1cU|' );
define( 'SECURE_AUTH_SALT', 'kos69|J%Br?gGF[^R*u_.>,MU:JOS_#W,_~:PSPI[YM^<>9!8ZNR<C7RhG2#P!_!' );
define( 'LOGGED_IN_SALT',   'boTb/M+I:<DDjjd2NEP&|uq_;y,`,km>Xi;Sop{!@NuK8S,bkRpx.!2KEX1lj!2`' );
define( 'NONCE_SALT',       'x!aGR]iI_-SFWSNXI [`2dYw)mf$@|{&D@O!K:$rRYl`EpmV<*#Y6T?rjSa*,=xw' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
