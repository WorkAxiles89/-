<?php

$this->menu=array(
	array('label'=>'Список акций','url'=>array('index')),
	array('label'=>'Создать акцию','url'=>array('create')),
	array('label'=>'Просмотреть акцию','url'=>array('view','id'=>$model->id), 'active' => true),
	array('label'=>'Изменить акцию','url'=>array('update','id'=>$model->id)),
	array('label'=>'Удалить акцию','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить акцию?')),
);
?>

<h1>Акция #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'img',
	),
)); ?>
