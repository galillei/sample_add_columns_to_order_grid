<?php
/**
 * Created by PhpStorm.
 * User: galillei
 * Date: 1.7.16
 * Time: 10.32
 */

namespace Belvg\ColumnToOrderGrid\Model\Config;

use Belvg\ColumnToOrderGrid\Model\OrderHistory;

class Statuses implements \Magento\Framework\Data\OptionSourceInterface
{

    public static $table = 'sales_order_grid';
    public static $leftJoinTable = 'rics_order_queue';

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        $options = [];
        $options[] = [
            'label' => __('In Queue'),
            'value' => OrderHistory::TYPE_IN_RABBITMQ

        ];
        $options[] = [
            'label' => __('Error'),
            'value' => OrderHistory::ERROR

        ];

        $options[] = [
            'label' => __('In bridge'),
            'value' => OrderHistory::TYPE_IN_BRIDGE

        ];
        $options[] = [
            'label' => __('Invalid validation in rics'),
            'value' => OrderHistory::INVALID_VALIDATION_IN_RICS
        ];
        $options[] = [
            'label' => __('Success'),
            'value' => OrderHistory::SUCCESS_SET_IN_RICS
        ];
        $options[] = [
            'label' => __('in RICS'),
            'value' => OrderHistory::TYPE_IN_RICS
        ];
        $options[] = [
            'label' => __('Not IN Queue'),
            'value' => OrderHistory::NOT_IN_QUEUE
        ];
        return $options;
    }


}