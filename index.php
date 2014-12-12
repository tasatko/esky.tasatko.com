<?php

    foreach (glob("lib/*.php") as $filename){
        include_once $filename;
    }

    $objTools = new Tools();

    if(!empty($_GET)){

        $objDataAdapter = array();
        $fullDataArray = array();
        $getInterface = $objTools->arrayToLowerRecursive($_GET);

        //check if this type of source is required
        if(in_array('json', (array) $getInterface['source'])){
            $objDataJson = new DataJson('data/data.json');
            $objDataAdapter[] = new DataAdapter($objDataJson);
        }

        if(in_array('php', (array) $getInterface['source'])){
            $objDataPhp = new DataPhp('data/data.php');
            $objDataAdapter[] = new DataAdapter($objDataPhp);
        }

        if(in_array('xml', (array) $getInterface['source'])){
            $objDataXml = new DataXml('data/data.xml');
            $objDataAdapter[] = new DataAdapter($objDataXml);
        }

        $fullDataArray = array();
        $key = 0;

        //make array of object for polymorphic use in next
        foreach($objDataAdapter as $polymorphAdapter){
            foreach($polymorphAdapter->getArray() as $val ){
                $fullDataArray[$key] = $val;
                $key ++;
            }
        }

        //use sort interface after all table data complete
        $fullDataArray = $objTools->sortBy($fullDataArray, $getInterface['sort_field'], $getInterface['sort_order'], $getInterface['code_unique'], $getInterface['price']);
    }

//Put data into template, and generate table
$objView = new BuilderResponse();
include 'index.phtml';