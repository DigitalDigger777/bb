<?php

class ProductController extends Controller
{
    public function actionIndex()
    {
        $condition = '1';
        $params = array();
        if(isset($_REQUEST['category_id'])&&$_REQUEST['category_id']!=0)
        {
            $condition .= ' AND category_id=:category_id';
            $params[':category_id'] = $_REQUEST['category_id'];
        }
        if(isset($_REQUEST['brand_id'])&&$_REQUEST['brand_id']!=0)
        {
            $condition .= ' AND brand_id=:brand_id';
            $params[':brand_id'] = $_REQUEST['brand_id'];
        }
        $products = Yii::app()->getDb()->createCommand()
                                       ->selectDistinct('t1.*, ifnull(t2.category_id,0) `public`')
                                       ->from('bb_products t1')
                                       ->leftJoin('bb_category_product t2', 't1.id = t2.product_id')
                                       ->where($condition, $params)
                                       ->order('id desc')
                                       ->queryAll();

        $_status = Status::model()->findAll();
        $status = array();
        foreach($_status  as $item)
            $status[$item->id] = $item->name;
        $c = new CDbCriteria();
        $c->order = 'name';
        $brands = Brand::model()->findAll($c);
        $c = new CDbCriteria();
        $c->order = 'if(parent_id = 0, id, parent_id), parent_id';
        $categories = Category::model()->findAll($c);
        //валюты
        $default_currency = Currency::model()->find('`default`=1');
        $this->render('index', array('products'=>$products, 
                                     'status'=>$status, 
                                     'brands'=>$brands, 
                                     'categories'=>$categories,
                                     'default_currency'=>$default_currency));
    }
    
    public function actionProduct()
    {
        $brands = Brand::model()->findAll();
        $c = new CDbCriteria();
        $c->order = 'if(parent_id = 0, id, parent_id), parent_id';
        $categories = Category::model()->findAll($c);
        $this->render('product', array('brands'=>$brands, 'categories'=>$categories));
    }
    
    public function actionSave()
    {
        $price = isset($_REQUEST['price'])?$_REQUEST['price']:'';
        $ebay = '';
        if(!empty($price))
        {
            if(preg_match('/http:\/\/[\w\W]*?/', $price))
            {
                   $ebay = $_REQUEST['price'];
                   $price = 0;
                   //отправка запроса к ebay
                   $ch = curl_init();
                   curl_setopt($ch, CURLOPT_URL, $ebay);
                   curl_setopt($ch, CURLOPT_HEADER, false);
                   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                   $page = curl_exec($ch);
                   
                   if(!preg_match('/<span id="" style="white-space: nowrap;font-weight:bold;">US \$([\w\W]*?)<\/span>/', $page, $match))
                        preg_match('/<span id="prcIsum" itemprop="price"  style="">US \$([\w\W]*?)<\/span>/', $page, $match);
                   if(count($match)>0)
                       $price = $match[1];
            }
        }
        
        if(isset($_REQUEST['id'])&&$_REQUEST['id'] != 0)
        {
            $product = Product::model()->find('id=:id', array(':id'=>$_REQUEST['id']));
            $product->brand_id          = isset($_REQUEST['brand_id'])?$_REQUEST['brand_id']:$product->brand_id;
            $product->name              = isset($_REQUEST['name'])?$_REQUEST['name']:$product->name;
            $product->desc              = isset($_REQUEST['desc'])?$_REQUEST['desc']:$product->desc;
            $product->photo             = isset($_REQUEST['photo'])?$_REQUEST['photo']:$product->photo;
            $product->price             = $price;
            $product->margin            = isset($_REQUEST['margin'])?$_REQUEST['margin']:$product->margin;
            $product->discount          = isset($_REQUEST['discount'])?$_REQUEST['discount']:$product->discount;
            $product->ebay              = $ebay;
            $product->status_id         = isset($_REQUEST['status_id'])?$_REQUEST['status_id']:$product->status_id;
            $product->lang              = isset($_REQUEST['lang'])?$_REQUEST['lang']:$product->lang;
            $product->public            = isset($_REQUEST['public'])?$_REQUEST['public']:$product->public;
            $product->order             = isset($_REQUEST['order'])?$_REQUEST['order']:$product->order;
            $product->end_public        = isset($_REQUEST['end_public'])?$_REQUEST['end_public']:$product->end_public;
            $product->meta_desc         = isset($_REQUEST['meta_desc'])?$_REQUEST['meta_desc']:$product->meta_desc;
            $product->meta_keywords     = isset($_REQUEST['meta_keywords'])?$_REQUEST['meta_keywords']:$product->meta_keywords;
            $product->delivery_price    = isset($_REQUEST['delivery_price'])?$_REQUEST['delivery_price']:$product->delivery_price;
            $product->update();
        }  else {
            $product = new Product();        
            $product->brand_id          = isset($_REQUEST['brand_id'])?$_REQUEST['brand_id']:0;
            $product->name              = $_REQUEST['name'];
            $product->desc              = $_REQUEST['desc'];
            $product->photo             = isset($_REQUEST['photo'])?$_REQUEST['photo']:'';
            $product->price             = $price;
            $product->margin            = isset($_REQUEST['margin'])?$_REQUEST['margin']:0;
            $product->discount          = isset($_REQUEST['discount'])?$_REQUEST['discount']:0;
            $product->ebay              = $ebay;
            $product->status_id         = isset($_REQUEST['status_id'])?$_REQUEST['status_id']:1;
            $product->lang              = isset($_REQUEST['lang'])?$_REQUEST['lang']:'ru';
            $product->public            = isset($_REQUEST['public'])?$_REQUEST['public']:1;
            $product->order             = isset($_REQUEST['order'])?$_REQUEST['order']:0;
            $product->end_public        = isset($_REQUEST['end_public'])?$_REQUEST['end_public']:'0000-00-00';
            $product->meta_desc         = isset($_REQUEST['meta_desc'])?$_REQUEST['meta_desc']:$product->meta_desc;
            $product->meta_keywords     = isset($_REQUEST['meta_keywords'])?$_REQUEST['meta_keywords']:$product->meta_keywords;
            $product->delivery_price    = isset($_REQUEST['delivery_price'])?$_REQUEST['delivery_price']:$product->delivery_price;
            $product->save();
        }
        if(isset($_REQUEST['category_id'])&&count($_REQUEST['category_id'])>0)
        {
            foreach($_REQUEST['category_id'] as $item)
            {
                Yii::app()->getDb()->createCommand()->delete('bb_category_product', 'category_id=:category_id AND product_id=:product_id', array(':category_id'=>$item, ':product_id'=>$product->id));
                Yii::app()->getDb()->createCommand()->insert('bb_category_product', array('category_id'=>$item, 'product_id'=>$product->id));
            }
        }
        $this->redirect('index.php?r=product');
    }
    
