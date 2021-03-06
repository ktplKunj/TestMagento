<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Sales\Test\Unit\Model\Order\Customer;

/**
 * Class BuilderTest
 */
class ManagementTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $objectCopyService;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $accountManagement;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $customerFactory;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $addressFactory;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $orderRepository;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $regionFactory;

    /**
     * @var \Magento\Sales\Model\Order\Customer\Management
     */
    protected $service;

    protected function setUp()
    {
        $this->objectCopyService = $this->getMock('\Magento\Framework\Object\Copy', [], [], '', false);
        $this->accountManagement = $this->getMock('\Magento\Customer\Api\AccountManagementInterface');
        $this->customerFactory = $this->getMock(
            '\Magento\Customer\Api\Data\CustomerInterfaceFactory',
            ['create'],
            [],
            '',
            false
        );
        $this->addressFactory = $this->getMock(
            '\Magento\Customer\Api\Data\AddressInterfaceFactory',
            ['create'],
            [],
            '',
            false
        );
        $this->regionFactory = $this->getMock(
            'Magento\Customer\Api\Data\RegionInterfaceFactory',
            ['create'],
            [],
            '',
            false
        );
        $this->orderRepository = $this->getMock('\Magento\Sales\Api\OrderRepositoryInterface');

        $this->service = new \Magento\Sales\Model\Order\Customer\Management(
            $this->objectCopyService,
            $this->accountManagement,
            $this->customerFactory,
            $this->addressFactory,
            $this->regionFactory,
            $this->orderRepository
        );
    }

    /**
     * @expectedException \Magento\Framework\Exception\AlreadyExistsException
     */
    public function testCreateThrowsExceptionIfCustomerAlreadyExists()
    {
        $orderMock = $this->getMock('\Magento\Sales\Api\Data\OrderInterface');
        $orderMock->expects($this->once())->method('getCustomerId')->will($this->returnValue('customer_id'));
        $this->orderRepository->expects($this->once())->method('get')->with(1)->will($this->returnValue($orderMock));
        $this->service->create(1);
    }

    public function testCreateCreatesCustomerBasedonGuestOrder()
    {
        $orderMock = $this->getMock('\Magento\Sales\Api\Data\OrderInterface');
        $orderMock->expects($this->once())->method('getCustomerId')->will($this->returnValue(null));
        $orderMock->expects($this->any())->method('getBillingAddress')->will($this->returnValue('billing_address'));
        $orderAddress = $this->getMock('\Magento\Sales\Api\Data\OrderAddressInterface');
        $addresses = [$orderAddress, $orderAddress];

        $orderMock->expects($this->any())->method('getAddresses')->will($this->returnValue($addresses));
        $this->orderRepository->expects($this->once())->method('get')->with(1)->will($this->returnValue($orderMock));
        $this->objectCopyService->expects($this->any())->method('copyFieldsetToTarget')->will($this->returnValueMap(
            [
                ['order_address', 'to_customer', 'billing_address', [], 'global', ['customer_data' => []]],
                ['order_address', 'to_customer_address', $orderAddress, [], 'global', 'address_data']
            ]
        ));
        $addressMock = $this->getMock('\Magento\Customer\Api\Data\CustomerAddressInterface');
        $this->addressFactory->expects($this->any())->method('create')->with(['data' => 'address_data'])->will(
            $this->returnValue($addressMock)
        );
        $customerMock = $this->getMock('\Magento\Customer\Api\Data\CustomerInterface');
        $customerMock->expects($this->any())->method('getId')->will($this->returnValue('customer_id'));
        $this->customerFactory->expects($this->once())->method('create')->with(
            ['data' => ['customer_data' => [], 'addresses' => [$addressMock, $addressMock]]]
        )->will($this->returnValue($customerMock));
        $this->accountManagement->expects($this->once())->method('createAccount')->with($customerMock)->will(
            $this->returnValue($customerMock)
        );
        $orderMock->expects($this->once())->method('setCustomerId')->with('customer_id');
        $this->orderRepository->expects($this->once())->method('save')->with($orderMock);
        $this->assertEquals($customerMock, $this->service->create(1));

    }
}
