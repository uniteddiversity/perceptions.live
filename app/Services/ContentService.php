<?php

namespace Content\Services;

use App\MetaData;

class ContentService
{

    private $page_size = 20;
    /**
     * @var UserFollowing
     */
    private $userFollowing;
    /**
     * @var MetaData
     */
    private $metaData;

    public function __construct(MetaData $metaData)
    {
        $this->metaData = $metaData;
    }

    public function getMetaListByKey($key = '')
    {
        $meta_array = array();
        if(empty($key)){
            $meta_data = $this->metaData->get();
            $meta_array = array();

            $i = 0;
            foreach($meta_data as $info)
            {
                $meta_array[$info['type']][$i]['id'] = $info['id'];
                $meta_array[$info['type']][$i]['type'] = $info['type'];
                $meta_array[$info['type']][$i]['value'] = $info['value'];
                $i++;
            }
        }

        return $meta_array;
    }
}