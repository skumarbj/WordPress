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
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         '|1X>#*s*5Fv%X3_95L+Xt}v!HGCiFV8dT-$P#A@jd<^f`Txlm&=SnJ@V*(>6d95-' );
define( 'SECURE_AUTH_KEY',  'ffmRW Kt30Be83is!8FxlU7yW|Wr{!7C4YsJM8dr5NT8C3.Bz+JtOo8{Z}|Gr/}v' );
define( 'LOGGED_IN_KEY',    '@HMv#P:t9~YqfoJW;5DPe^Qn~CJ_B&kjHO(zdGbMGBoX4gHG+znFZ;ZwJqi&8eW(' );
define( 'NONCE_KEY',        'BV6^L;Bvn35-HYBb.@;#,5qY8r+i|{0GR7o)VT-[:Fqn^M8FlEN-+xJk Z XRcrq' );
define( 'AUTH_SALT',        'K5E9E~YkCPT4|YMZ}r2f% .q[hyGNC6!H[A<{=.xzxF/%{B_{/0u/+l].zn,$e=T' );
define( 'SECURE_AUTH_SALT', 'HU1uT4+*<Q&$%PC0]d&}u%&oT0c_z-QhZC({oN^!K`=}7x^a%|TG0Obj)AQl@j:S' );
define( 'LOGGED_IN_SALT',   '$eZ,`5Yc`SoYuQ3%O`@nn_N1YhV%BRl;Vo%O!mue:x4,o$4&bn)$ZcL?gVN)DZUJ' );
define( 'NONCE_SALT',       '[@;i.R:@(ES`O-qmAeG XOQ$+]{uRv)$m~=0UpqG:e,|n197QaK$$l0xbO]Q6#2$' );

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
