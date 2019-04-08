<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 22.06.18
 * Time: 13:13
 */
?>

<?php foreach ($this->context->getItemGroups() as $group) : ?>
	<ul id="<?= $this->context->id; ?>">
		<?php $items = $this->context->getItems($group['id']); ?>
		<?php if (count($items) == 0) continue; ?>

		<?php foreach ($items as $item) : ?>
			<?php $item['htmlOptions']['class'] .= " list-group-item"; ?>
			<li class="<?= $item['isActive']?'active':''; ?> <?= isset($item['class'])?$item['class']:''; ?>"><?php echo \yii\helpers\Html::a($item['label'], $item['url']); ?></li>
		<?php endforeach; ?>
	</ul>
<?php endforeach; ?>