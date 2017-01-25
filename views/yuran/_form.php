<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Yuran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yuran-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'id_pelajar')->textInput() ?>

    <?= $form->field($model, 'id_kelas')->textInput() ?>

    <?= $form->field($model, 'id_bulan')->textInput() ?>

<!--    --><?//= $form->field($model, 'yuran_pelajaran')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'baki_yuran_pelajaran')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'yuran_makan')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'baki_yuran_makan')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'yuran_pengangkutan')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'baki_yuran_pengangkutan')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'yuran_tuisyen')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'baki_yuran_tuisyen')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'yuran_tuisyen_makan')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'baki_yuran_tuisyen_makan')->textInput() ?>

    <div class="clearfix">
        <p class="pull-left">
            <?= Html::submitButton('<span class="glyphicon "></span> Search',['class' => 'btn btn-success']); ?>
        </p>
    </div>


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
            th{
                padding: 5px;
                text-align: center;


            }
            td,tr {
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
    if($model->id_kelas!=null){
    ?>

    <table id="t01">
        <tr>
            <th>Nama Pelajar</th>
            <th>Markah1</th>
            <th>Markah2</th>
            <th>Jumlah</th>
            <th>Gred</th>
        </tr>
        <?php

        $rows = Yuran::find()->select(['id_markah','id_pelajar', 'nama_pelajar','markah1','markah2','jumlah','gred'])->innerjoinWith('pelajar')
            ->where(['id_exam' => $model->id_exam,'id_sesi' => $model->id_sesi, 'id_kelas' => $model->id_kelas, 'id_matapelajaran' => $model->id_matapelajaran])
            ->orderBy('id_pelajar')->all();

        if (count($rows) > 0) {
            foreach ($rows as $row) {
                echo $form->field($model, 'id_pelajar[]')->hiddenInput(['value' => $row->id_markah, 'id' => 'id_pelajar_' . $row->id_pelajar])->label(false)->error(false);
                //echo $form->field($model, 'id_pelajar')->hiddenInput(['value' => $row->id_pelajar, 'id' => 'id_pelajar_' . $row->id_pelajar])->label(false)->error(false);

                echo "<tr>";
                echo "<td>" . $row->pelajar->nama_pelajar . "</td>";
                if($row->markah1==NULL && $row->markah2==NULL && $row->jumlah==NULL && $row->gred==NULL){

                    echo "<td>" . $form->field($model, 'markah1[]')->textInput(['onkeyup' => 'kira(' . $row->id_pelajar . ')'
                            , 'id' => 'markah1_' . $row->id_pelajar])->label(false)->error(false) . "</td>";
                    echo "<td>" . $form->field($model, 'markah2[]')->textInput(['onkeyup' => 'kira(' . $row->id_pelajar . ')'
                            , 'id' => 'markah2_' . $row->id_pelajar])->label(false)->error(false) . "</td>";
                    echo "<td>" . $form->field($model, 'jumlah[]')->textInput(['readonly' => true, 'id' => 'jumlah_' . $row->id_pelajar])
                            ->label(false)->error(false) . "</td>";
                    echo "<td>" . $form->field($model, 'gred[]')->
                        textInput(['readonly' => true, 'id' => 'gred_' . $row->id_pelajar])->label(false)->error(false) . "</td>";

                }
                if($row->markah2==NULL){
                    echo "<td>" . $form->field($model, 'markah1[]')->textInput(['value' => $row->markah1
                            , 'id' => 'markah1_' . $row->id_pelajar])->label(false)->error(false) . "</td>";
                    echo "<td>" . $form->field($model, 'markah2[]')->textInput(['onkeyup' => 'kira(' . $row->id_pelajar . ')'
                            , 'id' => 'markah2_' . $row->id_pelajar])->label(false)->error(false) . "</td>";
                    echo "<td>" . $form->field($model, 'jumlah[]')->textInput(['readonly' => true, 'id' => 'jumlah_' . $row->id_pelajar])
                            ->label(false)->error(false) . "</td>";
                    echo "<td>" . $form->field($model, 'gred[]')->
                        textInput(['readonly' => true, 'id' => 'gred_' . $row->id_pelajar])->label(false)->error(false) . "</td>";
                }else
                {

                    echo "<td>" . $row->markah1 ."</td>";
                    echo "<td>" . $row->markah2 . "</td>";
                    echo "<td>" . $row->jumlah . "</td>";
                    echo "<td>" . $row->gred . "</td>";
                }


                echo "</tr>";
            }
        } else {
            $pelajar = "<option>-Tiada-</option>";
        }

        echo "</table>";
        echo '</br>';
        echo '<div class="form-group">';


        echo Html::submitButton( 'Save',['class' =>  'btn btn-success','name'=>'btn','value'=>'2']);

        echo '</div>';}

        ?>





        <body>


        <p id="demo"></p>

        <script>
            function kira(idpelajar) {
                var markah1 = document.getElementById("markah1_"+idpelajar).value;
                var markah2 = document.getElementById("markah2_"+idpelajar).value;
                var jum = parseFloat(markah1) + parseFloat(markah2);
                if(isNaN(jum)){
                    jum = markah1;
                }
                markah1
                document.getElementById("jumlah_"+idpelajar).value = jum;
                $.ajax({
                    type:"POST",
                    url: "index.php?r=markah/gred&val="+jum,
                    success: function(response){
                        //alert(response);
                        document.getElementById("gred_"+idpelajar).value = response;
                    }
                });

                //alert('<?php

             echo $gred['gred'];

             ?>');



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
