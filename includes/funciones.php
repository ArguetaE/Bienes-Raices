<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate( string  $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . "/{$nombre}.php"; 
}

function estaAutenticado(){
    session_start();

    if(!$_SESSION['login']) {
        return true;
        header('Location: /');
    }
}

function debuguear($variable){
    echo"<pre>";
    var_dump($variable);
    echo"</pre>";
    exit;
}

// Escapa el Html
function sane($html) : string{
    $sane = htmlspecialchars($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');    
    return $sane;
}