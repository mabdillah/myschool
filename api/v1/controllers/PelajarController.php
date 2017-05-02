<?php

namespace app\api\v1\controllers;

use yii\rest\ActiveController;

class PelajarController extends ActiveController
{
	//public $modelClass = 'app\api\v1\models\Pelajar';
	public $modelClass = 'app\models\Pelajar';
	/*public function checkAccess($action, $model = null, $params = [])
	{
		if (\Yii::$app->user->isGuest) {
			throw new UnauthorizedHttpException;
		}
	}*/
}
