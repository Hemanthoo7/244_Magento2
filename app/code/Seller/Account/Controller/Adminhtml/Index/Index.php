<?php
namespace Seller\Account\Controller\Adminhtml\Index;
class Index extends \Magento\Backend\App\Action
{
         protected $resultPageFactory = false;
         public function __construct(
                 \Magento\Backend\App\Action\Context $context,
                 \Magento\Framework\View\Result\PageFactory $resultPageFactory
         ) {
                 parent::__construct($context);
                 $this->resultPageFactory = $resultPageFactory;
         }
         public function execute()
         {
                 $resultPage = $this->resultPageFactory->create();
                 $resultPage->setActiveMenu('Seller_Account::menu');
                 $resultPage->getConfig()->getTitle()->prepend(__('Seller Data'));
                 return $resultPage;
         }
         protected function _isAllowed()
         {
                 return $this->_authorization->isAllowed('Seller_Account::menu');
         }
}
