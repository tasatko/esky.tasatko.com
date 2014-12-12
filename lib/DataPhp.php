<?php

/**
 * Class DataPhp
 */
class DataPhp extends DataFilter
{
    /**
     * @param $pathToFile
     * @return mixed
     */
    protected function _getArrayFromFile($pathToFile){
        $phpArr = include $pathToFile;
        return $phpArr;
    }

    /**
     * @param $fileSourceArray
     * @return array
     */
    protected function _setColumnArr($fileSourceArray){
        foreach ($fileSourceArray as $region => $arrayOfValues){
            foreach ($arrayOfValues as $key => $val){
                $this->code[] = $key;
                $this->price[] = floatval(preg_replace("/[^-0-9\.]/", ".", $arrayOfValues[$key]['value']));
                $this->name[] = $arrayOfValues[$key]['name'];
                $this->group[] = $region;
            }
        }
    }
}