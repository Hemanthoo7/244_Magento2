<?php


namespace I95Dev\SalesPersonDashboard\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Sales extends AbstractDb
{
    const MAIN_TABLE = 'sales_order';
    const ID_FIELD_NAME = 'id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}

