<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 24.05.18
 * Time: 13:02
 */
?>




<?php
/**
 * Left Navigation by MenuWidget.
 *
 * @package humhub.widgets
 * @since 0.5
 */
?>

<!-- start: list-group navi for large devices -->
<?php foreach ($this->context->getItemGroups() as $group) : ?>
	<?php $items = $this->context->getItems($group['id']); ?>
	<?php if (count($items) == 0) continue; ?>
<div class="top-menu">
    <ul>
	<?php foreach ($items as $item) : ?>
		<?php $item['htmlOptions']['class'] .= " list-group-item"; ?>
        <li class="<?= $item['isActive']?'active':''; ?>"><?php echo \yii\helpers\Html::a($item['label'], $item['url']); ?></li>
	<?php endforeach; ?>
    </ul>
</div>

<?php endforeach; ?>

<!-- end: list-group navi for large devices -->
