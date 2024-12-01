# Developer Test #

## Build Tool ##
- Node v21
- Gulp CLI v3

    <link rel="preconnect" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    
    makes negligable difference to score, but is in fact the only improvement you can see with your eyes




 .49 cls

     <img src="./dist/images/image-2.jpg" alt="Space Invader" width="585" height="329">
            <img src="./dist/images/image-3.jpg" alt="Gaming PC"  width="585" height="329">

You manage a website that is an off the shelf CMS that uses PHP and MySQL. You are running
at close to server capacity and occasionally have outages due to limited resources. You have no
control over the actual code implementation so what options do you have to:
1.
    a. Reduce server requirements
    b. If this isn’t possible, what suggestions would you make for ways of increasing capacity in
    a scalable way?


2. In the repository is a simple site called index.php that requires improvements to its (CWV) Core
Web Vitals, such as CLS (content layout shift) and LCP (largest contentful paint). We would like
you to:
    a. Identify the issues. 
        The images are too big for their spaces making the LCP larger than 
        The page jumps when the web font loads 
        The areas for the images have no default size
    b. Implement styles within the project’s stylesheets to improve CWV.
        // in critical.min.css
        body{margin:0}.hero{height:675px;width:1200px;}.images img{height:329px;width:585px;}
        // in the act
        .container .hero{width:100%;height:auto;}
        .images img{height:auto;width:100%;}
    c. Add any missing HTML attributes that may help improve CWV.
        <link rel="preconnect" href="https://fonts.googleapis.com/cs
    d. Implement ways to improve LCP.
       gulp-scale-images
       sharp

3. In the repository is a file called steamapi.php. We would like you to:
    a. implement a basic method of caching API responses to reduce the number of lookups
    to avoid rate limiting. The method of caching is up to you.
    b. implement a some basic defensive coding to gracefully handle instances where the
    API endpoint is either unavailable or under load
    c. sanitise the returned payload before output to protect about any potential risks with
    using third party data
