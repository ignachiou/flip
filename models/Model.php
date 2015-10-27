<?php
namespace app\models;
use Yii;
use yii\helpers\ArrayHelper;


class Model extends \yii\base\Model
{
	/**
	 * Creates and populates a set of models.
	 *
	 * @param string $modelClass
	 * @param array $multipleModels
	 * @return array
	 */
	
	
	public static function createMultiple($modelClass, $multipleModels = null)
	{
		$model    = new $modelClass;
		$formName = $model->formName();
		$post     = Yii::$app->request->post($formName);
		$models   = [];
		$flag     = false;
		
		
		if ($multipleModels !== null && is_array($multipleModels) && !empty($multipleModels)){
			
			$keys = array_keys(ArrayHelper::map($multipleModels,"id_articulo","id_articulo"));
			$multipleModels = array_combine($keys, $multipleModels);
			$flag = true;
		}

		if ($post && is_array($post)) {
			foreach ($post as $i => $item) {
				if($flag){
				if (isset($item['id_articulo']) && !empty($item['id_articulo']) && isset($multipleModels[$item['id_articulo']])) {
					$models[] = $multipleModels[$item['id_articulo']];
				} else {
					$models[] = new $modelClass;
				}
			}else{
				$models[] = new $modelClass;
				
			}
		}
	}

		unset($model, $formName, $post);

		return $models;
	}
}