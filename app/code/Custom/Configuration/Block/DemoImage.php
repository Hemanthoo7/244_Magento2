<?php
namespace Webkul\Demo\Block;

class DemoImage extends \Magento\Config\Block\System\Config\Form\Field {


    public function __construct(
        \Magento\Framework\View\Asset\Repository $assetRepo,
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        $this->_assetRepo = $assetRepo;
        parent::__construct($context, $data);
    }

    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element) {
        $imageUrl = $this->_assetRepo->getUrl("Webkul_Demo::images/demoImage.png");
        $html = "<img src='$imageUrl' alt='Demo Image' width='1000' height='100' />";
        return $html;
    }

}
