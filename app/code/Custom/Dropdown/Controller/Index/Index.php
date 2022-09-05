<?php
namespace Custom\Dropdown\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Index extends Action
{ /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory

    ) {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);

    }
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__(' heading '));
        $block = $resultPage->getLayout()
                ->createBlock('Custom\Dropdown\Block\Index')
                ->setTemplate('Custom_Dropdown::list.phtml')
                ->toHtml();
        $this->getResponse()->setBody($block);
    }
}

