<?php
$directories = [__DIR__.'/src', __DIR__.'/tests'];

return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => true,
        'ordered_imports' => true,
        'psr0' => false,
    ])
    ->setFinder(PhpCsFixer\Finder::create()->in($directories));
