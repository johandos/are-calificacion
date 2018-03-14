<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RangosCalificacion */


$this->title = current($institucionNombre);
$this->params['breadcrumbs'][] = [
									'label' => 'Rangos Calificaciones', 
									'url' => [
												'index',
												'idInstitucion' => $idInstitucion, 
											 ]
								 ];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="rangos-calificacion-update">

    <h1><?= Html::encode('Actualizar') ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'idInstitucion'=>$idInstitucion,
		'institucionNombre'=>$institucionNombre,
		'estados'=>$estados,
		'TiposCalificacion'=>$TiposCalificacion,
    ]) ?>

</div>
