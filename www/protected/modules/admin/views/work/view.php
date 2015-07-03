<?php

$this->menu=array(
	array('label'=>'Список работ','url'=>array('index')),
	array('label'=>'Создать работу','url'=>array('create')),
	array('label'=>'Просмотреть работу','url'=>array('view','id'=>$model->id), 'active' => true),
	array('label'=>'Изменить работу','url'=>array('update','id'=>$model->id)),
	array('label'=>'Удалить работу','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить работу?')),
);
?>

<h1>Работа #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
        'description',
		'img',
	),
)); ?>
