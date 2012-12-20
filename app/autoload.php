<?php

use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = require __DIR__.'/../vendor/autoload.php';

// intl
if (!function_exists('intl_get_error_code')) {
    require_once __DIR__.'/../vendor/symfony/symfony/src/Symfony/Component/Locale/Resources/stubs/functions.php';
    $loader->add('', __DIR__.'/../vendor/symfony/symfony/src/Symfony/Component/Locale/Resources/stubs');
}

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

// set dummy deploy.yml for community checkouts
// can be removed if deploy.yml already existing or when outcomment  "- { resource: deploy.yml }" in config.yml
$deployYml = __DIR__.'/config/deploy.yml';
if(!file_exists($deployYml)){
    file_put_contents($deployYml, '# Dummy file for community checkouts - needed because import in config.yml');
}

return $loader;