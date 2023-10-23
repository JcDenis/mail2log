<?php

declare(strict_types=1);

namespace Dotclear\Plugin\mail2log;

use Dotclear\Core\Process;

/**
 * @brief       mail2log prepend class.
 * @ingroup     mail2log
 *
 * @author      Jean-Christian Denis (author)
 * @copyright   GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
class Prepend extends Process
{
    public static function init(): bool
    {
        return self::status(My::checkContext(My::BACKEND));
    }

    public static function process(): bool
    {
        if (self::status()) {
            // function must be out of namespace
            require_once __DIR__ . '/_mail.php';
        }

        return self::status();
    }
}
