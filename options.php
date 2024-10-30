<?php
if ($_POST["act"]<>"") {
	update_option("chain_feed_items",$_POST["items"]);
	update_option("chain_feed_title",$_POST["title"]);
	echo '<div class="updated fade">Settings were saved</div>';
}
?>
<div class="wrap">
<?php if(function_exists('screen_icon')) screen_icon(); ?>
<h2>Chain Feed</h2>
<em>Chain Feed is a social tool to connect your blog with recent commentators's post by displaying their newest RSS Feeds. You can manage the number of RSS Feed should be shown here and give the title about it. However, it will automatically be placed on every single of your posts afterwards.</em>

<form method="post">
<h3>Number of RSS Items</h3>
<p><input name="items" value="<?php echo get_option("chain_feed_items");?>" size="5"/>items</p>
<h3>Chain Feed Title</h3>
<p><input name="title" value="<?php echo get_option("chain_feed_title");?>"/></p>
<p><input type="submit" value="Save" name="act" class="button-primary"/></p>
</form>

</div>