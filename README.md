# WP  Underscore Development Notes 

Notes from WP Building Themes from Scratch Using Underscores by Rand-Hendriksen.  Courser from Lynda.com  

### Table of Contents  

#### Ch1. Installation 
#### Ch2. Design to Development Process 
#### Ch3. Setting Up the Basic Theme
#### Ch4. Setting Up the Header
#### Ch5. Creating Menus
#### Ch6. The Single Post Template
#### Ch7. Working with Comments
 

## Ch1. Installation and Step-by-Step Set-up:  

1. Visit [underscores website](http://underscores.me).  Create theme using the advaned options.  Click on _sassify checkbox for SASS preprocessor option.  Then, click on the generate button.  This will create the theme file.  

2. Place the themefile in your wp-content/theme directory.  
3. Login to the WP Dashboard and select the theme.  
4. Install [Theme Unit Test](https://codex.wordpress.org/Theme_Unit_Test).  
5. Install [Developer Plugin](https://wordpress.org/plugins/developer/).  This is a helpful plugin for plugins and themes custom development.  
6. Activate WP_DEBUG constant in wp-config.php file.  Set option from false to true.  
7. Download Show Current Template plugin.  This will add a new feature in the toolbar that shows what template files are used for every page we are on.  

## Ch2. Design to Development Process  

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

This modularity allows us to use the same components on the **index.php** page.  
![index page](http://i.imgur.com/3prSXIw.png)  

Using this structure, we can tailor custom experiences for specific type of content:  
![page php](http://i.imgur.com/g7Yr2bE.png)

### WP Template Hierarchy  

[Hierarchy here](https://developer.wordpress.org/files/2014/10/template-hierarchy.png)  

If WP cannot find the template, it will route the request back to the index.php page.  Knowing the template hierarchy allows you to create custom content that kicks in for different scenarios.  

To help identify which template you are working on, use the "Show Current Template" plugin.  This allows you to see what are other templates your current template is calling.  
### _s: An Overview  

Underscores is an advanced theme that follows the latest webdev standards. It uses DRY dev aggressively.  

#### _s consists of the following main templates:   
        index.php - main blog pg  
        single.php - single post  
        page.php - single pages  
        archive.php - for all archives, including categories, tags, and authors  
        search.php - for search result  
        404.php - error page  

#### main page elements:  
        footer.php  
        header.php  
        sidebar.php  
    
[elements of pg](http://i.imgur.com/SuS0Dqf.png)

#### Five Folders:  
        inc/ has extra functions and features 
        js/  holds all the javascript
        languages/  
        layouts/  
        template-parts/  contains all the content loops  

## Chapter 3. Setting Up the Basic Theme  

#### Metadata  

Go to Appearance, and click on Theme Details.  Then you can read the current theme name, version number, author, and short description of theme.  

The theme details is actually stored in the **style.css** file in your custom _s theme folder.  

#### Typography  

##### Web Fonts  
To insert web fonts, go to google fonts and select the fonts you want.  To load these in WP, we need to go into function.php template file and code it in php.  

``` php
/* function.php
find the enqueue scripts and styles section,
since my theme name is anh_popperscores, the function is called */

function anh_popperscores_scripts() {
    // use wp_enqueue_style('custom-name', urllinkfromgoogle) to call the font

    wp_enqueue_style('anh-popperscores-google-fonts', 'https://fonts.googleapis.com/css?family=Fira+Sans:400,400italic,700,700italic|Merriweather:400,400italic,700,700italic');

    wp_enqueue_style ...
    wp_enqueue_script ...
}

```

##. Chapter 4 Setting Up the Header

The wp_enqueue function automatically adds the url to the header. 

#### Hosting Your Own Fonts  

Although you can download the font files on Google fonts, the service won't provide you the CSS that the browser needs to provide the specific font file.  This is because different browser uses different font types.  Google does not generate this CSS for you.  

Using the service [google-webfonts-helper](http://google-webfonts-helper.herokuapp.com/fonts), you can get the eot, ttf, svg, woff and woff2 files + CSS snippets files you need.  

1.  Create a fonts directory in your theme folder.  
2.  Create two subfolders inside the font/ for the two fonts you will host.  
        fonts/fira-sans/ 
        fonts/merriweather/  

3. Create a custom-fonts.css file in the fonts folders. 
4. Go to google-webfonts-helper and find the fonts.  Before downloading, remember to customize the folder prefix from default *fonts/* to *fira-sans/* and *merriweather/* similar to the directory name that you've made in step 2.  
5. Copy-paste the css styles that is generated on the google-webfonts-helper into your custom-fonts.css file.  
6. Place the downloaded files into the respective subdirectory.  For example, all eot tff svg woff and woff2 files belonging to fira-sans/ will be placed into the fira-sans/ folder.  
7. Go to functions.php and add wp_enqueue_style('themename-local-fonts', get_template_uri() . '/pathname/') into the themenamehere_scripts function.  

``` php

function anh_popperscores_scripts() {
    wp_enqueue_style( 'anh-popperscores-style', get_stylesheet_uri() );

    // Add Google Fonts with Third-Party Host (Fira Sans and Merriweather font)
    // wp_enqueue_style('anh-popperscores-google-fonts', 
    //  'https://fonts.googleapis.com/css?family=Fira+Sans:400,400italic,700,700italic|Merriweather:400,400italic,700,700italic');
    
    // Add Google Fonts that is self-hosted locally
    wp_enqueue_style('anh-popperscores-local-fonts', get_template_directory_uri() . '/fonts/custom-fonts.css');
    wp_enqueue_script( 'anh-popperscores-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

    wp_enqueue_script( 'anh-popperscores-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

```
### Responsive Typography 

Looking at overall semantic structure of _s, we have one page container with two content for primary and secondary area.  

![semantic_structure](http://i.imgur.com/sjTyYii.png)  

Specifically in #primary div, we have a <main> with the class site-main that holds the article and navs and comments.  

![semantic_primary_struture](http://i.imgur.com/S8Unc27.png)  

#### Looking at these container layouts, you can make two decisions: 

        1. Set default font size for all contents within the *site-content* container.  
        2. Use the <main> tag with #main to control the typography within the post and pages.  

### Implementation in the stylesheet  

We need to go to the **Typography** section in style.css and change the color and font-sizes.

1. Create .site-content new rule with font-size and line-height.

```

/* style.css */

/*--------------------------------------------------------------
# Typography
--------------------------------------------------------------*/
body,
button,
input,
select,
textarea {
    /* color was #404040 for _s default, change to black */
    color: #000;   
    font-family: 'Merriweather', serif;
    font-size: 16px;
    font-size: 1rem;
    line-height: 1.5;
}

/*create new rule for site-content*/
.site-content {
    font-size: 1.125em;  /*similar to 18px*/
    line-height: 1.6em; 
}

```

2.  Change the line-height for all normal headings throughout sites, and change margin-top and margin-bottom.  

``` css

h1,
h2,
h3,
h4,
h5,
h6 {
    font-family: 'Fira Sans', sans-serif;
    clear: both;
    /*this em will relate to the .site-content 1.125em, or 18 px */
    line-height: 1.3em;
    /*root relative em to relate to top most font size, which is 16px */
    margin-top: 2.5rem;
    margin-bottom: 1rem; 
}

```

3. Add new font-size for each headings.  

``` css

/*ensures each headings are different */
h1 { font-size: 2.4em; }
h2 { font-size: 2.2em; }
h3 { font-size: 2.0em; }
h4 { font-size: 1.8em; }
h5 { font-size: 1.6em; }
h6 { font-size: 1.4em; }
    
```  

4. Go to **Content** section and add new *Global* sub-section.  Add the following style changes.  

``` css
/*--------------------------------------------------------------
## Global 
--------------------------------------------------------------*/
.site-main {
    /*related to the 1.125em in the .site-content container*/
    font-size: 0.8em;
    line-height: 1.6em;
}

/* for wider screens, so when screen gets to a certain width, 
the font size will increase */
@media screen and (min-width: 40em) {
    .site-main { 
        font-size: 1em;
    }
}
```


## Chapter 5. Creating Menus  

### Headers Styling 

Our current header is not distinguishable from the page.  We want it to lok like the mock up.  To change the header, we will be accessing the .site-header class.  To change the contents of the header, we will be accessing the .site-branding class within the site-header container.  

![mockup-desktop](http://i.imgur.com/JKBvxL4.png)
![mockup](http://i.imgur.com/EzmkROk.png)
![current-header](http://i.imgur.com/hfnSwJO.png)


Add a new section for the header stylings in style.css after #Clearings section.  View style.css #Header section to see changes.    


Go to the customize page in WP theme.  We still cannot change the background image yet, because the code needs to be placed in the **header.php** file.  

#### Add Custom Header Feature    

        1. Go to inc/custom-header.php to access the code.  
        2. Paste them in the header.php  

Now you can upload an img through the WP customizer in the Dashboard, but the dimensions are not quite right.  To fix this, go to the yourthemename_custom_header_setup() function in the inc/custom-header.php file to modify.  

``` php
// example from inc/custom-header.php
function anh_popperscores_custom_header_setup() {
    add_theme_support( 'custom-header', apply_filters( 'anh_popperscores_custom_header_args', array(
        'default-image'          => '',
        'default-text-color'     => 'ffffff',
        'width'                  => 1000,
        'height'                 => 250,
        'flex-height'            => true,
        'wp-head-callback'       => 'anh_popperscores_header_style',
    ) ) );
}

```

#### Making header hide behind site title and headline  

To make the header stretch to full size of the header container, we need to use a conditional in header.php file.  

```php
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'anh-popperscores' ); ?></a> 
    <!-- If we have a header image -->
    <?php if( get_header_image()) { ?>
        <!-- Then display the header with background image -->
        <header id="masthead" class="site-header" style="background-image: url(<?php header_image(); ?>)" role="banner">
    <?php  } else } ?>
        <!-- else display the regular banner with default style -->
        <header id="masthead" class="site-header" role="banner">
    <?php } ?>

    <!-- THIS CODE BELOW NEEDS TO BE REMOVED -->
        <!--   <?php if ( get_header_image() ) : ?>
             <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
              <img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
              </a>
          <?php endif; // End header image check. ?> -->
...

```

Currently, the background image in the header is in repeated mode.  With some CSS, we can change this by using **background-size: cover** styling in .site-header class. 

```css
/*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/
.site-header {
    background-color: #000;
    background-size: cover;
}

```

You can also change the width and height of the background image for the site-header here in the 'width' and 'height' option.  

```php
unction anh_popperscores_custom_header_setup() {
    add_theme_support( 'custom-header', apply_filters( 'anh_popperscores_custom_header_args', array(
        'default-image'          => '',
        'default-text-color'     => 'ffffff',
        'width'                  => 1600,
        'height'                 => 420,
        'wp-head-callback'       => 'anh_popperscores_header_style',
    ) ) );
}

```

### Enabling Site Icons in Header  

#### Creating a site button  
The site button will have the following behaviors:  
        1. The button has the first letter of your blog's name. 
        2. The button acts as a home page link.   
        3. The button will be present on posts with no featured, posts with featured img, post with collapsed menu, and desktop-full screen.    
        4. The button is not fixed to the viewpoint.  That means when the reader is scrolling down the screen, the button will disappear.   

#### Site Icons in Place of Header
Let's make it an option for us to hook a site icon into the site header icon.  

Site icon is in the **Customizer > Site Identity > Site Icon**.  We can use it as a site favicon, but also as a site theme with two new functions:  

```php
    // tests if an icon has been uploaded to wp
    has_site_icon(int $blog_id) 

    // grab the url for site icon, notice the largest size is 512
    get_site_icon_url( int $size = 512, string $url = '', int $blog_id)

``` 

### Hide Header in Single Post Page  

Removing the entire header for specific page, such as pages with singular post, is as easy as adding a single class and a single media query.  

```php
//header.php
    <!-- put conditional to hide header for single post page in the .site-heading class-->
    <div class="site-branding<?php if (is_singular() ) {echo ' screen-reader-text'; } ?>">

```  

```css

/* style.css in # Header section, add media query to make sure header fits with site icon*/
@media screen and (min-width: 50em) {
    .site-header {
        min-height: 4em;
    }
}
```

We still need to work on the menu to place it on the bottom, when the header is hidden.  That's the next step.  

## Chapter 5. Creating Menu

The majority of the visitor on your site are mobile users.  It is better to rethink our placement of menus.  John Clark, in his article on [How We Hold Our Gadgets](http://alistapart.com/article/how-we-hold-our-gadgets) talks about this phenonmenon.   

![clark](http://i.imgur.com/qWq2rYK.png)  

To keep the mobile user experience in mind, we will move the menu to the bottom left of the screen.  When the user taps on the menu, the menu items will expand.  

![before-menu](http://i.imgur.com/a/C3fEJ.png)
![after-menu](http://i.imgur.com/HrRyv8a.png) 

The menu sticks on the page, and also has submenus.  The menu button disappears as we scrolls down and reappear as we scroll up.  

#### How Menu Works in _s  
The functions.php template has the register_nav_menus function with a generic menu called *primary*.  We can add a secondary menu in this array.  

```php
// This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'anh-popperscores' ),
    ) );

// Now add a secondary menu
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'anh-popperscores' ),
        'secondary' => esc_html__( 'Secondary', 'anh-popperscores' ),
    ) );

