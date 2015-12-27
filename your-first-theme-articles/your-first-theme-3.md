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



