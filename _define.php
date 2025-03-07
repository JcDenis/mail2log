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
    '0.9.1',
    [
        'requires'    => [['core', '2.28']],
        'permissions' => 'My',
        'priority'    => 10,
        'type'        => 'plugin',
        'support'     => 'https://github.com/JcDenis/' . $this->id . '/issues',
        'details'     => 'https://github.com/JcDenis/' . $this->id . '/',
        'repository'  => 'https://raw.githubusercontent.com/JcDenis/' . $this->id . '/master/dcstore.xml',
        'date'        => '2025-03-02T17:14:49+00:00',
    ]
);