```

Now go to the customizer > Menu > Menu Locations.  Now we see two menus: primary and secondary.  The secondary menu can be selected, but won't do anything.  To get the menu to display need to place it into our theme.  

Registering the 'secondary' menu was for demonstration purposes only.  We are going to select the *primary* menu and place it in the header.php template instead.  

We will recycle the code from WP 2015 Theme in the sidebar.php temmplate and use it in our header.php for _s theme.  The WP 2015 menu has a toggle drop down we can use.  

Notice how the nav tag with the social-navigation id is similar to our own _s theme menu.  The important line we need to copy over in the wp_nav_menu array is **'menu_class'     => 'nav-menu'**.  

```php
twentyfifteen/sidebar.php

if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) || is_active_sidebar( 'sidebar-1' )  ) : ?>
    <div id="secondary" class="secondary">
        <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <?php
                    // Primary navigation menu.
                    wp_nav_menu( array(
                        'menu_class'     => 'nav-menu',
                        'theme_location' => 'primary',
                    ) );
                ?>
            </nav><!-- .main-navigation -->
        <?php endif; ?>
    ...

```

Then go to your underscore theme's header.php template and paste it in at the end of the wp_nav_menu call.  

```php
<!-- wp_nav_meny displays menu, before  -->
<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu') ); ?>

