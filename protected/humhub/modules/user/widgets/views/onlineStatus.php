<?php


use humhub\widgets\ActiveForm;

if($isProfileOwner) {
	$form = ActiveForm::begin( [
		'action' => $actionUrl,
		'options' => [
			'id'                   => 'form_online_status',
			'enableAjaxValidation' => true
		]
	] ); ?>
	<?= $form->field( $user, 'status_online' )
             ->label( false )
             ->dropDownList( $arrayStatusOnline, ['options' => $arrayStatusOnlineClass, 'class' => 'status'] );; ?>
	<?php ActiveForm::end(); ?>

	<?php
	$script = <<< JS

    $(document).on("change", "#user-status_online", function () {
                //Сама форма    
                var form = $('#form_online_status');
                var action = form.attr('action');
                var data = form.serializeArray();
                sendUserData(form, action, data);

    return false; // Отменить синхронную отправку данных
    
    });

function sendUserData(form, action, data){
      $.ajax({
                    //Тип запроса
                    type: 'POST',

                    //Адрес запроса
                    url: action,

                     //Данные из формы в массиве
                    data: data,
                     }
                 )
                 
                 //Если запрос отправлен
                 .done(function(data) {
                 
                       //Не прошла валидация с сервера 
                      if (data.validation) {
                         form.yiiActiveForm('updateMessages', data.validation, true); // renders validation messages at appropriate places
                     } 
                 })
        //Если запрос не ушел	
        .fail(function () {
           
            //alert('Ошибка, попробуйте позже');
        })
}
 jQuery('select').styler();
JS;
	$this->registerJs( $script );
} else {
	echo '<div class="status ' . strtolower($arrayStatusOnline[$user->status_online]) . '">' . $arrayStatusOnline[$user->status_online] . '</div>';

}
?>