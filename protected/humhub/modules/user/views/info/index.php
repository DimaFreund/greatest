<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 08.02.18
 * Time: 17:33
 */

use yii\helpers\Url;

?>





<main>
    <section class="all-success-stories">
        <div class="base-wrap">
            <h1 class="base-lg-title">Success stories</h1>
            <div class="items-wrap success-stories">
	            <?php foreach($model as $item){ ?>
	            <?php if(!empty($item->attributes['image'])){ ?>
                <a class="item" href="<?= Url::toRoute(['info/view', 'id'=>$item->attributes['id']]); ?>">
                    <div class="item-img"><img src="/uploads/admin_files/<?php echo $item->attributes['image']; ?>"></div>
                    <div class="wrap">
                        <div class="title"><?php echo $item->attributes['title']; ?></div>
                        <div class="desc"><?php echo $item->attributes['description']; ?></div>
                        <div class="link">more</div>
                    </div>
                </a>
		            <?php } ?>
	            <?php } ?>
            </div>
            <div class="base-btn"><a href="#">Load more</a></div>
        </div>
    </section>
</main>