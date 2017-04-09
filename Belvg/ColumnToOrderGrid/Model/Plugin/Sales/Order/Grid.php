<?php
namespace Belvg\ColumnToOrderGrid\Model\Plugin\Sales\Order;

use Magento\Framework\Setup\SchemaSetupInterface;

class Grid 
{

    public static  $table = 'sales_order_grid';
    public static $leftJoinTable = 'rics_order_queue';

    
    public function afterSearch($intercepter, $collection)
    {
        if($collection->getMainTable() === $collection->getConnection()->getTableName(self::$table)){
            $leftJoinTableName = $collection->getConnection()->getTableName(self::$leftJoinTable);
            $collection->getSelect()->joinLeft(['roq' => $leftJoinTableName], 'roq.order_id=main_table.entity_id and roq.type=(IF(main_table.status=\'canceled\',\'canceled\',\'order_save\'))',  new \Zend_Db_Expr('IFNULL(roq.rics_status,\'not_in_queue\') as rics_status'));
            $where = $collection->getSelect()->getPart(\Magento\Framework\DB\Select::WHERE);
            foreach($where as &$wh){

                if(preg_match(preg_quote('/`rics_status` IN(/'), $wh) && preg_match('/not_in_queue/', $wh))
                {
                     $wh = substr($wh, 0, -1) .' OR `rics_status` IS NULL)';
                }
            }
            $collection->getSelect()->setPart(\Magento\Framework\DB\Select::WHERE, $where);

        }
        return $collection;
        
        
    }

    public function getConfig($path)
    {
        return $this->_scopeConfig->getValue($path);
    }

    public function __construct(\Magento\Framework\View\Element\Context $context,
                                array $data = []
    )
    {
        $this->_scopeConfig = $context->getScopeConfig();
    }
    
    
}