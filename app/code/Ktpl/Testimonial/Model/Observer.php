<?php
namespace Ktpl\Testimonial\Model;

class Observer 
{
	
	public function addTestimonialToTopmenuItems(\Magento\Framework\Event\Observer $observer)
	{
		$block = $observer->getEvent()->getBlock();
		$block->addIdentity('testimonial');
		$this->_addTestimonialMenu('testimonial', $observer->getMenu(), $block);
	}

	public function _addTestimonialMenu($testimonial,$parentTestimonialNode, $block){

		$block->addIdentity(\Magento\Catalog\Model\Category::CACHE_TAG . '_' . $testimonial);

		$tree = $parentTestimonialNode->getTree();
		$categoryData = $this->getMenuTestimonialData($testimonial);
		$categoryNode = new \Magento\Framework\Data\Tree\Node($categoryData, 'id', $tree, $parentTestimonialNode);
		$parentTestimonialNode->addChild($categoryNode);

	}

	public function getMenuTestimonialData($category)
	{
		$nodeId = 'ktpl-' . $category;
		$isActiveCategory = false;
		/** @var \Magento\Catalog\Model\Category $currentCategory */

	  /*  $currentCategory = $this->_registry->registry('current_category');
		if ($currentCategory && $currentCategory->getId() == $category->getId()) {
			$isActiveCategory = true;
		}*/

		$categoryData = [
			'name' => 'Testimonial',
			'id' => $nodeId,
			'url' => 'testimonial',
			'has_active' => $this->hasActive($category),
			'is_active' => $isActiveCategory,
		];

		return $categoryData;
	}

	protected function hasActive($category)
	{
		return false;
	}

}