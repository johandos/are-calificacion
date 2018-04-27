<?php

/**********
Versión: 001
Fecha: 06-03-2018
Desarrollador: Edwin Molina Grisales
Descripción: CRUD de sedes-jornadas
---------------------------------------
Modificaciones:
Fecha: 06-03-2018
Persona encargada: Edwin Molina Grisales
Cambios realizados: - Se lista las instituciones y las sedes y luego de seleccionar ambas se llama a la vista index por el controlador
---------------------------------------
**********/


use yii\helpers\Html;
use yii\widgets\ActiveForm;


use app\models\Instituciones;
use app\models\Sedes;
use app\models\TiposApoyoAcademico;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apoyo académico';
$this->params['breadcrumbs'][] = $this->title;


//Obterniendo los datos necsarios para las instituciones
$institucionesTable	 = new Instituciones();
$queryInstituciones  = $institucionesTable->find()->orderby('descripcion')->where('estado=1');
$dataInstituciones	 = $queryInstituciones->all();
$instituciones		 = ArrayHelper::map( $dataInstituciones, 'id', 'descripcion' );

//Opciones para el select instituciones
$optionsInstituciones = array( 
							'prompt' 	=> 'Seleccione...', 
							'id'	 	=> 'idInstitucion', 
							'name'	 	=> 'idInstitucion',
							'value'	 	=> $idInstitucion == 0 ? '' : $idInstitucion,
							'onChange'	=> '$( "#idSedes" ).val(\'\'); this.form.submit(); ',
						);

$sedes = [];
$arrayApoyoAcademico=[];
$TiposApoyoAcademico = new TiposApoyoAcademico();
//Si se ha seleccionado una institucion se buscan todas las sedes correspondientes a ese id
if( $idInstitucion > 0 ){
	
	//Obterniendo los datos necesarios para Sedes						
	$sedesTable	 		= new Sedes();
	$querySedes	 		= $sedesTable->find()->orderby('descripcion')->where('estado=1');
	$querySedes->andWhere( 'id_instituciones='.$idInstitucion );
	$dataSedes	 		= $querySedes->all();
	$sedes		 		= ArrayHelper::map( $dataSedes, 'id', 'descripcion' );
}



//opciones para el select sedes
$optionsSedes = array( 
					'prompt' 	=> 'Seleccione...', 
					'id'	 	=> 'idSedes', 
					'name'	 	=> 'idSedes',
					'value'	 	=> $idSedes == 0 ? '' : $idSedes,
					'onChange'	=> '$( "#AAcademico" ).val(\'\'); this.form.submit(); ',
				);

//opciones para el select ApoyoAcademico	
$optionsApoyoAcademico = array( 
					'prompt' 	=> 'Seleccione...', 
					'id'	 	=> 'AAcademico', 
					'name'	 	=> 'AAcademico',
					'value'	 	=> $AAcademico == 0 ? '' : $AAcademico,
					'onchange'	=> 'this.form.submit();'
				);
				
				//Si se ha seleccionado una sede se buscan todos los apoyos academicos 
if( $idSedes > 0 )
{
	
	//Obterniendo los datos necesarios para Sedes						
	$TiposApoyoAcademico = new TiposApoyoAcademico();
	$arrayApoyoAcademico = $TiposApoyoAcademico->find()->all();
	$arrayApoyoAcademico = ArrayHelper::map( $arrayApoyoAcademico, 'id', 'descripcion' );
}

?>
<div class="sedes-index">

    <h1><?= Html::encode($this->title) ?></h1>
	
	<?php $form = ActiveForm::begin([
		'action' => 'index.php?r=apoyo-academico/index', 
		'method' => 'get',
	]); ?>
	
	<?= $form->field($institucionesTable, 'id')->dropDownList( $instituciones, $optionsInstituciones )->label('Instituciones') ?>
	
	<?= $form->field($institucionesTable, 'id')->dropDownList( $sedes, $optionsSedes )->label('Sedes') ?>
	
	<?= $form->field($institucionesTable, 'id')->dropDownList( $arrayApoyoAcademico, $optionsApoyoAcademico )->label('Apoyo Académico') ?>
	
	<?php $form = ActiveForm::end(); ?>
	
</div>