<?php

/**
 * Class BuilderResponse
 */
class BuilderResponse
{
    /**
     * @param $array
     * @return string
     */
    public function buildTable($array)
    {
        if(empty($array)) {return false;}

        // start table

        $html = '<table>';

        // header row

        $html .= '<thead>';
        $html .= '<tr>';

        foreach(array_values($array)[0] as $key=>$value){

            $html .= '<th>' . $key . '</th>';
        }

        $html .= '</tr>';
        $html .= '</thead>';

        // data rows
        $html .= '<tbody>';
        foreach( $array as $key=>$value){

            $html .= '<tr>';

            foreach($value as $key2=>$value2){

                $html .= '<td>' . $value2 . '</td>';

            }

            $html .= '</tr>';

        }
        $html .= '</tbody>';
        // finish table and return it

        $html .= '</table>';

        return $html;

    }
}