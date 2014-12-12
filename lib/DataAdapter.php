<?php

/**
 * Class DataAdapter
 */
class DataAdapter
{
    /**
     * @var
     */
    private $externalDataArray;

    /**
     * @param $externalDataArray
     */
    public function __construct($externalDataArray){
        $this->externalDataArray = $externalDataArray;
    }

    /**
     * @return mixed
     */
    public function getArray(){
        return $this->externalDataArray->getArray();
    }
}