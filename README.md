# di-container-speed-test

Compare speed of Nette DIC and Simple DIC

## install

```
composer install
```

## run

```
php test.php
```

## results with 10.000 iterations

Manual Instance with A / Time (seconds): 0.0011680126190186
Simple DI with A / Time (seconds): 0.011862993240356
Simple DI with B / Time (seconds): 0.032898902893066
Simple DI with B / Time (seconds): 0.091301918029785
Nette DI first run with A / Time (seconds): 0.076591968536377
Nette DI with A / Time (seconds): 0.046128988265991
Nette DI with B / Time (seconds): 0.070529937744141
Nette DI with E / Time (seconds): 0.10993313789368
