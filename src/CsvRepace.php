<?php

    declare(strict_types = 1);

    namespace CsvRepace;

    use Exception;
    use TpgHelper\TpgHelper;

    class CsvRepace implements CsvRepaceInterface
    {
        private $dir;
        private $ingnore;
        private $replace;
        private TpgHelper $Helper;
        private $file;

        public function __construct()
        {
            $this->Helper = new TpgHelper();
            return $this;
        }

        public function setDir( string $dir ) : CsvRepace
        {
            $this->dir = $dir;
            return $this;
        }

        public function setIngnore( array $ingnore ) : CsvRepace
        {
            $this->ingnore = $ingnore;
            return $this;
        }

        public function setReplace( array $replace ) : CsvRepace
        {
            $this->replace = $replace;
            return $this;
        }

        public function getDir()
        {
            return $this->dir;
        }

        public function isDir() : CsvRepace
        {
            if ( ! is_dir ( $this->dir )) {

                throw new Exception('The folder does not exist.');
            }

            return $this;
        }

        public function replaceData() : CsvRepace
        {
            $folder = $this->dir     ?? CsvRepace::DEFAULT_FOLDER;
            $dia    = $this->ingnore ?? CsvRepace::DEFAULT_INGNORE_ARRAY;
            $dra    = $this->replace ?? CsvRepace::DEFAULT_REPLACE_ARRAY;

            if ( $handle = opendir($folder) ) {

                while ( ( $file = readdir( $handle ) ) !== false ) {

                    if ( ( array_search( $file, $dia ) ) === false ) {

                        $path_parts = pathinfo( $folder . '/' . $file );

                        if( $path_parts['extension'] != "csv" ){ continue; }

                        $contents = file_get_contents( $folder . '/' . $file );
                        $contents = explode( "\n", $contents );
                        $out      = fopen( $folder . '/' . $file, 'w');

                        foreach( $contents as $row ){

                            if( empty($row) ){ continue; }

                            $row = str_replace("\r", '', $row);
                            $row = trim($row, '"');
                            $row = str_replace($dra,  'XXXX', $row);
                            $row = str_replace('XXXX',';',    $row);
                            $row = str_replace('"',   "'",    $row);

                            fputcsv($out, explode(";", $row), ";");
                        }
                    }
                }
            }

            return $this;
        }

        public function getInfo() : void
        {
            $folder = $this->dir     ?? CsvRepace::DEFAULT_FOLDER;
            $dia    = $this->ingnore ?? CsvRepace::DEFAULT_INGNORE_ARRAY;
            $dra    = $this->replace ?? CsvRepace::DEFAULT_REPLACE_ARRAY;

            $infoArray = [
                'folder'            => $folder,
                'count CSV-Files'   => count(glob( $folder.'/*{.csv}',128)),
                'ingnore Array'     => $dia,
                'replace Array'     => $dra,
                'change folder, ingnore or replace' => "/src/CsvReplaceInterface"
            ];

            $this->Helper::e( $infoArray );

            exit;
        }
    }