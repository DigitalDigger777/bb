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
        $this->render('products');
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
