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
define( 'DB_NAME', 'resto' );

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
define( 'AUTH_KEY',         'i$BYY(-AVcR?zPs9#ds|%e!Ysqh.eoDCcOz+xFA*Cx-8=[<m`>i,b<-]ucA9L!wY' );
define( 'SECURE_AUTH_KEY',  '&OrQh+;u6OhZrDqZ-r1Vy_.Pn<+>jw$TY-O}{pui;*^iR;D=I`0ZF2IKRdrn~j`o' );
define( 'LOGGED_IN_KEY',    'y,hGAlI@S+ [@RBcH+dMhfF^W0j?USI1}i@#D&[1&v;H r5~ Zqzje2NUu0_XzI!' );
define( 'NONCE_KEY',        ']Fw_;LP00X}&<%dNH5H2=(5T[>`&VI F4@Kj+:Ml)/je8.R~.1}8%MI]&9YbV@`@' );
define( 'AUTH_SALT',        '@]pizgHA!FpJ[O2,#~Rv:zZ]Uc3`M7.&y&PM}[SDI`P@~wrz]n<SrXPSfs }lJX#' );
define( 'SECURE_AUTH_SALT', 'dE 5,%x1h)@^0UV ^;7&UDR|_q/h1o}CrY2T[vytCm56|pxIQg:LUUU~hIe1n%sE' );
define( 'LOGGED_IN_SALT',   'U0(iVV(~UJ.v(*+o__5{t7@wGLDZoJ6*6#|#hK/``7xH)mE#LQ03`y;_OUQpqC+8' );
define( 'NONCE_SALT',       'naCxj^#_WK`,U4nn.I<H DOK@s6*G 4||/@tbz}pIF``PFts }7~],L2:hacT^ 0' );
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
