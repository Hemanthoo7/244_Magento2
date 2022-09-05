<?php
namespace Seller\Account\Controller\Account;
use Magento\Framework\Controller\ResultFactory;
class Details extends \Magento\Framework\App\Action\Action
{

    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
