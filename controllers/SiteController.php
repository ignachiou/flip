<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\widgets\ActiveForm;
use yii\web\Response;
use app\models\Buscar;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\helpers\Url;
use app\models\FormRegister;
use app\models\Usuarios;
use app\models\User;
use app\models;
use app\models\FormAct;
use app\models\DbRevista;
use yii\web\Session;
use app\models\FormRecoverPass;
use app\models\FormResetPass;
use app\models\ObjetoSearch;
use app\models\TesisSearch;
use app\models\RevistaSearch;
use app\models\ArticuloSearch;
 

class SiteController extends Controller
{
		
	function init(){	                    //en esta funcion defino los distintos layout dependiendo del rol del usuario
		
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
	
	public function actionRecoverpass()
	{
		//Instancia para validar el formulario
		$model = new FormRecoverPass;
	
		//Mensaje que será mostrado al usuario en la vista
		$msg = null;
	
		if ($model->load(Yii::$app->request->post()))
		{
			if ($model->validate())
			{
				//Buscar al usuario a través del email
				$table = Usuarios::find()->where("email=:email", [":email" => $model->email]);
				 
				//Si el usuario existe
				if ($table->count() == 1)
				{
					//Crear variables de sesión para limitar el tiempo de restablecido del password
					//hasta que el navegador se cierre
					$session = new Session;
					$session->open();
	
					//Esta clave aleatoria se cargará en un campo oculto del formulario de reseteado
					$session["recover"] = $this->randKey("abcdef0123456789", 200);
					$recover = $session["recover"];
	
					//También almacenaremos el id del usuario en una variable de sesión
					//El id del usuario es requerido para generar la consulta a la tabla users y
					//restablecer el password del usuario
					$table = Usuarios::find()->where("email=:email", [":email" => $model->email])->one();
					$session["id_recover"] = $table->id;
	
					//Esta variable contiene un número hexadecimal que será enviado en el correo al usuario
					//para que lo introduzca en un campo del formulario de reseteado
					//Es guardada en el registro correspondiente de la tabla users
					$verification_code = $this->randKey("abcdef0123456789", 8);
					//Columna verification_code
					$table->verification_code = $verification_code;
					//Guardamos los cambios en la tabla users
					$table->save();
	
					//Creamos el mensaje que será enviado a la cuenta de correo del usuario
					$subject = "Recuperar clave";
					$body = "<p>Copie el siguiente código de verificación para restablecer su clave: ";
					$body .= "<strong>".$verification_code."</strong></p>";
					$body .= "<p><a href='http://localhost/flip/web/index.php?r=site/resetpass'>Recuperar clave</a></p>";
	
					//Enviamos el correo
					Yii::$app->mailer->compose()
					->setTo($model->email)
					->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
					->setSubject($subject)
					->setHtmlBody($body)
					->send();
	
					//Vaciar el campo del formulario
					$model->email = null;
	
					//Mostrar el mensaje al usuario
					$msg = "Se a enviado un mensaje a su correo para la recuperación de su clave";
				}
				else //El usuario no existe
				{
					$msg = "Ha ocurrido un error, el usuario no existe";
				}
			}
			else
			{
				$model->getErrors();
			}
		}
		return $this->render("recoverpass", ["model" => $model, "msg" => $msg]);
	}
	
	public function actionResetpass()
	{
		//Instancia para validar el formulario
		$model = new FormResetPass;
	
		//Mensaje que será mostrado al usuario
		$msg = null;
	
		//Abrimos la sesión
		$session = new Session;
		$session->open();
	
		//Si no existen las variables de sesión requeridas lo expulsamos a la página de inicio
		if (empty($session["recover"]) || empty($session["id_recover"]))
		{
			return $this->redirect(["site/index"]);
		}
		else
		{
	
			$recover = $session["recover"];
			//El valor de esta variable de sesión la cargamos en el campo recover del formulario
			$model->recover = $recover;
	
			//Esta variable contiene el id del usuario que solicitó restablecer el password
			//La utilizaremos para realizar la consulta a la tabla users
			$id_recover = $session["id_recover"];
	
		}
	
		//Si el formulario es enviado para resetear el password
		if ($model->load(Yii::$app->request->post()))
		{
			if ($model->validate())
			{
				//Si el valor de la variable de sesión recover es correcta
				if ($recover == $model->recover)
				{
					//Preparamos la consulta para resetear el password, requerimos el email, el id
					//del usuario que fue guardado en una variable de session y el código de verificación
					//que fue enviado en el correo al usuario y que fue guardado en el registro
					$table = Usuarios::findOne(["email" => $model->email, "id" => $id_recover, "verification_code" => $model->verification_code]);
	
					//Encriptar el password
					$table->clave = crypt($model->clave, Yii::$app->params["salt"]);
	
					//Si la actualización se lleva a cabo correctamente
					if ($table->save())
					{
						 
						//Destruir las variables de sesión
						$session->destroy();
						 
						//Vaciar los campos del formulario
						$model->email = null;
						$model->clave = null;
						$model->password_repeat = null;
						$model->recover = null;
						$model->verification_code = null;
						 
						$msg = "Has restablecido la clave correctamente, redireccionando";
						$msg .= "<meta http-equiv='refresh' content='5; ".Url::toRoute("site/login")."'>";
					}
					else
					{
						$msg = "Ha ocurrido un error";
					}
	
				}
				else
				{
					$model->getErrors();
				}
			}
		}
	
		return $this->render("resetpass", ["model" => $model, "msg" => $msg]);
	
	}
	
	
	
	public function actionPrueba()
	{
		
		return $this->render("prueba"); #pruebas del vizualizador
	}
	
				
	
public function actionCatalog()
{

	return $this->render("crear");
}

public function actionAdmin() //#pagina donde visualizamos los usuarios registrados
{
	
	
	/*$table = new Objeto;
	
	$model = $table->find()->all();
	*/
	$msg =null;
	$form = new Buscar;
	$search = null; 	#guardamos la busqueda realizada en esta variable
	if($form->load(Yii::$app->request->get()))#cuando el formulario de busqueda es enviado
	{
		if ($form->validate())//validamos el campo
		{
			$search = Html::encode($form->q); //evita ataques xss
			/*$query = "SELECT * FROM objeto WHERE id_objeto LIKE '%$search%' OR ";//realizamos una consulta SQL
			 $query .= "nombre LIKE '%$search%' OR autor LIKE '%$search%'";
			 $model = $table->findBySql($query)->all(); //extrae todos los registros que coincidan con la consulta almacenando en models
			*/
			$query = Usuarios::find()
			->where(["like","id",$search])
			->orwhere(["like","usuario",$search])
			->orwhere(["like","email",$search])
			->orwhere(["like","rol",$search])
			->orwhere(["like","nombre",$search])
			->orwhere(["like","apellido",$search])
			->orwhere(["like","nacionalidad",$search]);
			$countQuery = clone $query;
			$pages = new Pagination(['pageSize' => 10,'totalCount' => $countQuery->count()]);
			$model = $query->offset($pages->offset)
			->limit($pages->limit)
			->all();
			
			
		}
			
		else {
			$form->getErrors();
			
	
		}
			
	}
	else
	{
		$query = Usuarios::find();
		$countQuery = clone $query;
		$pages = new Pagination(['pageSize' => 10,'totalCount' => $countQuery->count()]);
		$model = $query->offset($pages->offset)
		->limit($pages->limit)
		->all();
		
		
			
	}
	
	return $this->render("admin",[ 'model' => $model, "form" => $form, "search" => $search, "pages" => $pages]);
	
	
	//return $this->render("admin");
}

public function actionActualizarusuario()
{
	$model = new FormAct;
	$msg = null;

	if($model->load(Yii::$app->request->post()))
	{
		if($model->validate())
		{
			$table = Usuarios::findOne($model->id);
			if($table)
			{
				$table->usuario = $model->usuario;
				$table->email = $model->email;
				$table->rol = $model->rol;
				
				if ($table->update())
				{
					$msg = "El Usuario ha sido actualizado correctamente";
				}
				else
				{
					$msg = "El Usuario no ha podido ser actualizado";
				}
			}
			else
			{
				$msg = "El Usuario seleccionado no ha sido encontrado";
			}
		}
		else
		{
			$model->getErrors();
		}
	}


	if (Yii::$app->request->get("id"))
	{
		$id = Html::encode($_GET["id"]);
		if ((int) $id)
		{
			$table = Usuarios::findOne($id);
			if($table)
			{
				$model->id = $table->id;
				$model->usuario = $table->usuario;
				$model->email = $table->email;
				$model->rol = $table->rol;
				
			}
			else
			{
				return $this->redirect(["site/admin"]);
			}
		}
		else
		{
			return $this->redirect(["site/admin"]);
		}
	}
	else
	{
		return $this->redirect(["site/admin"]);
	}
	 return $this->render("actualizarusuario", ["model" => $model, "msg" => $msg]);
}

public function actionEliminarusuario()
{
	if(Yii::$app->request->post())
	{
		$id = Html::encode($_POST["id"]);
		if((int) $id)
		{
			if(Usuarios::deleteAll("id=:id", [":id" => $id]))
			{
				echo"Usuario con la ID $id, ha sido eliminado. Redireccionando";
				echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("site/admin")."'> ";

				//eliminamos todos los archivos y el directorio que los contiene
				//primero se deben eliminar los archivos de la carpeta antes de poder eliminar la carpeta como tal
					
			}
			else
			{
				echo "H ocurrido un ERROR al tratar de eliminar el Usuario, redireccionamos ";
				echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("site/admin")."'> ";
					
			}

		}
		else
		{
			echo "H ocurrido un ERROR al tratar de eliminar el Usuario, redireccionamos ";
			echo "<meta http-equiv='refresh' content='3; ".Url::toRoute("site/admin")."'> ";

		}
	}
	else
	{
			
		return$this->redirect(["site/admin"]);
		
	}

}
	
	
 private function randKey($str='', $long=0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str)-1;
        for($x=0; $x<$long; $x++)
        {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
  
 public function actionConfirm() //el usuario confirma su registro desde correo
 {
    $table = new Usuarios;
    if (Yii::$app->request->get())
    {
   
        //Obtenemos el valor de los par�metros get
        $id = Html::encode($_GET["id"]);
        $authKey = $_GET["authKey"];
    
        if ((int) $id)
        {
            //Realizamos la consulta para obtener el registro
            $model = $table
            ->find()
            ->where("id=:id", [":id" => $id])
            ->andWhere("authKey=:authKey", [":authKey" => $authKey]);
 
            //Si el registro existe
            if ($model->count() == 1)
            {
                $activar = Usuarios::findOne($id);
                $activar->activate = 1;
                if ($activar->update())
                {
                    echo "Ha sido registrado de manera exitosa, Redireccionando";
                    echo "<meta http-equiv='refresh' content='5; ".Url::toRoute("site/login")."'>";
                }
                else
                {
                    echo "Ha ocurrido un error al realizar el registro";
                    echo "<meta http-equiv='refresh' content='5; ".Url::toRoute("site/login")."'>";
                }
             }
            else //Si no existe redireccionamos a login
            {
                return $this->redirect(["site/login"]);
            }
        }
        else //Si id no es un n�mero entero redireccionamos a login
        {
            return $this->redirect(["site/login"]);
        }
    }
 }
 
 public function actionRegister()
 {
  //Creamos la instancia con el model de validación
  $model = new FormRegister;
   
  //Mostrar� un mensaje en la vista cuando el usuario se haya registrado
  $msg = null;
   
  //Validaci�n mediante ajax
  if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
   
  //Validaci�n cuando el formulario es enviado v�a post
  //Esto sucede cuando la validaci�n ajax se ha llevado a cabo correctamente
  //Tambi�n previene por si el usuario tiene desactivado javascript y la
  //validaci�n mediante ajax no puede ser llevada a cabo
  if ($model->load(Yii::$app->request->post()))
  {
   if($model->validate())
   {
    //Preparamos la consulta para guardar el usuario
    $table = new Usuarios;
    $table->usuario = $model->usuario;
    $table->email = $model->email;
    $table->nombre = $model->nombre;
    $table->apellido = $model->apellido;
    $table->nacionalidad = $model->nacionalidad;
    //Encriptamos el password
    $table->clave = crypt($model->clave, Yii::$app->params["salt"]);
    //Creamos una cookie para autenticar al usuario cuando decida recordar la sesi�n, esta misma
    //clave ser� utilizada para activar el usuario
    $table->authKey = $this->randKey("abcdef0123456789", 200);
    //Creamos un token de acceso �nico para el usuario
    $table->accessToken = $this->randKey("abcdef0123456789", 200);
     
    //Si el registro es guardado correctamente
    if ($table->insert())
    {
     //Nueva consulta para obtener el id del usuario
     //Para confirmar al usuario se requiere su id y su authKey
     $user = $table->find()->where(["email" => $model->email])->one();
     $id = urlencode($user->id);
     $authKey = urlencode($user->authKey);
      
     $subject = "Confirmar registro";
     $body = "<h1>Haga click en el siguiente enlace para finalizar tu registro</h1>";
     $body .= "Bienvenidos a Bibliotheca, la biblioteca donde se encuentran toda clase de textos, presione el siguiente enlace para finalizar la suscripcion <br>
     		<a href='http://localhost/flip/web/index.php?r=site/confirm&id=".$id."&authKey=".$authKey."'>Confirmar</a>";
      
     //Enviamos el correo
     Yii::$app->mailer->compose()
     ->setTo($user->email)
     ->setFrom([Yii::$app->params["adminEmail"] => Yii::$app->params["title"]])
     ->setSubject($subject)
     ->setHtmlBody($body)
     ->send();
     
     $model->usuario = null;
     $model->email = null;
     $model->nombre = null;
     $model->apellido = null;
     $model->nacionalidad = null;
     $model->clave = null;
     $model->repita_clave = null;
   
     
     $msg = "Dirigete a tu correo y confirma tu suscripcion";
    }
    else
    {
     $msg = "Ha ocurrido un error al llevar a cabo tu registro";
    }
     
   }
   else
   {
    $model->getErrors();
   }
  }
  return $this->render("register", ["model" => $model, "msg" => $msg]);
 }
	
	
public function behaviors() //funcion de control de roles
{
    return [
        'access' => [
            'class' => AccessControl::className(),
            'only' => ['mostrar','ver','viewer', 'crear', 'registros', 'admin', 'editarusuario','creartesis','registrostesis','','registrosrevista','crearrevista','actualizar','actualizartesis','actualizarrevista'],
            'rules' => [
                [
                    //El administrador tiene permisos sobre las siguientes acciones
                    'actions' => ['logout','admin','ver', 'viewer','prueba', 'editarusuario','mostrar', 'registros','crear','creartesis','registrostesis','','registrosrevista','actualizar','actualizarrevista','actualizartesis','crearrevista','aaaaa'],
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
                'actions' => ['logout', 'crear','registros','creartesis','registrostesis','crear','registrosrevista','actualizar','actualizartesis','actualizarrevista','prueba'],
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
                   'actions' => ['logout', 'simple'],
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

 public function actionIndex()
    {
        $searchModel = new ObjetoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
   
    public function actionIndexp()
{
        $searchModel = new RevistaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexp', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionIndext()
{
        $searchModel = new TesisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indext', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionIndexa()
{
        $searchModel = new ArticuloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexa', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionLogin()
    	{	
    		if (!\Yii::$app->user->isGuest) 
    		{

				if (User::isUserAdmin(Yii::$app->user->identity->id))
				{
					
 					return $this->redirect(["site/admin"]);
				}
				if (User::isUserCatalog(Yii::$app->user->identity->id))
				{
					return $this->redirect(["objeto/index"]);
				}
				else
				{
 					return $this->redirect(["site/index"]);
				}
     		}

        	$model = new LoginForm();
			if ($model->load(Yii::$app->request->post()) && $model->login()) 
			{
        		if (User::isUserAdmin(Yii::$app->user->identity->id))
				{
 					return $this->redirect(["site/admin"]);
				}
				if  (User::isUserCatalog(Yii::$app->user->identity->id))
				{
					return $this->redirect(["objeto/index"]);
				}
				else
				{
 					return $this->redirect(["site/index"]);
				}

     		} else {
         		return $this->render('login', [
             		'model' => $model,
        		 ]);
    	 }
 }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
