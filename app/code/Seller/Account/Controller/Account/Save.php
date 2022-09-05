<?php
namespace Seller\Account\Controller\Account;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Seller\Account\Model\SellerFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
class Save extends Action
{
    protected $resultPageFactory;
    protected $sellerFactory;
    public function __construct(
        Context          $context,
        PageFactory      $resultPageFactory,
        SellerFactory    $sellerFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->sellerFactory = $sellerFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getPost();
            print_r($data);
            if ($data) {
                $model = $this->sellerFactory->create();
                $model->setData($data)->save();
                $this->messageManager->addSuccessMessage(__("Success!!!."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("Can't submit, Please try again!!!"));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;

    }
}
