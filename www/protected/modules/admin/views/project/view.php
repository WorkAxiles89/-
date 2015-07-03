<?php

$this->menu=array(
	array('label'=>'Список проектов','url'=>array('index')),
	array('label'=>'Создать проект','url'=>array('create')),
	array('label'=>'Просмотреть проект','url'=>array('view','id'=>$model->id), 'active' => true),
	array('label'=>'Изменить проект','url'=>array('update','id'=>$model->id)),
	array('label'=>'Удалить проект','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить работу?')),
);
?>

<h1>Проект #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'img',
		'cast',
	),
)); ?>
