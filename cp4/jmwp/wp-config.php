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
define( 'DB_NAME', 'jmwp' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'admin' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'greta' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '/eHbMbE+d13gpJ:J]}Cc*khNv1coe8g6L^O+;&;:tF?=^~(p)riaf(*q3o*E Tx5' );
define( 'SECURE_AUTH_KEY',  '1lD{FCO0f!Q#CAtmv-n!MrZNbvPx*z CnH=>Sf^1WS%Ce?|Nlw<Jl3&wDV)5|]w_' );
define( 'LOGGED_IN_KEY',    'IsD^!|tf8L(Xb}^){;<DRv,+PQC_JeZQY3}Yo9 z`GbpI^Q<iDyZR3IqC)>b&r5B' );
define( 'NONCE_KEY',        '*7+YT[}4u?{,?_IVCI`Fc&[-B^U;#U.C{I/6v1Mxg.HVhl)4QB8j3o}eF!;K/De4' );
define( 'AUTH_SALT',        '1-[me7APr8x,4A$RIR?r&0Yb9QiGeH=yKo8Y;{]3j13f@OG8$}]%GAx]5(! Eulw' );
define( 'SECURE_AUTH_SALT', 'B7,@G9,:hxbnBd;&9%/GEWWK583fQ/tdNO,b^cj?_)Q0T15@U|Rk=i+BiLDK@Z3-' );
define( 'LOGGED_IN_SALT',   'pcU_esT*i?`)n72re?aR_wO~Wp$Y3wd(]f(8W%5d{fbXg&jwc[-XE[58Y/h/(s$u' );
define( 'NONCE_SALT',       '+*I_tx)=z6?BOIh%1}t(MXDn3fO7@X7tE7v#II tL/B9!mQwudK~d=^v2bOz<<GK' );
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
