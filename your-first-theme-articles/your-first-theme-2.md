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

##Adding some structure
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

So let us consider what will be comment to every single page on our site.  Clearly every page will need our doctype, <html>, <head> and, <body> tags but we can take this further be saying that every page will also need the div.wrapper and div.content _opening_ tags. Go ahead and paste all these in your header.php ( delete any thing that may still be in this file ) file which will now look like:

```
<!DOCTYPE html>
<html>
	<head>
	<title></title>
	</head>
	<body>
		<div class="wrapper">
			<div class="content">
```

Clearly all these will also need to be closed, so take everything else and paste it into footer.php ( delete any thing that may still be in this file ) which will now look like:

```
			</div><!--end content-->
			<footer>
			</footer>
		</div><!--end wrapper-->
	</body>
</html>
```
Make sure you have save both those files, refresh you site and inspect ( right click > inspect in Chrome ) your site.  You should now see these html tags being spit out.

##Digging into The Loop
Ok, we now have some stucture and can begin to start diplaying our posts.  To satart with in index.php we will delete our sample content "This will work."  We will also update our php here to be a little cleaner to be:

```
<?php
get_header();

get_footer();
?>
```
Note that there is no close php tag `?>` at the end of this file.  We dont actually have to close php at the end of files which helps with some common white space issues taht result in a "headers already sent" error.

Now that this is a little cleaner will will update it to include WordPress' basic Loop so it will now look like:

```
<?php
get_header();

if ( have_posts() ) {

	// Start the loop.
	while ( have_posts() ) {
		// WordPress core function to set up post data
		the_post();

		the_title();
		// We will create this file shortly - Our template which we use for each post
		// get_template_part( 'template-parts/post', 'loop' );
	}
	// End the loop.

} else {
	// no content template part will go here
}


get_footer();
?>
```

Let brake this down and understand what's happening:
1. First we call `get_header()` - This includes our header.php file as well
2. Then `if ( have_posts() ) {` checks if we actually have any posts to display.  By default WordPress assumes that your index.php file is supposed to show a list of your most recent posts so in this situation we should have posts to display.  In short "If we have posts."
3. Then `while ( have_posts() ) {` Will loop through all our posts that we are supposed to show. It literally means "While we have posts to show do something"
4. the `the_post();` is a very important function which is often forgotten about when starting to work with WordPress.  This function sets up the current post's information so we can use WordPress' core functions.  In this example the next function we call is `the_title();`
5. `the_title();` Unsurprisingly displays ( or echos ) the name of the current post in the loop.

If everything has gone correct so far when you refresh your site's homepage you should now see the titles of the first 10 posts from our sample data, WordPress by default also assumes that you only want to show Published posts so and Scheduled or Draft ( or anything that is not Published ) will not be displayed.

So we have a list of titles being spit out in a very ugly way currently, now lets start making our first template part that will be the block of html that contains each of our posts.

Go ahead and delete `the_title();` from index.php and un-comment ( i.e. delete `//` ) from the line
`// get_template_part( 'template-parts/post', 'loop' );`. Clearly we need to create this directory and file.  WordPress' function of `get_template_part();` starts looking for files at the root level of your theme ( i.e. at the level of where index.php is ).  This means that we will need to create a `template-parts` directory as well as the file `post-loop.php` inside of this new directory.

In our code of `get_template_part( 'template-parts/post', 'loop' );` you can see that we are _passing_ 2 strings ( i.e. just text ) to this function.  The first string `template-parts/post` tells WordPress to look for `<your-theme>/template-parts/post-*.php` where `*` represents any addition string, while `loop` tells WordPress specifically to look for `post-loop.php`.

Once this directory and file have been created go ahead and add `<?php the_title(); ?>` to our new template part.

So now index.php looks like:

```
<?php
get_header();

if ( have_posts() ) {

	// Start the loop.
	while ( have_posts() ) {
		// WordPress core function to set up post data
		the_post();

		// Our template which we use for each post
		get_template_part( 'template-parts/post', 'loop' );
	}
	// End the loop.

} else {
	// no content template part will go here
}


get_footer();
?>
```

And our new template-parts/post-loop.php so have just one line of code like:

```
<?php the_title(); ?>
```

To take this one step further lets add a html heading tag around `the_title()` like:

```
<h2><?php the_title(); ?></h2>
```

Note how the html is _outside_ of our opening and closing php tags ( <?php and ?> ).

Now refresh your site and you should see all the titles of your first 10 posts now being displayed as `<h2>` headings.





