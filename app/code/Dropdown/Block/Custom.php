<?php
namespace I95Dev\Dropdown\Block;
class Custom extends \Magento\Framework\View\Element\Template
{

protected function _prepareLayout()
{

      return parent ::_prepareLayout();
}

    

    
    public function getContentForDisplay()
    {

        return '/dropdown/index/index';

    }
}

