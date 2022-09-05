<?php
namespace Seller\Account\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Seller extends AbstractDb
{
    const MAIN_TABLE = 'seller_account';
    const ID_FIELD_NAME = 'id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}

