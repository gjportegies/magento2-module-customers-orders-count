<?php

namespace SpringImport\CustomersOrdersCount\Plugin\Customer;

use Magento\Customer\Api\Data\CustomerExtensionFactory;
use Magento\Customer\Api\Data\CustomerExtensionInterface;
use Magento\Customer\Api\Data\CustomerInterface;

class CustomerAttributesLoad
{
    /**
     * @var CustomerExtensionFactory
     */
    protected $extensionFactory;

    /**
     * @param CustomerExtensionFactory $extensionFactory
     */
    public function __construct(CustomerExtensionFactory $extensionFactory)
    {
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @param CustomerInterface $entity
     * @param CustomerExtensionInterface|null $extension
     * @return CustomerExtensionInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetExtensionAttributes(
        CustomerInterface $entity,
        CustomerExtensionInterface $extension = null
    ) {
        if ($extension === null) {
            $extension = $this->extensionFactory->create();
        }

        return $extension;
    }
}
