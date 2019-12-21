<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../asset/favicon.ico">
    <title>Privacy </title>
    <link href="asset/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="asset/css/style.css" rel="stylesheet" type="text/css" />
    <link href="asset/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header class="header-container-wrapper">
    <!-- Static navbar -->
    <?php
    include_once("include/header.php");
    ?>
</header>

<!-- /body-container start here -->
<section class="body-container-wrapper">
    <section class="about-section">
        <div class="container">
            <div class="row">
                <h1>The Party Mantra privacy policy</h1>
                <p>Party mantra or its affiliates (company, we, us and our) respect your privacy and security and effectuate the same with the compliance of the privacy policies. The privacy policy describes:</p><p>
                <ul>
                    <li>The type of information that party mantra collects from its users when they access the website, application or use any other services.</li>
                    <li>The practices that we use for the collection of the information, use of information, maintenance o information and protection of the data.</li>
                </ul>

                <p>
                    Users are requested to read the privacy policy and terms carefully. If you do not agree with our policies then do not proceed further with our services.    </p>

                <h1>Information and its use:</h1>
                <p>The privacy policy of the Party Mantra explains how do we collect personal information and the non-personal information, which is categorized as mandatory or voluntary through the users who visit our websites. From the word personal information, we mean the data that can be used to uniquely identify a single person. Personal information will include information regarding the name, address, telephone number, date of birth, gender, email address, etc.</p>
                <p>While using the services of the party mantra, the user may have to provide personal information like for creating the user account and user ID. The user has to provide the information in your account, when you are registering on the website, provide the financial information during the tie of making purchase, uploading the content, participation in any of the online survey or the content that we provide, the information while communicating the party mantra’s customer service through phone, email or otherwise, or while providing the reviews for the content on the website.</p>
                <p>We also get the information about the internet connection and the devices that you are using to access our services through the websites or the applications.</p>
                <h1>Shared personal information</h1>
                <p>A user is required to provide some personal information at the time of making a purchase through the websites or the applications. The payment is completed by an online payment gateway that is operated by a third party. So the information that is shared with us for the payment, is transferred directly to the third party payment gateway operator. The operator of the third party payment gateway could have access to information like online purchase history, details of the purchase that you have made from the website. </p>
                <p>The confidential and sensitive information like the credit card details of the users is transacted upon secure sites of approved payment gateways only, which are digitally encrypted and therefore are applicable of providing the highest possible degree of safety and care as per the present technology. As internet security is not 100% safe and secure, so users should exercise discretion on using them</p>
                <h1>Links to third parties</h1>


                <p>Links to third parties
                    There can be links to the third party and advertisements for the other websites or products and services that could be sent by the party mantra. We do not provide any personal information to these agents and third parties, although we reserve the right to share with you the advertisement mailers on behalf of the other parties.</p>
                <h1>Information from the third parties</h1>

                <p>The party mantra may collect, process and save the user ID which is associated with any social media account like Facebook or Google account that you will use to sign in to the services. When you sign in to our services with any social media account or the email account then you consent to our collection, storage and use as per this privacy policy, of the information that is available to us through the social media interface. </p>

                <h1>Security</h1>
                <p>The Party Mantra aims for providing the security and integrity of your personal information and protects your personal information against any unauthorized access or unauthorized alteration, disclosure or destruction. We are not responsible for any breach of security and personal information or any other actions that are performed by the third parties that receive your personal information.</p>
                <p>The party mantra shall not be legible for any loss, damage or misuse of the personal information.</p>
                <h1>Information retention and account termination</h1>
                <p>You can anytime, close your account by going to the profile setting page on the official website. After you have closed your account, we will remove your public posts or dissociate them from your account profile. But the party manager holds the right to retain the information about you for the purposes authorized under this privacy policy scheme unless it is prohibited by law. The information could be retained to prevent, investigate, or identify possible wrongdoing in connection with the service or to comply with the legal liabilities.</p>
                <h1>Permissible age</h1>
                <p>Our services are not meant for the users under the age of 18 unless permitted under applicable local laws for the permissible age. We do not intentionally collect the information from the user or the market from anyone who is below the permissible age. If we came to know that a person submitting the information is below the permissible age, then we will delete all the related information with the immediate effect.</p>

                <h1>Force Majeure circumstances</h1>

                <p>The user has given consent to that there can be some exceptional circumstances where the service operators may not be able to honor your bookings or requirements due to various factors like the climatic conditions, labor unrest, business exigencies of the government decisions. There can be some technical or another failure in the party manager, services committed earlier may not be thus provided to the user as it was supposed to be or there can be certain modifications.</p>
                <h1>Job applications</h1>
                <p>If your information is collected by us while you are submitting a job in our company then the information will be used to consider your application. This information will be retained for any period of time and this could also be shared with other companies for evaluating the qualifications.</p>
                <p>For any queries related to the processing and the usage of the information provided by you or about the privacy policy that we implement, you may contact us or write to us on our address.</p>

            </div>
        </div>
    </section>


</section>

<!-- /body-container end here -->

<?php include_once("include/footer.php") ?>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="asset/js/jquery.min.js" type="text/javascript"></script>
<script src="asset/js/bootstrap.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });

        $('#back-to-top').tooltip('show');

    });

</script>
</body>
</html>
