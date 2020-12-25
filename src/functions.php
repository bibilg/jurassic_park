<?php

function getDinos()
{
    $response = Requests::get('https://allosaurus.delahayeyourself.info/api/dinosaurs/');

    $dinosaurs=json_decode($response->body);

    return $dinosaurs;
}