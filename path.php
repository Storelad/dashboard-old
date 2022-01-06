<?php 
ob_start();
session_start();
define('ROOT_PATH', realpath(dirname(__FILE__)));
include(ROOT_PATH . '/app/helpers/functions.php');

class APP{
    public $title; public $constants;
    public $appName; public $link;
    public $LOCAL;
    const APP_NAME = 'StoreLad';
    public function __construct($title)
    {
        $this->title = $title;
        $this->page = strtolower(str_replace(' ', '', $title));
    }

    public function dd($value) { // to be deleted
        echo "<pre>", print_r($value, true), "</pre>";
        die();
    }

    public function definer($data) {
        foreach ($data as $key => $value) {
            define($key, $value);
        }
    }

    public function mode(){
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
        $url .= $_SERVER['HTTP_HOST'];
        $LOCAL = strpos($url, 'localhost') ? 1 : 0;
        require_once(ROOT_PATH . '/app/includes/data.php');
        if($LOCAL){
            $data = $this->constants['dev'];
        }else{
            error_reporting(0);
            $data = $this->constants['live'];
        }
        $this->definer($data);
    }

    public function pager(){
        $link = str_replace('index.php', '', $_SERVER['PHP_SELF']);
        $link = str_replace($link, '', $_SERVER['REQUEST_URI']);
        $link = str_replace($_SERVER['PHP_SELF'], '', $link);
        $link = ROOT_PATH . '/resources/' . $link . '.php';
        if(file_exists($link)){
            return $link;
        }elseif(is_dir(str_replace('.php', '', $link))){
            $link = str_replace('.php', '', $link);
            return $link . 'index.php';
        }else{
            $link = ROOT_PATH . '/resources/default.php';
            return $link;
        }
    }
}

$_SESSION['id'] = 1;
