<?php

require "vendor/autoload.php";

// Load and configure twig
$loader = new \Twig\Loader\FilesystemLoader(dirname(__FILE__) . '/views');
$twigConfig = array(
    // 'cache' => './cache/twig/',
    // 'cache' => false,
    'debug' => true,
);

// Allow Flight to use twig :
Flight::register('view', '\Twig\Environment', array($loader, $twigConfig), function ($twig) {
    $twig->addExtension(new \Twig\Extension\DebugExtension()); // Add the debug extension
    $twig->addGlobal('ma_valeur', "Hello There!"); // Can use 'ma_valeur' in all twig views

    $twig->addFilter(new \Twig\TwigFilter('trad', function($string){
        return $string;
    })); // Filter how return an unchanged string
});

//For call more simply the views
Flight::map('render', function($template, $data=array()){

    Flight::view()->display($template, $data);
    // After that, we can write : Flight::render('child_view.twig');
    
});

/* ----- Starting routing ------*/

Flight::route('/', function(){

    $dinosaurs = getDinos();
    
    Flight::render('listeDino.twig', array(
        'dinosaurs' => $dinosaurs
    ));
});

Flight::route('/@dino', function($dino){

    $dino_names = getArrayOfDinoNames();

    $random_keys = array_rand($dino_names, 3); // Fetch 3 randoms dinosaurs
    $FirstRandomDino = $dino_names[$random_keys[0]];
    $SecondRandomDino = $dino_names[$random_keys[1]];
    $ThirdRandomDino = $dino_names[$random_keys[2]];

    $FirstDino = getDino($FirstRandomDino);
    $SecondDino = getDino($SecondRandomDino);
    $ThirdDino = getDino($ThirdRandomDino);

    $RandomDinos = array($FirstDino,$SecondDino,$ThirdDino);

    $dino = getDino($dino);

    $descriptionMD = renderHTMLFromMarkdown($dino->description);

    Flight::render('dino.twig', array(
        'dino' => $dino,
        'descriptionMD' => $descriptionMD,
        'randomDinos' => $RandomDinos
    ));

});

Flight::start();