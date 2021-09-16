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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'vBma*tRp#<aP1-vMgq>}uurIdtZrhF_!O*~+W#4!xbDveGwMP% <@Bx}$qJl(Q5!' );
define( 'SECURE_AUTH_KEY',  '8mC)zRVVe!CAJhF,5bDVdb_5ZY5>V P,*+9K]v`xs#q(|I#)NxM{Vm#oKRCt]5pw' );
define( 'LOGGED_IN_KEY',    '<v2mtg7E|OO[jBJ>-CbG4l)t*8x*Lv3S4CBbf>s1#^bpVEbn3{%p:$KN$pQ3Dk4I' );
define( 'NONCE_KEY',        'GuwskS.7_Ckr3saDg%D_*fvM*owT3PHD+d+i B)GG#4kOh4H_LY^{k>_8/37K@=R' );
define( 'AUTH_SALT',        '&UW}mhB3_e*}v]O8-pJSx#wBX<C@#s3V>Im65m][!S?me8hmF&6epf[]cTp}bw%C' );
define( 'SECURE_AUTH_SALT', '3X0a<<Zf.=(13C_&&4!n?4acOa*CzbB:B/S2NLi_~g%<4.p^3$E1fK<!hd TPx&L' );
define( 'LOGGED_IN_SALT',   '>Z.Evvl?Y|jT>0Y;j.nhL[jyZm-]&PXa<VgTP{)%oEZI#2kfmqY<Q1X3rohn+6E+' );
define( 'NONCE_SALT',       'MG~h9;^tZN[XRLh[fN]gx1AnUq:Jq?&-*|D@-5jxL>|vHq5D-^_ok{_-1R&xd7k6' );

/**#@-*/

/**
 * WordPress database table prefix.
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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
