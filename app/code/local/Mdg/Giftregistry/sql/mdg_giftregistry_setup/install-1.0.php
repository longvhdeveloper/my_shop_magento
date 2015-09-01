<?php
$installer = $this;
$installer->startSetup();

//create table mdg_giftregistry/type
$tableName = $installer->getTable('mdg_giftregistry/type');
//check table is exists
if ($installer->getConnection()->isTableExists($tableName) != true) {
    $table = $installer->getConnection()->newTable($tableName)
        ->addColumn(
            'type_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
            array(
                'auto_increment' => true,
                'indetity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ),
            'Type Id'
        )->addColumn(
            'code',
            Varien_Db_Ddl_Table::TYPE_VARCHAR,
            25,
            array(
                'nullable' => true
            ),
            'Code'
        )->addColumn(
            'name',
            Varien_Db_Ddl_Table::TYPE_VARCHAR,
            255,
            array(
                'nullable' => true
            ),
            'Name'
        )->addColumn(
            'description',
            Varien_Db_Ddl_Table::TYPE_TEXT,
            null,
            array(
                'nullable' => true
            ),
            'Description'
        )->addColumn(
            'strore_id',
            Varien_Db_Ddl_Table::TYPE_SMALLINT,
            null,
            array(
                'unsigned' => true,
                'nullable' => false,
                'default' => '0'
            ),
            'Store Id'
        )->addColumn(
            'is_active',
            Varien_Db_Ddl_Table::TYPE_SMALLINT,
            null,
            array(
                'unsigned' => true,
                'nullable' => false,
                'default' => '1'
            ),
            'Is Active'
        )->setComment('Magento Develop Guide Type Table');
    $installer->getConnection()->createTable($table);
}

//create mdg_giftregistry/registry table
$tableName = $installer->getTable('mdg_giftregistry/entity');
//check if table already exists
if ($installer->getConnection()->isTableExists($tableName) != true) {
    $table = $installer->getConnection()
        ->newTable($tableName)
        ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
            array(
                'auto_increment' => true,
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ),
            'Entity Id'
        )->addColumn(
            'customer_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            10,
            array(
                'unsigned' => true,
                'nullable' => false,
                'default' => 0
            ),
            'Customer Id'
        )->addColumn(
            'type_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
            array(
                'unsigned' => true,
                'nullable' => false,
                'default' => '0'
            ),
            'Type id'
        )->addColumn(
            'website_id',
            Varien_Db_Ddl_Table::TYPE_SMALLINT,
            5,
            array(
                'unsigned' => true,
                'nullable' => false,
                'default' => '0'
            ),
            'Website Id'
        )->addColumn(
            'event_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null,
            array(),
            'Event name'
        )->addColumn(
            'event_date', Varien_Db_Ddl_Table::TYPE_DATE, null,
            array(),
            'Event date'
        )->addColumn(
            'event_country', Varien_Db_Ddl_Table::TYPE_TEXT, null,
            array(),
            'Event Country'
        )->addColumn(
            'event_location', Varien_Db_Ddl_Table::TYPE_TEXT, null,
            array(),
            'Event Location'
        )->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATE, null,
            array(
                'nullable' => false,
            ),
            'Created At'
        )->addIndex(
            $installer->getIdxName('mdg_giftregistry/entity', array('customer_id')),
            array('customer_id')
        )->addIndex(
            $installer->getIdxName('mdg_giftregistry/entity', array('website_id')),
            array('website_id')
        )->addIndex(
            $installer->getIdxName('mdg_giftregistry/entity', array('type_id')),
            array('type_id')
        )->addForeignKey(
            $installer->getFkName(
                'mdg_giftregistry/entity',
                'customer_id',
                'customer/entity',
                'entity_id'
            ),
            'customer_id',
            $installer->getTable('customer/entity'),
            'entity_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE,
            Varien_Db_Ddl_Table::ACTION_CASCADE
        )->addForeignKey(
            $installer->getFkName(
                'mdg_giftregistry/entity',
                'website_id',
                'core/website',
                'website_id'
            ),
            'website_id',
            $installer->getTable('core/website'),
            'website_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE,
            Varien_Db_Ddl_Table::ACTION_CASCADE
        )->addForeignKey(
            $installer->getFkName(
                'mdg_giftregistry/entity',
                'type_id',
                'mdg_giftregistry/type',
                'type_id'
            ),
            'type_id',
            $installer->getTable('mdg_giftregistry/type'),
            'type_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE,
            Varien_Db_Ddl_Table::ACTION_CASCADE
        );
    $installer->getConnection()->createTable($table);
}

//create tale mdg_giftregistry/item
$tableName = $installer->getTable('mdg_giftregistry/item');
//Check table is exist
if($installer->getConnection()->isTableExists($tableName) != true) {
    $table = $installer->getConnection()
        ->newTable($installer->getTable('mdg_giftregistry/item'))
        ->addColumn(
            'item_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            null,
            array(
                'auto_increment' => true,
                'unsigned' => true,
                'identity' => true,
                'nullable' => false,
                'primary' => true,
            ),
            'Item Id'
        )->addColumn(
            'product_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            null,
            array(
                'unsigned' => true,
                'nullable' => false,
            ),
            'Product Id'
        )->addColumn(
            'registry_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER,
            null,
            array(
                'nullable' => false
            ),
            'Entity Id'
        )->addColumn(
            'added_at',
            Varien_Db_Ddl_Table::TYPE_DATE,
            null,
            array(
                'nullable' => false
            ),
            'Added At'
        )->addIndex(
            $installer->getIdxName('mdg_giftregistry/item', array('product_id')),
            array('product_id')
        )->addIndex(
            $installer->getIdxName('mdg_giftregistry/item', array('registry_id')),
            array('registry_id')
        );
    $installer->getConnection()->createTable($table);
}

$installer->endSetup();