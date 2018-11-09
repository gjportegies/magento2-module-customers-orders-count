<?php

namespace SpringImport\CustomersOrdersCount\Model\Api\SearchCriteria\CollectionProcessor\FilterProcessor;

use Magento\Framework\Api\Filter;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor\FilterProcessor\CustomFilterInterface;
use Magento\Framework\Data\Collection\AbstractDb;

class OrdersCountFilter implements CustomFilterInterface
{
    /**
     * Apply orders_count filter to Customer Collection
     *
     * @param Filter $filter
     * @param AbstractDb $collection
     * @return bool Whether the filter is applied
     */
    public function apply(Filter $filter, AbstractDb $collection)
    {
        $sqlCondition = $this->getConditionSql(
            $collection->getConnection(),
            $filter->getField(),
            [
                $filter->getConditionType() => $filter->getValue()
            ]
        );

        $collection->getSelect()->where($sqlCondition, null, \Magento\Framework\DB\Select::TYPE_CONDITION);

        return true;
    }

    /**
     * @param $connection
     * @param $fieldName
     * @param $condition
     * @return mixed
     */
    protected function getConditionSql($connection, $fieldName, $condition)
    {
        return $connection->prepareSqlCondition($fieldName, $condition);
    }
}
