<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="item">
    <a class="mobile-link" href="<?= Url::to(['/friendship/manage/list', 'id' => Yii::$app->user->id]); ?>"></a>
	<div id="icon-friends" class="activity-icon"><svg class="icon icon-friends"><use xlink:href="svg/sprite/sprite.svg#friends"></use></svg>
		<div class="activity-counter"><span id="badge-requests"><?php echo $receivedRequestsCount; ?></span></div>
	</div>
	<div class="tooltip-base">Friends</div>
	<div class="activity-sub-menu">
		<div class="friends-sub-menu">

			<div class="sub-menu-header">
				<div class="title">Friend Requests</div>
				<div class="counter"><span ><?php echo $receivedRequestsCount; ?></span></div>
				<div class="moreLink"><a class="findUserLink" href="#">Find friends</a></div>
			</div>

			<div class="sub-menu-content">
				<div class="requestList">
					<ul id="dropdown-requests">

					</ul>
				</div>
				<div class="onLineList">
					<div class="list-header">
						<div class="marker"></div><span>Friends Online (<?= $count_online_user; ?>)</span></div>
					<ul id="dropdown-online">

					</ul>
				</div>
			</div>
			<div class="sub-menu-footer"><a class="seeAll" href="<?= Url::to(['/friendship/manage/list', 'id' => Yii::$app->user->id]); ?>">See all</a></div>
		</div>
	</div>
</div>


<script type="text/javascript">

    /**
     * Refresh New Mail Message Count (Badge)
     */
    reloadRequestsCountInterval = 7000;
    setInterval(function () {
        jQuery.getJSON("<?php echo Url::to(['/friendship/manage/get-new-requests-count-json']); ?>", function (json) {
            setFriendRequestsCount(parseInt(json.newRequests));
        });
    }, reloadRequestsCountInterval);

    setFriendRequestsCount(<?php echo $receivedRequestsCount; ?>);


    /**
     * Sets current message count
     */
    function setFriendRequestsCount(count) {
        // show or hide the badge for new messages
        if (count == 0) {
            $('#badge-requests').css('display', 'none');
            $('#badge-requests').parents('.item').removeClass('has-notification');
        } else {
            $('#badge-requests').empty();
            $('#badge-requests').append(count);
            $('#badge-requests').fadeIn('fast');
            $('#badge-requests').parents('.item').addClass('has-notification');
        }
    }

    // V1.2 force update when pjax load
    $(document).on('humhub:ready', function () {
        jQuery.getJSON("<?php echo Url::to(['/friendship/manage/get-new-requests-count-json']); ?>", function (json) {
            setFriendRequestsCount(parseInt(json.newRequests));
        });
    });



    // open the messages menu
    $('#icon-friends').click(function () {

        // remove all <li> entries from dropdown
        $('#dropdown-requests').find('li').remove();
        $('#dropdown-requests').find('ul').remove();

        $('#dropdown-online').find('li').remove();
        $('#dropdown-online').find('ul').remove();

        // append title and loader to dropdown
        $('#dropdown-requests').append('' +
            ' <ul class="media-list">' +
            '<li id="loader_requests">' +
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

        // append title and loader to dropdown
        $('#dropdown-online').append('' +
            ' <ul class="media-list">' +
            '<li id="loader_online">' +
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
            'url': '<?php echo Url::to(['/friendship/manage/requests-list']); ?>',
            'cache': false,
            'data': jQuery(this).parents("form").serialize(),
            'success': function (html) {
                jQuery("#loader_requests").replaceWith(html);
            }});

        $.ajax({
            'type': 'GET',
            'url': '<?php echo Url::to(['/friendship/manage/online-list']); ?>',
            'cache': false,
            'data': jQuery(this).parents("form").serialize(),
            'success': function (html) {
                jQuery("#loader_online").replaceWith(html);
            }});

    })
</script>

