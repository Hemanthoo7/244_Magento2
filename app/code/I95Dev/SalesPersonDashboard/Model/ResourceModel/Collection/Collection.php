<?php
declare(strict_types=1);

namespace I95Dev\SalesPersonDashboard\Model\ResourceModel\Collection;
use I95Dev\SalesPersonDashboard\Model\Sales as SalesModel;
use I95Dev\SalesPersonDashboard\Model\ResourceModel\Sales as SalesResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(SalesModel::class, SalesResourceModel::class);
    }
}

