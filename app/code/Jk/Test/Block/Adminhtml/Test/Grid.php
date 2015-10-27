<?php
namespace Jk\Test\Block\Adminhtml\Test;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Jk\Test\Model\testFactory
     */
    protected $_testFactory;

    /**
     * @var \Jk\Test\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Jk\Test\Model\testFactory $testFactory
     * @param \Jk\Test\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Jk\Test\Model\testFactory $testFactory,
        \Jk\Test\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_testFactory = $testFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('test_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_testFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();
        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'test_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'test_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );
        $this->addColumn(
            'title',
            [
                'header' => __('Title'),
                'index' => 'title',
                'class' => 'xxx'
            ]
        );

        $this->addColumn(
            'publish_date',
            [
                'header' => __('Publish Date'),
                'index' => 'publish_date'
            ]
        );


        $this->addColumn(
            'is_active',
            [
                'header' => __('Status'),
                'index' => 'is_active',
                'type' => 'options',
                'options' => $this->_status->getOptionArray()
            ]
        );


        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => '*/*/edit'
                        ],
                        'field' => 'test_id'
                    ]
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('test_id');
        $this->getMassactionBlock()->setTemplate('Jk_Test::test/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('test');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('test/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('test/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


        return $this;
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('test/*/grid', ['_current' => true]);
    }

    /**
     * @param \Jk\Test\Model\test|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'test/*/edit',
            ['test_id' => $row->getId()]
        );
    }
}