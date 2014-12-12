<?php

/**
 * Class DataFilter
 */
abstract class DataFilter
{
    /**
     * @var array
     */
    protected $code = array();
    /**
     * @var array
     */
    protected $price = array();
    /**
     * @var array
     */
    protected $name = array();
    /**
     * @var array
     */
    protected $group = array();
    /**
     * @var array
     */
    protected $globArray = array();

    /**
     * @param $pathToFile
     */
    public function __construct($pathToFile) {
        $fileSourceArray = $this->_getArrayFromFile($pathToFile);
        $this->_setColumnArr($fileSourceArray);
        $this->_setGlobArray();
    }

    /**
     * @return array
     */
    public function getArray() {
        return $this->globArray;
    }

    /**
     * @param $pathToFile
     * @return mixed
     */
    protected abstract function _getArrayFromFile($pathToFile);

    /**
     * @param $fileSourceArray
     * @return mixed
     */
    protected abstract function _setColumnArr($fileSourceArray);

    /**
     * @param $id
     * @return bool
     */
    protected function _filteringData($id) {
        //filter by group
        if($_GET['group'] && !in_array($this->group[$id], (array) $_GET['group'])){
            return false;
        }

        //filter by price
        if(!empty($_GET['price_condition']) && !empty($_GET['price_value']) && is_numeric($_GET['price_value'])){
            $condition = $_GET['price_condition'];
            $value = $_GET['price_value'];

            if($condition == 'more' && $this->price[$id] <= $value) {
                return false;
            }

            if($condition == 'less' && $this->price[$id] >= $value) {
                return false;
            }

        }

        //... another filter

        //all filters passed
        return true;
    }

    /**
     * Set globArray with implemented filter data
     */
    protected function _setGlobArray()
    {
        foreach ($this->code as $key => $val) {
            if ($this->_filteringData($key)) {
                $this->globArray[$key]['code'] = $val;
                $this->globArray[$key]['price'] = $this->price[$key];
                $this->globArray[$key]['name'] = $this->name[$key];
                $this->globArray[$key]['group'] = $this->group[$key];
            }
        }
    }
}