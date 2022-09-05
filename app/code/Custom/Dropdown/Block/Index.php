<?php
namespace Custom\Dropdown\Block;
class Index extends \Magento\Framework\View\Element\Template
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

