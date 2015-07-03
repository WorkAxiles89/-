<?php

$this->menu=array(
	array('label'=>'Список работ','url'=>array('index')),
	array('label'=>'Создать работу','url'=>array('create'), 'active' => true),
);
?>

<h1>Создать работу</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>