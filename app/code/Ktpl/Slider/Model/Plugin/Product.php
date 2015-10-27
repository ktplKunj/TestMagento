<?php
/**
 * Created by PhpStorm.
 * User: kunj.joshi
 * Date: 10/1/15
 * Time: 12:41 PM
 */
namespace Ktpl\Slider\Model\Plugin;

class Product
{
    public function afterGetName(\Magento\Catalog\Model\Product $subject,$name)
    {
        return $name.' My Test';
    }
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject,$price)
    {
        return 10.00;
    }

}