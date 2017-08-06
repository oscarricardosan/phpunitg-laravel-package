<?php

namespace Oscarricardosan\PhpunitgLaravel\Interfaces;


use Nette\Reflection\ClassType;

interface PhpunitG_Interface
{
    /**
     * @param string $path
     * @return array
     */
    public function getTests($path= 'tests');

    /**
     * @return array
     */
    public function getMethods(ClassType $class);

}