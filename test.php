<?php

require __DIR__ . '/vendor/autoload.php';

const ITER = 10000;

function doTest($name, callable $func) {
    $start = microtime(true);
    $func();
    $time = microtime(true) - $start;
    echo "$name / Time (seconds): " . $time . "\n";    
}

function deleteNetteDiCache() {
    array_map('unlink', glob(__DIR__ . "/temp/*"));
}

function createClassWithSimpleDi($className) {
    for ($i = 0; $i < ITER; $i++) {
        $container = new Cee\SimpleDi\Container();
        $classInstance = $container->createServiceOnce($className);
    }
}

function createClassWithNetteDi($className) {    
    for ($i = 0; $i < ITER; $i++) {
        $loader = new Nette\DI\ContainerLoader(__DIR__ . '/temp');
        $class = $loader->load(function($compiler) {
            $compiler->loadConfig(__DIR__ . '/config.neon');
        });
        $container = new $class;
        $classInstance = $container->getByType($className);
    }
}

doTest('Manual Instance with A', function () {
    for ($i = 0; $i < ITER; $i++) {
        $classInstance = new TestData\A();
    }
});

doTest('Simple DI with A', function () {
    createClassWithSimpleDi(TestData\A::class);
});

doTest('Simple DI with B', function () {
    createClassWithSimpleDi(TestData\B::class);
});

doTest('Simple DI with B', function () {
    for ($i = 0; $i < ITER; $i++) {
        $container = new Cee\SimpleDi\Container();
        $container->setInterfaceImplementation(TestData\C::class, TestData\D::class);
        $classInstance = $container->createServiceOnce(TestData\E::class);
    }
});

deleteNetteDiCache();

doTest('Nette DI first run with A', function () {
    createClassWithNetteDi(TestData\A::class);
});

doTest('Nette DI with A', function () {
    createClassWithNetteDi(TestData\A::class);
});

doTest('Nette DI with B', function () {
    createClassWithNetteDi(TestData\B::class);
});

doTest('Nette DI with E', function () {
    createClassWithNetteDi(TestData\E::class);
});
