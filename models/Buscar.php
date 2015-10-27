<?php
namespace app\models;
use Yii;
use yii\base\model;

class Buscar extends model{
	public $q, $m, $t, $p;
	
	public function rules()
	{		
		return[
				["q", "match", "pattern" =>  '/^[0-9a-z������\s]+$/i', 'message' => 'S�lo se aceptan letras y numeros'],
				["m", "match", "pattern" =>  '/^[0-9a-z������\s]+$/i', 'message' => 'S�lo se aceptan letras y numeros'],
				["t", "match", "pattern" =>  '/^[0-9a-z������\s]+$/i', 'message' => 'S�lo se aceptan letras y numeros'],
				["p", "match", "pattern" =>  '/^[0-9a-z������\s]+$/i', 'message' => 'S�lo se aceptan letras y numeros'],
								
		];		
	}
	
	public function attributeLabels()
	{
		return [
			'q' => "Buscar:", //esto aparece en index
			'm' => "Buscar Monografia:",
			't' => "Buscar Tesis:",
			'p'	=> "Buscar Publicacion Periodica:"
				
		];		
	}
}