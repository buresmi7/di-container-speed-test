# di-container-speed-test

Compare speed of [Nette DIC](https://github.com/nette/di) and [Simple DIC](https://github.com/Travelport-Czech/SimpleDi)

## install

```
composer install
```

## run

```
php test.php
```

## results with 10.000 iterations

 * Manual Instance with A / Time (seconds): 0.0011558532714844
 * Simple DI with A / Time (seconds): 0.011802911758423
 * Simple DI with B / Time (seconds): 0.031620025634766
 * Simple DI with B / Time (seconds): 0.089388132095337
 * Nette DI first run with A / Time (seconds): 0.088018178939819
 * Nette DI with A / Time (seconds): 0.051923990249634
 * Nette DI with B / Time (seconds): 0.066601037979126
 * Nette DI with E / Time (seconds): 0.11947894096375
 * Simple DI with big DI tree / Time (seconds): 0.063581943511963
 * Nette DI with big DI tree / Time (seconds): 0.24848604202271

## comments

First part simulate many requests, so test loop include initialization of the DI container. Second part simulate bigger dependency tree and initialization of the DI container is before test loop (last two tests).
