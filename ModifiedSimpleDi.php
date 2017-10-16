<?php

class ModifiedSimpleDI extends Cee\SimpleDi\Container {
    public function getService($name) {
        return parent::getService($name);
    }
}