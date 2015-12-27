#Your First Theme - Part 3

In part two of this series we end with having made a header.php, footer.php, and template-part/post-loop.php to show our most recent posts on index.php ( our home page ).  In this article will will and some more markup ( html ), get some basic stles in place, and take a look at writing a custom query.

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

Here `the_ID()` will display the specific ID of ach post and `post_class` willa number of different classes to help target different post types should you want to. Go ahead and make sure everything is saved and refreash your site. Some default browser styling should now take effect due `<p>` tags that are output because of the `the_excerpt();` function that we added.

