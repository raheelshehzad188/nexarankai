<?php
define( 'WP_CACHE', true );

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
define( 'DB_NAME', 'u889571259_cleanairblog' );

/** Database username */
define( 'DB_USER', 'u889571259_cleanairblog' );

/** Database password */
define( 'DB_PASSWORD', 'au>DQHyb=R5' );

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
define( 'AUTH_KEY',         '@M0zOPp_K_e *iD@#T4D7k.[BIKY$J`E+eXz-aEO{&g$GH;aQ!pbeeIF?JF_z8z.' );
define( 'SECURE_AUTH_KEY',  'e+p%mOiD/5R!Bz_:-JtDsnT+5#SaS.x|wF?P+Y%|m%Nq9qM>qMt&qgNYV+SbmK=e' );
define( 'LOGGED_IN_KEY',    'x2vQ6:m?.S_eNCWStmM0(i{~8YD/~$nM.Ttb$*m-i,7K)DfH*b}L=bBOc(HibPOC' );
define( 'NONCE_KEY',        '&B>)QBJ;Vjp0/CxSp0Z,_>Z6%`)iFB.nSS=hQvv%:?SpV9-M{-p3T?9@btTb%>EC' );
define( 'AUTH_SALT',        'r?:Sess5j#(h@P*2tF!BJ8SEQ~Y09BtqO[p^`Ha44Wk`vBM+vzvb4}D[CpThpQRI' );
define( 'SECURE_AUTH_SALT', ')E$(ZtC[q C={rw@SuRo<V@~/<c~NH-t(qQD4H6f1M65AuyPC1C>w<gzM.$gzOh!' );
define( 'LOGGED_IN_SALT',   '/:gG%Ewfm{,3}A}HVaXFpjLyw73`+hRpF-ZF!,<=>[8r$^7e>^ov,XBY_6=o[yN_' );
define( 'NONCE_SALT',       'Ng_!J}Q2<uR@Vrj^eI{Jql>G_e(J(-*y/WK`97FnlSG{U;f7ibQlh`f9`l?o=1fy' );

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
$table_prefix = 'aircl_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
