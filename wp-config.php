<?php

/**
 * In dieser Datei werden die Grundeinstellungen für WordPress vorgenommen.
 *
 * Zu diesen Einstellungen gehören: MySQL-Zugangsdaten, Tabellenpräfix,
 * Secret-Keys, Sprache und ABSPATH. Mehr Informationen zur wp-config.php gibt es
 * auf der {@link http://codex.wordpress.org/Editing_wp-config.php wp-config.php editieren}
 * Seite im Codex. Die Informationen für die MySQL-Datenbank bekommst du von deinem Webhoster.
 *
 * Diese Datei wird von der wp-config.php-Erzeugungsroutine verwendet. Sie wird ausgeführt,
 * wenn noch keine wp-config.php (aber eine wp-config-sample.php) vorhanden ist,
 * und die Installationsroutine (/wp-admin/install.php) aufgerufen wird.
 * Man kann aber auch direkt in dieser Datei alle Eingaben vornehmen und sie von
 * wp-config-sample.php in wp-config.php umbenennen und die Installation starten.
 *
 * @package WordPress
 */
/**  MySQL Einstellungen - diese Angaben bekommst du von deinem Webhoster. */
/**  Ersetze database_name_here mit dem Namen der Datenbank, die du verwenden möchtest. */
define('DB_NAME', 'gtibackend');

/** Ersetze username_here mit deinem MySQL-Datenbank-Benutzernamen */
define('DB_USER', 'root');

/** Ersetze password_here mit deinem MySQL-Passwort */
define('DB_PASSWORD', 'root');

/** Ersetze localhost mit der MySQL-Serveradresse */
define('DB_HOST', 'localhost');

/** Der Datenbankzeichensatz der beim Erstellen der Datenbanktabellen verwendet werden soll */
define('DB_CHARSET', 'utf8');

/** Der collate type sollte nicht geändert werden */
define('DB_COLLATE', '');

/* * #@+
 * Sicherheitsschlüssel
 *
 * Ändere jeden KEY in eine beliebige, möglichst einzigartige Phrase.
 * Auf der Seite {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * kannst du dir alle KEYS generieren lassen.
 * Bitte trage für jeden KEY eine eigene Phrase ein. Du kannst die Schlüssel jederzeit wieder ändern,
 * alle angemeldeten Benutzer müssen sich danach erneut anmelden.
 *
 * @seit 2.6.0
 */
define('AUTH_KEY', 'hSe>KI-qa4Pm2VS2qs0!Ul7uLwt Pkd{URbs5.GXy 9xm?b5d^Fhq.-Bp6rnAk^T');
define('SECURE_AUTH_KEY', '!+o9(NGU7D2tuj`{>H6LWloNRk}b3+~g3PdT[@vp`GRv VyRf4sL9Ji?BJk>s Bb');
define('LOGGED_IN_KEY', 'L#Tz2OtUJMTgBd+nhb}-rv9Hc0BXTOMd}+mG1j4+b8{Nt+LQ_6Y#}a^74,pzg5yB');
define('NONCE_KEY', '/PB ZGyY/C{tFcJ#92tFEh8Z[cyu[zZk(?RNA!kF.`|8.c~N^Wxtg4c7M=YMYAdl');
define('AUTH_SALT', '~fv;4 uGo_Kw)S# i}R`[J^>)yV~}@]SXAy-i?6b`JKd*KJ9[*-h6(r|2ZN~%G@h');
define('SECURE_AUTH_SALT', 'vc/!m==*,VZvUWU|J>~iYgo<*Ec8|<~}_Lc1M1+&0^u~1o4|]$o*QzMj XU-4$a<');
define('LOGGED_IN_SALT', '7FHfOA{ .zDQfb{6-KnXy1e^MW((A%BSc+iOHcn|%:7okaYr*]$.$aG|v!nz/osW');
define('NONCE_SALT', 'KKeVMyRdRIS#z8L{5YiJ}rWI|:sdGm a,o5-${,X75p*,!J{EV2]Z5Vl1jDts=(|');

/* * #@- */

/**
 * WordPress Datenbanktabellen-Präfix
 *
 *  Wenn du verschiedene Präfixe benutzt, kannst du innerhalb einer Datenbank
 *  verschiedene WordPress-Installationen betreiben. Nur Zahlen, Buchstaben und Unterstriche bitte!
 */
$table_prefix = 'wp_';

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
if (!defined('ABSPATH'))
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
