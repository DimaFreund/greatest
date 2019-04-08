<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 31.05.18
 * Time: 16:33
 */

use yii\helpers\Url;

?>
<?php foreach($tags as $tag) { ?>
	<li><a href="<?= Url::to(['/desire/desire/search', 'SearchForm[keyword]' => $tag->title]); ?>">#<?= $tag->title; ?></a></li>
<?php } ?>
