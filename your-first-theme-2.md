#Your First Theme - Part 2

##Where we are at
Ok so in our last post we finished with you technically having a WordPress theme but the only thing it did was say "This will work" on the home page. In this post we will add a header, footer, and list your posts on the home page using the default WP_Query and Loop.

So fire up your local environment and lets get to work.

##Base Structure
All websites have a head and a footer ( even if they appear not to ). These two components consist of everything the is exactly the same ( for the most part ) at the top and bottom of a page.  Lets start by creating a header.php and a footer.php in `<your-theme>` directory.

In these files simply type "header" and "footer" respectively so we can see that they are loading in our next step. Now that these files exist we need to tell your theme to load them.  WordPress specifically looks for files with these names so in index.php well will add two Core functions that call ( i.e. include ) these files.  These two funtions are `get_header()` and `get_footer()` - when you add these your index.php file should now look like:

```
<?php get_header(); ?>
this will work
<?php get_footer(); ?>
```

After saving and refreshing your home page you should now see `headerthis will work footer`.

Ok, this is all well and good but we need some html to make this thing actually work. Lets take this basic html structure and decide what will be in header.php, what will go in index.php and what will be in footer.php:

```
<!DOCTYPE html>
<html>
	<head>
	<title></title>
	</head>
	<body>
		<div class="wrapper">
			<div class="content">
			</div><!--end content-->
			<footer>
			</footer>
		</div><!--end wrapper-->
	</body>
</html>
```

