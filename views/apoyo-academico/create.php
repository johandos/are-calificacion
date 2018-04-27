<?php

use yii\helpers\Html;
use app\models\Sedes;
use	yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\ApoyoAcademico */
$nombreSede = new Sedes();
$nombreSede = $nombreSede->find()->where('id='.$idSedes)->all();
$nombreSede = ArrayHelper::map($nombreSede,'id','descripcion');
$nombreSede = $nombreSede[$idSedes];


$this->title = 'Agregar Apoyo Académico';
$this->params['breadcrumbs'][] = 
	[
		'label' => 'Apoyo Academico', 
		'url' => [
					'index',
					'idInstitucion' => $idInstitucion, 
					'idSedes' 		=> $idSedes,
					'AAcademico'	=> $AAcademico,
				 ]
	];	
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apoyo-academico-create">

    <h1><?= Html::encode($nombreSede) ?></h1>

    <?= $this->render('_form', [
        'model'			=> $model,
		'estudiantes'	=> $estudiantes,
		'doctores'		=> $doctores,
		'idSedes' 		=> $idSedes,
		'idInstitucion' => $idInstitucion,
		'AAcademico'	=> $AAcademico
    ]) ?>

</div>