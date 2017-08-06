<?php

namespace Oscarricardosan\PhpunitgLaravel\SystemObjects;

use Nette\Reflection\ClassType;

Class File{

    protected $filePath;

    protected $fileContent;

    /**
     * FileToClass constructor.
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath= $filePath;
        $this->fileContent= file_get_contents($this->filePath);
    }

    /**
     * @return boolean
     */
    public function is_class()
    {
        if(trim($this->getNamespace()) == '' || trim($this->getClassName()) == '')
            return false;
        else
            return true;
    }

    /**
     * @return ClassType|boolean
     */
    public function getReflectionClass()
    {
        return new ClassType($this->getNamespace()."\\".$this->getClassName());
    }

    /**
     * @return class|boolean
     */
    public function getClass()
    {
        $namespace= $this->getNamespace()."\\".$this->getClassName();
        return new $namespace;
    }

    /**
     * @return string
     */
    public function getClassnameWithNamespace()
    {
        return $this->getNamespace()."\\".$this->getClassName();
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        $pos = strpos($this->fileContent, 'namespace');
        if($pos===false)
            return '';
        $temporal_line= substr($this->fileContent, $pos, 100);
        $lines= explode("\n", $temporal_line);
        $words= explode(" ", $lines[0]);
        $namespace= str_replace(";", "", $words[1]);
        return $namespace;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        $pos = strpos($this->fileContent, 'class');
        if($pos===false)
            return '';
        $temporal_line= substr($this->fileContent, $pos, 100);
        $lines= explode("\n", $temporal_line);
        $words= explode(" ", $lines[0]);
        if($words[0]!=='class')
            return '';
        $className= $words[1];
        return $className;
    }

}