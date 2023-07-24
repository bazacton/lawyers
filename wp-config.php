<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'u312518386_lawyers');

/** MySQL database username */
define('DB_USER', 'u312518386_lawyers');

/** MySQL database password */
define('DB_PASSWORD', 'Ah2o@[dDzTG=');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');



/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'D#!7(+O&r1I~c*Gx)|<sn)z$TAQSRxz0x4P0U/:u,{UGiwQ$hPJg-!qzr^E>DBbe');
define('SECURE_AUTH_KEY',  'NzXmre.L|?-j5c}-[{T #H&J~U_d/U{~Y|o:hx35 G;-GmWek}*|CZ8c4b5i_/$z');
define('LOGGED_IN_KEY',    '`WFwaQ4Rvk`_a9|D0AGzz]2h`9mZHsN h.4mHW$6jb1YAy&9{pE-zivkOU=S&y:T');
define('NONCE_KEY',        'p&|V&|?mek)<D.[GwemyrX67/i81@2c-ab5NCWT~bn7pM=-P:+cJ55(D*HJT+BNc');
define('AUTH_SALT',        '9dN=_ds++.]l+nZQ*[J;h(I|~~~@y-z5?:Mjtd&-M:#&6AYgu:kwkq>rcGCg(2fD');
define('SECURE_AUTH_SALT', ';At3B(];oC$@*z{k04-Z1Z(W4!kcmy^{,q}9=L8(Ussdsil4E0@-<I0F%?4x*4(1');
define('LOGGED_IN_SALT',   ':|t#FdRZzGnV302Q$)<5%Um9&7-$9QnQA CPC}0>D>&8eAn{&&,EPVx85*8~aCXo');
define('NONCE_SALT',       '_np9+fr(-kl%yV1=t(-x96p~(oU=K6(1IA{n_]-sbDx >!8-+LE&#q9|5)HLB,t4');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'lawyer_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
// Enable WP_DEBUG mode
define( 'WP_DEBUG', true );

// Enable Debug logging to the /wp-content/debug.log file
define( 'WP_DEBUG_LOG', true );

// Disable display of errors and warnings
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
