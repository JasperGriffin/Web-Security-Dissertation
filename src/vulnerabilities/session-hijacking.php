<?php

  require_once "../templates/header.php";

 ?>
 <html>
   <head>
     <link rel="stylesheet" type="text/css" href="/public/assets/css/page_template.css">
     <link rel="stylesheet" type="text/css" href="/public/assets/css/session-hijacking.css">
   </head>
   <body>

     <div class="video-container">
       <video autoplay muted loop class="default-vid">
         <!--https://www.youtube.com/watch?v=CgJudU_jlZ8-->
         <source src="/img/video/session-hijacking.mp4" type="video/mp4">
       </video>
     </div>
     <div class="colour-overlay"></div>
     <div class="subheadings">
       <h1>Broken authentication</h1>
       <div class="anchor-buttons">
         <button class="first-child"><a href="#Introduction">Introduction</a></button>
         <button class="middle-child"><a href="#Risks">Risks</a></button>
         <button class="second-last-child"><a href="#Demonstration">Demonstration</a></button>
         <button class="last-child"><a href="#Solutions">Solutions</a></button>
       </div>
     </div>

     <div class="header-container">
       <h1 id="Introduction">Introduction</h1>
         <div class="p-container">
           <p>Poor session management is an extension of broken authentication and describes the compromise and abuse of session tokens,
             a one-time token that provides a proof of authentication for any user.
             The most common form of which is session hijacking, where an attacker assumes a user’s identity with their session and swipes their credentials.
           </p>
         </div>

       <div class="header-overlay">
         <h1 id="Risks">Risks</h1>
           <div class="p-container">
             <p>Session hijacking can result in the following factors:
               <br /><br /> - Automated attacks of a brower's session id with random string combinations
               <br /><br /> - The eventual compromise of a user's account if a valid identifier is guessed
             </p>
           </div>
       </div>
       <h1 id="Demonstration">Demonstration</h1>
         <div class="p-container">
           <p>If you haven't already, login as a user with your registered account. Press f12 on the keyboard and navigate to the application tab on your browser. Below should be your cookie which in this case a 1 digit number.
             <br /><br />This was even the technique MoonPig used to store session ids as the value is still uniqe for each user. However, this also led to its demise where over 3,000,000 accounts could potentially be compromised.
             <br /><br />This is because whatever number your session identifier is, you can at least assume that the total number of users registered is your session minus 1. To demonstrate this, replace your session id with '1', refresh the page and see
             if you can compromise another user's account.

             </p>
         </div>

         <div class="header-overlay">
           <h1 id="Solutions">Solutions</h1>
             <div class="p-container">
               <p>To prevent sessino hijacking the following solutions include:
                 <br /><br /><b>More complex identifiers</b> - Generating more secure and complex session identifier that are harder to guess from an attacker's perspective
                 <br /><br /><b>More secure session handling</b> - Unsetting and destroying a session id every time a user logs out to minise the pool of guesses an attacker can make.
               </p>
             </div>
         </div>

     </div>
   </body>
 </html>
