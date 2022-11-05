<?php

namespace Adriano\NewSorting\Block\Product\ProductList;

class Toolbar extends \Magento\Catalog\Block\Product\ProductList\Toolbar
{
    public function aroundSetCollection(
        \Magento\Catalog\Block\Product\ProductList\Toolbar $subject,
        \Closure $proceed,
        $collection
    )
    {
        $currentOrder = $subject->getCurrentOrder();
        $result = $proceed($collection);
        if ($currentOrder) {
            if ($currentOrder == 'price_desc') {
                $subject->getCollection()->setOrder('price', 'desc');
            } else if ($currentOrder == 'price_asc') {
                $subject->getCollection()->setOrder('price', 'asc');
            }
        }
        return $result;
    }
}
