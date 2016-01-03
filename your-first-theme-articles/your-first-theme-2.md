#Your First Theme - Part 2

##Where we are at
Ok, so in our last post, we finished with you creating and activating your own WordPress theme, but the only thing it did was say "This will work" on the home page. In this post we will add a header, footer, and output a basic list of posts on the home page using the default `WP_Query` and Loop.

So fire up your local environment and lets get to work!

##Base Structure
All websites have a header and a footer (even if they appear not to). The header includes the doctype, the opening `<html>` tag, all of the information contained within the `<head>` tag, and the opening of the `<body>` tag. Sometimes it also includes navigation, the site logo, or other components found at the top of every page. The footer includes your `<footer>` tag and the closing of the `<body>` and `<html>` tags. Many websites also have `<divs>` that function as content wrappers, and encase all the content on every page. 

Lets start by creating a `header.php` and a `footer.php` in the root of the `<your-theme>` directory.

In these files, simply type the words "header" and "footer" respectively, so we can see that they are loading in our next step. Now that these files exist, we need to tell your theme to load them.  WordPress has functions that specifically look for these files, so in `index.php` we will add two Core functions that call (i.e. include) these files.  These two funtions are `get_header()` and `get_footer()` - when you add these your `index.php` file should now look like:

```
<?php get_header(); ?>
This will work
<?php get_footer(); ?>
```

After saving and refreshing your home page you should now see `headerThis will workfooter`.

##Adding some structure
Ok, this is all well and good but we need some html to make this thing actually work. Lets take this basic html structure and decide what will be in `header.php`, what will go in `index.php` and what will be in `footer.php`:

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
In WordPress themes, we always want to avoid repetition in our code by breaking it up into reusable parts whenever possible. This means when planning what will go in our header and footer, we want to identify the components which will be exactly the same at the top and bottom of our pages.

So let us consider what will be common to every single page on our site.  Clearly every page will need our doctype, `<html>`, `<head>` and, `<body>` tags but we can take this further be saying that every page will also need the `div.wrapper` and `div.content` _opening_ tags. Go ahead and paste all these in your `header.php` (delete anything that may still be in this file) file which will now look like:

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

Clearly all these will also need to be closed, so take everything else and paste it into `footer.php` (delete anything that may still be in this file) which will now look like:

```
			</div><!--end content-->
			<footer>
			</footer>
		</div><!--end wrapper-->
	</body>
</html>
```
Make sure you save both those files, then refresh your site and view it in the inspector (right click > Inspect in Chrome).  You should now see these html tags being output at the top and bottom, and your "This will work" content in the middle. *Note: there is some more content we will need to add to the header and footer for WordPress to work properly, but we will get to that in the next tutorial.*

##Digging into The Loop
Ok, we now have some stucture and can begin to start diplaying our posts.  To start with, delete your sample "This will work" content in `index.php`.  We will also update our php here to be a little cleaner by eliminating extra opening and closing tags:

```
<?php
get_header();

get_footer();
```
Note that there is no close php tag `?>` at the end of this file.  We don't actually have to close php at the end of files, and not doing so can help avoid common white space issues that result in a "headers already sent" error.

Now that this is a little cleaner, we will update it to include the WordPress Loop. "The Loop" is one of WordPress' core capabilities which is used to output your post data (aka, show the content on the frontend of your site). In combination with WordPress core templates, `WP_Query` and a few other custom functions, this is a powerful tool that enables you to display any combination of WordPress content, and powers most of the visual logic of themes.

For now, we will use the default Loop with no special query defined, which, on `index.php`, outputs all recent content from "Posts."

```
<?php
get_header();

if ( have_posts() ) {

	// Start the loop 
	// This is where content that wraps around all of your posts will go
	while ( have_posts() ) {
		
		// WordPress core function to set up post data
		the_post();

		// This is where the content for each individual post will go
		// For now, we will output the title of each post so you can see that it is working
		the_title();
	}
	// End the loop
	// Close the contet that wraps around all of your posts

} else {
	// if there is no content in the loop, display your "no content" template here
}


get_footer();
?>
```

**Let's break this down and understand what's happening:**

