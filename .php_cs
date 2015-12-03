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
        'symfony',
        'align_double_arrow',
        'align_equals',
        'strict',
        'unalign_double_arrow'
    ])
    ->finder($finder)
    ->setUsingCache(true)
;
