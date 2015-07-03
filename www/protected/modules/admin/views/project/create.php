<?php
$this->menu=array(
	array('label'=>'Список проектов','url'=>array('index')),
	array('label'=>'Создать проект','url'=>array('create'), 'active' => true),
);
?>

<h1>Создать проект</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>