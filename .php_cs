<?php
/**
 * PHP-CS-fixer configuration.
 */

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__ . '/app/')
;

return Symfony\CS\Config\Config::create()
    ->fixers(array('symfony', '-psr0'))
    ->finder($finder)
    ->setUsingCache(true)
;
