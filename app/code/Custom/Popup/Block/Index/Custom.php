<?php
namespace Custom\Popup\Block\Index;
class Custom extends \Magento\Framework\View\Element\Template
{

     public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
       }


    public function getFormAction()
    {

        return '/popup/index/index';

    }
}

