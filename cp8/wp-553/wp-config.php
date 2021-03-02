<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'wp-553' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'greta' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost/cp8/wp553' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );
define('FS_METHOD','direct');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '*h-^1%^D7k#no&LUS*(Yag%DZF)S=D&Q,>{BoU@Fp`G-)?},:S6/qC$^tOc([|nu' );
define( 'SECURE_AUTH_KEY',  'wteGed0<g~&Dk!]1UIhQUl re|bMsEb0i?tPB(;fU|;<NGr1J4g#X<VsuWt-H%k5' );
define( 'LOGGED_IN_KEY',    'F2+MfDfqo$wzba88j?:yaIb7|1-H8[1)iHUnH<*hECFu1({E1guB5M%jswO8x%!%' );
define( 'NONCE_KEY',        'hs,yw6`J3^zH`b-r-BNhL<bq*$wrMIyjyPFOXOdH/Wo~G+2)y`8%!B%xx[ryV3OW' );
define( 'AUTH_SALT',        '!;&NKi$ Z+-n=Q0i,k(7#XRo|_jRzaqUNyi9sC2mqWAMTw{OWU$qF6uGip$`YrHS' );
define( 'SECURE_AUTH_SALT', '@:{}(1^qKAIVYX }Sf/Z-~K&wZQ]>PTODi),*VYG1F$y*#u&XA36PBs%xXbHkr m' );
define( 'LOGGED_IN_SALT',   'pUh!v}<-kRQG#Q@$/ISNl{6j+/4v&+@+2`BoO^/1EvFsTCR@Pb)8k0gE%7@o`G<2' );
define( 'NONCE_SALT',       'j9BOM*$vL[}<<Y(xx`j~;~DoT$Za&R h^bx-e6[oL^2Pl}xv*)o[9Dw{Ou:O)u@a' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
