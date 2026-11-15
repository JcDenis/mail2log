<?php

declare(strict_types=1);

namespace Dotclear\Plugin\mail2log;

use Dotclear\App;
use Dotclear\Helper\Process\TraitProcess;

/**
 * @brief       mail2log backend class.
 * @ingroup     mail2log
 *
 * @author      Jean-Christian Denis (author)
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
class Backend
{
    use TraitProcess;

    public static function init(): bool
    {
        return self::status(My::checkContext(My::BACKEND));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        App::behavior()->addBehaviors([
            // Warn on dashboard that mails are not sent
            'adminDashboardMessage' => function (): string {
                App::backend()->notices()->warning(
                    __('Plugin "Mail to log" is enabled: mails are not sent but recorded in logs. Use it only for development.'),
                    false
                );

                return '';
            },
        ]);

        return true;
    }
}
