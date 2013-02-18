<?php

class CategoryController extends Controller
{
    public function sortTree($array, $item)
    {
        $res = array();
        foreach($array as $_item)
            if($_item->parent_id == $item->id)
                $this->sortTree($array, $item);
    }
    
    public function actionIndex()
    {
        //$categories = Category::model()->findAll();
        $categories = Yii::app()->getDb()->createCommand('SELECT T1.*,if(category_id is null, 0, count(1)) cnt
                                                            FROM `bb_categories` T1
                                                            LEFT JOIN `bb_category_product` T2 ON T1.id = T2.category_id
                                                            GROUP BY T1.id
                                                            ORDER BY if(parent_id = 0, id, parent_id), parent_id')->queryAll();
        $paren_categories = Yii::app()->getDb()->createCommand('SELECT * FROM `bb_categories` WHERE parent_id = 0')->queryAll();
        $this->render('index', array('categories'=>$categories, 'paren_categories'=>$paren_categories));
    }
    
    public function actionSave()
    {
        if(isset($_REQUEST['parent_id'])&&$_REQUEST['parent_id']!=0)
        {
            $parent = Category::model()->find('id=:id', array(':id'=>$_REQUEST['parent_id']));
            if($parent)
                $level = $parent->level+1;
            else
                $level = 1;
        }else{
            $level = 1;
        }

        if(isset($_REQUEST['id'])&&$_REQUEST['id']!=0)
        {
            $category            = Category::model()->find('id=:id', array(':id'=>$_REQUEST['id']));
            $category->parent_id = isset($_REQUEST['parent_id'])?$_REQUEST['parent_id']:$category->parent_id;
            $category->name      = isset($_REQUEST['name'])?$_REQUEST['name']:$category->name;
            $category->lang      = isset($_REQUEST['lang'])?$_REQUEST['lang']:$category->lang;
            $category->public    = isset($_REQUEST['public'])?$_REQUEST['public']:$category->public;
            $category->order     = isset($_REQUEST['order'])?$_REQUEST['order']:$category->order;
            $category->level     = $level;
            $category->meta_keywords = isset($_REQUEST['meta_keywords'])?$_REQUEST['meta_keywords']:$category->meta_keywords;
            $category->meta_desc = isset($_REQUEST['meta_desc'])?$_REQUEST['meta_desc']:$category->meta_desc;
            $category->update();
        }
        else {
            $category            = new Category();
            $category->parent_id = $_REQUEST['parent_id'];
            $category->name      = $_REQUEST['name'];
            $category->lang      = isset($_REQUEST['lang'])?$_REQUEST['lang']:'ru';
            $category->public    = isset($_REQUEST['public'])?$_REQUEST['public']:1;
            $category->order     = isset($_REQUEST['order'])?$_REQUEST['order']:0;
            $category->level     = $level;
            $category->meta_keywords = isset($_REQUEST['meta_keywords'])?$_REQUEST['meta_keywords']:$category->meta_keywords;
            $category->meta_desc = isset($_REQUEST['meta_desc'])?$_REQUEST['meta_desc']:$category->meta_desc;            
            $category->save();
        }
        if(Yii::app()->request->isAjaxRequest)
            print(CJSON::encode ($category));
    }
    
    public function actionLoad()
    {
        $category = Category::model()->find('id=:id', array(':id'=>$_REQUEST['id']));
        print(CJSON::encode($category));
    }
    
    public function actionEdit()
    {
        $categories = Category::model()->findAll('parent_id=:parent_id', array('parent_id'=>0));
        $category = Category::model()->find('id=:id', array(':id'=>$_REQUEST['id']));
        $this->render('index', array('category'=>$category, 'categories'=>$categories));
    }
    
    public function actionPublic()
    {
        $category = Category::model()->find('id=:id',array(':id'=>$_REQUEST['id']));
        $category->public = $category->public?0:1;
        $category->save();
        $this->redirect('index.php?r=category');
    }
    
    public function actionDelete()
    {
        $category = Category::model()->find('id=:id',array(':id'=>$_REQUEST['id']));
        $category->delete();
        $this->redirect('index.php?r=category');        
    }
}
?>
