<?php
/**
 * Created by PhpStorm.
 * User: galillei
 * Date: 1.7.16
 * Time: 9.15
 */

namespace Belvg\ColumnToOrderGrid\Ui\Component\Columns;

use Belvg\ColumnToOrderGrid\Model\OrderHistoryFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class OrderGrid extends Column
{
    /**
     * @var PriceCurrencyInterface|OrderHistory
     */
    protected $rics_order_history;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param OrderHistory $orderHistory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        OrderHistoryFactory $orderHistory,
        array $components = [],
        array $data = []
    )
    {
        $this->rics_order_history = $orderHistory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if ($item['status'] === 'cancel')
                    $item[$this->getData('name')] =
                        $this->rics_order_history->create()->getGridColumn($item['entity_id'], 'cancel');
                else {
                    $item[$this->getData('name')] =
                        $this->rics_order_history->create()->getGridColumn($item['entity_id'], 'order_save');
                }
            }
        }

        return $dataSource;
    }
}