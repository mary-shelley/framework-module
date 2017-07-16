# Frankie Framework Module

Base framework module

```php
container = new CompositeContainer();
$modules = new Loader($container);

$modules->add(new Corley\Framework\FrameworkModule($container, [
    "app"       => __DIR__ . '/../src',
    "cache"     => "/tmp",
    "debug"     => true,
]);

$app = $modules->getContainer()->get("app");
```
