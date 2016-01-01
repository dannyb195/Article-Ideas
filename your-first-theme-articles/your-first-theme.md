#Your First Theme - Part 1

>This series will teach you what you need to know to build a simple WordPress theme.  We'll be starting with the basics of local development and WordPress theme structure, and moving into learning how WordPress outputs and processes information, before finally learning how to combine that with HTML/CSS to produce a final theme. We will not go over every single use case, but my hope is that you will learn enough from this series to be able to do your own research, ask the right questions, and read/understand other people's code as well.

>One assumption I am going to make is that you already know how to install themes and plugins, navigate the admin area, work with menus, and make content changes - if this does not describe you, take some time to learn these topics and come back when you are comfortable navigating the admin of WordPress, and familiar with how themes/plugins interact with it.

>Another assumption is that you are already familiar on some level with HTML/CSS. Though markup and styling are important to the visual presentation and organization of themes, as well as other considerations like semantics and accessibility, we will not be covering those topics in-depth here. There are many resources available for getting yourself familiar with these things, and if you are not, I suggest doing so before reading the later articles in this series.

##Local development
Before we get started, you need to have a local environment up and running - this is crucial to anyone that wants to work with code because you (and I) will break things, and it's a lot easier to deal with/fix that on your own computer :)

Should you not have a local environment, take a look at these links to get started setting one up:

- https://developer.wordpress.org/themes/getting-started/setting-up-a-development-environment/
- https://serverpress.com/get-desktopserver/ (beginners)
- https://www.apachefriends.org/index.html (intermediate)

Now, if you are new to development, you've probably spent the better part of your day getting your local environment up and running, probably swore a lot, and want to go all 'Office Space' on your computer.  This is ok - feel free to take a break and come back to this post later - it's not going anywhere. ;)

##Code editors
If you are going to be writing code, you're going to need a **text/code editor**.  If you don't have one currently, head over to http://www.sublimetext.com/2 and download Sublime Text - it's free (though it will bug you for a donation every 10 saves or so).  Personally, I use Sublime Text everyday and love it. You'll also hear of developers using PHPStorm or Coda - both of which have their benefits. We don't need to discuss the merits of text editors vs IDEs right now - a feature-rich text editor like Sublime Text will be more than enough for what we are doing during this series.

##Why am I not starting with a child theme?
A **Child Theme** refers to a theme that is dependent on a Parent Theme for operation, it cannot exist on its own. The advantage is that it lets you modify the Parent Theme without altering it, so if the Parent Theme updates, you will not lose your changes.

Child themes work by containing template and style files that override the equivalent files in the Parent Theme, or extend the Parent Theme with new files.  They fall back to using a Parent Theme's code and layout for templates/styles not defined in the Child Theme.  This could be as simple as just adding a few new items to a stylesheet to override a Parent Theme's CSS, or it could be complex with dozens of new templates, scripts, functions, etc. 

Child themes can be a great way to learn about how to modify theme files, and many people start this way.  However, I'd like to give you an understanding of exactly what goes into a theme and why, and that's easiest to do when we start with a blank slate and build up from there.  This knowledge will help you build Child Themes as well as Parent/Standard themes in the future.

##Looking at WordPress
But let us pause for a moment and look at what we are dealing with so far.  At this point you should have WordPress installed locally, so navigate over to that directory/folder now on your computer, it should look like:

```
- wp-admin
- wp-content
- wp-includes
- a bunch of .php files
```

<screen shot here>

`wp-admin`, `wp-includes`, and the `.php files` here are considered the **Core** files.  We will almost never be touching these (that would be considered modifying/"hacking" core) unless we need to alter or create a `wp-config.php` file.  Our work will happen in `wp-content/themes`, so navigate there now.  Here you should see something like:

```
- twentyfifteen
- twentyfourteen
- twentythirteen
- index.php
```

These folders are the **default themes** that come with a WordPress install.

Take a break at this point and make sure your local install is working correctly by opening your browser and going to the **frontend** (meaning how the website looks in your broswer, on whichever URL is specified by your local development environment) and poking around.  If the theme is loading at all, we should be good to go.

##What a theme needs to come alive
A theme needs **2 base files** to be considered operational.

1. `style.css` (your main styles and where your theme is defined)
2. `index.php` (the default template for displaying content on the frontend)

