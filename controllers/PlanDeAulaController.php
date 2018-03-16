<?php

namespace app\controllers;

use Yii;
use app\models\PlanDeAula;
use app\models\PlanDeAulaBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Personas;
use app\models\Periodos;
use app\models\Niveles;
use app\models\Asignaturas;
use app\models\Estados;
use yii\helpers\ArrayHelper;

/**
 * PlanDeAulaController implements the CRUD actions for PlanDeAula model.
 */
class PlanDeAulaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PlanDeAula models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlanDeAulaBuscar();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere( 'estado=1' );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PlanDeAula model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PlanDeAula model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
		$personasData 	= Personas::find()
										->select( "d.id_perfiles_x_personas as id, ( personas.nombres || ' ' || personas.apellidos ) nombres " )
										->innerJoin('perfiles_x_personas pf', 'personas.id=pf.id_personas' )
										->innerJoin('docentes d', 'd.id_perfiles_x_personas=pf.id' )
										->where( 'personas.estado=1' )
										->where( 'd.estado=1' )
										->all();
		$personas	 	= ArrayHelper::map( $personasData, 'id', 'nombres' );
		
		$periodosData	= Periodos::find()->where( 'estado=1' )->all();
		$periodos		= ArrayHelper::map( $periodosData, 'id', 'descripcion' );
		
		$nivelesData	= Niveles::find()->where( 'estado=1' )->all();
		$niveles		= ArrayHelper::map( $nivelesData, 'id', 'descripcion' );
		
		$asignaturasData= Asignaturas::find()->where( 'estado=1' )->all();
		$asignaturas	= ArrayHelper::map( $asignaturasData, 'id', 'descripcion' );
		
		$estadosData	= Estados::find()->where( 'id=1' )->all();
		$estados		= ArrayHelper::map( $estadosData, 'id', 'descripcion' );
		
        $model = new PlanDeAula();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' 		=> $model,
            'personas' 		=> $personas,
            'periodos'		=> $periodos,
            'niveles' 		=> $niveles,
            'asignaturas' 	=> $asignaturas,
            'estados' 		=> $estados,
        ]);
    }

    /**
     * Updates an existing PlanDeAula model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
		$personasData 	= Personas::find()
										->select( "d.id_perfiles_x_personas as id, ( personas.nombres || ' ' || personas.apellidos ) nombres " )
										->innerJoin('perfiles_x_personas pf', 'personas.id=pf.id_personas' )
										->innerJoin('docentes d', 'd.id_perfiles_x_personas=pf.id' )
										->where( 'personas.estado=1' )
										->where( 'd.estado=1' )
										->all();
		$personas	 	= ArrayHelper::map( $personasData, 'id', 'nombres' );
		
		$periodosData	= Periodos::find()->where( 'estado=1' )->all();
		$periodos		= ArrayHelper::map( $periodosData, 'id', 'descripcion' );
		
		$nivelesData	= Niveles::find()->where( 'estado=1' )->all();
		$niveles		= ArrayHelper::map( $nivelesData, 'id', 'descripcion' );
		
		$asignaturasData= Asignaturas::find()->where( 'estado=1' )->all();
		$asignaturas	= ArrayHelper::map( $asignaturasData, 'id', 'descripcion' );
		
		$estadosData	= Estados::find()->all();
		$estados		= ArrayHelper::map( $estadosData, 'id', 'descripcion' );
		
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' 		=> $model,
			'personas' 		=> $personas,
            'periodos'		=> $periodos,
            'niveles' 		=> $niveles,
            'asignaturas' 	=> $asignaturas,
            'estados' 		=> $estados,
        ]);
    }

    /**
     * Deletes an existing PlanDeAula model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$model->estado = 2;
		$model->update(false);

        return $this->redirect(['index']);
    }

    /**
     * Finds the PlanDeAula model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PlanDeAula the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlanDeAula::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
