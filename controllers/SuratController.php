<?php
namespace app\controllers;

use Yii;

class SuratController extends \yii\web\Controller
{
	public function actionResit($id)
	{
		return $this->render('resit',['id'=>$id]);
	}
	public function actionSumbangan($id)
	{
		return $this->render('sumbangan',['id'=>$id]);
	}
}
