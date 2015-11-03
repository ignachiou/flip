<?php

namespace app\controllers;

use Yii;
use app\models\Revista;
use app\models\RevistaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Articulo;
use app\models\Model;
use yii\web\UploadedFile;
use app\models\User;

/**
 * RevistaController implements the CRUD actions for Revista model.
 */
class RevistaController extends Controller
{
	
function init(){	
		
			if (!\Yii::$app->user->isGuest) {
					
				if(User::isUserSimple(Yii::$app->user->identity->id)){
					$this->layout = 'simplelayout';
			}
			
			if(User::isUserCatalog(Yii::$app->user->identity->id)){
				$this->layout = 'cataloglayout';
			}
			
			if(User::isUserAdmin(Yii::$app->user->identity->id)){
				$this->layout = 'adminlayout';
			}
		
			
		}
	}
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Revista models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RevistaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Revista model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Revista model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Revista();
        $modelsArticulo = [new Articulo];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	
               	
        	$modelsArticulo = Model::createMultiple(Articulo::classname());
        	Model::loadMultiple($modelsArticulo, Yii::$app->request->post());
        	
        	$id = $model->id;//id del modelo Revista
        	
        	$model->url_revista = 'imagenes/revista/'.$id."/"; //se coloca directo aca y no en el modelo, ya que esta implicito por la llamada a la BD
        	
        	// ajax validation
        	if (Yii::$app->request->isAjax) {
        		Yii::$app->response->format = Response::FORMAT_JSON;
        		return ArrayHelper::merge(
        				ActiveForm::validateMultiple($modelsArticulo),
        				ActiveForm::validate($modelCustomer)
        		);
        	}
        	
        	// validate all models
        	$valid = $model->validate();
        	$valid = Model::validateMultiple($modelsArticulo) && $valid;
        	
        	
        	if ($valid) {
        		$transaction = \Yii::$app->db->beginTransaction();
        		try {
        			if ($flag = $model->save(false)) {
        				
        				foreach ($modelsArticulo as $modelArticulo) {
        					
        					$modelArticulo->id_revista = $id;        					
        					
        					if (! ($flag = $modelArticulo->save(false))) {
        						$transaction->rollBack();
        						break;
        					}
        				}
        				
        			}
        			if ($flag) {
        				$transaction->commit();
        				
        				$model->img = UploadedFile::getInstances($model, 'img');
        				
        				if (!is_dir('imagenes/revista/'.$id))  // creo directorios dentro de imagenes con la id
        				{													// del OB donde guardare las imagenes.
        				 
        				mkdir('imagenes/revista/'.$id, 777);//le otorgo permiso de lectura y escritura
        				
        				foreach ($model->img as $img)
        				{
        					$img->saveAs('imagenes/revista/'.$id."/". $img->baseName . '.' . $img->extension);
        					//$msg = "<p><strong class='label label-info'>subida de archivos lograda con exito</strong></p>";
        				}
        				
        				}
        				
        				return $this->redirect(['site/registrosrevista', 'id' => $model->id]);
        			}
        		} catch (Exception $e) {
        			$transaction->rollBack();
        		}
        	}
        	
        	
        } else {
            return $this->render('create', [
                	'model' => $model,
            		'modelsArticulo' => (empty($modelsArticulo)) ? [new Articulo] : $modelsArticulo
            ]);
        }
    }

    /**
     * Updates an existing Revista model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Revista model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Revista model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Revista the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Revista::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
