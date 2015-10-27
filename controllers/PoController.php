<?php

namespace app\controllers;

use Yii;
use app\models\Po;
use app\models\PoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\PoItem;
use app\models;
use app\models\Model;
use yii\web\UploadedFile;

/**
 * PoController implements the CRUD actions for Po model.
 */
class PoController extends Controller
{
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
     * Lists all Po models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Po model.
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
     * Creates a new Po model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Po();
        $modelsPoItem = [new PoItem];
        $model->img;
        
        

        if ($model->load(Yii::$app->request->post()) && $model->save() && $model->img) 
        {
        	
        	$model->img;
        	$modelsPoItem = Model::createMultiple(PoItem::classname());
        	Model::loadMultiple($modelsPoItem, Yii::$app->request->post());
        	
        	
        	// validate all models
        	$valid = $model->validate();
        	$valid = Model::validateMultiple($modelsPoItem) && $valid;
        	
        	if ($valid) 
        	{        		
        		$transaction = \Yii::$app->db->beginTransaction();
        		try {
        			if ($flag = $model->save(false)) {
        				foreach ($modelsPoItem as $modelPoItem) {
        					$id = $model->id;
        					$modelPoItem->po_id = $id;
        					if (! ($flag = $modelPoItem->save(false))) {
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
        				
        				//if($model->img && is_dir('C:/xampp/htdocs/basic/web/imagenes/revista/'.$id))
        				//{ //pendiente error al validar el modelo de las imagenes
        					
        				//foreach ($model->img as $img)
        				//{
        					//$img->saveAs('C:/xampp/htdocs/basic/web/imagenes/revista/'.$id."/". $img->baseName . '.' . $img->extension);
        					//$msg = "<p><strong class='label label-info'>subida de archivos lograda con exito</strong></p>";
        			//	}
        					
        				//}
        				
        				//else
        				//{
        					//$msg = "No se ha creado ninguna carpeta o no se ha podido realizar la subida de imagenes";
        						
        				//}
        				
        				return $this->redirect(['view', 'id' => $model->id]);
        			}
        			}catch (Exception $e) {
        								$transaction->rollBack();
        								}
        					
        		}		
        	}      	
             else {
            return $this->render('create', [
                'model' => $model,
            	'modelsPoItem' => (empty($modelsPoItem)) ? [new PoItem] : $modelsPoItem
            ]);
        }
    }

    /**
     * Updates an existing Po model.
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
     * Deletes an existing Po model.
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
     * Finds the Po model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Po the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Po::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
