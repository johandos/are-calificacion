<?php

/**********
Versión: 001
Fecha: 06-03-2018
Desarrollador: Oscar David lopez 
Descripción: CRUD de participantes-grupos-soporte
---------------------------------------

**********/


use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\TiposGruposSoporte;
use app\models\GruposSoporte;
use app\models\Jornadas;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Participantes grupos soporte';
$this->params['breadcrumbs'][] = $this->title;



$institucionesTable	 		= new TiposGruposSoporte();
$queryTiposGruposSoporte  	= $institucionesTable->find()->orderby('descripcion')->where('estado=1');
$dataTiposGruposSoporte	 	= $queryTiposGruposSoporte->all();
$tiposGruposSoporte		 		= ArrayHelper::map( $dataTiposGruposSoporte, 'id', 'descripcion' );

$jornadas	= new Jornadas();
$jornadas	= $jornadas->find()->orderby('descripcion')->where('estado=1');
$jornadas	= $jornadas->all();
$jornadas	= ArrayHelper::map( $jornadas, 'id', 'descripcion' );

$optionsTiposGruposSoporte = array( 
							'prompt' 	=> 'Seleccione...', 
							'id'	 	=> 'TiposGruposSoporte', 
							'name'	 	=> 'TiposGruposSoporte',
							'value'	 	=> $TiposGruposSoporte == 0 ? '' : $TiposGruposSoporte,
							'onChange'	=> '$( "#idGruposSoporte" ).val(\'\'); this.form.submit(); ',
						);




$GruposSoporte = [];


if( $TiposGruposSoporte > 0 ){
	
	//Obterniendo los datos necesarios para GruposSoporte						
	$GruposSoporteTable	 		= new GruposSoporte();
	$queryGruposSoporte	 		= $GruposSoporteTable->find()->orderby('descripcion')->where('estado=1');
	$queryGruposSoporte->andWhere( 'id_tipo_grupos='.$TiposGruposSoporte );
	$dataGruposSoporte	 		= $queryGruposSoporte->all();
	$GruposSoporte		 		= ArrayHelper::map( $dataGruposSoporte, 'id', 'descripcion' );
}

//opciones para el select GruposSoporte
$optionsGruposSoporte = array( 
					'prompt' 	=> 'Seleccione...', 
					'id'	 	=> 'idGruposSoporte', 
					'name'	 	=> 'idGruposSoporte',
					'value'	 	=> $idGruposSoporte == 0 ? '' : $idGruposSoporte,
					'onchange'	=> 'this.form.submit();'
				);
				
$optionsjornadas = array( 
					'prompt' 	=> 'Seleccione...', 
					'id'	 	=> 'idJornadas', 
					'name'	 	=> 'idJornadas',
					'value'	 	=> $idJornadas == 0 ? '' : $idJornadas,
				);

?>
<div class="GruposSoporte-index">

    <h1><?= Html::encode($this->title) ?></h1>
	
	<?php $form = ActiveForm::begin([
		'action' => 'index.php?r=participantes-grupos-soporte/index', 
		'method' => 'get',
	]); ?>
	
	<?= $form->field($institucionesTable, 'id')->dropDownList( $jornadas, $optionsjornadas )->label('Jornadas') ?>
	
	<?= $form->field($institucionesTable, 'id')->dropDownList( $tiposGruposSoporte, $optionsTiposGruposSoporte )->label('Tipos Grupos Soporte') ?>
	
	<?= $form->field($institucionesTable, 'id')->dropDownList( $GruposSoporte, $optionsGruposSoporte )->label('Grupos Soporte') ?>
	
	
	<?php $form = ActiveForm::end(); ?>
	
</div>