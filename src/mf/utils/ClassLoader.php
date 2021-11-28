<?php 

namespace mf\utils;

class classLoader extends AbstractClassLoader{

    public function loadClass(string $classname){
        $filename = $this->getFilename($classname);
        $chemin = $this->makePath($filename);

        if (file_exists($chemin)){
            require_once $chemin;
        }
    }

    protected function makePath(string $filename): string{
        $chemin = ($this->prefix).DIRECTORY_SEPARATOR.$filename;
        return $chemin;
    }

    protected function getFilename(string $classname): string{
        $filename = str_replace( "\\",  DIRECTORY_SEPARATOR,  $classname).".php";
        return $filename;
    }
}

?>