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

### Setting Up the Basic Theme  

#### Metadata  

Go to Appearance, and click on Theme Details.  Then you can read the current theme name, version number, author, and short description of theme.  

The theme details is actually stored in the **style.css** file in your custom _s theme folder.  

#### Typography  

To insert web fonts, go to google fonts and select the fonts you want.  To load these in WP, we need to go into function.php template file and code it in php.  

``` php
/* function.php
find the enqueue scripts and styles section,
since my theme name is anh_popperscores, the function is called */

function anh_popperscores_scripts() {
    // use wp_enqueue_style('custom-name', urllinkfromgoogle) to call the font

    wp_enqueue_style('anh-popperscores-google-fonts', 'https://fonts.googleapis.com/css?family=Fira+Sans:400,400italic,700,700italic|Merriweather:400,400italic,700,700italic');

}

```


