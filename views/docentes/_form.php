<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// HTML::getInputName( $model, 'id_perfiles_x_personas' );

/* @var $this yii\web\View */
/* @var $model app\models\Docentes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docentes-form">


	<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelPerfilesXPersonas, 'id_personas')->dropDownList( $personas, [ 'prompt' => 'Seleccione...' ] )->label( 'Docente' ) ?>

    <?= $form->field($model, 'id_escalafones')->dropDownList( $escalafones, [ 'prompt' => 'Seleccione...' ] ) ?>
    
	<?= $form->field($model, 'Antiguedad')->textInput( [ 'type' => 'number', 'placeholder' => 'Digite la antigüedad del docente' ] ) ?>

    <?= $form->field($model, 'estado')->dropDownList( $estados ) ?>
	
	<div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); ?>
  

</div>