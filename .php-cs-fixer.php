<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src');

$config = new PhpCsFixer\Config();

return $config->setRules(
    [
        '@Symfony' => true,
        'yoda_style' => true
    ]
)
    ->setFinder($finder);
