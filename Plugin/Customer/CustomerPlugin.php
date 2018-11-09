<?php

namespace SpringImport\CustomersOrdersCount\Plugin\Customer;

use Magento\Customer\Api\Data\CustomerInterfaceFactory;

class CustomerPlugin
{
    /**
     * @var CustomerInterfaceFactory
     */
    protected $customerDataFactory;

    /**
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    protected $dataObjectHelper;

    public function __construct(
        CustomerInterfaceFactory $customerDataFactory,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper
    ) {
        $this->customerDataFactory = $customerDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    public function afterGetDataModel(\Magento\Customer\Model\Customer $subject, $result)
    {
        $ordersCount = $subject->getData('orders_count');

        $extensionAttributes = $result->getExtensionAttributes();
        $extensionAttributes->setOrdersCount($ordersCount);
        $result->setExtensionAttributes($extensionAttributes);

        return $result;
    }
}
