<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src');

$config = new PhpCsFixer\Config();

return $config->setRules(
    [
        '@Symfony' => true,
        'yoda_style' => true,
        'class_attributes_separation' => [
            'elements' => ['method' => 'one', 'property' => 'one', 'trait_import' => 'one']
        ]
    ]
)
    ->setFinder($finder);
