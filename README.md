# csvReplace

    require_once '../vendor/autoload.php';

    use CsvRepace\CsvRepace;
    use TpgHelper\TpgHelper;

    $CsvRepace = new CsvRepace;

Use for information:

    $CsvRepace
        ->setDir('../csvdata')
        ->isDir()
        ->getInfo();

Use for replace:

    $CsvRepace
        ->setDir('../csvdata')
        ->isDir()
        ->replaceData();