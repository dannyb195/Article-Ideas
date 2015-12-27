#Your First Theme - Part 3

In part two of this series we end with having made a header.php, footer.php, and template-part/post-loop.php to show our most recent posts on index.php ( our home page ).  In this article will will and some more markup ( html ), get some basic styles in place, and take a look at writing a custom query.

We have also skipped some very important things that WordPress needs to work correctly so let's start with these as they are super simple...

First open up your header.php file and find the the closing `</head>` tag.  Just before this tag we are going to add the fuction `wp_head();` so header.php should now look like:

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

wp_head() is a crucial function as it allows us, plugins, and WordPress Core to add link and scripts to the header itself.  If you've noticed, while we do have a style.css file, it is not actually being used in our html markup - but don't worry we'll be getting to that today.

Similarly to wp_head(), there is also the `wp_footer();` function which I'm sure you hvae already guessed goes in footer.php, which will now look like:

```
			</div><!--end content-->
			<footer>
			</footer>
		</div><!--end wrapper-->
		<?php wp_footer(); ?>
	</body>
</html>
```

wp_footer() basically does the exact same thing as wp_head() as it allows us, plugins, and WordPress core to add scripts ( and in theory styles ) to the footer of our theme.

##Post-loop.php markup
Let us turn our attention back to template-parts/post-loop.php which currently only has `<h2><?php the_title(); ?></h2>` in it.  We'll start by wrapping everything in an `<article>` tag as well as adding two more empty `<divs>` under the `<h2>` title - give the first `<div>` the class of `author` and the second the class of `excerpt`.  The file show now look like:

```
<article>
	<h2><?php the_title(); ?></h2>
	<div class="author"></div>
	<div class="excerpt"></div>
</article>
```

WordPress provides us with a number of functions to help output our data.  The two that we now need are `<?php the_author(); ?>` and `<?php the_excerpt(); ?>`. Place each of these funcitons in side the appropriate div like:

```
<div class="author"><?php the_author(); ?></div>
<div class="excerpt"><?php the_excerpt(); ?></div>
```

It is also time to start following some WordPress conventions.  WordPress themes typically allow us to target content via unique classes that each page or post have.  To allow for this we will update the opening `<article>` tag to look like:

```
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
```

Here `the_ID()` will display the specific ID of each post and `post_class` will display a number of different classes to help target different post types should you want to. Go ahead and make sure everything is saved and refreash your site. Some default browser styling should now take effect due `<p>` tags that are output because of the `the_excerpt();` function that we added.

Ok - lets move on to doing a little styling work in style.css.  If you have not already done so go ahead and clear out any remain information for twentyfifteen, such as:

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

You can fill this information out if you like but it is not required for us right now.

Then Adding...

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
}
```

Will give a basic stucture to work with but of course we haven't even added our style sheet to our header yet - so we'll do that now.

The correct way to include stylesheets in WordPress is to _enqueue_ them (https://codex.wordpress.org/Function_Reference/wp_enqueue_style). We do this in functions.php which will now look like

```
<?php

add_action( 'wp_enqueue_scripts', 'my_cool_theme_scripts' );
function my_cool_theme_scripts() {
	wp_enqueue_style( 'your-cool-theme-styles', get_stylesheet_uri() );
}

?>
```

Let translate this into english so we can see what's actually happening. First we see a function called `add_action` - this is a core part of how we work with WordPress.  Here we are sending it two arguments. The first, `wp_enqueue_scripts` is an _action hook_ - it tells WordPress _when_ to do something.  The second argument, `my_cool_theme_scripts` is the _function name_ of what we are going to do.

Then you'll see the `my_cool_theme_scripts` function itself.  Don't the the word `scripts` confuse you here,  the function can really be call anything as long as it is referred to correctlyin our `add_action` call though since stylesheets and javascript scripts are typically added at the same time you will often find them enqueued in the same function.

Ok, so inside our `my_cool_theme_scripts` function you'll see yet another function from WordPress Core called `wp_enqueue_style` which is also getting two arguments.  Here the first argument the _handle_ of our stylesheet, all you need to know right now about this is that it should be *unique* so it is ofter prefixed with your theme name. The second argument is the actual location of our stylesheet.  WordPress has the function `get_stylesheet_uri()' which literally look for the file `style.css` in the root of your theme - so in this case this is all we need here.

If everything has gone well ( and you've saved style.css and functions.php ) when you refresh the frontend of your site you should now see our basic styles taking effect.





