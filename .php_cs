<?php
$directories = [__DIR__.'/src', __DIR__.'/tests'];

return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => true,
        'ordered_imports' => true,
        'psr0' => false,
        'yoda_style' => false,
        'array_syntax' => [
            'syntax' => 'short',
        ],
    ])
    ->setFinder(PhpCsFixer\Finder::create()->in($directories));
