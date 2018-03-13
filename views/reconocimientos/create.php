<?php
/**********
Versión: 001
Fecha: Fecha en formato (10-03-2018)
Desarrollador: Viviana Rodas
Descripción: Vista agregar de Formaciones
---------------------------------------
*/

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reconocimientos */

$this->title = 'Agregar';
$this->params['breadcrumbs'][] = ['label' => 'Reconocimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reconocimientos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'personas' => $personas,
        'estados' => $estados,
    ]) ?>

</div>
