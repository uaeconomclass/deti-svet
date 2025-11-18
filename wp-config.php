<?php

//Begin Really Simple Security session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple Security cookie settings
//Begin Really Simple Security key
define('RSSSL_KEY', 'zHSiezDLk9WaYWOvHJcLIOhP25jsxTj4aUdJQ5FUsaY70XStvpGMhMSMQkt7M1Tz');
//END Really Simple Security key
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'yourpon6_wp_1' );

/** Database username */
define( 'DB_USER', 'yourpon6_wp_1' );

/** Database password */
define( 'DB_PASSWORD', 'mB*4&SjX%' );

/** Database hostname */
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
define( 'AUTH_KEY',         'OXJbb.FEWvFxIcm-CP(lh(>?.5&RAOUUvyF.h}&G6Ki!#jmFt|]fMkpBxl1%fi+D' );
define( 'SECURE_AUTH_KEY',  'rtF4lQMZW1S#GqwHFQ~sqr|wZt22w|2v4,YM8QV#Sluu5ExuHQ7i}Q.H%zOV5WsJ' );
define( 'LOGGED_IN_KEY',    'DkZ*)%UE+6}*i?(q%v0r.umSumU,58%9iZPBF[0| f%d>kcVeG*)?jpUAw->t;i{' );
define( 'NONCE_KEY',        'R`f]mizT5K{&#38_p+c>U:#]1JE~FP9m=yzX1urDz{Y37A;-j-{U!]V[ZS$&u<T@' );
define( 'AUTH_SALT',        'NU0gZqY`}..NRuIug]eQkg_zf3:y*PuA*PL-wGkELQci#bD9#K(._PoH,B;8v9:0' );
define( 'SECURE_AUTH_SALT', 'iecTA7S9<*e/Yc@ $a{s%o*P(;c4YL@JI}Ahei3ICV{oH%t850ZvVN`@7ZT$ObTE' );
define( 'LOGGED_IN_SALT',   'kmkCC /1Y-tz4qq-):S_az6(`3W~XYA8iOV^2FgMZqT}9}Go; }ZGj>RWOIJt.om' );
define( 'NONCE_SALT',       ')T>T8bAjCDGoVl/2hsuRc9[<xLUPbg*RVcuNeL} aqoi:1;,BISMdb+-ZRk_$aCB' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
