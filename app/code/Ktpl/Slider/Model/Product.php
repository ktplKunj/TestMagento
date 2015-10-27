<?php
/**
 * Created by PhpStorm.
 * User: kunj.joshi
 * Date: 10/2/15
 * Time: 7:14 PM
 */
namespace Ktpl\Slider\Model;

class Product extends Ktpl\Slider\Model\Product//\Magento\Catalog\Model\Product
{
    /*public $_product;

    public function __construct(
        Product $product
    )
    {
        $this->_product=$product;
        $this->_product->setName("My Slide");
    }*/
    public function getName()
    {
        return "My Slide";
    }

   /* public function getOldName()
    {
        return parent::getName();
    }*/

}