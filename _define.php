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
    '0.5',
    [
        'requires'    => [['core', '2.24']],
        'permissions' => dcCore::app()->auth->makePermissions([
            dcCore::app()->auth::PERMISSION_USAGE,
        ]),
        'type'       => 'plugin',
        'support'    => 'https://git.dotclear.watch/JcDenis/' . basename(__DIR__) . '/issues',
        'details'    => 'https://git.dotclear.watch/JcDenis/' . basename(__DIR__) . '/src/branch/master/README.md',
        'repository' => 'https://git.dotclear.watch/JcDenis/' . basename(__DIR__) . '/raw/branch/master/dcstore.xml',
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
