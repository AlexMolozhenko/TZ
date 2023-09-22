<?php


include_once '.'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'configAutoload.php';

/**
 * implementation of class autoloading function
 */
spl_autoload_register(function($class){
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    $classPath = DEFAULT_DIRECTORY_NAME.DIRECTORY_SEPARATOR.$class.'.php';
    if(file_exists($classPath)){
        include_once $classPath;
        return true;
    }
    return false;

});


Route::init();