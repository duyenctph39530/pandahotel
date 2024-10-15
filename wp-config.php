<?php
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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */
define('WP_MEMORY_LIMIT', '512M');


// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hotel' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



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
define( 'AUTH_KEY',         'vlJ0gAOPRbOUW7zltAD0zkvRNpNxa7S6C3HQU64FX1hZg3fHRvbATlwUSc8adn9g' );
define( 'SECURE_AUTH_KEY',  'lcbucDCIvgrMSOunIgfLvPPtbaYLZjnaDS7l7R9ZuTPw8MgOgGy0EoD0nsaqRZme' );
define( 'LOGGED_IN_KEY',    'C9uyW4eNcxZWVAcaQCTIOAyFyt7zFQRceYQzbIJ9Zm1MsJuMNyga1Um1sW6s0AET' );
define( 'NONCE_KEY',        '2oaUh3eJ7q8t5eQsLAL9HQEhAklH0d19t1pQQl8MufgjtLee5Qy61TPiw0sFb5t4' );
define( 'AUTH_SALT',        'mZ08PKxeT1sPFr2vNKwPilyciU3EJaPCT5y6I77aYqtHEgdrsqy3b9VR7uBhQ7wY' );
define( 'SECURE_AUTH_SALT', 'eGWw0rakAKuimnbatPGNnItEQN1s1zZqkna7jOnCwFyOUL7GNrA5RxJsQbhkaq0z' );
define( 'LOGGED_IN_SALT',   'FM8COn2osEAi340elVt45Iq2ge7h3kEM50mZyQZiyBtjg77Y7Y0o7Js7SfrxXRxt' );
define( 'NONCE_SALT',       '9Ht8WFHKtRv2I0gLaIrdfIGlDmVyr79a0aji1mKa5cMZ7EBEfXKgVrj6qj5jmM9T' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
