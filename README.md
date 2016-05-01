# WP  Underscore Development Notes  

Notes from WP Building Themes from Scratch Using Underscores by Rand-Hendriksen.  Courser from Lynda.com  

###Installation and Step-by-Step Set-up:  

1. Visit [underscores website](http://underscores.me).  Create theme using the advaned options.  Click on _sassify checkbox for SASS preprocessor option.  Then, click on the generate button.  This will create the theme file.  

2. Place the themefile in your wp-content/theme directory.  
3. Login to the WP Dashboard and select the theme.  
4. Install [Theme Unit Test](https://codex.wordpress.org/Theme_Unit_Test).  
5. Install [Developer Plugin](https://wordpress.org/plugins/developer/).  This is a helpful plugin for plugins and themes custom development.  
6. Activate WP_DEBUG constant in wp-config.php file.  Set option from false to true.  

###Design to Development Process  

Web design and dev are going through drastic changes due to proliferation of mobile devices.  The old method of designing webpages in Photoshop and trying to create pixel perfect version in HTML CSS is no longer valid.  

#### The current trend is modular, mobile-first design.  That means three things:  
    1. Design Modules that make a full view  
    2. Design and build for small screens first, then scale up the screen for other larger sizes.  
    3.  Make design decisions in the browser.  

#### Responsive Web Deign Three Simple Steps  

    1. start with the smallest screen  
    2. make viewport wider  
    3. when a component looks strange, add a breakpoint with media queries  

### Structure of _s Themes    
WP uses a distributive templating principle.  

```
When the user enters http://mysite.com/test-drive,  
that url is actually a rewrite of a db reference.  

http://mysite.com/test-drive  --> htpp://mysite.com/?p=2726  

```
When the /test-drive page is requested, the db server finds the post by its ID, which is 2726, and returns it to the WP file server:  
![db server](http://i.imgur.com/gcu5cGy.png)  

Then, now go and grabs the correct template, which is the **single.php** file.  Then single.php, in turn, has refences to the other php templates.  

![single template](http://i.imgur.com/fYOpaTW.png)

