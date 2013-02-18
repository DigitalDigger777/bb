<?php

class DeliveryMethod extends CActiveRecord
{
    public function model($className = __CLASS__) {
        parent::model($className);
    }
    
    public function tableName() {
        return 'bb_delivery_methods';
    }
}
?>
