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
define('DB_NAME', 'Robbwhitewood');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'yN$3CWiB_-3zlU1$OAJ+r5/{NzJ-Q ^YZ*TCvn4qQ$/*&|oOk)+O cVVH$owR7aY');
define('SECURE_AUTH_KEY',  'cN$i4^.G$3x{TGpqsh!C~Fa+20ni31<E(6:f&k`ws%i~N+0?(UM?6@DzVnZ=]aL|');
define('LOGGED_IN_KEY',    'gco;lXR/DC+p`O||25qjen]P@jz+ 8+wz+3K!x(RPJWl$~e!y+]HQD`Wi-C_]WAW');
define('NONCE_KEY',        'n&f%Xv#US?I{?oQ1Me4}dH|L+;|6CoM%_A@_.OkBF:01<88vc5FGOzo_QZ7eR#aa');
define('AUTH_SALT',        ' gR(mA0|UL~^)SyjD:[ 6?P#O`T-Om8[p|f}-^vB-euM.L?82-a#&ee-xJs&7?WA');
define('SECURE_AUTH_SALT', '] j= .guEHhcce+;$D9v3-hWvgWl|bbD)GY;JueuA^6TKm4,Z]c]$Un%_2/G7%o|');
define('LOGGED_IN_SALT',   '-h=6+Dcnfg3!$ON6R)4 xCr|Yl(5ic[(*+gmU*w]Ei/r{)/##%b qD_]!1p?3]Ae');
define('NONCE_SALT',       ')C(sWZ#>lJ->olf|[2`b#`E;Vu|-B-l8> ZKLVxTa7&eK(wn<+z8SGFgaP9aHvVX');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
