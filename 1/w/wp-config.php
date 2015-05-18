<?php
/**
 * WordPress基础配置文件。
 *
 * 本文件包含以下配置选项：MySQL设置、数据库表名前缀、密钥、
 * WordPress语言设定以及ABSPATH。如需更多信息，请访问
 * {@link http://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 * 编辑wp-config.php}Codex页面。MySQL设置具体信息请咨询您的空间提供商。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以手动复制这个文件，并重命名为“wp-config.php”，然后填入相关信息。
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'app_tianhk');

/** MySQL数据库用户名 */
define('DB_USER', 'n1zn31o550');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'hm50m203z1022l3wwz1w5k1kmm1zwhlh4kmmjkhw');

/** MySQL主机 */
define('DB_HOST', 'w.rdc.sae.sina.com.cn:3307');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'eU#wsshp.r)S{tnS Wom[CD9Zu^gSgv(lJr~[ S!^+Fey1@tgxz9KLt0d_3XmBz<');
define('SECURE_AUTH_KEY',  '?,Q7#|kD!-&Ptr]K>3.Dg:DsWY*:)RecJ+/85;!3e)lO dz6L}PR~RoBlV2 HZe9');
define('LOGGED_IN_KEY',    'X@}z*cA!E2}b}s5;TA^:|t]d*gi]K+=fSE2Ai7]~(#|}*F88Q`yn,{B2tWkH>~Sj');
define('NONCE_KEY',        'X,=>,SPV4C|X|no_Lz)8`Go=J4B1:v]0wj16LE,^G4@Zv;Y0;Kr~5XqlulkJJ[>3');
define('AUTH_SALT',        'T1_c1ts/6t8@7n~#Ra9mNWYTh9UmP7Z,zb!nV3LNUAnK:C=FRYVpfd_/LS-;SI9+');
define('SECURE_AUTH_SALT', 'R`946 TBm!tgmrKQrfqQd6%BvF$t~mUYdlmkeZB0oW1&DtB+tG,K(k9*dp_3Df^Y');
define('LOGGED_IN_SALT',   'JZmI8=[DN/js{_qyWzrbG4[LgC@.15HQgCajd-#FplA1)Y8p=`U}!akW-s#:icj#');
define('NONCE_SALT',       '7y_fHmxbcE;VXxvw~UmT)R&~$Dt-dPJb<1clXFjzO}LHzOmn2xD^yS.J;}!Yf.vK');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
