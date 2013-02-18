<?php

class Product extends CActiveRecord
{
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function tableName() {
        return 'bb_products';
    }
    
    public static function getProductList($category_id = 0, $brand_id = 0)
    {
        $condition = '1';
        $params = array();
        if($category_id)
        {
            $condition .= ' AND (category_id=:category_id OR parent_id=:category_id)';
            $params[':category_id'] = $category_id;
        }
        if($brand_id)
        {
            $condition .= ' AND brand_id=:brand_id';
            $params[':brand_id'] = $brand_id;
        }
        $products = Yii::app()->getDb()->createCommand()
                                       ->selectDistinct('t1.*, group_concat(t3.name) category, t4.name brand')
                                       ->from('bb_products t1')
                                       ->join('bb_category_product t2', 't1.id = t2.product_id')
                                       ->join('bb_categories t3', 't2.category_id = t3.id')
                                       ->join('bb_brands t4', 't1.brand_id = t4.id')
                                       ->where($condition, $params)
                                       ->group('t1.id')
                                       ->order('id desc')
                                       ->queryAll();
        return $products;
    }
}
?>