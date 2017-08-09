<?php

namespace Oscarricardosan\PhpunitgLaravel;



use Oscarricardosan\PhpunitgLaravel\Interfaces\PhpunitG_methodInterface;

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
            ->runCommand()
            ->readPhpunitResponsetOfLog()
            ->deleteLog();
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
        exec(
            "vendor/bin/phpunit --bootstrap=bootstrap/autoload.php --configuration=phpunit.xml".
            " --filter='{$this->methodName}' >phpunitg.log"
        );
        return $this;
    }

    /**
     * @return $this
     */
    protected function readPhpunitResponsetOfLog()
    {
        $this->phpunitResponse= file_get_contents('phpunitg.log');
        return $this;
    }

    /**
     * @return $this
     */
    protected function deleteLog()
    {
        unlink('phpunitg.log');
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