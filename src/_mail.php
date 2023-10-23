<?php
/**
 * @file
 * @brief       The plugin mail2log _mail function
 * @ingroup     mail2log
 *
 * @author      Jean-Christian Denis (author)
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */

use Dotclear\App;

if (!function_exists('\_mail')) {
    function _mail(string $to, string $subject, string $message, $headers = '', ?string $params = null): bool
    {
        $cur = App::log()->openLogCursor();
        $cur->setField('log_table', 'mail2log');
        $cur->setField('log_msg', sprintf(
            "%s\n-----\n To: %s\n Subject: %s\n-----\n Message:\n%s\n",
            is_array($headers) ? implode("\n\t", $headers) : (is_string($headers) ? $headers : ''),
            $to,
            $subject,
            $message
        ));
        App::log()->addLog($cur);

        return true;
    }
}
