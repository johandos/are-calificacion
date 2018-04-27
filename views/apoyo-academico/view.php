<?php
/**********
Versión: 001
Fecha: 17-04-2018
Desarrollador: Oscar David Lopez
Descripción: CRUD de Apoyo Académico
---------------------------------------
Modificaciones:
Fecha: 17-04-2018
Persona encargada: Oscar David Lopez
Cambios realizados: - cambios en los datos para mostrar la descripcion en lugar del id
miga de pab
---------------------------------------
**********/
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Estados;

/* @var $this yii\web\View */
/* @var $model app\models\ApoyoAcademico */

$idSedes = $model->id_sede;
use app\models\Sedes;
use app\models\TiposApoyoAcademico;
use	yii\helpers\ArrayHelper;

$nombreSede = new Sedes();
$nombreSede = $nombreSede->find()->where('id='.$idSedes)->all();
$idInstitucion = ArrayHelper::map($nombreSede,'id','id_instituciones');
$idInstitucion = $idInstitucion[$idSedes];
$nombreSede = ArrayHelper::map($nombreSede,'id','descripcion');
$nombreSede = $nombreSede[$idSedes];

$AAcademico = $model->id_tipo_apoyo;


$this->title = "Detalle";
$this->params['breadcrumbs'][] = 
	[
		'label' => 'Apoyo Académico', 
		'url' => [
					'index',
					'idInstitucion' => $idInstitucion, 
					'idSedes' 		=> $idSedes,
					'AAcademico'	=> $AAcademico,
				 ]
	];	
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apoyo-academico-view">

    <h1><?= Html::encode($nombreSede) ?></h1>

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
				'attribute'=>'id_persona_doctor',
				'value' => function( $model )
				{
					/**
					* Llenar nombre del docente
					*/
					//variable con la conexion a la base de datos 
					$connection = Yii::$app->getDb();
					$command = $connection->createCommand("
					SELECT pp.id, concat(pe.nombres,' ',pe.apellidos) as nombres
					FROM public.perfiles_x_personas as pp, public.personas as pe
					where pp.id_personas = pe.id
					and pp.id =$model->id_persona_doctor
					");
					$result = $command->queryAll();
					
					return $result[0]['nombres'];
				},
				
			],
            'registro',
            [
				'attribute'=>'id_persona_estudiante',
				'value' => function( $model )
				{
					/**
					* Llenar nombre del docente
					*/
					//variable con la conexion a la base de datos 
					$connection = Yii::$app->getDb();
					$command = $connection->createCommand("
					SELECT es.id_perfiles_x_personas, concat(pe.nombres,' ',pe.apellidos) as nombres
					FROM public.estudiantes as es, public.perfiles_x_personas as pp, public.personas as pe
					where es.id_perfiles_x_personas = pp.id
					and pp.id_personas = pe.id
					and es.id_perfiles_x_personas =$model->id_persona_estudiante
					");
					$result = $command->queryAll();
					
					return $result[0]['nombres'];
				},
				
			],
            'motivo_consulta',
            'fecha_entrada',
            'hora_entrada',
            'fecha_salida',
            'hora_salida',
            'incapacidad:boolean',
            'no_dias_incapaciad',
            'discapacidad:boolean',
            'observaciones',
            // 'id_sede',
            
			[
				'attribute'=>'id_tipo_apoyo',
				'value' => function( $model )
				{
					$tipoApoyo = TiposApoyoAcademico::findOne($model->id_tipo_apoyo);
					return $tipoApoyo ? $tipoApoyo->descripcion : '';
				},
				
			],
            [
				'attribute'=>'estado',
				'value' => function( $model )
				{
					$nombreEstado = Estados::findOne($model->estado);
					return $nombreEstado ? $nombreEstado->descripcion : '';
				},
				
			],
			
        ],
    ]) ?>

</div>