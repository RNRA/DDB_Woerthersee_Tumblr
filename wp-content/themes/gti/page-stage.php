<?php $slides = RNRA_Stage::loadSlides(); ?>

<div class="slider">
	<?php foreach ($slides as $slide): ?>
		<?php $post = get_post($slide->ID) ?>
		<div>
			<?php $alternative = get_field("slide_mainimg_alternative", $slide->ID); ?>
			<?php if (strlen($alternative) == 0): ?>
				<?php echo get_the_post_thumbnail($slide->ID) ?>
			<?php else: ?>
				<?php echo $alternative ?>
			<?php endif ?>
			<div class="intro">
				<h2><?php echo get_field("slide_box_title", $slide->ID) ?></h2>
				<p><?php echo get_field("slide_box_text", $slide->ID) ?></p>
				<a href="#<?php echo $post->post_name ?>" class="button bcorner">mehr</a>
			</div>
		</div>
	<?php endforeach ?>
</div>
<div class="slider-tabs show-for-medium-up">
	<div class="row">
		<div class="small-12 columns">
			<ul>
				<?php $x = 0; ?>
				<?php foreach ($slides as $slide): ?>
					<li class="slider-tab" data-index="<?php echo $x ?>">
						<h3 class="title bcorner"><?php echo get_field("slide_bracket_title", $slide->ID) ?></h3>
						<img src="<?php echo get_field("slide_bracket_image", $slide->ID) ?>" alt="">
					</li>
					<?php $x++; ?>
				<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>
<div class="articles">
	<?php foreach ($slides as $slide): ?>
		<?php $post = get_post($slide->ID) ?>
		<article class="" id="<?php echo $post->post_name ?>">
			<div class="row">
				<div class="small-12 columns closewrapper">
					<a href="#" class="close-article">
						Schließen <i class="fa fa-times"></i>
					</a>
				</div>
				<div class="small-12 columns">
					<h2><?php echo $post->post_title ?></h2>
					<?php echo $post->post_content ?>
				</div>
			</div>
		</article>
	<?php endforeach ?>
</div>