<?php


namespace I95Dev\SalesPersonDashboard\Model;


use Magento\Framework\Model\AbstractModel;
use I95Dev\SalesPersonDashboard\Model\ResourceModel\Sales as SalesResourceModel;

class Sales  extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(SalesResourceModel::class);
    }
}

