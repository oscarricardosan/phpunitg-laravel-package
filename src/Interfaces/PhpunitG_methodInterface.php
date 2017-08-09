<?php

namespace Oscarricardosan\PhpunitgLaravel\Interfaces;


interface PhpunitG_methodInterface
{
    /**
     * @param string $methodName
     */
    public function __construct($methodName);

    /**
     * @return string
     */
    public function runInPhpunit();

    /**
     * @return string
     */
    public function getResponseOfPhpunit();

    /**
     * @return boolean
     */
    public function isSuccess();

}