<!-- wp_nav_meny displays menu, after  -->
<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'nav-menu' ) ); ?>

```  

Copy paste the styles related to the menu section from twentyfifteen/style.css and paste it in ##Menu subsection under #Navigation in your own _s theme style.css.  Select all styles related to .main-navigation and .dropdown menu class.  Make changes to the css to create the menu similar to the mockup.  

We still need to add the javascript.  Look at in twentyfifteen/functions.php, we can see that these functions relate to the menu:  

```php
// twentyfifteen/functions.php
wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );

wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
    'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
    'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
) );
```

We can trace the code back to the  **js/functions.js** file in the twentyfifteen directory.  The function we need to copy is the **initMainNavigation**.  Add this to the underscore theme js/navigation.js file.  Make sure to enable jQuery code.  

Go to the functions.php and make sure jQuery is added to the array in functions.php as well.  

```php
// anh_popperscores/functions.php
// add 'jquery' in the array()
wp_enqueue_script( 'anh-popperscores-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );

``` 

Lastly, we need to add the wp_localize_script function from the twentyfifteen theme into to our _s function.php file.  Make sure the handle from both wp_enqueue_script and wp_localize_script are the same.  Notice both are 'anh-popperscores-navigation' as the first params in the two functions.  Also change the screen reader text to say the correct theme.    


```php

function anh_popperscores_scripts() {

    ...

    // BEFORE
    wp_enqueue_script( 'anh-popperscores-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );

    wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
        'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
        'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
    ) );

    // AFTER
    wp_enqueue_script( 'anh-popperscores-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );

    wp_localize_script( 'anh-popperscores-navigation, 'screenReaderText', array(
        'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'anh-popperscores' ) . '</span>',
        'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'anh-popperscores' ) . '</span>',
    ) );
 
    ...
}

