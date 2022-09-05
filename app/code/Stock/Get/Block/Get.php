<?php
namespace Stock\Get\Block;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Magento\CatalogInventory\Model\Stock\StockItemRepository;

class Index extends Template
{
protected $stockItemRepository;

public function __construct(
Context $context,StockItemRepository $stockItemRepository )
{
$this->stockItemRepository = $stockItemRepository;
 parent::__construct($context);
}

public function getStockItem($productId)
{
return $this->stockItemRepository->get($productId);
}
}
