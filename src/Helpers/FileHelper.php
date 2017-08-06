<?php

namespace Oscarricardosan\PhpunitgLaravel\Helpers;


class FileHelper
{
    public static function getFilesInPath($path, array $allowsExtension= ['php'])
    {
        $rii = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));

        $files = array();
        foreach ($rii as $file){
            if (!$file->isDir())
                if(in_array($file->getExtension(), $allowsExtension))
                    $files[] = $file->getPathname();
        }
        return $files;
        
    }
}