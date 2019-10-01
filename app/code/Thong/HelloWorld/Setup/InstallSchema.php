<?php
namespace Thong\HelloWorld\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('sm_article')) {
            try {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('sm_article')
                )
                    ->addColumn(
                        'article_id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary' => true,
                            'unsigned' => true,
                        ],
                        'Article ID'
                    )
                    ->addColumn(
                        'title',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Title'
                    )
                    ->addColumn(
                        'content',
                        Table::TYPE_TEXT,
                        '64k',
                        [],
                        'Content'
                    )
                    ->addColumn(
                        'image',
                        Table::TYPE_TEXT,
                        255,
                        [],
                        'Image'
                    )
                    ->addColumn(
                        'created_at',
                        Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                        'Created At'
                    )->addColumn(
                        'updated_at',
                        Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                        'Updated At'
                    )
                    ->setComment('Article Table');
            } catch (\Zend_Db_Exception $e) {
            }
            try {
                $installer->getConnection()->createTable($table);
            } catch (\Zend_Db_Exception $e) {
            }

            $installer->getConnection()->addIndex(
                $installer->getTable('sm_article'),
                $setup->getIdxName(
                    $installer->getTable('sm_article'),
                    ['title','content','image'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['title','content','image'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }
}