    public function actionPublic()
    {
        $product = Product::model()->find('id=:id',array(':id'=>$_REQUEST['id']));
        $product->public = $product->public?0:1;
        $product->save();
        $this->redirect('index.php?r=product');
    }
    
    public function actionEdit()
    {
        $brands = Brand::model()->findAll();
        $c = new CDbCriteria();
        $c->order = 'if(parent_id = 0, id, parent_id), parent_id';        
        $categories = Category::model()->findAll($c);
        $product = Product::model()->find('id=:id',array(':id'=>$_REQUEST['id']));
        $_product_categories = Yii::app()->getDb()->createCommand()->select('*')
                                                                  ->from('bb_category_product')
                                                                  ->where('product_id=:id', array(':id'=>$_REQUEST['id']))->query();
        $product_categories = array();
        foreach($_product_categories as $item)
            $product_categories[$item['category_id']] = $item['category_id'];
        $this->render('product', array('product'=>$product, 'brands'=>$brands, 'categories'=>$categories, 'product_categories'=>$product_categories));
    }
    
    public function actionDelete()
    {
        $product = Product::model()->find('id=:id',array(':id'=>$_REQUEST['id']));
        $product->delete();
        $this->redirect('index.php?r=product');        
    }
    
    public function actionUploadPhoto()
    {
        if(isset($_FILES['_photo'])&&$_FILES['_photo']['error'] === 0)
        {
            $file = getimagesize($_FILES['_photo']['tmp_name']);
            
            switch($file['mime'])
            {
                case 'image/jpeg':
                        $ext = '.jpg';
                    break;
                case 'image/gif':
                        $ext = '.gif';
                    break;
                case 'image/png':
                        $ext = '.png';
                    break;
            }
            $name = time().''.$ext;
            
            if($file['mime'] == 'image/jpeg' || $file['mime'] == 'image/gif' || $file['mime'] == 'image/png')
            {
                move_uploaded_file($_FILES['_photo']['tmp_name'], 'images/products/'.$name);
                print('{"img":"'.$name.'"}');
            }else
            {
                print('{"error":"'.$file['mime'].'"}');
            }
        }else{
            print('{"error":"ошибка при загрузке"}');
        }
        Yii::app()->end();
    }
    
    //фронт
    public function actionProductList()
    {
        $this->layout = 'front';
        //категории
        $criteria = new CDbCriteria();
        $criteria->addCondition('parent_id=0');
        $criteria->order = 'if(parent_id = 0, id, parent_id), parent_id';
        $categories = Category::model()->findAll($criteria);
        //продукты
        $cat_id = isset($_REQUEST['cat_id'])?$_REQUEST['cat_id']:0;
        $brand_id = isset($_REQUEST['brand_id'])?$_REQUEST['brand_id']:0;
        $products = Product::getProductList($cat_id, $brand_id);
        //текущая категория
        if($cat_id)
        {
            $cat = Category::model()->find('id=:id', array(':id'=>$cat_id));
            $this->pageTitle = 'Beautybay | Продукты | '.$cat->name;
            Yii::app()->clientScript->registerMetaTag($cat->meta_keywords, 'keywords');
            Yii::app()->clientScript->registerMetaTag($cat->meta_desc, 'descript');
        }else
            $this->pageTitle = 'Beautybay | Продукты';
        //статус
        $_status = Status::model()->findAll();
        $status = array();
        foreach($_status  as $item)
            $status[$item->id] = $item->name;
        //валюта
        $currency = Currency::model()->find('symbol=:symbol',array(':symbol'=>isset($_REQUEST['symbol'])?$_REQUEST['symbol']:'UAH'));
        $this->render('frontlist', array('categories'=>$categories, 'products'=>$products, 'status'=>$status, 'currency'=>$currency));
    }
    //карточка продукта
    public function actionFrontProduct()
    {
        $this->layout = 'ajax';
        $product = Product::model()->find('id=:id', array(':id'=>$_REQUEST['id']));
        $this->render('frontproduct', array('product'=>$product));
    }
}
?>