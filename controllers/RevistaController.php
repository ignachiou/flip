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
use app\models\Pagina;
use app\models\ModelPagina;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;


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
	
public function behaviors() //funcion de control de roles
{
    return [
        'access' => [
            'class' => AccessControl::className(),
            'only' => ['logout','update','create'],
            'rules' => [
                [
                    //El administrador tiene permisos sobre las siguientes acciones
                    'actions' => ['logout','update','create'],
                    //Esta propiedad establece que tiene permisos
                    'allow' => true,
                    //Usuarios autenticados, el signo ? es para invitados
                    'roles' => ['@'],
                    //Este m�todo nos permite crear un filtro sobre la identidad del usuario
                    //y as� establecer si tiene permisos o no
                    'matchCallback' => function ($rule, $action) {
                        //Llamada al m�todo que comprueba si es un administrador
                        return User::isUserAdmin(Yii::$app->user->identity->id);
                    },
                ],
                [
                //Los usuarios catalog tienen permisos sobre las siguientes acciones
                'actions' => ['logout','update','create'],
                //Esta propiedad establece que tiene permisos
                'allow' => true,
                //Usuarios autenticados, el signo ? es para invitados
                'roles' => ['@'],
                //Este m�todo nos permite crear un filtro sobre la identidad del usuario
                //y as� establecer si tiene permisos o no
                'matchCallback' => function ($rule, $action) {
                	//Llamada al m�todo que comprueba si es un usuario simple
                	return User::isUserCatalog(Yii::$app->user->identity->id);
                },
                ],
                [
                   //Los usuarios simples tienen permisos sobre las siguientes acciones
                   'actions' => ['logout'],
                   //Esta propiedad establece que tiene permisos
                   'allow' => true,
                   //Usuarios autenticados, el signo ? es para invitados
                   'roles' => ['@'],
                   //Este m�todo nos permite crear un filtro sobre la identidad del usuario
                   //y as� establecer si tiene permisos o no
                   'matchCallback' => function ($rule, $action) {
                      //Llamada al m�todo que comprueba si es un usuario simple
                      return User::isUserSimple(Yii::$app->user->identity->id);
                  },
               ],
               
               
            ],
        ],
 //Controla el modo en que se accede a las acciones, en este ejemplo a la acci�n logout
 //s�lo se puede acceder a trav�s del m�todo post
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
                'logout' => ['post'],
            ],
        ],
    ];
}

   
    public function actionIndex()
    {
        $searchModel = new RevistaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    public function actionCreate()
    {
        $model = new Revista();
        $modelsArticulo = [new Articulo];
        $modelsPagina = [new Pagina];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	
               	
        	$modelsArticulo = Model::createMultiple(Articulo::classname());
        	Model::loadMultiple($modelsArticulo, Yii::$app->request->post());
        	
        	$modelsPagina = ModelPagina::createMultiple(Pagina::classname());
        	ModelPagina::loadMultiple($modelsPagina, Yii::$app->request->post());
        	
        	$id = $model->id;//id del modelo Revista
        	
        	$model->url_revista = 'imagenes/revista/'.$id."/"; //se coloca directo aca y no en el modelo, ya que esta implicito por la llamada a la BD
        	        	
        	// validate all models
        	$valid = $model->validate();
        	$valid = Model::validateMultiple($modelsArticulo) && $valid;
        	$valid = ModelPagina::validateMultiple($modelsPagina) && $valid;
        	
        	
        	if ($valid) {
        		$transaction = \Yii::$app->db->beginTransaction();
        		try {
        			if ($flag = $model->save(false)) {
        				
        				if (!is_dir('imagenes/revista/'.$id))  // creo directorios dentro de imagenes con la id
        				{													// del OB donde guardare las imagenes.
        				 
        				mkdir('imagenes/revista/'.$id, 777);//le otorgo permiso de lectura y escritura
        				        				
        				}
        				
        				foreach ($modelsArticulo as $modelArticulo) { 
        					
        					$modelArticulo->id_revista = $id;       
        					$modelArticulo->url_revista = 'imagenes/revista/'.$id."/"; 					
        					
        					if (! ($flag = $modelArticulo->save(false))) {
        						$transaction->rollBack();
        						break;
        					}
        				}
        				
        				foreach ($modelsPagina as $i => $modelPagina) {
        					$random = rand(0,999999999);
        					//se asigna la id de objeto para generar dependencia
        					$modelPagina->publicaciones = $model->id;
        					$idpag = $i + 1;
        					//se obtiene la instancia img
        					$omg = UploadedFile::getInstance($modelPagina, "[{$i}]img");
        					$transform = "{$idpag}.jpg";
        					//se almacena la direccion donde estara guardada la imagen
        					$modelPagina->url = "imagenes/revista/".$model->id."/".$transform ;
        					//se duplica la imagen y se almacena en el servidor
        					$omg -> saveAs("imagenes/revista/".$model->id."/". $transform);
        				
        					 
        					if (! ($flag = $modelPagina->save(false))) {
        						$transaction->rollBack();
        						break;
        					}
        				}
        				
        			}
        			if ($flag) {
        				$transaction->commit();
        				        				
        				return $this->redirect(['view', 'id' => $model->id]);
        			}
        		} catch (Exception $e) {
        			$transaction->rollBack();
        		}
        	}
        	
        	
        } else {
            return $this->render('create', [
                	'model' => $model,
            		'modelsArticulo' => (empty($modelsArticulo)) ? [new Articulo] : $modelsArticulo,
            		'modelsPagina' => (empty($modelsPagina)) ? [new Pagina] : $modelsPagina
            ]);
        }
    }

  
