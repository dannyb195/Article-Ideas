#Your First Theme - Part 3

In part 2 of this series we ended having made a `header.php`, `footer.php`, and `template-part/post-loop.php` to show our most recent posts on `index.php` using The Loop.  In this article we'll work on displaying some additional useful WordPress data within The Loop, adding a sidebar, and create additional markup and styles for structure.

In the interest of diving right into displaying your content, we also skipped some very important elements that WordPress is looking for. We want to add `wp_head()` and `wp_footer()`, which are known as action hooks. We'll talk about the concept of hooks later, but for now what you need to know is that these specific hooks enable themes, plugins, and WordPress Core to output content into the header and footer, respectively. Luckily, it's very simple to include them now:

First open up your `header.php` file and find the the closing `</head>` tag.  Just before this tag we are going to add the php function `wp_head()` so `header.php` should now look like:

```
<!DOCTYPE html>
<html>
	<head>
	<title></title>
	<?php wp_head(); ?>
	</head>
	<body>
		<div class="wrapper">
			<div class="content">
```

`wp_head()` allows themes, plugins, and WordPress Core to add links, scripts, and other output to the header.  If you've noticed in your browser inspector, while we do have a `style.css` file, it is not actually being called or used in our HTML markup yet - but don't worry, we'll be getting to that today.

Similar to `wp_head()`, there is also the `wp_footer()` function, which I'm sure you hvae already guessed goes in `footer.php`. Open this and add it right before the closing `</body>` tag, and your file will now look like:

```
			</div><!--end content-->
			<footer>
			</footer>
		</div><!--end wrapper-->
		<?php wp_footer(); ?>
	</body>
</html>
```

`wp_footer()` basically does the exact same thing as `wp_head()`, allowing themes, plugins, and WordPress Core to add scripts and other output to the footer of our theme.


##Adding markup within the loop
Let us turn our attention back to `template-parts/post-loop.php` which currently only has `<h2><?php the_title(); ?></h2>` in it. Remember, this is the content inside our Loop, which is output for each post we have. We probably want to display something besides the title, perhaps we want to show who wrote each post and the post content itself.  In anticipation of our new content, let's give it some basic markup so we can target it with styles later. We'll start by wrapping everything in an `<article>` tag as well as adding two more empty `<divs>` under the `<h2>` title - give the first `<div>` the class of `author` and the second the class of `post-content`.  The file should now look like:

```
<article class="post-archive">
	<h2><?php the_title(); ?></h2>
	<div class="author"></div>
	<div class="post-content"></div>
</article>
```

WordPress provides us with a number of functions to help output our data.  According to WordPress standards, any of the core fucnctions that start with `the_` will automatically output (echo) the information being returned, which is why they are often used in themes to display content. The two that we will use now are `<?php the_author(); ?>` and `<?php the_content(); ?>` – I'm guessing you have a pretty good idea what they do! Place each of these funcitons inside the appropriate `<div>` like:

```
<div class="author"><?php the_author(); ?></div>
<div class="post-content"><?php the_content(); ?></div>
```

When you refresh your page, you should now see a list of titles, authors, and the entirety of the post content (including any images or media embedded within the post).

##Adding WordPress IDs and Classes
WordPress also has some very handy helper functions that will be beneficial when we want to target these elements with CSS or JavaScript.  WordPress themes typically allow us to target content via unique classes that each page or post has.  To allow for this we will update the opening `<article>` tag to look like:

```
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-archive' ); ?>>
```

Here `the_ID()` will display the specific ID of each post. `post_class()` creates the `class=` and displays a number of automatically generated classes WordPress creates to target different post types. Because we added our own specific class to the output, we put it inside the function like so: `<?php post_class( 'post-archive' ); ?>`. 

Go ahead and make sure everything is saved and refreash your site. Some default browser styling should now take effect due to the `<p>` tags that `the_content()` function automatically adds to your content. Take a look in the browser inspector to see the IDs and classes that WordPress has added to each article.

##Enqueue stylesheets: our first look at actions
Ok - lets move on to doing a little styling work. First of all, we need to make sure WordPress recognizes that we have a stylesheet and knows where to use it. This will take advantage of the `wp_head()` function we added earlier.

