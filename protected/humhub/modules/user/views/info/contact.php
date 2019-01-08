<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 09.02.18
 * Time: 15:16
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<main>
    <section class="contacts">
        <div class="base-wrap">
            <h1 class="base-lg-title">Contact Us</h1>
            <div class="subtitle">If you have a quastions, please, contact us:</div>
        </div>
        <div class="contacts-form">
            <div class="base-wrap">
	            <?php $form = ActiveForm::begin(); ?>
                    <label>Your Name*
	                    <?= $form->field( $model, 'name')->textInput( [ 'maxlength' => true ] )->label(false);
	                    ?>
                    </label>
                    <label>Your Email*
	                    <?= $form->field( $model, 'email')->textInput( [ 'maxlength' => true ] )->label(false); ?>
                    </label>
                    <label>Message Subject*
	                    <?= $form->field( $model, 'subject')->textInput( [ 'maxlength' => true ] )->label(false); ?>
                    </label>
                    <label>Message Text*
	                    <?= $form->field( $model, 'text')->textarea( [ 'rows' => 6 ] )->label(false); ?>
                    </label>
                    <div class="base-sm-btn"><input type="submit" value="send"></div>
	            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>
</main>



