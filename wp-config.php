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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'mdb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'VCeQnMuVS[GlM]q&ouA,$o`7E^?FV=W+)8!I$^r^(}!+XSwzSrb@zZl$?[yiQ,jD');
define('SECURE_AUTH_KEY',  '+|(z_7&,}iC`.}_Y{f80,; =&:V+v-`G}$|nDZV]#IbCGqa]N2ElMt&B,V`!-A|,');
define('LOGGED_IN_KEY',    'um9^feE7g5#N@]zg2Ic4xrinN+b%flmvZkwS2JXNFfk-f~)Sb$fwnyI<A~c/BHE(');
define('NONCE_KEY',        '#y6L1O.qCi4KomE2`9j*9`/cnco!g-g&K=o%$L[RqcFPv&oTQ- =4)0qCbi0nf*T');
define('AUTH_SALT',        '.DA^Om8Itg.{?8zl7868e)K%<$FVQ`N|Dx7&dqDQ=H _VL%T :+H:w|]B`sbd{{o');
define('SECURE_AUTH_SALT', 'dyudr[decJCa&Z&=HmV*hJtp>f: h^r^:z*_l#gsC]Nvfak+v6+s=>3xD@Jyd0-?');
define('LOGGED_IN_SALT',   'H2?s8r`r4#Xfc:CdI3]})A~FpN<SDR4TOM21C+Xv&~m97bGDmOvYvtkY8}B=8>!o');
define('NONCE_SALT',       'H&d*J;.3vJ!w.WM8 ]Y:j8e6o=(O*U @p-rUG_$=}Q?Wh{Uj&!UU@T#MP[yC(JAP');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