The correct way to include stylesheets in WordPress is to [enqueue](https://codex.wordpress.org/Function_Reference/wp_enqueue_style) them . We do this by adding a function to `functions.php` as seen below:

```
<?php

add_action( 'wp_enqueue_scripts', 'my_cool_theme_scripts' );

// Enqueue styles and scripts
function my_cool_theme_scripts() {
	wp_enqueue_style( 'your-cool-theme-styles', get_stylesheet_uri() );
}

?>
```

Let's break this down so we can see what's actually happening. 

First we see a function called `add_action` - this is a core part of how we work with WordPress, and our first experience hooking onto an action event. We are basically telling WordPress "When the specified action happens, add the stuff from my function here as well."

We send `add_action` two arguments. The first, `wp_enqueue_scripts` is the name of an existing _action hook_ or a place where WordPress expects stuff to happen.  The second argument, `my_cool_theme_scripts` is the _function name_ containing what we are going to do (which we see referenced below).  

To think of this another way, imagine a scenario of deciding to hook a "buy milk" function to the action "at the store":

```
<?php

add_action( 'at_the_store', 'buy_milk' );

function buy_milk() {
	// stuff I need to do to buy milk here
}

?>
```

This is saying "When I am at the store, in addition to what would normally happen here, I would also like to buy milk."

Back to our function, underneath `add_action` you see the `my_cool_theme_scripts` function itself.  Don't let the word `scripts` confuse you here, you can call the function anything you want as long as it's referred to correctly in our `add_action` call. Just remember, it is very helpful if your function names are descriptive. Since stylesheets and JavaScript are often added at the same time, it's common to see them enqueued in the same function.

Ok, so inside our `my_cool_theme_scripts` function you'll see yet another function from WordPress Core called `wp_enqueue_style` which is used by WordPress to add the stylesheets to the header (via `wp_head()`).  This function is also getting two arguments. 

Here the first argument is the _handle_ of our stylesheet. All you need to know right now about this is that it should be *unique* so it is often prefixed (i.e. just add your theme name to the beginning of the handle). The second argument is the actual location of our stylesheet.  WordPress has another helper function `get_stylesheet_uri()` which literally looks for the file `style.css` in the root of your theme - so in this case this is all we need here.

##Side notes on functions.php
This is where I start to be opinionated about _how_ themes should be built. You've noticed that I told you to add this code to `functions.php`, and you will see many other tutorials talk about placing code here. Technically, that is all correct, because all functions placed here will work as expected. However, we are not just writing code that functions correctly, we are trying to write code that is easy to edit, maintain, and update, so we should be thinking about code organization at all times.

For proper code organization `Functions.php` should be a file that only includes WordPress Core functions that _set up_ your theme, such as enqueuing styles and scripts. All other functions, like custom functions or helper functions, should be placed in other files, and referenced here via a `require_once()` call.  Using this approach, your `functions.php` file will remain shorter and easier to navigate, while any files that you will eventaully `require_once()` in `functions.php` will be much easier to navigate and read as well.  

If this is confusing at this point, that is perfectly fine. In our next article, we will be creating a custom query where this principle will be demonstrated. For now, `functions.php` is just fine the way it is.

##Adding styles and structure
Let's revisit our `style.css` and add some styles to give our theme a little bit of structure.

```
/*
Theme Name: My cool theme
Theme URI:
Author:
Author URI:
Description:
Version:
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags:

This theme, like WordPress, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.
*/
```

You can fill the rest of the information out if you like, since it does show up on the `Appearance > Theme` interface, but it is not required for us right now.

If you know a little about CSS, you can include your favorite resets and other structural components in your file now, underneath the WordPress information. Remember, this is not an HTML or CSS tutorial, the examples here are just to show you how the structure works in conjunction with WordPress, so you may have a different way you prefer to markup or style your themes, and that is fine!

At minimum, we want to include something like the following:

```
* {
	box-sizing: border-box;
}

html,
body {
	margin: 0;
	padding: 0;
}

.wrapper {
	max-width: 960px;
	margin: 0 auto;
	padding: 0;
	overflow: auto;
}

.content {
	overflow: auto;
	margin: 20px 0;
}
```

We can also write styles that target the elements we've introduced into our theme. Just for fun, in order to show that our styles are loading properly, add this as well:

```
h2 {
	color: #bada55;
}

.author {
	font-style: italic;
}

article {
	border-bottom: 1px solid #eee;
	margin-bottom: 20px;
}
```

If everything has gone well (and you've saved `style.css` and `functions.php`) when you refresh the frontend of your site you should now see our basic styles taking effect. Look at those attractive green titles! Of course, you can style your text and existing elements however you like.

##Sidebars!
Many WordPress themes include sidebars. These can be used as "widget areas" to output the content found in `Appearance > Widgets` or can be used to output custom content. We'll be learning how to do both.

Let us start by making room for our sidebar.  Depending on the theme, you may want to include the classes for wrapping the content and sidebar in your header and footer. However, if you don't want to include the sidebar on every page, this is not recommended. For now, we will add this logic to `index.php` as this is currently our only page template.

Our first step will be updating `index.php` to include some new markup. Remember to properly open and close your PHP tags!

```
<?php
get_header();
?>

<section class="content-left">

	<?php if ( have_posts() ) {

		// Start the loop.
		while ( have_posts() ) {
			// WordPress core function to set up post data
			the_post();

			// Our template which we use for each post
			get_template_part( 'template-parts/post', 'loop' );
		}
		// End the loop.

	} else {
		// if there is no content in the loop, display your "no content" template here
	} ?>

</section>
<aside class="content-right">
</aside>

<?php
get_footer();
?>
```

You can see that we have created two content areas, a main `<section>` for our post content, and an `<aside>` which will contain our sidebar. Next we need to create a template file for our to-be sidebar. Create a file called `sidebar.php` and place it into the main theme folder. Then update `index.php` to this:

```
<?php
get_header();
?>

<section class="content-left">

	<?php if ( have_posts() ) {

		// Start the loop.
		while ( have_posts() ) {
			// WordPress core function to set up post data
			the_post();

			// Our template which we use for each post
			get_template_part( 'template-parts/post', 'loop' );
		}
		// End the loop.

	} else {
		// if there is no content in the loop, display your "no content" template here
	} ?>

</section>
<aside class="content-right">
	<?php get_sidebar(); ?>
</aside>

<?php
get_footer();
?>
```

The WordPress function `get_sidebar()` automatically looks for sidebar.php in your theme root folder. Feel free to add some random text inside `sidebar.php`, like "This is my sidebar," so we can make sure it is loading correctly. If it is loading you should see your random text showing below the list of our posts. Why is it showing up below? Well, right now all of our block level content (like `<div>` `<article>` `<section>` and `<aside>`) defaults to 100% width. 

In order to get the sidebar to show up to the right hand side of the content, go ahead and add this to `style.css`:

```
.content-left {
	width: 65%;
	float: left;
	margin-right: 5%;
}

.content-right {
	width: 30%;
	float: right;
	padding: 20px;
	border: 1px solid #ddd;
}
```

Feel free to use your favorite CSS method for aligning content if floats are not your thing. We've added a border and some padding to the `.content-right` class so we can distinguish it from our main content. Refresh your page after saving `style.css` and you should see content to the left and a (short) sidebar to the right. This is starting to look like a website!

Once your `sidebar.php` file is loading correctly, we should populate it with some real content. If we want to use this sidebar to display widgets, we need to register the sidebar so WordPress knows it exists. Open `functions.php` again and add the following:

```
if ( ! function_exists( 'my_cool_theme_sidebar' ) ) {

	// Register Sidebars
	function my_cool_theme_sidebar() {

		$args = array(
			'name'          => __( 'My Cool Sidebar', 'my_cool_theme' ),
			'id'			=> 'my-cool-sidebar',
			'class'         => 'sidebar',
			'before_title'  => '<h3 class="sidebar-title">',
			'after_title'   => '</h3>',
			'before_widget' => '<div class="sidebar-widget">',
			'after_widget'  => '</div>',
		);
		register_sidebar( $args );

	}

	add_action( 'widgets_init', 'my_cool_theme_sidebar' );

}
```
Remember, because this is a theme setup function, it is OK to include in `functions.php`. We won't go into too much detail here about what each component is doing, but if you want to learn more about registering sidebars/widget areas, visit [the Codex](http://codex.wordpress.org/Function_Reference/register_sidebar) or [GenerateWP](https://generatewp.com/sidebar/).

Once the sidebar is registered, it will show up in `Appearance > Widgets` and you'll be able to add widgetized content to this area. Go ahead and add a couple of the core widgets to this sidebar now. However, they won't get show up in your theme, because we haven't told our sidebar template to display them yet.

After you've got some sample widgets in place, you can return to `sidebar.php`, delete your sample text, and insert the following:

```
<?php 

if ( is_active_sidebar( 'my-cool-sidebar' ) ) {

	dynamic_sidebar( 'my-cool-sidebar' );

} 

?>
```

The `dynamic_sidebar()` function tells your theme to display all of the widget content contained within the sidebar ID you are referencing. Themes can have multiple widgetized areas which can output content based on various rules, but for now we'll stick to just one. When you refresh, you should see those widgets inside your sidebar.

Though sidebars are often used for widgets, we can also write our own custom functionality for content that is displayed in the sidebar. As an example, let's go back to our list of posts. We want to add another default loop above our dynamic sidebar and output some titles. In your template-parts folder, create a new file called `sidebar-content-custom.php` and update `sidebar.php` with a call to that template part:

```
<?php

get_template_part( 'template-parts/sidebar', 'content-custom' );

if ( is_active_sidebar( 'my-cool-sidebar' ) ) {

	dynamic_sidebar( 'my-cool-sidebar' );

} 

?>
```

Inside `sidebar-content-custom.php` place the following to output your post titles:

```
<?php

// Start the loop.
while ( have_posts() ) {
	// WordPress core function to set up post data
	the_post(); ?>

	<h3 class="sidebar-title sidebar-post-title"><?php the_title(); ?></h3>

<?php }
// End the loop.

?>
```

Now you should see a list of the titles of the same recent posts in the sidebar that you are seeing in your main loop, above the dynamic sidebar content. This is a good place to stop for now.  In our next post we will customize the output further by digging into writing custom WP_Query and learning how to customize what it returns.







