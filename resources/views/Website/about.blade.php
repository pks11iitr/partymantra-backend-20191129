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
    <title>The party mantra </title>
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


                <p>The party mantra</p>
                <p>Party Mantra is an exclusively designed and created web and mobile-based platform that renders aid to the customers who are looking for a suitable and perfect party venue for their celebrations.</p>
                <p>With the help of party mantra, you can get the expert suggestions on the selection of the venues for your parties or get-togethers. We value your time and hard-earned money, so our motive is to provide a platform that offers the best results and keeps your pocket happy both at the same time.</p>

                <p>With the strong determination and innovative ideas, we try our best that the users meet the venue requirements as per their choice in minimal time and at the unbeatable prices. The ultimate objective that we hold is to connect the right people with the right kind of venues and thus, bridging the differences and gaps in the delivering values and the customers.</p>

                <p>With our core values, the team at the Party Mantra helps to provide them all kinds of the venues, whether it is trendy, chic, professional or unique as per the party themes that you require.</p>
                <h1>We make sure that the team works on the major principle as follows:</h1>
                <ul>
                    <li>Innovation: Innovation is the backbone for our business values and the team is constantly looking to make a better user experience. We cater to the unique, and state of art services to all users.</li>
                    <li>Transparency and openness:We believe in business that is transparent to the users. This means that there are no hidden prices and all of the team members are endorsed to share their opinions, ideas and for genuine openly. Thus, we can easily build strong relationships and better products and processes.</li>
                    <li>Change: Change is the rule of life and why not to bring that change in partying venues. We believe to create value by driving change in the ways things are done at present.</li>
                    <li>Ownership: Each and every team member at the party mantra is punctual and responsible. So they take up the comprehensive ownership of every task that they take up.</li>
                    <li>Honesty: Honesty is the foundation of our businesses and we have complete faith in doing and communicating the right things in all types of circumstances.</li>


                </ul>
                <h1>
                    How does the party mantra work?</h1>
                <p>Party mantra is a platform that helps the user to find exciting and unique venues for their events and parties. Whatever be the occasion, one can make the event more memorable by the venue. Without a doubt, a perfect venue adds to the beauty and joy of the event. The event venues are the first and foremost priority.
                </P>
                <p>
                    Party mantra establishes a good working relationship with the local venues, vendors and catering management at those venues. The party mantra has an enthusiastic team that builds strong relationships and connections, which turns to be fruitful in delivering excellent events easily.		</p>
                <h1>
                    What party mantra provides?		</h1>

                <P>
                    The party mantra helps in organizing the corporate parties, the family gets together,  kitty parties and the personal parties on a monthly basis. Thus, we collaborate efficiently and smoothly with consumers. We ensure that you get the place for your events.		</P>

                <h1>
                    Our vision		</h1>

                <p>The party mantra has got immense success due to the strong vision that it holds. We respect the customer and treat them with dignity. The clients' imagination and their wishes are completely understood and help us to deliver them memorable experiences. The customer's support and trust has helped us to make strong customer relations. The positive feedback motivates us to push ourselves out of the boundaries and deliver better experiences to our consumers.</p>

                <h1>Perks of the collaboration</h1>
                <p>You can easily collaborate with the party mantra and enjoy the various benefits and perks. With us, you can get your brand promoted on the huge and large social media that we provide. We will provide you with a business that does not need any investments to be done. Synchronize with us and get your outlets promoted. Also, get an increased number of audiences and their appraisals. We do not make hefty charges with our business partners. Just 10% on each transaction of the customer that reaches you with us!</p>
                <h1>Meet the authorities</h1>
                <p>The party mantra is the service provided by the Makkarz Hospitality Pvt. Ltd. The company has been founded by Mr. Prabhjot Singh, who has extensive experience of more than 12 years in the hospitality industry. As a graduate in hospitality, he has managed well with the firm determination to build his own empire.</p>
                <p>The various services that the company offers to the customers include offline and online digital marketing, more visibility to the vendors and getting more business to them</p>

                <p>The team:</p>
                <ul>
                    <li>Reeta: Content Writer</li>
                    <li>Aditi: PR manager</li>
                    <li>Aditye: PR manager</li>

                </ul>

                <h1>Why choose party mantra?</h1>
                <p>If you are planning to throw a party or looking for a family get together then, the venue is the first and foremost requirement to make the party memorable. It is the venue of the party that turns it into a magnificent event. But where to get the unique and best party venues for your events? The party mantra is the right place. With the collaborations that we have, we provide you the various types of venues that would be just perfect for turning your event into an amazing one. Get the perfect party venues with at the prices that befriend your pockets.
                </p>



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
