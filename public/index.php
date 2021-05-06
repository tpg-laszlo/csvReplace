<?php

    require_once '../vendor/autoload.php';

    use CsvRepace\CsvRepace;

    $CsvRepace = new CsvRepace;

    $CsvRepace
        ->setDir('../csvdata')
        ->isDir()
        ->replaceData();

    // $CsvRepace->getInfo();

    
    
