<?php


class Counter
{
    private $_countFilePath;

    public function __construct()
    {
        $this->_countFilePath = File_Path;
    }

    public function getCount()
    {
        if (file_exists(File_Path)) {
            $file = fopen(File_Path, "r") or die("Unable to open file!");
            return (int) fgets( $file);
        } else {
            return 0;
        }
    }   

    public function incrementCount()
    {
        $count = $this->getCount();
        $count++;
        $file = fopen(File_Path, "w") or die("Unable to open file!");
        $count = fwrite($file, $count);
        fclose($file);
    }
}