<?php

namespace app\controllers;

use Yii;
use app\models\Pagina;
use app\models\PaginaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\filters\AccessControl;


class PaginaController extends Controller
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
                    'actions' => ['logout',],
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
                'actions' => ['logout',],
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
        $searchModel = new PaginaSearch();
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
        $model = new Pagina();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

   
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

    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    
    protected function findModel($id)
    {
        if (($model = Pagina::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
