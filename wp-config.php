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
define( 'DB_NAME', 'wp_travel' );

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
define( 'AUTH_KEY',         'QM9EG FreFK^^8=MiDVLW;d 9R2_--v,4Pi4t:M{amveQ*bnK#[.TmARz,#=i$kI' );
define( 'SECURE_AUTH_KEY',  'i-W.~M6akey7NPt0#uYjlLTD/F0>-Sj@{+f@L.Nkk[mFS,.0Kwh08/Z0}SKg-mSJ' );
define( 'LOGGED_IN_KEY',    '9cCVXCR/j-;&;hM}..Ouu}sd=[&weG`w@^3}e;~`<.m?e_m1*#4.q9s2>vE)r|,N' );
define( 'NONCE_KEY',        '3~tl**iE$Pd9G^IjY?p<dMQVrgGV2%Y8uT(FZsh[E)? `0Uk 7r);g<.<*jVFVWh' );
define( 'AUTH_SALT',        'JzCx#zklN!%X$8l?d^3O/(7&n6yj^and#0].g?E1>#*x8(Y*hH6:t+oUn*L[Bpck' );
define( 'SECURE_AUTH_SALT', 'y7Fyp IX-w=Ootz ~6;Q~EEG^O_OIc<f,mG(3YsU 0F]q#`k{AIsJhes(rsPGyxN' );
define( 'LOGGED_IN_SALT',   'eUqO1]mM0!8!<I*qb)Y z`:VsR(r~t*e*cQIuA74H6jP87kybj(^>4%v,#*6sl)r' );
define( 'NONCE_SALT',       '{]<mAp>geiaRc8Rpm#^{xJ[e<i:+VOk;T1>`S{ljD_&(1n=&n~<DcW3#~Jp;uKkD' );

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
