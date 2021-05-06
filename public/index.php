<?php

    require_once '../vendor/autoload.php';

    use CsvRepace\CsvRepace;

    use TpgHelper\TpgHelper;

    $CsvRepace = new CsvRepace;

    $CsvRepace
        ->setDir('../csvdata')
        ->isDir()
        ->replaceData();

    // $CsvRepace->getInfo();

    exit;
    echo "Hallo";
    TpgHelper::e($CsvRepace->getDir());
    exit;

    
