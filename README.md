# WP  Underscore Development Notes  

Notes from WP Building Themes from Scratch Using Underscores by Rand-Hendriksen.  Courser from Lynda.com  

###Installation and Step-by-Step Set-up:  

1. Visit [underscores website](http://underscores.me).  Create theme using the advaned options.  Click on _sassify checkbox for SASS preprocessor option.  Then, click on the generate button.  This will create the theme file.  

2. Place the themefile in your wp-content/theme directory.  
3. Login to the WP Dashboard and select the theme.  
4. Install [Theme Unit Test](https://codex.wordpress.org/Theme_Unit_Test).  
5. Install [Developer Plugin](https://wordpress.org/plugins/developer/).  This is a helpful plugin for plugins and themes custom development.  
6. Activate WP_DEBUG constant in wp-config.php file.  Set option from false to true.  
7. Download Show Current Template plugin.  This will add a new feature in the toolbar that shows what template files are used for every page we are on.  

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

### Chapter 3. Setting Up the Basic Theme  

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

The wp_enqueue function automatically adds the url to the header. 

##### Hosting Your Own Fonts  

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

[semantic_structure](http:i.//imgur.com/sjTyYii.png)  

Specifically in #primary div, we have a <main> with the class site-main that holds the article and navs and comments.  

[semantic_primary_struture](http:i.//imgur.com/S8Unc27.png)  

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