public function actionUpdate($id)
    {
        $model = $this->findModel($id);        
        $modelsArticulo = $model->articulos;
        $modelsPagina = $model->paginas;

        if ($model->load(Yii::$app->request->post()) ) {
        	
        	$oldIDs = ArrayHelper::map($modelsPagina, 'id','id');
        	$modelsPagina = ModelPagina::createMultiple(Pagina::className(),$modelsPagina);       	
        	ModelPagina::loadMultiple($modelsPagina, Yii::$app->request->post());
        	$deleteIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPagina, 'id', 'id')));
        	
        	$oldIDss = ArrayHelper::map($modelsArticulo,'id_articulo','id_articulo');
        	$modelsArticulo = Model::createMultiple(Articulo::classname(),$modelsArticulo);
        	Model::loadMultiple($modelsArticulo, Yii::$app->request->post());
        	$deleteIDss = array_diff($oldIDss, array_filter(ArrayHelper::map($modelsArticulo, 'id_articulo', 'id_articulo')));
        	
        	
        	$valid = $model->validate();
            $valid = ModelPagina::validateMultiple($modelsPagina) && $valid;
            $valid = Model::validateMultiple($modelsArticulo) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                        	Pagina::deleteAll(['id' => $deletedIDs]);
                        }
                        if(! empty($deleteIDss))
                        {
                        	Articulo::deleteAll(['id_articulo'=> $deleteIDs]);
                        }                        
                        foreach ($modelsArticulo as $modelArticulo) {
                        	 
                        	$modelArticulo->id_revista = $id;
                        	$modelArticulo->url_revista = 'imagenes/revista/'.$id."/";
                        	 
                        	if (! ($flag = $modelArticulo->save(false))) {
                        		$transaction->rollBack();
                        		break;
                        	}
                        }
                        foreach ($modelsPagina as $i => $modelPagina) {
                            $modelPagina->publicaciones = $model->id;
                            $omg = UploadedFile::getInstance($modelPagina, "[{$i}]img");
                            $idpag = $i + 1;
                            $transform = "{$idpag}.jpg";
                            
                            if(!empty($omg))  
                            {        					
        					$modelPagina->url = "imagenes/revista/".$model->id."/".$transform ;
        					$omg -> saveAs("imagenes/revista/".$model->id."/". $transform);
                            }
                            
                            if (! ($flag = $modelPagina->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsArticulo' => (empty($modelsArticulo)) ? [new Articulo] : $modelsArticulo,
            'modelsPagina' => (empty($modelsPagina)) ? [new Pagina] : $modelsPagina
        ]);
    }

   
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        foreach (glob("imagenes/revista/".$id."/*.*") as $archivos_carpeta)
        {
        	unlink($archivos_carpeta); //eliminamos todos los archivos dentro de la carpeta
        }
        rmdir("imagenes/revista/".$id); //eliminamos la carpeta.

        return $this->redirect(['index']);
    }

    
    protected function findModel($id)
    {
        if (($model = Revista::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('El objeto no existe');
        }
    }
}
