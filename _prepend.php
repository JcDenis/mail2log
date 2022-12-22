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

if (!function_exists('_mail')) {
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
