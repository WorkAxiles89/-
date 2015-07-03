<?php

class SiteController extends Controller
{
	public function actionError()
	{
		if ($error=Yii::app()->errorHandler->error)
			$this->render('error', $error);
	}
	
    public function actionIndex()
	{
        $criteria = new CDbCriteria;
		$criteria->order = "id DESC";
		$criteria->limit = "6";
		
		$work = Work::model()->findAll($criteria);
        
        $criteria = new CDbCriteria;
		$criteria->order = "id DESC";
		$criteria->limit = "3";
		
		$project = Project::model()->findAll($criteria);
		
		$this->render('index', array(
            'work' => $work,
            'project' => $project));
	}
    
    public function actionCast()
	{		
		$this->render('cast', array());
	}
    
    	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionProjectview($id)
	{
        $project = Project::model()->findByPk($id);
        if (!$project)
           $this->redirect(array('/index'));
           
		$this->render('projectview',array(
			'project'=>$project,
		));
	}
    
    /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionWorkview($id)
	{
        $project = Work::model()->findByPk($id);
        if (!$project)
           $this->redirect(array('/index'));
           
		$this->render('workview',array(
			'project'=>$project,
		));
	}
    
    public function actionStock()
	{
        $criteria = new CDbCriteria();
       
		$criteria->order = "id DESC";
		
		$count=Stock::model()->count($criteria);
 
		$pages=new CPagination($count);
		// элементов на страницу
		$pages->pageSize = 20;
		$pages->applyLimit($criteria);
 
		$stock = Stock::model()->findAll($criteria);
		$this->render('stock', array(
            'stock' => $stock,
			'pages' => $pages
        ));
	}
    
    public function actionProject()
	{
        $criteria = new CDbCriteria();
       
		$criteria->order = "id DESC";
		
		$count=Project::model()->count($criteria);
 
		$pages=new CPagination($count);
		// элементов на страницу
		$pages->pageSize = 20;
		$pages->applyLimit($criteria);
 
		$work = Project::model()->findAll($criteria);
		$this->render('project', array(
            'project' => $work,
			'pages' => $pages
        ));
	}
    
    public function actionWork()
	{		
        $criteria = new CDbCriteria();
       
		$criteria->order = "id DESC";
		
		$count=Work::model()->count($criteria);
 
		$pages=new CPagination($count);
		// элементов на страницу
		$pages->pageSize = 20;
		$pages->applyLimit($criteria);
 
		$work = Work::model()->findAll($criteria);
		
		$this->render('work', array(
			'work' => $work,
			'pages' => $pages
		));
	}


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}