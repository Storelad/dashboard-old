<?php
$storeVar = array(
    'STORE_URL' => BASE_URL . str_replace('/cyberfox', '', $_SERVER['REQUEST_URI'])
);
others::definer($storeVar);