<?php
/**
 * Copyright © Swenson, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Swenson\Downloadable\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        $installer = $setup;

        $installer->startSetup();

        $eavTable[] = $installer->getTable('downloadable_link');
        $eavTable[] = $installer->getTable('downloadable_link_purchased_item');

        $connection = $installer->getConnection();

        foreach ($eavTable as $table) {
            $connection->addColumn($table,
                'is_visible',
                ['type' => Table::TYPE_BOOLEAN, 'nullable' => false, 'comment' => 'Is visible']
            );
        }

        $installer->endSetup();

    }
}