<?php

namespace Oscarricardosan\PhpunitgLaravel\SystemObjects;

use Nette\Reflection\ClassType;

Class File{

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var bool|string
     */
    protected $fileContent;

    /**
     * @var class
     */
    protected $class;

    /**
     * @var ClassType
     */
    protected $reflectionClass;

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
     * @return string
     */
    public function getAnnotation($key)
    {
        return $this->reflectionClass()->getAnnotation($key);
    }

    /**
     * @return boolean
     */
    public function hasAnnotation($key)
    {
        return $this->reflectionClass()->hasAnnotation($key);
    }

    /**
     * @return ClassType|boolean
     */
    public function getReflectionClass()
    {
        return $this->reflectionClass();
    }

    protected function reflectionClass()
    {
        if(is_null($this->reflectionClass)){
            $this->reflectionClass= new ClassType($this->getNamespace()."\\".$this->getClassName());
        }
        return $this->reflectionClass;
    }

    /**
     * @return class|boolean
     */
    public function getClass()
    {
        return $this->class_();
    }

    protected function class_()
    {
        if(is_null($this->class)){
            $namespace= $this->getNamespace()."\\".$this->getClassName();
            $this->class= new $namespace;
        }
        return $this->class;
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