<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var yii\widgets\ActiveForm      $form
 * @var dektrium\user\models\User   $user
 */
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>

<?= $form->field($user, 'fullname')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'password')->passwordInput() ?>
<?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>

<div class="form-group">
	<?php echo Html::label('Role *','',['class'=>'control-label col-sm-3']) ?>
		<div class="col-sm-9">
			<?php
			if($user->isNewRecord){
				$itemname = '';
			}else{
				$authassg = \Yii::$app->db->createCommand("SELECT item_name FROM auth_assignment WHERE user_id='".$user->id."'")->queryOne();
				$itemname = $authassg['item_name'];				
			}				
			$main = \Yii::$app->db->createCommand("SELECT name FROM `auth_item` WHERE `type` = '1' AND name != 'Admin'")->queryAll();
			echo Html::dropDownList('role',$itemname,ArrayHelper::map($main, 'name', 'name'),['prompt'=>'Pilih','class'=>'form-control']) ?>
		</div>
</div>
