#Your First Theme - Part 1

First things first, this post will be about creating a pretty simple WordPress theme.  One assuption that I am going to make is that you have a local environment up and running - this is crutial to anyone that want's to work with code because you ( and I ) will break things :) A second assumption I am making is that you already know how to install themes and plugins, navigate the admin area, work with menus, and make content changes - if this does not describe you take some time to learn these topics and come back when you are comfortable navigating the admin of a theme you dont really know.

Should you not have a local environment take a look at these links to get started setting one up:

- https://developer.wordpress.org/themes/getting-started/setting-up-a-development-environment/
- https://serverpress.com/get-desktopserver/ ( beginners )
- https://www.apachefriends.org/index.html ( intermediate )

Now if you are new to development you've probably spent the better part of your day getting your local enviro up and running, probably swore a lot, and want to go all 'Office Space' on your computer.  This is ok - feel free to take a break and come back to this post later - it's not going anywhere ;)

##Code editors
Now if you ar going to be changing code you're going to need a text/code editor.  If you don't have one currently head over to http://www.sublimetext.com/2 and download Sublime Text - it's free though it will bug you for a donation every 10 saves or so.  Personally I use Sublime Text everyday and love it. You'll also hear of developers using PHPStorm or Coda - both of which have their benefits.

##Why am I not starting with / what is a child themes?
A Child Theme refers to a theme that fallsback to using a Parent Theme's code and layout if the child theme does not override it.  So you could have "Parent Theme A" and "Child Theme B" - In "Child Theme B" you may just alter a stylesheet or a template part and that would be it, all the rest of the code would be loaded from "Parent Theme A".

This can be a little confusing so I like to start with making a stand alone theme when teaching this topic.  Any theme can be a Parent Theme so knowing how any theme works in general is very important.

But let us pause for a moment and look at what we are dealing with so far.  At this point you should have WordPress installed locally so navigate over to that directory / folder now, it should look like:

- wp-admin
- wp-content
- wp-includes
- a bunch of .php files

<screen shot here>

wp-admin, wp-includes, and the .php files here are considered the Core files.  We will not be touching these unless we need to alter or create a wp-config.php file.  Our work will happen in wp-content/themes/ so navigate there now.  Here you should see something like:

- twentyfifteen
- twentyfourteen
- twentythirteen
- index.php

These are the default themes that come with a WordPress install.

Take a break at this point and make sure your local install is working correctly by going to the frontend and poking around.  If the theme is loading at all we should be good to go.

##What a theme needs to come alive
When building a stand alone theme you'll need 3 files to get started.

1. style.css ( your main styles and where your theme is defined )
2. functions.php ( base file for functionality )
3. index.php ( the default page for the frontend )

Let's take a look at twentyfifteen's style.css to give us an idea of what we need. The top ofthe file should look like:

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

Now humor me for a second and activate the twentyfifteen theme if it is not already. Ok, now go back the twentyfifteen/style.css and change `Theme Name: Twenty Fifteen` to `Theme Name: My cool theme`. Save the, file the head back over to appearances > themes, and Hazza! the name displayed here should now be `My cool theme` - this is what I am referring to above when I said `...and where your theme is defined`.

You can take some time to look at functions.php and index.php now if you like but we will be doing things slightly differently as we begin to build.

"Ok, Ok, that's kind of cool" you say, "but I want to build my own theme!"

Fine, let's build your own theme then :)

In wp-content/themes create a new directory / folder, name it something like `my-cool-theme` ( from here out I will refer to your theme directoy as `<your-theme>`, also note the directory should not have spaces in it ), and create the three files that we will need, style.css, functions.php, and index.php.  Once that is done copy and paste the above code, from the twentyfifteen style.css you just changed, and paste it at the top of <your-theme>/style.css - note: make sure to rename `Twenty Fifteen` to what you want your theme to be called.

Now when we goto appearances > themes you should see <your-theme-name> as an option to active.  Go ahead and active your theme - assuming you do not get an error message, if so you probably did not create functions.php or index.php.

Awesome you just activated your theme! let's go look at it by going to frontend.

Annnndddddd White Screen! you scream - "Damnit Dan, what did you do!?!?!"

But don't fret, let's go over to your index.php file simply type "This will work", save the file and refresh your site :) See? nothing is broken, it's just that we have not built anything yet.

For the rest of these posts we will be mostly looking at the backend and some basic structure on the frontend to display data.  We are not going to be worried about styling for the most part as that will be up to you once we have all the data being spit out on the frontend.

##lets get some data to work with
Because we dont like wasting time we are going to use the WordPress Theme Unit Testing Data XML file.  This data is designed to test everything that WordPress comes baked in with which you should account for in your styles.

Head over to https://wpcom-themes.svn.automattic.com/demo/theme-unit-test-data.xml ( yes it is just a white page with some xml text ), select everything on the page, create a new file and paste this data. Save this new file as a .xml ( i.e. wordpress-data.xml ) to your desktop as it is not actually part of our theme.  Once this is done head over to Tools > Import in your local install and select 'WordPress' ( you may be prompted to install the WordPress Importer plugin - if so, please do ).

You should now now be at a page where you can select the xml we just saved an import it, you dont need to do anything with the author options that you will see but DO check the box to upload images.

Now lets go over to Posts and you should see a bunch of new posts that you just imported :) For our sanity find the post titled "Template: Sticky - Sticky" and delete it ( just trust me on this one ).

This is where we'll stop for now.  In my next post we will add a few more template files and start looking at WP_Query to spit out some data on the front end.