```

If we look back at the site, we might think the code doesn't work.  However, the reason has to do with wordpress idiosyncrasy for loading pages.  Remember in our initMainNavigation, the container wants to find any menu item that hs the class  **menu-item-has-children**, but right now the menu item that has children all all *pages*.  The menu item right now is wrapped in a **page_item_has_children**.  We can fix this by simply adding the extra class in our initMainNavigation.  

```php

// js/navigation.js

// BEFORE
function initMainNavigation( container ) {
        // Add dropdown toggle that display child menu items.
        container.find( '.menu-item-has-children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false">' + screenReaderText.expand + '</button>' );

// AFTER
function initMainNavigation( container ) {
        // Add dropdown toggle that display child menu items.
        container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( '<button class="dropdown-toggle" aria-expanded="false">' + screenReaderText.expand + '</button>' );

```

## Chapter 6. The Single Post Template  

We are going to use three posts to test our content in this chapter.  

### Changing the metasection to match the design draft  
Looking at the template-parts/content.php file, we find the popperscores_posed_on() function.  
We can use "grep -rnw /currentdir/ -e "search_pattern_name" to locate which file this function is located.  The search result shows us it is in inc/template-tags.php.  Make the adjustments to the style to match the mock-up.    

### Stretching the Meta Content in Post Page to Full-Width  
This is the formula to use to stretch an inner content full width of the page.  The tricky part is to take different font-sizes into consideration.  

![formula1](http://i.imgur.com/14LYECB.png)
![formula2](http://i.imgur.com/880fRDj.png)

### Adding Gravatar 

Using the [get_the_author_meta](https://developer.wordpress.org/reference/functions/get_the_author_meta/) and [get_avatar](https://developer.wordpress.org/reference/functions/get_avatar/) functions to add the gravatar to our post.  


In the case of of users who has no gravatar, we can use the code from [validate gravatar](https://gist.github.com/justinph/5197810) to fix this issue.  Make sure you add the code to the template-tags.php and add the conditional in the yourthemename_posted_on function in the sample template.   

#### Blockquote  

Blockquotes can be styled using basic css and icons such as the set from [fontawesome](http://fontawesome.io).  Go to your browser and use the developer tool to see the blockquote from a mobile-device screen and add a new rule for blockquotes.  

```css
/* pseudo element to load before the blockquote text
this allows us to use the before quotes icon with \f10d as the unicode */

blockquote::before {
    font-family: 'FontAwesome';
    content: "\f10d";
}
blockquote {
    font-size: 1.5em;
    line-height: 1.4em;
    margin: 1.5em 0 1.5em 2em;
}

```
#### Center Aligned Images and Display as Full-Width Items  

Remember before when we position the meta content to full-width of the page, we have to increase its size using css and use negative margins to position it.  
There was some convoluted math since the font size of the meta section is smaller than the regular font size.  

But for images, the font-size is the same, so the math is much easier.  When users upload different sizes images, it makes it harder to predict the specific media queries to adjust images to full-width.  

To solve this issue, we will instead wrap the image inside a new element, the <figure> element.  Then we can increase the size of the figure element, while the image has already filled in the available space.  Now we can use the same technique to align images properly.  

Go to js/navigation.js  and add some js to wrap the html with the figure element.   

```js
js/navigation.js 
( function( $ ) {
    
    ...

    // wrap centered images in a a new figure element 
    $( 'img.aligncenter').wrap('<figure class="centered-image"></figure>');

)(jQuery);

```

```css
style.css
## Images 

.centered-image {
/*  Notice that the image is inside the div with .entry-content class
    and this div is constrain by our .site-main. The .site-main div is 
    the parent div of .entry-content.  We see the margin for the left and 
    right side of .site-content class as 1.4em.  So 1.4+1.4 = 2.8em. 
    That's how we can find the value to increase the image to the 
    full-width of the page.
*/
    max-width: calc(100% + 2.8em);
    margin: 1.5em -1.4em;
}

/*small screen*/
@media screen and (min-width: 30em) {
    .centered-image {
        max-width: calc(100% + 3.6em);
        margin: 1.5em -1.8em;
    }
}

```

Also **change the js/navigation.js --> js/functions.js  and update the pathname in wp_enqueue_scripts in functions.php.  


#### Post Navigations  

Use [the_post_navigation( array $args = array())](https://developer.wordpress.org/reference/functions/the_post_navigation/) to modify the navigation fo next/previous post.  

Optional args are 'prev_text', 'next_text', 'screen_reader_text'.  

Current post navigations is bare-bone, so modify the single.php template to change the view.  

**Before**  

![beforepostnav](http://i.imgur.com/kv6OSHd.png)

**After**

![afterpostnav](http://i.imgur.com/PqNEOCw.png) 

## Chapter 7. Working with Comments  








 



















