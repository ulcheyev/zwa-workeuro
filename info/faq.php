<?php
    session_start();
    include "../components/header.php";
?>
<img class="bannerfaq" src="img/bannerfaq.jpg" alt="Banner for FAQ"/>
<div class="faqtable">
    <div class="faqtd">
        <h1 class="faqnadpis">What is the website intended for?</h1>
        <p class="faqtext">The site is intended for posting vacancies by registered users and for leaving applications for a job of interest to everyone.</p>
    </div>
    <div class="faqtd">
        <h1 class="faqnadpis">How can I register?</h1>
        <p class="faqtext">To register, you must: </p>
        <ol>
            <li>Follow <a href="../registration/registration.php" class="afaq" target="_blank">THIS</a> link or click on the <span class="faqp">"SignUp/LogIn"</span> button in the navigation
                <img src="img/navinfosignup.png" alt="FAQ for reg"/>
            </li>
            <li>In the window that opens, you need to fill out the form following all the instructions, 
                if necessary, they will be displayed under the input field. For successful registration,
                 it is necessary that all fields are green.In the window that opens, you need to fill out the form following all the instructions, if necessary, they will be displayed under the input field. For successful registration, 
                 it is necessary that all fields are green.  Next, click the register button <span class="faqp">"Get Started!"</span>
                <img src="img/registerinfo.png" alt="How to register"/>
            </li>
            <li>After successful registration, you will be automatically transferred to the authorization page. 
                In the window that opens, you need to fill out the form with the data that was specified during registration. 
                After filling out the form, if all fields are green, click the button <span class="faqp">"Initialize!"</span>
                <img src="img/logininfo.png" alt="How to register"/>
            </li>
            <li>After successful authorization, you will be directed to the main page. Now you can use the site!
            </li>
        </ol>
    </div>
    <div class="faqtd">
        <h1 class="faqnadpis">I am an employer and I want to post a vacancy on your website, how can I do this?</h1>
        <p class="faqtext">To place a vacancy, you must: </p>
        <ol>
            <li>Be <a href="../registration/login.php" class="afaq" target="_blank">LOGGED</a> in to the site</li>
            <li>
                Follow <a href="../jobsPublication/jobsPublication.php" class="afaq" target="_blank">THIS</a> link or click on the <span class="faqp">"Post a job"</span> button in the navigation
            </li>
            <li><img src="img/navinfo2.jpg" alt="FAQ Navigation"/></li>
            <li>In the window that opens, you need to fill out the form, following all the instructions. 
            After successfully filling out the form, click on <span class="faqp">"Post a job"</span></li>
            <li><img src="img/postajobinfo.png" alt="How to post a job" height=900 /></li>
            <li>After successful authorization, you will be directed to the main page. You will see it in the list of works.
            </li>
        </ol>
    </div>
    <div class="faqtd">
        <h1 class="faqnadpis">How can I find a job?</h1>
        <p class="faqtext">To get acquainted with the list of proposed works, you must:</p>
        <ol>
            <li>Follow <a href="../index.php#findjob" class="afaq" target="_blank">THIS</a> link or click on the <span class="faqp">"Find a job"</span> button in the navigation</li>
            <li><img src="img/navinfofind.png" alt="FAQ Navigation"/></li>
            <li>In the window that opens, select the vacancy you like and click on it to go to the description of this vacancy.</li>
            <li><img src="img/jobsinfo.png" alt="FAQ find a job"/></li>
            <li>In the window that opens, there will be a description of this vacancy. If you are interested in this vacancy, fill out the form on the right and click <span class="faqp">"Apply!"</span>
                <img src="img/apply.png" alt="How to apply"/>
            </li>
            <li>Wait for the call. We hope that you will pass the interview and get your dream job! Good luck!
            </li>
        </ol>
    </div>
</div>
<?php
    include "../components/footer.php"
?>