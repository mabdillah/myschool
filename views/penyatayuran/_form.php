<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Penyatayuran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penyatayuran-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'darjah')->radioList(['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6']) ?>
    <?= $form->field($model, 'id_kelas')->checkboxList(ArrayHelper::map(
        \app\models\Kelas::find()
            ->all(),'id','nama_kelas'),[ 'prompt' => 'Please Choose One']); ?>
    <?= $form->field($model, 'id_sesi')->dropDownList(ArrayHelper::map(
        \app\models\Sesi::find()
            ->all(),'id_sesi','tahun'),[ 'prompt' => 'Please Choose One']); ?>

    <?= $form->field($model, 'id_bulan')->dropDownList(ArrayHelper::map(
        \app\models\Bulan::find()
            ->all(),'id_bulan','nama_bulan'),[ 'prompt' => 'Please Choose One']); ?>


    <?= $form->field($model, 'yuran_belajar')->textInput(['onkeyup'=>'kira()']) ?>

    <?= $form->field($model, 'yuran_makan')->textInput(['onkeyup'=>'kira()']) ?>

    <?= $form->field($model, 'yuran_pengangkutan')->textInput(['onkeyup'=>'kira()']) ?>

    <?= $form->field($model, 'yuran_tuisyen')->textInput(['onkeyup'=>'kira()']) ?>

    <?= $form->field($model, 'yuran_tuisyenmakan')->textInput(['onkeyup'=>'kira()']) ?>

    <?= $form->field($model, 'discount')->textInput(['onkeyup'=>'kira()']) ?>

    <?= $form->field($model, 'jumlah')->textInput(['readonly'=>true]) ?>


    <p id="demo"></p>

    <script>
        function kira() {
            var yuranbelajar = document.getElementById("penyatayuran-yuran_belajar").value;
            var yuranmakan = document.getElementById("penyatayuran-yuran_makan").value;
            var yuranpengangkutan = document.getElementById("penyatayuran-yuran_pengangkutan").value;
            var yurantuisyen = document.getElementById("penyatayuran-yuran_tuisyen").value;
            var yurantuisyenmakan = document.getElementById("penyatayuran-yuran_tuisyenmakan").value;
            var discount = document.getElementById("penyatayuran-discount").value;
            var jum = parseFloat(yuranbelajar) + parseFloat(yuranmakan)+ parseFloat(yuranpengangkutan)+ parseFloat(yurantuisyen)+ parseFloat(yurantuisyenmakan);
            var jumlahkasar= parseFloat (jum -(jum * (discount/100)));
            if(isNaN(jumlahkasar)){
                jumlahkasar = 0;
            }

            document.getElementById("penyatayuran-jumlah").value =  jumlahkasar;
        }


    </script>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
