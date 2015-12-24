#Your First Theme

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

Take a break at this point and activate one of these themes