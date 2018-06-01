<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SancionesEstudiantes */

$this->title = "Detalle";
$this->params['breadcrumbs'][] = ['label' => 'Sanciones Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sanciones-estudiantes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro de eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
				'attribute'=>'id_perfiles_persona',
				'value' => function( $model )
				{
					$id = $model->id_perfiles_persona;
					$connection = Yii::$app->getDb();
					//saber el id de la sede para redicionar al index correctamente
					$command = $connection->createCommand("
					select concat(p.nombres,' ',p.apellidos) as nombre
					from personas as p, perfiles_x_personas as pp, perfiles_x_personas_institucion as ppi
					where pp.id_personas  = p.id
					and pp.id = ppi.id_perfiles_x_persona
					and ppi.id_perfiles_x_persona = $id
					");
					$result = $command->queryAll();
					return $result[0]['nombre'];
				},
			
			],
			'fecha',
            'descripcion',			
        ],
    ]) ?>

</div>
