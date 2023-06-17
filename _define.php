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
if (!defined('DC_RC_PATH') || is_null(dcCore::app()->auth)) {
    return null;
}

$this->registerModule(
    'Mail to log',
    'Do not send mails but log them',
    'Jean-Christian Denis and contributors',
    '0.4.1',
    [
        'requires'    => [['core', '2.24']],
        'permissions' => dcCore::app()->auth->makePermissions([
            dcCore::app()->auth::PERMISSION_USAGE,
        ]),
        'type'       => 'plugin',
        'support'    => 'https://github.com/JcDenis/' . basename(__DIR__),
        'details'    => 'https://plugins.dotaddict.org/dc2/details/' . basename(__DIR__),
        'repository' => 'https://raw.githubusercontent.com/JcDenis/' . basename(__DIR__) . '/master/dcstore.xml',
    ]
);

if (!function_exists('\_mail')) {
    function _mail(string $to, string $subject, string $message, $headers = '', ?string $params = null): bool
    {
        $headers = is_array($headers) ? implode("\n\t", $headers) : (is_string($headers) ? $headers : '');

        $cur = dcCore::app()->con->openCursor(dcCore::app()->prefix . dcLog::LOG_TABLE_NAME);
        $cur->setField('log_table', basename(__DIR__));
        $cur->setField('log_msg', sprintf("%s\n-----\n To: %s\n Subject: %s\n-----\n Message:\n%s\n", $headers, $to, $subject, $message));
        dcCore::app()->log->addLog($cur);

        return true;
    }
}
