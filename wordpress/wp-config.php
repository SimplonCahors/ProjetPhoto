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
define('DB_NAME', 'projet_photo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Mellet082217');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'q-fmo!c(xQ8kk*5dEQW^6:,^#6Sq_Z1)+7_d/[r,(OrYa@y+Y|On.4h nF)bWlKz');
define('SECURE_AUTH_KEY',  '*=Eya9(DQ2{yk`L+B8},Ihy68JHP!>RBu-lPR<^Vf?yEt73|&m/7mTe!>&<n_5<!');
define('LOGGED_IN_KEY',    '^G=/tkiLdY9?E9!6dy2.N+wp%[T=PAzc-BO}8|;1[?O@Z:BGaX}@Z_U:oFqlX3P^');
define('NONCE_KEY',        '&oVc+W6uFr+vfhN;;&@1}};dP8m_Jl[fleEgC[mFOZRCVN01bm}d!TkMC|=KBe%v');
define('AUTH_SALT',        'V@^ij+cGyBNGDtYjfFT4zNmxI@>~D}w{uX k>bQ:;}hk,<,nIQ_H;<0 Fvyu^3]=');
define('SECURE_AUTH_SALT', '/Z2%AWP&{SC/a<G<W]s.):=1K{t.C+a#= a+PNnFEq/ez+Oa>soahsT{z-T*HGGc');
define('LOGGED_IN_SALT',   'Ssuy,qK-g{p?t1@Lebf[GEh/Z@,p_p5gUf^4+N2vpI:TR6|]+/eh=]7d`#en8`g)');
define('NONCE_SALT',       'u|#;n7XNJa7k2Nbf^2G(G,lREzMph@,0V]H2._|6`bZyAZf4Mn:2ISP22L.V^ke.');

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
