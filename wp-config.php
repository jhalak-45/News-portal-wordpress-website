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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'meronews' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define( 'JETPACK_DEV_DEBUG', true ); 
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
define( 'AUTH_KEY',         'i)4zV6;EB`eEWr&<WgZt6[@.=u(gtc/0u_5O/P&y6d6!reC`G:mP=XA b46RAU[t' );
define( 'SECURE_AUTH_KEY',  ')bLv1i3zA-G95#Oy}v:1##gntkY1/WnVT>l9)[h0:]1!$Q0x`/xS^XfO/.uP}:]:' );
define( 'LOGGED_IN_KEY',    '%[W&}?f=]|63|Y?KwqXP]{}e>B^weEI!Nc?F}X@]Wu>jVVEdgy%p!ZB#A>Z@)-Yh' );
define( 'NONCE_KEY',        'NU^G{BAoh#y`D`=2Y]K}sXy,%GvjIRv&6P6Oz)[lok(s[?if;LWKLU9rc.[d:cx2' );
define( 'AUTH_SALT',        ';^{=Rf5%,eqzl FhqIPj2x=VdU;3IBo-4ft#ZL~ebx05J(qB[fGmwC{Q3YthsN-q' );
define( 'SECURE_AUTH_SALT', 'PbegdMi|NB/)iJW]hjP_lAz_CB;|i&lm}h%3cOWqpoa:l< N*UPs^T@Y}We!Z9Ni' );
define( 'LOGGED_IN_SALT',   '? h}I F<P~i:.DJ>@;Vq9GhF:?lWsu/f{Bt[SGkpS3=m:HH`#Xsw[THC(}#T73NE' );
define( 'NONCE_SALT',       'WP^H+l4n_eY1^xEgjx75V[`e27Or??ch!]D)fx@~&P2:dl}ZStzP1PcDLwIjF|-T' );

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
