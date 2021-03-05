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
define( 'DB_NAME', 'wp-eval' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

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
define( 'AUTH_KEY',         '=.Q#E%(N2BKC$(a{nf-)cc^AeJ<L-SKwAKH.=!0^}P :Pmt,Q2Od[n_uO{Uifi4W' );
define( 'SECURE_AUTH_KEY',  'sn0Br>y4R71pR qv?UhGchs0<1,2(ZG. ~vY;w-$?~;b22-P//fo?{rE]<-o)+p0' );
define( 'LOGGED_IN_KEY',    '3Hj 87fRt:Zh9i[_JXeh_WkWG?m)R2W<0n6i!sHh={f_cVICsv<a$uurDF=a5_M9' );
define( 'NONCE_KEY',        ']:`0k3k5;/Xm~uw&W$MqJPP0~;w<}m0uBigLB}ay/cisv29,02GZnp~yh/M%)h)I' );
define( 'AUTH_SALT',        'enTfNVY!$8]{^k#%0nM^k.H4 eAhPa53mBnkNUg7G!ybb;LiiLFWtA`y 64o+x#m' );
define( 'SECURE_AUTH_SALT', '5TEPSWzH{@Wrcm^dL2bi5nm<}Ncl%eX|.?0^X*K}@*N1@btP0fR!ec# 2AN6eaF;' );
define( 'LOGGED_IN_SALT',   '7$-%WME<oHp<))Z:)JWjd<X.#UI(Qkf^3{Tl(`y`Hj%W@w,15uJ9t*LR.7lo>h*R' );
define( 'NONCE_SALT',       'E2-iuY;fy$|A4Cj&r+]UZ5nrDZaq-zHlRk-A68b@z ,IDWJBcdXxZytPi>u)Dr`t' );
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
