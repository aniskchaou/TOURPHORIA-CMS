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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'tourphoria' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'k]j UEX^LkU<ko5sIJBZ e$!Y:8gOBV/$$}Ec=EJ%]R}[|%Ha!T{<K^6<x&ODc#R' );
define( 'SECURE_AUTH_KEY',  'cw~GlQd#e5fAXe%ae-%l~2Ya]BIh2+?ReQ265nfEEiNeDWFMEStJ|:~mu,0~U8$a' );
define( 'LOGGED_IN_KEY',    'cQ0sB}zhdhE/0-X5trGviOgvV3]_4_*!<Isbz+0= JD+&++ =Icb4}mR )]8(xdH' );
define( 'NONCE_KEY',        '=Rv Tp];>3+Jux-$gm Q6UN]NaQXR`b;;E2OS<KLq#AiRhE$eX*qkfSIv`x@YI+i' );
define( 'AUTH_SALT',        '?x](!0YjC6ZDMN?F812gu(s8@d+bxLx_>m4#0H,sTCov,y6MU_|qa0UU<U;anU7^' );
define( 'SECURE_AUTH_SALT', 'S3WXNX)|3Jx&de3Y^!.LQ>f,(Bm,/mIf.Th)K=1dzf>U~{!,i8P]<0?:!Z;Ei*9q' );
define( 'LOGGED_IN_SALT',   'K9/rq9!FZK8<Yw nRp,10g#1Je/.CYCL.vLz1L}tPkO}K541pEQ-X.Rn1nIS&h*u' );
define( 'NONCE_SALT',       'h9uwY(b`[c~A^eCYz0b*4)0!%bq+vCgl2kz@4if6UYacv&*7RE=W-9pb+>HIo~,O' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
