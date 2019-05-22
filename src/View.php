<?php

namespace TodoTest;

class View{

    const VIEWS_DIR = '/src/views/';

    public function render($file, $vars = []){
        try {
            $fixedFilePath =  self::fixFilePath($file);
            self::isAllowFile($fixedFilePath);

            ob_start();

            extract($vars);

            include $fixedFilePath;

            $content = ob_get_clean();
        } catch (\Throwable $th) {
            ob_end_clean();

            throw $th;
        }

        return $content;
    }

    private static function fixFilePath($file){
        return APP_ROOT . self::VIEWS_DIR . $file . '.php';
    }

    private static function isAllowFile($file){
        $fullpath = realpath($file);

        $basePath = APP_ROOT . self::VIEWS_DIR;

        if( strpos($fullpath, $basePath) !== 0 ){
            throw new \Exception("View file must to be in APP_ROOT/views/ directory", 1);
        }

        return true;
    }
}
