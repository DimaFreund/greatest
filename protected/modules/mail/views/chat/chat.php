<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 26.06.18
 * Time: 11:38
 */
?>
<div class="page-content">
    <div class="content-wrap">
        <iframe  name="target" id="frameID" allow="camera; microphone" src="https://gd-chat.page.ua" width="100%" height="562"></iframe>
    </div>
</div>

<script>

    $('#frameID').on('load', function () {
        setTimeout(function(){
            var token = '<?= $loginToken; ?>';
            if(token) {
                window.frames.target.postMessage({
                    event: 'login-with-token',
                    loginToken: token,
                }, '*');
            } else {
                alert('Error connection');
            }
        }, 1000);

    });

</script>