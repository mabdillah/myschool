<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Markah;
use app\models\PelajarKelas;
use kartik\grid\GridView;
use yii\helpers\HtmlPurifier;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Markah */
/* @var $form yii\widgets\ActiveForm */
$id_kelas=Yii::$app->getRequest()->getQueryParam('kelas_id') ? Yii::$app->getRequest()->getQueryParam('kelas_id') : $model->id_kelas;
?>

<div class="markah-form">

    <?php $form = ActiveForm::begin([]); ?>

    <?php echo $form->field($model, 'id_sesi')->dropDownList(ArrayHelper::map(
        \app\models\Sesi::find()
            ->all(),'id_sesi','tahun'),['prompt'=>'-Choose a Category-','onchange'=>'$.get( "'.Url::toRoute('/markah/exam').'", { id1: $(this).val() } )
    .done(function( data ) {
    $( "#'.Html::getInputId($model, 'id_exam').'" ).html( data.exam );
    $( "#'.Html::getInputId($model, 'id_kelas').'" ).html( data.kelas );
    }
    );']);?>


    <?php echo $form->field($model, 'id_exam')->dropDownList(ArrayHelper::map(
        \app\models\Exam::find()
            ->all(),'id_exam','description'),['prompt'=>'Please Choose One']); ?>

    <?php echo $form->field($model, 'id_kelas')->dropDownList(ArrayHelper::map(
        \app\models\Kelas::find()
            ->all(),'id','nama_kelas'),['prompt'=>'-Choose a Category-','onchange'=>'$.get( "'.Url::toRoute('/markah/kelas-mp').'", { id2: $(this).val() } )
    .done(function( data ) {
    $( "#'.Html::getInputId($model, 'id_matapelajaran').'" ).html( data.matapelajaran );
    }
    );']); ?>



    <?php echo $form->field($model, 'id_matapelajaran')->dropDownList(ArrayHelper::map(
        \app\models\Matapelajaran::find()
            ->all(),'id_matapelajaran','nama_matapelajaran'),['prompt'=>'-Choose a Category-','onchange'=>'$.get( "'.Url::toRoute('/markah/pelajar-kelas').'", { id: $(this).val() } )
    .done(function( data ) {
    $( "#'.Html::getInputId($model, 'id_pelajar').'" ).html( data.pelajar2 );
    }
    );']); echo '</br>';?>



    <p id="demo"></p>

    <head>
        <style>
            table {
                width:100%;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;

            }
            th, td {
                padding: 5px;
                text-align: center;


            }
            table#t01 tr:nth-child(even) {

                background-color: #eee;
            }
            table#t01 tr:nth-child(odd) {
                background-color:#fff;
            }
            table#t01 th {
                background-color: black;
                color: white;
            }
        </style>
    </head>

    <body>

    <?php
    if($model->id_kelas){
    ?>

    <table id="t01">
        <tr>
            <th>Nama Pelajar </th>
            <th>Markah1</th>
            <th>Markah2</th>
            <th>Jumlah</th>
            <th>Gred</th>
        </tr>
        <?php

        //$rows= Yii::$app->db->createCommand('select nama_pelajar from pelajar_kelas inner join pelajar on pelajar_kelas.id_pelajar=pelajar.id where id_kelas=1')->queryAll();
        $rows = Markah::find()->select(['id_pelajar','nama_pelajar','markah1','markah2','jumlah','gred'])->innerjoinWith('pelajar')->
        where(['id_markah'=>$model->id_markah,'id_kelas' =>  $model->id_kelas,'id_exam'=>$model->id_exam,'id_matapelajaran'=>$model->id_matapelajaran])->orderBy('id_pelajar')->all();
//        $rows1 = Markah::find()->select(['id_pelajar','nama_pelajar'])->innerjoinWith('pelajar')->
//        where(['id_kelas' =>  $model->id_kelas])->orderBy('id_pelajar')->all();

        if (count($rows) > 0) {
            foreach ($rows as $row) {
                $form->field($model, 'id_pelajar')->hiddenInput(['value' => $row->id_pelajar, 'id' => 'id_pelajar_' . $row->id_pelajar])->label(false);
                echo "<tr>";
                echo "<td>" . $row->pelajar->nama_pelajar . "</td>";
                echo "<td>" . $form->field($model, 'markah1')->textInput(['onkeyup' => 'kira(' . $row->id_pelajar . ')', 'id' => 'markah1_' . $row->id_pelajar])->label(false)->error(false) . "</td>";
                echo "<td>" . $form->field($model, 'markah2')->textInput(['onkeyup' => 'kira(' . $row->id_pelajar . ')', 'id' => 'markah2_' . $row->id_pelajar])->label(false)->error(false) . "</td>";
                echo "<td>" . $form->field($model, 'jumlah')->textInput(['readonly' => true, 'id' => 'jumlah_' . $row->id_pelajar])->label(false)->error(false) . "</td>";
                echo "<td>" . $form->field($model, 'gred')->textInput(['readonly' => true, 'id' => 'gred_' . $row->id_pelajar])->label(false)->error(false) . "</td>";
                echo "</tr>";
            }
        } else {
            $pelajar = "<option>-Tiada-</option>";
        }
        echo "</table>";
        echo '</br>';
        echo '<div class="form-group">';
        echo Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        echo '</div>';
        }
        ?>


    </table>

    <body>


    <p id="demo"></p>

    <script>
        function kira(idpelajar) {
            var markah1 = document.getElementById("markah1_"+idpelajar).value;
            var markah2 = document.getElementById("markah2_"+idpelajar).value;
            var jum = parseFloat(markah1) + parseFloat(markah2);
            if(isNaN(jum)){
                jum = 0;
            }
            document.getElementById("jumlah_"+idpelajar).value = jum;
            $.ajax({
                type:"POST",
                url: "index.php?r=markah/gred&val="+jum,
                success: function(response){
                    //alert(response);
                    document.getElementById("gred_"+idpelajar).value = response;
                }
            });
            //alert('<?php echo $grade['gred'] ?>');
            //document.getElementById("markah-gred").value = gred;
            /*if(jum >= 80 && jum <= 100 ){
             document.getElementById("markah-gred").value = 'A';
             }else if(jum >= 60 && jum < 80){
             document.getElementById("markah-gred").value = 'B';
             }else if(jum >40 && jum < 60){
             document.getElementById("markah-gred").value = 'C';
             }else if(jum >=20 && jum < 40){
             document.getElementById("markah-gred").value = 'D';
             }else if(jum >=0 && jum < 20){
             document.getElementById("markah-gred").value = 'E';
             }else{
             document.getElementById("markah-gred").value = '';
             }*/
        }


    </script>






    <?php ActiveForm::end(); ?>

</div>
