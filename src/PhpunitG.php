<?php

namespace Oscarricardosan\PhpunitgLaravel;


use Nette\Reflection\ClassType;
use Oscarricardosan\PhpunitgLaravel\Helpers\FileHelper;
use Oscarricardosan\PhpunitgLaravel\Interfaces\PhpunitG_Interface;
use Oscarricardosan\PhpunitgLaravel\SystemObjects\File;

class PhpunitG implements PhpunitG_Interface
{

    /**
     * @param string $path
     * @return array
     */
    public function getTests($path= 'tests')
    {
        $path= base_path().'/'.$path;
        $classes= [];
        foreach (FileHelper::getFilesInPath($path) as $file){
            $classFile= (new File($file));
            if($classFile->is_class()){
                if($classFile->getReflectionClass()->hasAnnotation('phpunitG'))
                    $classes[]= [
                        "class"=> $classFile->getClassnameWithNamespace(),
                        "path"=> $file,
                        "methods"=> $this->getMethods($classFile->getReflectionClass())
                    ];
            }
        }
        return $classes;
    }

    /**
     * @return array
     */
    public function getMethods(ClassType $class)
    {
        $methods= [];
        foreach($class->getMethods() as $method){
            if($method->getAnnotation('test'))
                $methods[]= $method->name;
        }
        return $methods;
    }
}