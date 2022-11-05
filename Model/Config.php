<?php

namespace Adriano\NewSorting\Model;

class Config extends \Magento\Catalog\Model\Config
{
    public function afterGetAttributeUsedForSortByArray(
        \Magento\Catalog\Model\Config $catalogConfig,
        $options
    )
    {
        unset($options['position']);
        unset($options['price']);
        return $options;
    }
}
