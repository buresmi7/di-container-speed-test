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

doTest('Simple DI with E', function () {
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

doTest('Simple DI with big DI tree', function () {
    $container = new ModifiedSimpleDI();
    $container->setInterfaceImplementation(TestData\C::class, TestData\D::class);
    $container->setInterfaceImplementation(TestData\C1::class, TestData\D1::class);
    $container->setInterfaceImplementation(TestData\C2::class, TestData\D2::class);
    $container->setInterfaceImplementation(TestData\C3::class, TestData\D3::class);
    $container->setInterfaceImplementation(TestData\C4::class, TestData\D4::class);
    $container->setInterfaceImplementation(TestData\C5::class, TestData\D5::class);

    for ($i = 0; $i < ITER; $i++) {
        $a = $container->getService(TestData\A::class);
        $a = $container->getService(TestData\A1::class);
        $a = $container->getService(TestData\A2::class);
        $a = $container->getService(TestData\A3::class);
        $a = $container->getService(TestData\A4::class);
        $a = $container->getService(TestData\A5::class);

        $b = $container->getService(TestData\B::class);
        $b = $container->getService(TestData\B1::class);
        $b = $container->getService(TestData\B2::class);
        $b = $container->getService(TestData\B3::class);
        $b = $container->getService(TestData\B4::class);
        $b = $container->getService(TestData\B5::class);

        $d = $container->getService(TestData\D::class);
        $d = $container->getService(TestData\D1::class);
        $d = $container->getService(TestData\D2::class);
        $d = $container->getService(TestData\D3::class);
        $d = $container->getService(TestData\D4::class);
        $d = $container->getService(TestData\D5::class);

        $e = $container->getService(TestData\E::class);
        $e = $container->getService(TestData\E1::class);
        $e = $container->getService(TestData\E2::class);
        $e = $container->getService(TestData\E3::class);
        $e = $container->getService(TestData\E4::class);
        $e = $container->getService(TestData\E5::class);

        $f = $container->getService(TestData\F::class);
        $g = $container->getService(TestData\G::class);
        $h = $container->getService(TestData\H::class);
    }
});

doTest('Nette DI with big DI tree', function () {
    $loader = new Nette\DI\ContainerLoader(__DIR__ . '/temp');
    $class = $loader->load(function($compiler) {
        $compiler->loadConfig(__DIR__ . '/config.neon');
    });
    $container = new $class;

    for ($i = 0; $i < ITER; $i++) {
        $a = $container->getByType(TestData\A::class);
        $a = $container->getByType(TestData\A1::class);
        $a = $container->getByType(TestData\A2::class);
        $a = $container->getByType(TestData\A3::class);
        $a = $container->getByType(TestData\A4::class);
        $a = $container->getByType(TestData\A5::class);

        $b = $container->getByType(TestData\B::class);
        $b = $container->getByType(TestData\B1::class);
        $b = $container->getByType(TestData\B2::class);
        $b = $container->getByType(TestData\B3::class);
        $b = $container->getByType(TestData\B4::class);
        $b = $container->getByType(TestData\B5::class);

        $d = $container->getByType(TestData\D::class);
        $d = $container->getByType(TestData\D1::class);
        $d = $container->getByType(TestData\D2::class);
        $d = $container->getByType(TestData\D3::class);
        $d = $container->getByType(TestData\D4::class);
        $d = $container->getByType(TestData\D5::class);

        $e = $container->getByType(TestData\E::class);
        $e = $container->getByType(TestData\E1::class);
        $e = $container->getByType(TestData\E2::class);
        $e = $container->getByType(TestData\E3::class);
        $e = $container->getByType(TestData\E4::class);
        $e = $container->getByType(TestData\E5::class);

        $f = $container->getByType(TestData\F::class);
        $g = $container->getByType(TestData\G::class);
        $h = $container->getByType(TestData\H::class);
    }
});
