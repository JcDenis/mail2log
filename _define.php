<?php
/**
 * @brief mail2log, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugin
 *
 * @author Jean-Christian Denis and contributors
 *
 * @copyright Jean-Christian Denis
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
if (!defined('DC_RC_PATH')) {
    return null;
}

$this->registerModule(
    'Mail to log',
    'Do not send mails but log them',
    'Jean-Christian Denis and contributors',
    '0.3',
    [
        'requires'    => [['core', '2.24']],
        'permissions' => dcCore::app()->auth->makePermissions([
            dcAuth::PERMISSION_USAGE,
        ]),
        'type'       => 'plugin',
        'support'    => 'https://github.com/JcDenis/' . basename(__DIR__),
        'details'    => 'https://plugins.dotaddict.org/dc2/details/' . basename(__DIR__),
        'repository' => 'https://raw.githubusercontent.com/JcDenis/' . basename(__DIR__) . '/master/dcstore.xml',
    ]
);

if (!function_exists('\_mail')) {
    function _mail($to, $subject, $message, $headers)
    {
        $headers = is_array($headers) ? implode("\n\t", $headers) : (string) $headers;

        $cur            = dcCore::app()->con->openCursor(dcCore::app()->prefix . dcLog::LOG_TABLE_NAME);
        $cur->log_table = basename(__DIR__);
        $cur->log_msg   = sprintf("%s\n-----\n To: %s\n Subject: %s\n-----\n Message:\n%s\n", $headers, $to, $subject, $message);
        dcCore::app()->log->addLog($cur);

        return true;
    }
}
