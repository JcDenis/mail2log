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
    '0.8',
    [
        'requires'    => [['core', '2.28']],
        'permissions' => 'My',
        'priority'    => 10,
        'type'        => 'plugin',
        'support'     => 'https://git.dotclear.watch/JcDenis/' . basename(__DIR__) . '/issues',
        'details'     => 'https://git.dotclear.watch/JcDenis/' . basename(__DIR__) . '/src/branch/master/README.md',
        'repository'  => 'https://git.dotclear.watch/JcDenis/' . basename(__DIR__) . '/raw/branch/master/dcstore.xml',
    ]
);
