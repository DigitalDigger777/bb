<?php

class OrderController extends Controller
{
    public function actionIndex()
    {
        $orders = Yii::app()->getDb()->createCommand('SELECT T1.*, T2.name delivery
                                                      FROM `bb_orders` T1
                                                      JOIN `bb_delivery_methods` T2 ON T1.delivery_id = T2.id')->queryAll();
        $this->render('index', array('orders'=>$orders));
    }
    
    public function actionProducts()
    {
        $products = Yii::app()->getDb()->createCommand('SELECT *
                                            FROM `bb_order_product` T1
                                            JOIN `bb_products` T2 ON T1.product_id = T2.id
                                            JOIN `bb_brands` T3 ON T2.brand_id  = T3.id
                                            WHERE order_id = '.$_REQUEST['order_id'])->queryAll();
        //статус
        $_status = Status::model()->findAll();
        $status = array();
        foreach($_status  as $item)
            $status[$item->id] = $item->name;
        //валюта
        $currency = Currency::model()->find('symbol=:symbol',array(':symbol'=>isset($_REQUEST['symbol'])?$_REQUEST['symbol']:'UAH'));        
        $default_currency = Currency::model()->find('`default`=1');
        $this->render('products', array('products'=>$products, 'status'=>$status, 'currency'=>$currency, 'default_currency'=>$default_currency));
    }
    
    public function actionSave()
    {
        $this->layout = 'front';
        $order = new Order();
        $order->full_name       = $_REQUEST['full_name'];
        $order->mobile_phone    = $_REQUEST['mobile_phone'];
        $order->phone           = $_REQUEST['phone'];
        $order->email           = $_REQUEST['email'];
        $order->delivery_id     = $_REQUEST['delivery_id'];
        $order->address         = $_REQUEST['address'];
        $order->info            = $_REQUEST['info'];
        $order->date            = date('Y-m-d H:i:s');
        $order->save();
        //
        $cart = Yii::app()->session['cart'];
        $pid = array();
        
        foreach($cart as $item)        
            Yii::app()->getDb()->createCommand()->insert('bb_order_product', array('order_id'=>$order->id, 'product_id'=>$item['product_id'], 'count'=>$item['count']));
        Yii::app()->session['cart'] = array();
        Yii::app()->session['cart_count'] = 0;
        $this->render('confirm');
    }
    
}
?>
