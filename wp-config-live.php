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

define('FORCE_SSL', true);
define('FORCE_SSL_ADMIN',true);
if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false)  
    $_SERVER['HTTPS']='on';

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
#define( 'DB_NAME', 'lalit_jul20' );
#define( 'DB_NAME', 'wp_thelalit_live' );
define('DB_NAME', 'thelalit_v1');


/** MySQL database username */
#define( 'DB_USER', 'root' );
define( 'DB_USER', 'lalitdb' );

/** MySQL database password */
#define( 'DB_PASSWORD', 'password' );
define( 'DB_PASSWORD', 'Lalitdb!98765' );

/** MySQL hostname */

define( 'DB_HOST', '13.234.63.154' );
#define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

#define( 'WP_DEBUG', true );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
#define( 'AUTH_KEY',         'put your unique phrase here' );
#define( 'SECURE_AUTH_KEY',  'put your unique phrase here' );
#define( 'LOGGED_IN_KEY',    'put your unique phrase here' );
#define( 'NONCE_KEY',        'put your unique phrase here' );
#define( 'AUTH_SALT',        'put your unique phrase here' );
#define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
#define( 'LOGGED_IN_SALT',   'put your unique phrase here' );
#define( 'NONCE_SALT',       'put your unique phrase here' );

define('AUTH_KEY',         ';+x>%P&@2}J4 Rht8ua8nu|n&>fBHG~@Cow69rps_56<ql%^P/|_A>nZjMNYjo#_');
define('SECURE_AUTH_KEY',  'R}iH<hU,+%o@Wcjn2Lh6IaSON<a~K.L:#&.ntI`xgAK|4^+A^z0QM|/r1UZ(qCtK');
define('LOGGED_IN_KEY',    '8_Ii~Mx?1B:N+rnV6^h;S9QH#b.wZUF_SkZgM%de51vQg0U-Y?:tOf%Gg<R:8(sP');
define('NONCE_KEY',        'ht|10%}EQ+0I$=&C7 O~fY[$|,8_7ftOEWSY//291(T:CHe-J]%]WyK]L2/(lAan');
define('AUTH_SALT',        '%*_uJ|2Z?pz=ba{O4mOmGKo[5d&s1$Ci@fnK=rc~t-IM8`ICW]8~ki*RY!O?%mw3');
define('SECURE_AUTH_SALT', 'UrdV-`Haz>]q3{,b,jc?Ts:cG.-)r;1@cBCtT5x7Vk1l- Sf{v|Ykli~7Ao9IIc6');
define('LOGGED_IN_SALT',   'yFpA~-M<rm&}7+G8[~:j! RgC0+o+mr84ds_>|na.nt%R12|#!rItP`MOl`#MubB');
define('NONCE_SALT',       '!:rzq:7k >{d;`R[-Py[u0`k2It3,-Ntw9UzVi56siC{cnE #9E#e7+l#+=|{^+|');

# Localized Language Stuff
define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'WP_SITEURL', 'https://www.thelalit.com' );
define( 'WP_HOME', 'https://www.thelalit.com' );

#define('WP_SITEURL', 'http://localhost:60');
#define('WP_HOME', 'http://localhost:60');

define( 'WP_MEMORY_LIMIT', '256M' );


define('ENV', 'production');

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

@ini_set( 'upload_max_size' , '12M' );
@ini_set( 'post_max_size', '13M');
@ini_set( 'memory_limit', '15M' );

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
