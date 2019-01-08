<?php

use yii\helpers\Html;
use yii\helpers\Url;
use humhub\modules\mail\Assets;

$this->registerjsVar('mail_loadMessageUrl', Url::to(['/mail/mail/show', 'id' => '-messageId-']));
$this->registerjsVar('mail_viewMessageUrl', Url::to(['/mail/mail/index', 'id' => '-messageId-']));

Assets::register($this);
?>

<div class="item">
    <a class="mobile-link" href="<?= Url::to(['/mail/mail']); ?>"></a>
    <div id="icon-messages" class="activity-icon"><svg class="icon icon-messages"><use xlink:href="svg/sprite/sprite.svg#messages"></use></svg>
        <div class="activity-counter"><span id="badge-messages" ></span></div>
    </div>

    <div class="tooltip-base">Messages</div>
    <div class="activity-sub-menu">
        <div class="messages-sub-menu">
            <div class="sub-menu-header">
                <div class="title">Messages</div>
            </div>
            <div class="sub-menu-content">
                <ul id="dropdown-messages" class="dialogList">

                </ul>
            </div>
            <div class="sub-menu-footer"><a class="mailBox" href="<?= Url::toRoute(['/mail/mail']) ?>">View in the Mailbox</a></div>
        </div>
    </div>
</div>


<script type="text/javascript">

    /**
     * Refresh New Mail Message Count (Badge)
     */
    reloadMessageCountInterval = 7000;
    setInterval(function () {
        jQuery.getJSON("<?php echo Url::to(['/mail/mail/get-new-message-count-json']); ?>", function (json) {
            setMailMessageCount(parseInt(json.newMessages));
        });
    }, reloadMessageCountInterval);

    setMailMessageCount(<?php echo $newMailMessageCount; ?>);


    /**
     * Sets current message count
     */
    function setMailMessageCount(count) {
        // show or hide the badge for new messages
        if (count == 0) {
            $('#badge-messages').css('display', 'none');
            $('#badge-messages').parents('.item').removeClass('has-notification');
        } else {
            $('#badge-messages').empty();
            $('#badge-messages').append(count);
            $('#badge-messages').fadeIn('fast');
            $('#badge-messages').parents('.item').addClass('has-notification');
        }
    }

    // V1.2 force update when pjax load
    $(document).on('humhub:ready', function () {
        jQuery.getJSON("<?php echo Url::to(['/mail/mail/get-new-message-count-json']); ?>", function (json) {
            setMailMessageCount(parseInt(json.newMessages));
        });
    });



    // open the messages menu
    $('#icon-messages').click(function () {

        // remove all <li> entries from dropdown
        $('#dropdown-messages').find('li').remove();
        $('#dropdown-messages').find('ul').remove();

        // append title and loader to dropdown
        $('#dropdown-messages').append('' +
                ' <ul class="media-list">' +
                '<li id="loader_messages">' +
                '<div class="loader">' +
                '<div class="sk-spinner sk-spinner-three-bounce">' +
                '<div class="sk-bounce1">' +
                '</div>' +
                '<div class="sk-bounce2">' +
                '</div>' +
                '<div class="sk-bounce3">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</li>' +
                '</ul>');

        $.ajax({
            'type': 'GET',
            'url': '<?php echo Url::to(['/mail/mail/notification-list']); ?>',
            'cache': false,
            'data': jQuery(this).parents("form").serialize(),
            'success': function (html) {
                jQuery("#loader_messages").replaceWith(html);
            }});
    })
</script>

