<?php

use Michelf\Markdown;

function getDinos()
{
    $response = Requests::get('https://allosaurus.delahayeyourself.info/api/dinosaurs/');

    $dinosaurs=json_decode($response->body);

    return $dinosaurs;
}

function getDino($dino)
{
    $response = Requests::get('https://allosaurus.delahayeyourself.info/api/dinosaurs/' . $dino);

    $dino=json_decode($response->body);

    return $dino;
}

// For Markdown
function renderHTMLFromMarkdown($string_markdown_formatted)
{
    return Markdown::defaultTransform($string_markdown_formatted);
}

function getArrayOfDinoNames()
{
    $dinosaurs=getDinos();

    $dino_names = array();

    foreach($dinosaurs as $value)
    {
        array_push($dino_names,$value->slug);
    }

    return $dino_names;
}