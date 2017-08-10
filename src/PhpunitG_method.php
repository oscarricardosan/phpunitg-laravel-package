<?php

namespace Oscarricardosan\PhpunitgLaravel;



use Illuminate\Support\Facades\Artisan;
use Oscarricardosan\PhpunitgLaravel\Interfaces\PhpunitG_methodInterface;
use Symfony\Component\Process\Process;

class PhpunitG_method implements PhpunitG_methodInterface
{

    /**
     * @var string
     */
    protected $methodName;

    /**
     * @var string
     */
    protected $phpunitResponse;

    /**
     * @param string $methodName
     */
    public function __construct($methodName)
    {
        $this->methodName= $methodName;
    }

    /**
     * @return string
     */
    public function runInPhpunit()
    {
        $this
            ->moveDirToBase()
            ->runCommand();
        return $this;
    }

    /**
     * @return $this
     */
    protected function moveDirToBase()
    {
        chdir(base_path());
        return $this;
    }

    /**
     * @return $this
     */
    protected function runCommand()
    {
        $process= new Process(
            "vendor/bin/phpunit --bootstrap=bootstrap/autoload.php --configuration=phpunit.xml ".
            " --filter='{$this->methodName}'"
        , base_path(), getenv());
        $process->run();
        $this->phpunitResponse= $process->getOutput();
        return $this;
    }

    /**
     * @return string
     */
    public function getResponseOfPhpunit()
    {
        return $this->phpunitResponse;
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        $pos= strpos($this->phpunitResponse, 'OK (1 test');
        return !($pos===false);
    }
}