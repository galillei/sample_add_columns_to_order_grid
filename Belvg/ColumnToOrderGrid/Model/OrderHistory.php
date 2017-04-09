<?php
/**
 * Created by PhpStorm.
 * User: galillei
 * Date: 17.4.16
 * Time: 12.19
 */

namespace Belvg\ColumnToOrderGrid\Model;


class OrderHistory extends \Magento\Framework\Model\AbstractModel
{
    const TYPE_IN_RABBITMQ = 'in_queue';
    const TYPE_ERROR_ADDING_TO_RABBITMQ = 'error';
    const TYPE_IN_RICS = 'in_rics';
    const VALIDATION_ERROR_IN_BRIDGE = 'error';
    const BRIDGE_IS_UNAVAILABLE = 'error';
    const ERROR_IN_RICS = 'error';
    const ERROR = 'error';
    const TYPE_IN_BRIDGE = 'in_bridge';
    const INVALID_VALIDATION_IN_RICS = 'invalid_validation_in_rics';
    const SUCCESS_SET_IN_RICS = 'success_set_in_rics';
    const ERROR_ADDING_TO_BRIDGE = 'error';
    const NOT_IN_QUEUE = 'not_in_queue';

    public function getGridColumn($id)
    {
        if($id % 2 === 0){

            return '<p style="background:rgba(255, 6, 26, 0.2);text-align: center;border:2px solid #800501;">' .$id.'</p>';
        }else{
            return '<p style="background:rgba(20, 255, 92, 0.2);text-align: center;border:2px solid green;">' .$id.'</p>';

        }

        return '<p style="background:rgba(9, 138, 255, 0.2);text-align: center;border:2px solid #040880;">' .$id.'</p>';
    }






}