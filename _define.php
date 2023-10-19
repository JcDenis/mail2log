<?php
/**
 * @file
 * @brief       The plugin mail2log definition
 * @ingroup     mail2log
 *
 * @defgroup    mail2log Plugin mail2log.
 *
 * Do not send mails but log them.
 *
 * @author      Jean-Christian Denis (author)
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
declare(strict_types=1);

$this->registerModule(
    'Mail to log',
    'Do not send mails but log them',
    'Jean-Christian Denis and contributors',
    '0.7.1',
    [
        'requires'    => [['core', '2.28']],
        'permissions' => 'My',
        'type'        => 'plugin',
        'support'     => 'https://git.dotclear.watch/JcDenis/' . basename(__DIR__) . '/issues',
        'details'     => 'https://git.dotclear.watch/JcDenis/' . basename(__DIR__) . '/src/branch/master/README.md',
        'repository'  => 'https://git.dotclear.watch/JcDenis/' . basename(__DIR__) . '/raw/branch/master/dcstore.xml',
    ]
);

if (!function_exists('\_mail')) {
    function _mail(string $to, string $subject, string $message, $headers = '', ?string $params = null): bool
    {
        $headers = is_array($headers) ? implode("\n\t", $headers) : (is_string($headers) ? $headers : '');

        $cur = Dotclear\App::log()->openLogCursor();
        $cur->setField('log_table', basename(__DIR__));
        $cur->setField('log_msg', sprintf("%s\n-----\n To: %s\n Subject: %s\n-----\n Message:\n%s\n", $headers, $to, $subject, $message));
        Dotclear\App::log()->addLog($cur);

        return true;
    }
}
