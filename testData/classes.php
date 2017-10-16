<?php

namespace TestData;

class A {};
class A1 {};
class A2 {};
class A3 {};
class A4 {};
class A5 {};

class B {
    public function __construct(A $a) {}
};

class B1 {
    public function __construct(A1 $a) {}
};

class B2 {
    public function __construct(A2 $a) {}
};

class B3 {
    public function __construct(A3 $a) {}
};

class B4 {
    public function __construct(A4 $a) {}
};

class B5 {
    public function __construct(A5 $a) {}
};

interface C {};
interface C1 {};
interface C2 {};
interface C3 {};
interface C4 {};
interface C5 {};

class D implements C {};
class D1 implements C1 {};
class D2 implements C2 {};
class D3 implements C3 {};
class D4 implements C4 {};
class D5 implements C5 {};

class E {
    public function __construct(A $a, B $b, C $c) {}
};

class E1 {
    public function __construct(A1 $a, B1 $b, C1 $c) {}
};

class E2 {
    public function __construct(A2 $a, B2 $b, C2 $c) {}
};

class E3 {
    public function __construct(A3 $a, B3 $b, C3 $c) {}
};

class E4 {
    public function __construct(A4 $a, B4 $b, C4 $c) {}
};

class E5 {
    public function __construct(A5 $a, B5 $b, C5 $c) {}
};

class F {
    public function __construct(A $a, A1 $a1, A2 $a2, A3 $a3, A4 $a4, A5 $a5) {}
}

class G {
    public function __construct(B $b, B1 $b1, B2 $b2, B3 $b3, B4 $b4, B5 $b5) {}
}

class H {
    public function __construct(C $c, C1 $c1, C2 $c2, C3 $c3, C4 $c4, C5 $c5) {}
}
