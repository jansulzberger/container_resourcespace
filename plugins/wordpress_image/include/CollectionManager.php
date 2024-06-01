<?php

class CollectionManager
{

    public static function mapCollection(string $filename){
        $fileSlice = explode("_",$filename);
        $collectionName = substr(reset($fileSlice),0,2);
        return $collectionName;
    }
}