1. `if ( have_posts() ) {` checks if we actually have any posts to display.  
By default, WordPress assumes that your `index.php` file is supposed to show a list of your most recent posts, and because we grabbed all that Unit Testing Data to populate our site with content, we should have posts to display.  You can read this as "If we have posts."

2. Then `while ( have_posts() ) {` will loop through all our posts that we are supposed to show. 
Read this as "While we have posts to show, do this thing for each post."

3. `the_post()` is a very important function which is often forgotten about when starting to work with WordPress.  
This function sets up the current post's information so we can use WordPress' core functions.  Read this as "Use this specific post information for the following content." In this example the next function we call is `the_title()`

4. `the_title()` Unsurprisingly, displays (or echoes) the name of the current post (`the_post()`) in the loop.

If everything has gone correctly so far, when you refresh your site's homepage you should now see the titles of the first 10 posts from our sample data. Why 10? "Show 10 Posts" is the default setting in WordPress' Settings > Reading page for the maximum number of posts that can show on a single page. If you update that setting, it will change the maximum number of posts output in any loop/archive. (You can also customize how many posts-per-page appear programmatically with a custom `WP_Query`, but this setting can have affects on pagination if you ever try to display a posts-per-page number that is larger than what you set here, so just be aware of it).

WordPress by default also assumes that you only want to show Published posts, so any Scheduled or Draft (or anything that is not Published) will not be displayed.

##Adding template parts
So we have a list of titles being spit out (in a very ugly way, remember we haven't added any styles or markup yet). However, that is probably not very useful content in most situations. We can display all sorts of WordPress content here, like your post content, the author, the date, any taxonomies associated with the post (like categories or tags), any metadata associated with the post, featured images, etc. And you will probably want to wrap this in semantic markup so that you can style it as well!

We could just write all of that stuff right there inside the Loop and it would work. But remember, it is good practice in WordPress themes not to repeat yourself, and keep logic separate from visual presentation as much as possible. Maybe we will be displaying posts with the same formatting in multiple areas of the site, or maybe we just want to simplify our `index.php` file and make it easy to find the code for our single post content later. This means we probably want the code for our single post content to be in its own file.

This is where Template Parts come in. Much like how `get_header()` and `get_footer()` tells WordPress to go look for specific core template files, `get_template_part()` tells WordPress to look for specific custom template files, and it's a good idea to get in the habit of building Template Parts for each unique section of your content.

Let's start making our first Template Part, which will contain the block of HTML for each of our posts.

Go ahead and delete `the_title();` from `index.php` and add `get_template_part( 'template-parts/post', 'loop' );` in its place. WordPress' `get_template_part()` function starts looking for files at the root level of your theme (i.e. at the level where `index.php` is). In our code, you can see that we are _passing_ 2 strings (i.e. text) to this function.  The first string `template-parts/post` tells WordPress to look for `<your-theme>/template-parts/post-*.php` where `*` represents any additional string, while `loop` tells WordPress specifically to look for `post-loop.php`. This means it is looking for a file called `post-loop.php` inside a directory called `template-parts`. 

These don't exist yet, so clearly we need to create this directory and file. Add a `template-parts` directory to your theme and create the file `post-loop.php` inside of this new directory.

Once this directory and file have been created, go ahead and add `<?php the_title(); ?>` to our new template part.

So now `index.php` looks like:

```
<?php
get_header();

if ( have_posts() ) {

	// Start the loop 
	// This is where content that wraps around all of your posts will go
	while ( have_posts() ) {
		
		// WordPress core function to set up post data
		the_post();

		// Our template which we use for each post
		get_template_part( 'template-parts/post', 'loop' );
	}
	// End the loop
	// Close the contet that wraps around all of your posts

} else {
	// if there is no content in the loop, display your "no content" template here
}


get_footer();
?>
```

And our new template-parts/post-loop.php should have just one line of code like:

```
<?php the_title(); ?>
```

To take this one step further, let's add an html heading tag around `the_title()` like:

```
<h2><?php the_title(); ?></h2>
```

Note how the html is _outside_ of our opening and closing php tags (`<?php` and `?>`).

Now refresh your site, and you should see all the titles of your first 10 posts now being displayed as `<h2>` headings.

This is a good place to stop for now. In our next post, we will add some of our posts' content, as well as add to the html structure so we can get some basic styles in place.





