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
    'mail2log',
    'Do not send mails but log them',
    'Jean-Christian Denis and contributors',
    '0.1',
    [
        'requires'    => [['core', '2.24']],
        'permissions' => dcCore::app()->auth->makePermissions([
            dcAuth::PERMISSION_USAGE,
        ]),
        'type'       => 'plugin',
        'support'    => 'https://github.com/JcDenis/mail2log',
        'details'    => 'https://plugins.dotaddict.org/dc2/details/mail2log',
        'repository' => 'https://raw.githubusercontent.com/JcDenis/mail2log/master/dcstore.xml',
    ]
);
