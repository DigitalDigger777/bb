<?php

class BrandController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl',
        );
    }
    
    public function accessRules() {
        return array(
            array('allow',
                  'actions'=>array(),
                  'roles'=>array('admin')),          
            array('deny', 'users'=>array('*'))
        );
    }
    
    public function actionIndex()
    {
        $this->layout = '//layouts/mainauth';
        $brands = Yii::app()->getDb()->createCommand('SELECT T1.*, if(T2.id is null,0, count(1)) cnt
                                                        FROM `bb_brands` T1
                                                        LEFT JOIN `bb_products` T2 ON T1.id = T2.brand_id
                                                        GROUP BY T1.id')->queryAll();
        $this->render('index', array('brands'=>$brands));
    }
    
    public function actionSave()
    {
        $brand = new Brand();
        $brand->id      = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $brand->name    = $_REQUEST['name'];
        $brand->desc    = isset($_REQUEST['desc'])?$_REQUEST['desc']:'';
        $brand->logo    = isset($_REQUEST['logo'])?$_REQUEST['logo']:'';
        $brand->lang    = isset($_REQUEST['lang'])?$_REQUEST['lang']:'ru';
        $brand->public  = isset($_REQUEST['public'])?$_REQUEST['public']:1;
        $brand->order   = isset($_REQUEST['order'])?$_REQUEST['order']:0;
        $brand->save();
    }
}
?>