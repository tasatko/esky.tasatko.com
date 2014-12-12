<?php

/**
 * Class DataXml
 */
class DataXml extends DataFilter
{
    /**
     * @param $pathToFile
     * @return bool|mixed
     */
    protected function _getArrayFromFile($pathToFile){
        libxml_use_internal_errors(true);
        $doc = simplexml_load_file($pathToFile);

        if(!$doc){
            return false;
        }

        $sourceArr = unserialize(serialize(json_decode(json_encode((array) $doc), 1)));
        return $sourceArr;
    }

    /**
     * @param $fileSourceArray
     * @return array
     */
    protected function _setColumnArr($fileSourceArray){
        foreach($fileSourceArray['Item'] as $key=>$val){
            $val = array_change_key_case($val, CASE_LOWER);
            $this->code[] = $val['code'];
            $this->price[] = floatval(preg_replace("/[^-0-9\.]/",".", $val['value']));
            $this->name[] = $val['description'];
            $this->group[] = $val['@attributes']['Type'];
        }
    }
}