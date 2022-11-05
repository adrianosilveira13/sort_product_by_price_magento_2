<?php

namespace Adriano\NewSorting\Setup\Patch\Data;

use Magento\Catalog\Model\Product\Attribute\Backend\Price;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Eav\Setup\EavSetupFactory;

class AddEavAttribute implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * Eav setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @inheridoc
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'price_asc',
            [
                'type' => 'decimal',
                'label' => 'Menor Preço',
                'input' => 'price',
                'backend' => Price::class,
                'sort_order' => 1,
                'global' => ScopedAttributeInterface::SCOPE_WEBSITE,
                'searchable' => true,
                'filterable' => true,
                'visible_in_advanced_search' => true,
                'used_in_product_listing' => true,
                'used_for_sort_by' => true,
                'apply_to' => 'simple,virtual',
                'group' => 'Prices',
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'price_desc',
            [
                'type' => 'decimal',
                'backend' => Price::class,
                'frontend' => '',
                'label' => 'Maior Preço',
                'input' => 'price',
                'class' => '',
                'source' => '',
                'global'=> ScopedAttributeInterface::SCOPE_STORE,
                'visible' => false,
                'required' => false,
                'user_defined' => false,
                'default' => 0,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_for_sort_by' => true,
                'unique' => false,
                'apply_to' => '',
                'group' => 'Prices'
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'price_asc',
            [
                'type' => 'decimal',
                'backend' => Price::class,
                'frontend' => '',
                'label' => 'Menor Preço',
                'input' => 'price',
                'class' => '',
                'source' => '',
                'global'=> ScopedAttributeInterface::SCOPE_STORE,
                'visible' => false,
                'required' => false,
                'user_defined' => false,
                'default' => 0,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_for_sort_by' => true,
                'unique' => false,
                'apply_to' => '',
                'group' => 'Prices'
            ]
        );
    }

    /**
     * @inheridoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheridoc
     */
    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheridoc
     */
    public function getAliases()
    {
        return [];
    }
}
