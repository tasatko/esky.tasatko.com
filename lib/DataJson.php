<?php

/**
 * Class DataJson
 */
class DataJson extends DataFilter
{
    /**
     * @param $pathToFile
     * @return mixed
     */
    protected function _getArrayFromFile($pathToFile) {
        $jsonString = file_get_contents($pathToFile);
        $sourceArr = json_decode($jsonString);
        return $sourceArr;
    }

    /**
     * @param $fileSourceArray
     * @return array
     */
    protected function _setColumnArr($fileSourceArray){

        foreach($fileSourceArray as $key => $val){
            $this->code[] = $fileSourceArray[$key][0];
            $this->price[] = floatval(preg_replace("/[^-0-9\.]/",".", $fileSourceArray[$key][2]));
            $this->name[] = $fileSourceArray[$key][1];
            $this->group[] = $fileSourceArray[$key][3];
        }
    }
}