<?php
$this->menu=array(
	array('label'=>'Список проектов','url'=>array('index')),
	array('label'=>'Создать проект','url'=>array('create')),
	array('label'=>'Просмотреть проект','url'=>array('view','id'=>$model->id)),
	array('label'=>'Изменить проект','url'=>array('update','id'=>$model->id), 'active' => true),
	array('label'=>'Удалить проект','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить предложение?')),
);
?>

<h1>Редактирование проекта <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>