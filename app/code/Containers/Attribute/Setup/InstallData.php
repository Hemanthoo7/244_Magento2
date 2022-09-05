<?php
namespace Containers\Attribute\Setup;
use Containers\Attribute\Model\Attribute\Frontend\Dimensions as Frontend;
use Containers\Attribute\Model\Attribute\Source\Dimensions as Source;
use Containers\Attribute\Model\Attribute\Backend\Dimensions as Backend;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $eavSetupFactory;

    public function _construct(
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
            Product::ENTITY,
            'Dimensions',
            [
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'Dimensions',
                'input' => 'select',
                'source' => Source::class,
                'frontend' => Frontend::class,
                'backend' => Backend::class,
                'required' => false,
                'sort_order' => 50,
                'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_STORE,
                'visible' => true,
                'attribute_set_id' => 'Containers',
                'used_in_product_listing' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true,
                ' is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
            ]
        );
    }
}
