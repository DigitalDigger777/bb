<?php

class CartController extends Controller
{    
    public function actionIndex()
    {
        $this->layout = 'front';
        if(isset(Yii::app()->session['cart']))
        {
            $cart = Yii::app()->session['cart'];
            $pid = array();
            foreach($cart as $item)
                $pid[] = $item['product_id'];
            
            $criteria = new CDbCriteria();
            $criteria->addInCondition('id', $pid);
            $products = Product::model()->findAll($criteria);
        }else
            $products = array();
        
        $this->render('index', array('products'=>$products, 'cart'=>$cart));
    }
    
    public function actionOrder()
    {
        $this->layout = 'front';
        $this->render('order');
    }

    public function actionAddToCart()
    {
        $a = Yii::app()->session['cart'];
        //$cart_count = Yii::app()->session['cart_count'];
        $cart_count = 0;
        
        $a[$_REQUEST['product_id']]['product_id']    = $_REQUEST['product_id'];
        $a[$_REQUEST['product_id']]['count']         = 1;
        foreach($a as $item)
            $cart_count += $item['count'];
        Yii::app()->session['cart']                  = $a;
        Yii::app()->session['cart_count'] = $cart_count;
        print($cart_count);
        Yii::app()->end();
    }
    
    public function actionChangeCount()
    {
        $a = Yii::app()->session['cart'];
        //$cart_count = Yii::app()->session['cart_count'];
        $cart_count = 0;
        
        $a[$_REQUEST['product_id']]['count'] = $_REQUEST['count'];
        foreach($a as $item)
            $cart_count += $item['count'];        
        Yii::app()->session['cart']         = $a;
        Yii::app()->session['cart_count']   = $cart_count;
        print($cart_count);
        Yii::app()->end();
    }
    
    public function actionDelete()
    {
        $a = Yii::app()->session['cart'];
        $cart_count = 0;
        unset($a[$_REQUEST['product_id']]);
        foreach($a as $item)
            $cart_count += $item['count'];
        
        Yii::app()->session['cart']         = $a;
        Yii::app()->session['cart_count']   = $cart_count;
        print($cart_count);
        Yii::app()->end();
    }
}
?>
