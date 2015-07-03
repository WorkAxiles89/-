<?php
$this->menu=array(
	array('label'=>'Список работ','url'=>array('index')),
	array('label'=>'Создать работу','url'=>array('create')),
	array('label'=>'Просмотреть работу','url'=>array('view','id'=>$model->id)),
	array('label'=>'Изменить работу','url'=>array('update','id'=>$model->id), 'active' => true),
	array('label'=>'Удалить работу','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить предложение?')),
);
?>

<h1>Редактирование работы <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>