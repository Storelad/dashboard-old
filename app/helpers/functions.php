<?php

class AddApp extends APP{
    public function includes($fileName){
        return(ROOT_PATH . '/app/includes/' . $fileName . '.php');
    }
    public function controllers($fileName){
        return(ROOT_PATH . '/app/controllers/' . $fileName . '.php');
    }
    
    public function componets($fileName){
        return(ROOT_PATH.'/resources/componets/'.$fileName.'.php');
    }
    public function models($fileName){
        return(ROOT_PATH.'/app/models/'.$fileName.'.php');
    }
    public function helpers($fileNames){
        foreach($fileNames as $fileName){
            return(ROOT_PATH.'/app/helpers/'.$fileName.'.php');
        }
    }
    public function database($fileName){
        return(ROOT_PATH.'/app/database/'.$fileName.'.php');
    }

    public function autoloader($path = []){
        foreach($path as $key => $value){
            
        }
    }
}

class others{
    public function definer($data) {
        foreach ($data as $key => $value) {
            define($key, $value);
        }
    }
}