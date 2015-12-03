<?php
/**
 * PHP-CS-fixer configuration.
 *
 * https://github.com/FriendsOfPHP/PHP-CS-Fixer
 */

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->exclude('vendor')
    ->in(__DIR__)
;

return Symfony\CS\Config\Config::create()
    ->fixers([
        'psr2',
        'align_double_arrow',
        'align_equals',
        'strict',
    ])
    ->finder($finder)
    ->setUsingCache(true)
;
