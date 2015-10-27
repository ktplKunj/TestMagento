<?php
/**
 * Created by PhpStorm.
 * User: kunj.joshi
 * Date: 10/20/15
 * Time: 6:43 PM
 */
namespace Ktpl\Test\Model\Config;
class Reader extends \Magento\Framework\Config\Reader\Filesystem
{
    /**
     * List of id attributes for merge
     *
     * @var array
     */
    protected $_idAttributes = []; //['/config/option' => 'name','/config/option/inputType' => 'name'];
/**
 * @param \Magento\Framework\Config\FileResolverInterface $fileResolver
 * @param \Magento\Catalog\Model\ProductOptions\Config\Converter $converter
 * @param \Magento\Catalog\Model\ProductOptions\Config\SchemaLocator
$schemaLocator
 * @param \Magento\Framework\Config\ValidationStateInterface $validationState
 * @param string $fileName
 * @param array $idAttributes
 * @param string $domDocumentClass
 * @param string $defaultScope
 */
    public function __construct(
        \Magento\Framework\Config\FileResolverInterface $fileResolver,
        \Ktpl\Test\Model\Config\Converter $converter,
        \Ktpl\Test\Model\Config\SchemaLocator $schemaLocator,
        \Magento\Framework\Config\ValidationStateInterface $validationState,
        $fileName,
        $domDocumentClass,
        $defaultScope,
        $idAttributes
    ) {
        parent::__construct(
            $fileResolver,
            $converter,
            $schemaLocator,
            $validationState,
            $fileName,
            $idAttributes,
            $domDocumentClass,
            $defaultScope
        );
    }
}