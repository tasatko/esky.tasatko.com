<?php

/**
 * Class Tools
 */
class Tools
{
    /**
     * @param $array
     * @return mixed
     */
    public function arrayToLowerRecursive($array){
        foreach ($array as $key=>$value){
            if(is_array($value)){
                $this->arrayToLowerRecursive($value);
                continue;
            }
            $array[$key] = strtolower($value);
        }
        return $array;
    }

    /**
     * @param $fullDataArray
     * @param string $value
     * @param string $order
     * @param bool $code_unique
     * @return array
     */
    public function sortBy($fullDataArray, $value = 'code', $order = 'desc', $code_unique = false){
        $total = array();
        foreach ($fullDataArray as $key => $val){
            if(empty($val[$value])){
                $value = 'code';
            }
            $total[$key] = $val[$value];
        }

        if($order == 'desc'){
            arsort($total);
        } else {
            asort($total);
        }

        foreach ($total as $key1 => $value1){
            $total[$key1] = $fullDataArray[$key1];
        }

        if($code_unique == 'true'){
            $total = $this->_makeUnique($total, $fullDataArray);
        }

        return $total;
    }

    /**
     * @param $total
     * @param $fullDataArray
     * @return array
     */
    private function _makeUnique($total, $fullDataArray){

        foreach ($total as $key => $val){
            $total[$key] = $val['code'];
        }

        $total = array_unique($total);

        foreach ($total as $key1 => $value1){
            $total[$key1] = $fullDataArray[$key1];
        }

        return $total;
    }
}