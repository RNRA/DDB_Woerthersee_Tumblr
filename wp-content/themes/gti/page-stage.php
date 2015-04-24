<?php $slides = RNRA_Stage::loadSlides(); ?>
<?php $tumblr_blog_url = "http://igiwuhesa487.tumblr.com" ?>

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
		<article class="article" id="<?php echo $post->post_name ?>" data-article="<?php echo $post->post_name ?>">
			<div class="row">
				<div class="small-12 columns closewrapper">
					<a href="#" class="close-article">
						Schließen <i class="fa fa-times"></i>
					</a>
				</div>
				<div class="small-12 medium-5 columns">
					<h2><?php echo $post->post_title ?></h2>
					<?php echo $post->post_content ?>
				</div>
				<div class="small-12 medium-7 columns">
					<div class="share">
						<strong>Teile dies</strong>
						<div class="sharewrapper">
							<ul class="socialmedia">
								<li class="facebook">
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $tumblr_blog_url ?>%23<?php echo $post->post_name ?>"><i class="fa fa-facebook"></i></a>
								</li>
								<li class="twitter">
									<a href="https://twitter.com/home?status=<?php echo $tumblr_blog_url ?>%23<?php echo $post->post_name ?>"><i class="fa fa-twitter"></i></a>
								</li>
								<li class="pinterest">
									<a href="https://pinterest.com/pin/create/button/?url=<?php echo $tumblr_blog_url ?>%23<?php echo $post->post_name ?>&amp;media="><i class="fa fa-pinterest-p"></i></a>
								</li>
							</ul>
						</div>
						<div class="share-meta">
							<span class="note"></span>
							<span class="date"></span>
						</div>
					</div>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa nam quos ipsa tempore veritatis, libero temporibus atque magni et, laboriosam qui pariatur porro veniam perspiciatis! Sed natus enim quaerat voluptate.</p>
				</div>
			</div>
		</article>
	<?php endforeach ?>
</div>