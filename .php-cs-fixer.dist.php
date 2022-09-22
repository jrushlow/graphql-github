<?php

$finder = PhpCsFixer\Finder::create()
    ->in(['./src', './tests'])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'phpdoc_to_comment' => false,
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
;
