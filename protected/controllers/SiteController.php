<?php

class SiteController extends Controller
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
                      'actions'=>array('index'),
                      'roles'=>array('admin')),                
                array('allow',
                      'actions'=>array('login','error','logout','site'),
                      'roles'=>array('guest','users')),
                array('deny', 'users'=>array('*'))
            );
        }
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
            $this->layout = '//layouts/mainauth';
            $cnt_category = count(Category::model()->findAll());
            $cnt_brand = count(Brand::model()->findAll());
            $cnt_product = count(Product::model()->findAll());
            $cnt_order = count(Order::model()->findAll());
            $this->render('index', array('cnt_category'=>$cnt_category, 
                                         'cnt_brand'=>$cnt_brand,
                                         'cnt_product'=>$cnt_product,
                                         'cnt_order'=>$cnt_order));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionSite()
        {
            $products = Yii::app()->getDb()->createCommand()
                                            ->select('*')
                                            ->from ('bb_products')
                                            ->queryAll();
            $_status = Status::model()->findAll();
            $status = array();
            foreach($_status  as $item)
                $status[$item->id] = $item->name;
            $this->render('site', array('products'=>$products, 'status'=>$status));            
        }
}