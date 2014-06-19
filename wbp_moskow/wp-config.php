<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'srv35388_alx');

/** Имя пользователя MySQL */
define('DB_USER', 'srv35388_alx');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'j4vAod');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '&k@LO=,|/,JSb%)|yjKXf-%ix-PK,I^-p5n (Q^,^s?3E<QbaT[AC1^6}[D`mC;+');
define('SECURE_AUTH_KEY',  'v|7-!l/Eyv+{/sFfG7a!aEnS<h.-0GcIR3uz)H+GpuR~6~aYci}a.Sm(t!~jLJ|h');
define('LOGGED_IN_KEY',    ';Ipq.E]SA4$*NdmbU&0@WGpmd@eydc+HxgT|>IkLp|<#l9.*/t0d<dJtk4Et)90c');
define('NONCE_KEY',        '(SiHDRAuOj`!9V >@imr8.BF0r+n;=>hTIsXNz^9+C`wN)qhh75TVwPt1Zh].Kh@');
define('AUTH_SALT',        '|J,6]f0j uE@y4/gJ6%~Z?cihh$<:k+X3BSSbEXDc-K/#`)xBZ_<Jg|9fEYIZ3B9');
define('SECURE_AUTH_SALT', '#t >;J|>24-guMzj3>0:2^y%y0G69*`6?LC-En*[`0o@^e{`}}M{Z{enan;CUquG');
define('LOGGED_IN_SALT',   'nz2vU[]L@aYndjJRr)V*@fg{b72LeK-p8bs=oP;LU}l4,C)BrfajCZ(.Zo(bstF:');
define('NONCE_SALT',       '^c2Ru@s$c_QxN66^*t$70x{w+6kCpURu TyO_&-5=D w2ck|H pX0B3.[ir^`[Ww');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Язык локализации WordPress, по умолчанию английский.
 *
 * Измените этот параметр, чтобы настроить локализацию. Соответствующий MO-файл
 * для выбранного языка должен быть установлен в wp-content/languages. Например,
 * чтобы включить поддержку русского языка, скопируйте ru_RU.mo в wp-content/languages
 * и присвойте WPLANG значение 'ru_RU'.
 */
define('WPLANG', 'ru_RU');

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Настоятельно рекомендуется, чтобы разработчики плагинов и тем использовали WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