Many themes also have `functions.php` (default file for adding functionality), but it is not necessary for a theme to exist. However, we will be including one in our theme.

Let's take a look at twentyfifteen's `style.css`. Open it up in your text editor. The top of the file should look like:

```
/*
Theme Name: Twenty Fifteen
Theme URI: https://wordpress.org/themes/twentyfifteen/
Author: the WordPress team
Author URI: https://wordpress.org/
Description: Our 2015 default theme is clean, blog-focused, and designed for clarity. Twenty Fifteen's simple, straightforward typography is readable on a wide variety of screen sizes, and suitable for multiple languages. We designed it using a mobile-first approach, meaning your content takes center-stage, regardless of whether your visitors arrive by smartphone, tablet, laptop, or desktop computer.
Version: 1.3
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: black, blue, gray, pink, purple, white, yellow, dark, light, two-columns, left-sidebar, fixed-layout, responsive-layout, accessibility-ready, custom-background, custom-colors, custom-header, custom-menu, editor-style, featured-images, microformats, post-formats, rtl-language-support, sticky-post, threaded-comments, translation-ready
Text Domain: twentyfifteen

This theme, like WordPress, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.
*/
```

Now humor me for a second and activate the Twenty Fifteen theme if it is not already. Ok, now take that `style.css` file (which you have open) and change `Theme Name: Twenty Fifteen` to `Theme Name: My Cool Theme`. (No, it's not generally a good idea to directly edit other people's themes, this is just for demonstration purposes). Save the file, then head back over to `Appearances > Themes`, and Huzzah! the name displayed here should now be `My Cool Theme`. This is what I am referring to above when I said "Where your theme is defined". WordPress requires that a `style.css` exist in the root which has this special header area, and tells WordPress "This is a theme."

"Ok, Ok, that's kind of cool" you say, "but I want to build my own theme!"

Fine, let's get started. :)

In `wp-content/themes` create a new directory/folder, name it whatever you like, maybe `my-cool-theme` (from here out I will refer to your theme directoy as `<your-theme>` Note the directory should not have any spaces in it).  Create the three files that we will be using: `style.css`, `functions.php`, and `index.php`.  Once that is done, copy the header code from the Twenty Fifteen `style.css` (that we just looked at), and paste it at the top of `<your-theme>/style.css` - note: make sure to rename `Twenty Fifteen` to what you want your theme to be called.

Now when we go to `Appearances > Themes` you should see `<your-theme-name>` as an option to activate.  Go ahead and activate your theme! (If you get an error message, check to make sure you created index.php and functions.php and that neither of them have any spaces or extra content)

Awesome, you just activated your theme! Let's go look at it by going to the frontend.

Annnndddddd White Screen! you scream - "Damnit Dan, what did you do!?!?!"

Don't fret, nothing is broken. We may have a theme, but it's not doing anything yet. Let's go over to your index.php file and simply type "This will work", save the file and refresh your site :) You should see the words you just typed, everything is working just fine!

For the rest of these posts, we will be mostly looking at the **backend** (the directories and theme files where your theme code lives) and setting up some basic structure on the frontend to display data.  We are not going to be worried about styling for the most part, as that will be up to you once your theme is outputting the data you want.

##Let's get some data to work with
Because we don't like wasting time, we are going to use the **WordPress Theme Unit Testing Data** XML file.  This data is designed to test every capability and content type that comes baked in to WordPress, which is a good idea to account for in your theme.

Head over to http://wptest.io. and select "Download" to get your copy (you can also see the demo if you want a preview of what we are about to install). Once this is done, head over to `Tools > Import` in your local install and select "WordPress" (you may be prompted to install the WordPress Importer plugin - if so, please do).

You should now now be at a page where you can select the xml we just saved and import it. You can leave all the author options set as their defaults, but DO check the box to upload images.

Now lets go over to Posts and you should see a bunch of new posts that you just imported :) *Note: For our sanity, find the post titled "Template: Sticky - Sticky" and set it to draft or put it in the trash for now (sticky posts have their own special rules when dealing with queries and it will get confusing when you are first learning - just trust me on this one).*

This is where we'll stop for now.  In my next post we will add a few more template files and start looking at `WP_Query` to spit out some data on the front end.