<?php


	namespace app\models;
	use Yii;
	use yii\base\model;
	
	class ValidarObjetoBibliografico extends model {
		
		public $nombre_objeto;
		//public $autor_objeto;
		//public $editorial_objeto;
		//public $isbn_objeto;
		//public $palabras_objeto;
		
		public function rules(){
			
			return [
					['nombre_objeto', 'required', 'message' => 'Campo Requerido' ],
					['nombre_objeto', 'match', 'pattern' =>  '/^.{3,50}$/', 'message' => 'Minimo 3 caracteres'],
					['nombre_objeto', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Escriba solo Numeros y Letras'],
					['nombre_objeto','nombre_objeto_existe']				
								
			];			
			
		}
		
		public function attributeLabels(){			
			
			return[
					'nombre_objeto' => 'Nombre del Objeto Bibliografico',					
			];				
		} 
		
		public function nombre_objeto_existe($attribute, $params){
			
			$nombre_objeto = ["Plantas","vegetacion" ,"Aguila"];			
			foreach ($nombre_objeto as $val){ //recorremos los elementos de la matriz
				
				if($this->nombre_objeto == $val){ //realiza una comparacion entre lo que se tiene guardado y lo que se esta ingresando
					
					$this->addError ($attribute, "El titulo del objeto bibliografico que pretende almacenar, existe");
					return true;					
				}
				else{
					return false;
					
				}
			}
			
		}
		
	}