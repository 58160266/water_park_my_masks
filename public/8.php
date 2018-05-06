<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Marks</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://angsila.cs.buu.ac.th/~58160266/ProWebser/api_get_datafb.js"></script>
  <script>
  $(document).ready(function(){
      $.get("https://angsila.cs.buu.ac.th/~58160266/reatful/public/index.php/api/v1/waterparks/8", function(data, status){
              //alert("Data: " + data.result["0"].wp_detail + "\nStatus: " + status);
          console.log(data);
          //console.log(.result.wp_pic);
          $('#pic').html("<img src='"+data.result.wp_pic+"' />");
          $('#name').html(data.result.wp_name);
          $('#detail').html(data.result.wp_detail);
          $('#contract').html(data.result.wp_contract);
      });
  });
  </script>

    <div id="fb-root"></div> <!-- fb page sdk javascript -->
      <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v3.0&appId=1724935924262941&autoLogAppEvents=1';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>

  <style>
  .modal {
    padding-top: 200px; /* Location of the box */
  }
  body {
      font: 400 15px Lato, sans-serif;
      line-height: 1.8;
      color: #818181;
  }
  h2 {
      font-size: 24px;
      text-transform: uppercase;
      color: #303030;
      font-weight: 600;
      margin-bottom: 30px;
  }
  h4 {
      font-size: 19px;
      line-height: 1.375em;
      color: #303030;
      font-weight: 400;
      margin-bottom: 30px;
  }
  .jumbotron {
      background-color: #20B2AA;
      color: #fff;
      padding: 50px 25px;
      font-family: Montserrat, sans-serif;
  }
  .container-fluid {
      padding: 60px 50px;
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  .logo-small {
      color: #f4511e;
      font-size: 50px;
  }
  .logo {
      color: #f4511e;
      font-size: 200px;
  }
  .thumbnail {
      padding: 0 0 15px 0;
      border: none;
      border-radius: 0;
  }
  .thumbnail img {
      width: 100%;
      height: 100%;
      margin-bottom: 10px;
  }
  .carousel-control.right, .carousel-control.left {
      background-image: none;
      color: #f4511e;
  }
  .carousel-indicators li {
      border-color: #f4511e;
  }
  .carousel-indicators li.active {
      background-color: #f4511e;
  }
  .item h4 {
      font-size: 19px;
      line-height: 1.375em;
      font-weight: 400;
      font-style: italic;
      margin: 70px 0;
  }
  .item span {
      font-style: normal;
  }
  .panel {
      border: 1px solid #f4511e;
      border-radius:0 !important;
      transition: box-shadow 0.5s;
  }
  .panel:hover {
      box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
      border: 1px solid #f4511e;
      background-color: #fff !important;
      color: #f4511e;
  }
  .panel-heading {
      color: #fff !important;
      background-color: #f4511e !important;
      padding: 25px;
      border-bottom: 1px solid transparent;
      border-top-left-radius: 0px;
      border-top-right-radius: 0px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
  }
  .panel-footer {
      background-color: white !important;
  }
  .panel-footer h3 {
      font-size: 32px;
  }
  .panel-footer h4 {
      color: #aaa;
      font-size: 14px;
  }
  .panel-footer .btn {
      margin: 15px 0;
      background-color: #f4511e;
      color: #fff;
  }
  .navbar {
      margin-bottom: 0;
      background-color: #20B2AA;
      z-index: 9999;
      border: 0;
      font-size: 12px !important;
      line-height: 1.42857143 !important;
      letter-spacing: 4px;
      border-radius: 0;
      font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #f4511e !important;
      background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #fff !important;
  }
  footer .glyphicon {
      font-size: 20px;
      margin-bottom: 20px;
      color: #f4511e;
  }
  .slideanim {visibility:hidden;}
  .slide {
      animation-name: slide;
      -webkit-animation-name: slide;
      animation-duration: 1s;
      -webkit-animation-duration: 1s;
      visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    }
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    }
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
        width: 100%;
        margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
        font-size: 150px;
    }
  }
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
     </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-left">
            <li ><a href="Home.php" ><b>Home</b></a></li>
            <li class="active"><a href="Marks.php"><b>Marks</b></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" onclick="logout();" ><b>Logout</b></a></li>
          </ul>
        </div>
      </div>
    </nav>

<div class="jumbotron text-center">
  <h1>Water Park My Marks</h1>
  <form>

  </form>
</div>



<div class="w3-container w3-content" style="max-width:2500px;margin-top:30px">    <!-- Page Container -->

  <div class="w3-row">  <!-- The Grid -->

    <div class="w3-col m3">  <!-- Left Column -->

      <div class="w3-card w3-round w3-white"> <!-- Profile -->
        <div class="w3-container">
          <h4 class="w3-center" id='user_name'>User</h4>
          <h4 class="w3-center" id='user_email' hidden></h4>
          <p class="w3-center" id='user_pic'><img src="img/U.jpg" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <div class="list-group">
         <a href="1.php" class="list-group-item "> 1. Vana Nava Hua Hin</a>
         <a href="2.php" class="list-group-item"> 2. Santorini Water Fantasy</a>
         <a href="3.php" class="list-group-item"> 3. Splash Jungle Water Park</a>
         <a href="4.php" class="list-group-item"> 4. Tube Trek Water Park </a>
         <a href="5.php" class="list-group-item"> 5. Navaland Chiangrai Water Park</a>
         <a href="6.php" class="list-group-item"> 6. Grand Canyon Water Park</a>
         <a href="7.php" class="list-group-item"> 7. Scenical World</a>
         <a href="8.php" class="list-group-item active"> 8. Dino Water Park Khon Kaen</a>
         <a href="9.php" class="list-group-item"> 9. Usotel Water Park</a>
         <a href="10.php" class="list-group-item"> 10.  Siam Park City</a>
         <a href="11.php" class="list-group-item"> 11.  Pororo Aquapark BKK </a>
         <a href="12.php" class="list-group-item"> 12.  Ramayana Water Park</a>
        </div>
        </div>
      </div><!-- End Profile -->
    </div><!-- End Left Column -->

    <div class="w3-col m7" style="margin-top:-15px" ><!-- Middle Column -->
      <div class="w3-container w3-card w3-white w3-round w3-margin" align="center"><br>
        <p id='pic'></p>
        <p id='name'></p>
        <p id='detail'></p>
        <p id='contract'></p>
        
          <!-- popup -->
       <div id='missionClick_btn_2'>
          <!-- Trigger the modal with a button -->
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Check Mark</button>
          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">ทำเครื่องหมายว่าไปมาแล้ว</h4>
                </div>
                <div class="modal-body">
                  <p>กรุณายืนยันว่าคุณได้ไปที่ Dino Water Park Khon Kaen มาแล้ว </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" onclick="getMission(2);"data-dismiss="modal">ตกลง</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                </div>
              </div>

            </div>
          </div>
          </div>
          <br><br>
        <!-- popup -->

         <br>
      </div>


    </div><!-- End Middle Column -->


    <div class="w3-col m2"> <!-- Right Column -->
      <div class="w3-card w3-round w3-white w3-center">
          <!-- fb page sdk -->
          <div class="fb-page" data-href="https://www.facebook.com/dinowaterparkkhonkaen" data-tabs="timeline" data-height="805" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/dinowaterparkkhonkaen" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/dinowaterparkkhonkaen">Dino Water Park</a></blockquote></div>
         <!--End fb page sdk -->
      </div>
    </div> <!-- End Right Column -->



  </div><!-- End Grid -->
</div><!-- End Page Container -->





<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Water Park My Marks</p>
</footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });

  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

</body>
</html>
