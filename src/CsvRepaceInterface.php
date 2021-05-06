<?php

    declare(strict_types = 1);

    namespace CsvRepace;

    interface CsvRepaceInterface
    {
        /** @var string */
        const DEFAULT_FOLDER = '../csvdata';

        /** @var array */
        const DEFAULT_INGNORE_ARRAY = [ '.','..','data.csv','data1.csv','original.csv','sicherung' ];
        
        /** @var array */
        const DEFAULT_REPLACE_ARRAY = [ '";"',';"','";' ];

        public function isDir();
        public function getDir();
        public function setReplace(array $replace) : CsvRepace;
        public function setIngnore(array $ingnore) : CsvRepace;
        public function setDir( string $dir )      : CsvRepace;
        public function replaceData()              : CsvRepace;
        public function getInfo()                  : void;
    }