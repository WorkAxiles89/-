<?php

class DefaultController extends Controller
{
	public $layout='/layouts/column2';
	
	/**
	 * Displays the login page
	 */
	public function actionIndex()
	{
		if (!Yii::app()->user->isGuest)
			$this->redirect('../admin/work');
			
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
				$this->redirect('/admin');
		}
			
		// display the login form
		$this->render('index',array('model'=>$model));
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect('/admin');
	}
}