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
define( 'DB_NAME', 'wp-canek' );

/** MySQL database username */
define( 'DB_USER', 'Canek' );

/** MySQL database password */
define( 'DB_PASSWORD', '123' );

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
define( 'AUTH_KEY',         'e*!oGOh=;kUC_&96X+Img-9UZ024HGQ5&8si}b2vbpo#3eR)SO*J+B5(#9np^l0P' );
define( 'SECURE_AUTH_KEY',  'TNi_0VTbMwY(U$<`DD%C(pG3Bx{jTjY8PjweA`0iBq<2OYUq$`@{Rxr;kk3JJ);E' );
define( 'LOGGED_IN_KEY',    'IP}`J&YQ}&L6|WWYc(M)(,BZRjCl5T22Epb9)7Ub)=t/_,5S[e apI=q((fLMaje' );
define( 'NONCE_KEY',        'x1]e#+wmP$Q{-Q[Y#X BAp0>&~:mh6_:gZ?xp#=VG_XK9G,mSV%+YoFS41&?*U#m' );
define( 'AUTH_SALT',        'A0=U !pt@EN S5sWIY#~8o1F!r|=p/ed>~cD?Wvo&!vsNxF_y|tTWLeufr@}6q5`' );
define( 'SECURE_AUTH_SALT', '{*Nuo76^a A6mE&L2CR/JAf-{UKRdnqG]FT+IZ]]txbM#~PI?mmyR?ns](L+ M([' );
define( 'LOGGED_IN_SALT',   'y*ED@#*_9WOBK>(.VdkG,jn~4(%Z])K>/rZ=0X4O(-^^BgLb2uh]a18k*$&MZJ.4' );
define( 'NONCE_SALT',       'zCMPFPc|)OZyIo#X^CQE|,/T&-rC~k~A`zo[}yBF|1kjx`*k8ax:>D;iU?aS_Hjx' );

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
