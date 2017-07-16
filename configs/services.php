<?php

use Zend\ServiceManager\Factory\InvokableFactory;

use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Annotations\AnnotationReader;

use Corley\FrameworkModule\Factory;
use Corley\Middleware\Reader\HookReader;
use Corley\Middleware\Executor\AnnotExecutor;

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Corley\Middleware\App;

return [
    "services" => [
        "factories" => [
            AnnotationReader::class => InvokableFactory::class,
            RequestContext::class   => InvokableFactory::class,
            FilesystemCache::class  => Factory\FilesystemCacheFactory::class,
            CachedReader::class     => Factory\CachedReaderFactory::class,
            HookReader::class       => Factory\HookReaderFactory::class,
            AnnotExecutor::class    => Factory\AnnotExecutorFactory::class,
            UrlMatcher::class       => Factory\UrlMatcherFactory::class,
            App::class              => Factory\AppFactory::class,
        ],
        "aliases" => [
            "app" => App::class,
        ],
    ],
];
