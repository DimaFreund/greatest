<?php

use humhub\modules\file\libs\FileHelper;
use humhub\modules\file\widgets\FilePreview;
use humhub\modules\post\models\Post;
use yii\helpers\Html;

/* @var  $showPreview boolean */
/* @var  $files \humhub\modules\file\models\File[] */
/* @var  $previewImage \humhub\modules\file\converter\PreviewImage */
/* @var  $object \humhub\components\ActiveRecord */
/* @var  $hideImageFileInfo boolean */

?>
<?php $counter = 0; ?>
<?php if ( count( $files ) > 0 ) { ?>
	<?php if ( isset( $options['index'] ) && empty( $options['for'] ) ) {
		if ( isset( $files[ $options['index'] ] ) ) {
			if ( $previewImage->applyFile( $files[ $options['index'] ] ) ) {
				$arr                   = array(
					'height' => isset( $options['height'] ) ? $options['height'] : 100,
					'width'  => isset( $options['width'] ) ? $options['width'] : 100,
					'mode'   => 'force'
				);
				$previewImage->options = $arr; ?>
					<?php
					echo $previewImage->render(); ?>
				<?php
			}
		}
		?>

	<?php } elseif ( isset( $options['for'] ) && $options['for'] === 'dessireGallery' ) { ?>
		<?php foreach ( $files as $file ) {
			if ( $previewImage->applyFile( $file ) ) {

				if ( $counter === 1 ) {
					$arr = array(
						'height' => 350,
						'width'  => 510,
					);
				} elseif ( $counter ) {
					$arr = array(
						'height' => 172,
						'width'  => 251,
					);
				}

				?>
				<?php if ( $counter ) {
					$previewImage->options = $arr;
					?>
                    <div class="item">
                        <a data-ui-gallery="<?= "gallery-" . $object->getUniqueId(); ?>"
                           href="<?= $file->getUrl(); ?>#.jpeg" title="<?= Html::encode( $file->file_name ) ?>">
							<?= $previewImage->render(); ?>
                        </a>
                    </div>
				<?php }
			}
			$counter ++;
		}
	} elseif(isset( $options['for'] ) && $options['for'] === 'post') {
		foreach ( $files as $file ) {
			if ( $previewImage->applyFile( $file ) ) {
					$arr = array(
						'height' => 152,
						'width'  => 211,
						'mode'   => 'force'
					);
				    $previewImage->options = $arr;
					?>
                    <div class="item">
                        <a data-ui-gallery="<?= "gallery-" . $object->getUniqueId(); ?>"
                           href="<?= $file->getUrl(); ?>#.jpeg" title="<?= Html::encode( $file->file_name ) ?>">
							<?= $previewImage->render(); ?>
                        </a>
                    </div>
				<?php
			}
		}
    } else { ?>
        <!-- hideOnEdit mandatory since 1.2 -->
        <div class="hideOnEdit">
            <!-- Show Images as Thumbnails -->

			<?php if ( $showPreview ) : ?>
                <div class="post-files" id="post-files-<?= $object->getUniqueId(); ?>">

                    <?php if(count($files) < 3) { ?>
	                    <?php if ( $previewImage->applyFile( $files[0] ) ): ?>
	                        <?php $arr             = array(
		                        'height' => 181,
		                        'width'  => 265,
		                        'mode'   => 'force'
	                        );
	                        $previewImage->options = $arr;
	                        ?>

                            <div><?= $previewImage->render(); ?></div>
	                    <?php endif; ?>
                    <?php } else { ?>
					    <?php foreach ( $files as $file ): ?>
					    	<?php if ( $previewImage->applyFile( $file ) ): ?>

					    		<?php if ( $counter == 0 ) { ?>
					    			<?php $arr             = array(
					    				'height' => 724,
					    				'width'  => 548,
					    				'mode'   => 'force'
					    			);
					    			$previewImage->options = $arr;
					    			?>

                                    <div class="item"><?= $previewImage->render(); ?></div>



					    		<?php } ?>
					    		<?php if ( $counter ===1 ) { ?>
					    			<?php $arr             = array(
					    				'height' => 91,
					    				'width'  => 128,
					    				'mode'   => 'force'
					    			);
					    			$previewImage->options = $arr;
					    			?>


                                    <div class="item"><?= $previewImage->render(); ?></div>

					    		<?php } ?>
					    		<?php if ( $counter === 2 ) { ?>
					    			<?php $arr             = array(
					    				'height' => 91,
					    				'width'  => 128,
					    				'mode'   => 'force'
					    			);
					    			$previewImage->options = $arr;
					    			?>
                                    <div class="item"><?= $previewImage->render(); ?>
                                        <?php if(count($files) > 3) { ?>
                                        <div class="show-more"><span>+<?php echo count( $files ) - 3; ?></span></div>
                                        <?php } ?>
                                    </div>
                                    <?php
					    				break;
					    				?>
					    		<?php } ?>

					    	<?php endif; ?>
					    	<?php $counter ++; ?>
					    <?php endforeach; ?>
                    <?php } ?>
					<?php $playlist = [] ?>


                </div>
			<?php endif; ?>


        </div>

	<?php } ?>
<?php }?>