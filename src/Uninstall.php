<?php

declare(strict_types=1);

namespace Dotclear\Plugin\mail2log;

use Dotclear\Core\Process;
use Dotclear\Plugin\Uninstaller\Uninstaller;

/**
 * @brief       mail2log uninstall class.
 * @ingroup     mail2log
 *
 * @author      Jean-Christian Denis (author)
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
class Uninstall extends Process
{
    public static function init(): bool
    {
        return self::status(My::checkContext(My::UNINSTALL));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        Uninstaller::instance()
            ->addUserAction(
                'logs',
                'delete_all',
                'mail2log'
            )
            ->addUserAction(
                'plugins',
                'delete',
                My::id()
            )
            ->addUserAction(
                'versions',
                'delete',
                My::id()
            )
            ->addDirectAction(
                'logs',
                'delete_all',
                'mail2log'
            )
            ->addDirectAction(
                'plugins',
                'delete',
                My::id()
            )
            ->addDirectAction(
                'versions',
                'delete',
                My::id()
            )
        ;

        // no custom action
        return false;
    }
}
