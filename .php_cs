<?php

$finder = PhpCsFixer\Finder::create()
    ->in(['src', 'database']);

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR1' => true,
        '@PSR2' => true
    ])->setFinder($finder);