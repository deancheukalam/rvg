<?php

ini_set('max_execution_time', 300); //300 seconds = 5 minutes
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', "remyvastgoed");
/** MySQL database username */
define('DB_USER', "root");
/** MySQL database password */
define('DB_PASSWORD', "");
/** MySQL hostname */
define('DB_HOST', "localhost");
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
define('AUTH_KEY',         'i56c+xI*JryM];@;`d(OViM8*#<VcKDBKRJQ&uIlWgr;!#,flirTs~Xn.`u[J)O4');
define('SECURE_AUTH_KEY',  'K6fnI=iv$Z~P.BPL!3Fl}-8ZDCcg8PX_)}(Hm`A5a1S=VBQT;9C!R#(48!EPNsd`');
define('LOGGED_IN_KEY',    'Y_] !!{,FcdY([09-7;<f7l69OUl3j6`$S$~l^UOHL&O!{&v{7`h}T@G4X%[TBti');
define('NONCE_KEY',        '0}U)W0]5qAFiQI.#E0g.oI7lsevy3D]YF FHnXH%S.w=KQxf1Xr)S+];}tVp~V`Z');
define('AUTH_SALT',        'cVA_``EsTJ+BsA(n]=_IJ/l@A8:eo`86#$ga|*p(C4{wmNKsz&fRLkdksAavoEc-');
define('SECURE_AUTH_SALT', '2mnIW0vYlW8k_x1ypfPFW^E4)5dUwux_0.6m-XSL`xxtk7l!^e{;$}]LUq<Uy/8U');
define('LOGGED_IN_SALT',   '/c%=M){sKaYbZ>;qCi^61S4Qu|<JL?apVwZ%dhfFz-Nb:TR<)@p$04IuYj/W Tvh');
define('NONCE_SALT',       'Gh_iR1CgGz^UO$XyHLY3!Wp }@+kdaV W!RY)=BKO?^%X?x1GTn}Y42b sdy`o?a');
define( 'WPCF7_ADMIN_READ_CAPABILITY', 'manage_options' );
define( 'WPCF7_ADMIN_READ_WRITE_CAPABILITY', 'manage_options' );
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define( 'WP_DEBUG', false );
define('WP_DEBUG_DISPLAY', false);
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
