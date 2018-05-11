//var mission = new Array(12);

  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    //console.log('statusChangeCallback');
    if (response.status === 'connected') {
      //window.location ='https://angsila.cs.buu.ac.th/~58160266/ProWebser/Home.php';
      get_data_API();
      getArray_misson();
    } else {
      window.location ='https://angsila.cs.buu.ac.th/~58160266/ProWebser/index.php';

    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '234877417086475',
      cookie     : true,  // enable cookies to allow the server to access
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  function get_data_API() {
    //console.log('Welcome!  Fetching your information.... ');
    FB.api('/me','GET',{"fields":"name,picture.width(150).height(150),email"},function(response) {
      console.log(response);
      document.getElementById('user_name').innerHTML = response.name ;
      //document.getElementById('user_email').innerHTML = response.email ;
      document.getElementById('user_pic').innerHTML = '<img src="'+response.picture.data.url+'" class="w3-circle" style="height:106px;width:106px" alt="Avatar">' ;
      get_rank(response.email);
      }
    );
  }

  function logout() {
      FB.getLoginStatus(function(response) {
      if (response && response.status === 'connected') {
          FB.logout(function(response) {
              document.location.reload();
          });
      }
  });
}

function get_addmember(email) {

  $.post("https://angsila.cs.buu.ac.th/~58160266/reatful/public/index.php/api/v1/members",
        {
          email: email
        },
        function(data,status){
            //console.log(data);
            mission = [data.result.mb_wp1,
                      data.result.mb_wp2,
                      data.result.mb_wp3,
                      data.result.mb_wp4,
                      data.result.mb_wp5,
                      data.result.mb_wp6,
                      data.result.mb_wp7,
                      data.result.mb_wp8,
                      data.result.mb_wp9,
                      data.result.mb_wp10,
                      data.result.mb_wp11,
                      data.result.mb_wp12];
            document.getElementById('mission').innerHTML = mission;
            initMap();
        });
}

function getArray_misson(){
  FB.api('/me','GET',{"fields":"email"},function(response) {
    get_addmember(response.email);

    }
  );
}

function get_rank(email){
  $.get("https://angsila.cs.buu.ac.th/~58160266/reatful/public/index.php/api/v1/missionscount/"+email, function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
        //console.log(data.result["0"].count);
        var rank = data.result["0"].count;
        show_cup(rank);
        show_car(rank);
        show_message(rank);
    });
}

  function show_car(rank){
      if(rank==0)
          document.getElementById('car').innerHTML = '<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/car1.png" width="100%">';
      else if(rank==1)
          document.getElementById('car').innerHTML = '<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/car2.png" width="100%">';
      else if(rank==2)
          document.getElementById('car').innerHTML = '<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/car3.png" width="100%">';
      else if(rank==3)
          document.getElementById('car').innerHTML = '<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/car4.png" width="100%">';
      else if(rank==4)
          document.getElementById('car').innerHTML = '<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/car5.png" width="100%">';
      else if(rank==5)
          document.getElementById('car').innerHTML = '<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/car6.png" width="100%">';
      else if(rank==6)
          document.getElementById('car').innerHTML = '<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/car7.png" width="100%">';
      else if(rank==7)
          document.getElementById('car').innerHTML = '<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/car8.png" width="100%">';
      else if(rank==8)
          document.getElementById('car').innerHTML = '<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/car9.png" width="100%">';
      else if(rank==9)
          document.getElementById('car').innerHTML = '<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/car10.png" width="100%">';
      else if(rank==10)
          document.getElementById('car').innerHTML = '<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/car11.png" width="100%">';
      else if(rank==11)
          document.getElementById('car').innerHTML = '<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/car12.png" width="100%">';
      else if(rank==12)
          document.getElementById('car').innerHTML = '<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/car13.png" width="100%">';
  }

  function show_cup(rank){
    if(rank==0)
      document.getElementById('cup').innerHTML='<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/cup1.png" width="100%"></a>';
    else if(rank>=12)
      document.getElementById('cup').innerHTML='<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/cup5.png" width="100%"></a>';
    else if (rank>=9)
      document.getElementById('cup').innerHTML='<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/cup4.png" width="100%"></a>';
    else if (rank>=6)
      document.getElementById('cup').innerHTML='<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/cup3.png" width="100%"></a>';
    else if (rank>=3)
      document.getElementById('cup').innerHTML='<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/cup2.png" width="100%"></a>';
  }

  function show_message(rank){
    if(rank!=0)
      document.getElementById('rankmessage').innerHTML='<img src="http://angsila.cs.buu.ac.th/~58160186/887373/img/icon1.png" width="30" height="30"> PASS  '+rank+'  Mission!</a>'
  }






  function initMap() {

  var myOptions = {
    zoom: 5,
    center: new google.maps.LatLng(15.000682,103.728207),
    //mapTypeId: google.maps.MapTypeId.SATELLITE
  };

/* */
  var map = new google.maps.Map(document.getElementById('map_canvas'),myOptions);

  var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
  var image = 'http://deknerd.informatics.buu.ac.th/887350/58160259/pc/swimming%20(4).png';

  ////---------------------------------------------------------ภาคใต้//---------------------------------------------------------
  //สวนน้ำวานานาวาหัวหินวอเตอร์จังเกิ้ล
  var marker4 = new google.maps.Marker({
     position : {lat:12.532460,lng:99.962088},
          map: map,
          icon: image
        });
    var contentString4 = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">สวนน้ำวานานาวาหัวหินวอเตอร์จังเกิ้ล</h1>'+
      '<div id="bodyContent">'+
    '<p><img src="http://www.twentyfour-news.com/wp-content/uploads/2018/03/IMG_20180308_203125.jpg" width="400" height="200"></p>' +
      '<p>ที่อยู่: 129/99 ถนน เพชรเกษม ตำบล หนองแก อำเภอ หัวหิน ประจวบคีรีขันธ์ 77110</p>'+
    '<p>ชั่วโมง: เปิด ⋅ ปิด 18:00 </p>'+
    '<p>เวลาทำการอาจมีการเปลี่ยนแปลงใน วันฉัตรมงคล (วันหยุดชดเชย)</p>'+
      '<p>โทรศัพท์: 032 909 606 </p>'+
    '<p>Website :<a href="https://www.vananavahuahin.com/">'+
      'https://www.vananavahuahin.com/</a> '+
      '</div>'+
      '</div>';



    google.maps.event.addListener(marker4,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:contentString4
    });
  infowindow.open(map,marker4);
  });


//ซานโตรินี วอเตอร์ แฟนตาซี
  var marker5 = new google.maps.Marker({
     position : {lat:12.831838,lng:99.930877},
          map: map ,
          icon: image
        });
    var contentString5 = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">ซานโตรินี วอเตอร์ แฟนตาซี</h1>'+
      '<div id="bodyContent">'+
    '<p><img src="https://sites.google.com/site/pk5510101226/_/rsrc/1409159192079/topten/santorine/san1.jpg" width="400" height="200"></p>' +
      '<p>ที่อยู่: 555 ม .3 ถ เพชรเกษม ตำบล เขาใหญ่ ต เขา ใหญ่ อ ชะอำ เพชรบุรี 76120</p>'+
    '<p>ชั่วโมง: เปิด ⋅ ปิด 18:30 </p>'+
    '<p>เวลาทำการอาจมีการเปลี่ยนแปลงใน วันฉัตรมงคล (วันหยุดชดเชย)</p>'+
      '<p>โทรศัพท์: 032 890 400 </p>'+
    '<p>Website :<a href="http://www.santoriniparkwaterventures.com/index.php">'+
      'http://www.santoriniparkwaterventures.com/index.php</a> '+
      '</div>'+
      '</div>';
    google.maps.event.addListener(marker5,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:contentString5
    });
  infowindow.open(map,marker5);
  });

//Splash Jungle Water Park
  var marker6 = new google.maps.Marker({
     position : {lat:8.116770,lng:98.306255},
          map: map ,
          icon: image
        });
    var contentString6 = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">Splash Jungle Water Park</h1>'+
      '<div id="bodyContent">'+
    '<p><img src="https://i.ytimg.com/vi/pF_jJEquDrM/maxresdefault.jpg" width="350" height="200"></p>' +
      '<p>ที่อยู่: 65 ซอย ไม้ขาว 4 ตำบล ไม้ขาว อำเภอ ถลาง ภูเก็ต 83110 </p>'+
    '<p>ชั่วโมง: เปิด ⋅ ปิด 17:45 </p>'+
    '<p>เวลาทำการอาจมีการเปลี่ยนแปลงใน วันฉัตรมงคล (วันหยุดชดเชย)</p>'+
      '<p>โทรศัพท์: 076 372 111 </p>'+
    '<p>Website :<a href="http://splashjungle.com/">'+
      'http://splashjungle.com/</a> '+
      '</div>'+
      '</div>';

    google.maps.event.addListener(marker6,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:contentString6
    });
  infowindow.open(map,marker6);
  });
//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------




//---------------------------------------------------------ภาคเหนือ-------------------------------------------------------------------------------------------------------
  //Tube Trek Water park
  var marker1 = new google.maps.Marker({
     position : {lat:18.764837,lng:99.097005},
          map: map ,
          icon: image
        });
    var contentString1 = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">Tube Trek Water park</h1>'+
      '<div id="bodyContent">'+
    '<p><img src="https://tubetrekwaterparkchiangmai.com/assets/images/Pic%202.jpg" width="350" height="200"></p>' +
      '<p>ที่อยู่:ถนนบ่อสร้าง ซอย 10 ตำบล ต้นเปา อำเภอ สันกำแพง เชียงใหม่ 50130</p>'+
    '<p>ชั่วโมง: เปิด ⋅ ปิด 19:00 </p>'+
    '<p>เวลาทำการอาจมีการเปลี่ยนแปลงใน วันฉัตรมงคล (วันหยุดชดเชย)</p>'+
      '<p>โทรศัพท์: 052 010 123 </p>'+
    '<p>Website :<a href="https://tubetrekwaterparkchiangmai.com/">'+
      'https://tubetrekwaterparkchiangmai.com/</a> '+
      '</div>'+
      '</div>';

    google.maps.event.addListener(marker1,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:contentString1
    });
  infowindow.open(map,marker1);
  });


//สวนน้ำนาวาแลนด์
  var marker2 = new google.maps.Marker({
     position : {lat:19.884401,lng:99.915630},
          map: map ,
          icon: image
        });
    var contentString2 = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">สวนน้ำนาวาแลนด์</h1>'+
      '<div id="bodyContent">'+
    '<p><img src="https://2.bp.blogspot.com/-Q0da0dk7pTI/WRwKOyDtC0I/AAAAAAAAAMY/acVrQKgT7CgmXKPtUO6gAY65TjN2YE3oQCLcB/s1600/NawaLand_-3.jpg" width="350" height="200"></p>' +
      '<p>ที่อยู่:ตำบล เวียงชัย อำเภอ เวียงชัย เชียงราย 57210</p>'+
    '<p>ชั่วโมง: เปิด ⋅ ปิด ⋅</p>'+
    '<p>เวลาทำการอาจมีการเปลี่ยนแปลงใน วันฉัตรมงคล (วันหยุดชดเชย)</p>'+
      '<p>โทรศัพท์: 053 768 088 </p>'+
    '<p>Website :<a href="http://www.navalandchiangrai.com/">'+
      'http://www.navalandchiangrai.com/</a> '+
      '</div>'+
      '</div>';

    google.maps.event.addListener(marker2,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:contentString2
    });
  infowindow.open(map,marker2);
  });


//สวนน้ำแกรนด์แคนยอนวอเตอร์ปาร์ค
var marker3 = new google.maps.Marker({
     position : {lat:18.696004,lng:98.892088},
          map: map ,
          icon: image
        });
    var contentString3 = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">สวนน้ำแกรนด์แคนยอนวอเตอร์ปาร์ค</h1>'+
      '<div id="bodyContent">'+
    '<p><img src="http://www.emagtravel.com/wp-content/uploads/2015/08/grandcanyon-800.jpg" width="400" height="200"></p>' +
      '<p>ที่อยู่:202 ถนนเลียบคลองชลประทาน น้ำแพร่ หางดง เชียงใหม่ 50230</p>'+
    '<p>ชั่วโมง: เปิด ⋅ ปิด 19:00</p>'+
    '<p>เวลาทำการอาจมีการเปลี่ยนแปลงใน วันฉัตรมงคล (วันหยุดชดเชย)</p>'+
      '<p>โทรศัพท์: 063 672 4007 </p>'+
    '<p>Website : - '+
      '</div>'+
      '</div>';
    google.maps.event.addListener(marker3,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:contentString3
    });
  infowindow.open(map,marker3);
  });
//------------------------------------------------------------------------------------------------------------------





//---------------------------------------------------------ภาคอีสาน---------------------------------------------------------
  //scenical world
  var marker7 = new google.maps.Marker({
     position : {lat:14.538169,lng:101.377999},
          map: map ,
          icon: image
        });
    var contentString7 = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">scenical world</h1>'+
      '<div id="bodyContent">'+
    '<p><img src="https://f.ptcdn.info/393/050/000/oo5aefga4gVkyGGyG7X-o.jpg" width="400" height="200"></p>' +
      '<p>ที่อยู่:777 หมู่ 5 ถนน ธนะรัชต์ ตำบล หมูสี อำเภอ ปากช่อง นครราชสีมา 30130</p>'+
    '<p>ชั่วโมง: เปิด ⋅ ปิด 18:00</p>'+
    '<p>เวลาทำการอาจมีการเปลี่ยนแปลงใน วันฉัตรมงคล (วันหยุดชดเชย)</p>'+
      '<p>โทรศัพท์: 044 001 188 </p>'+
    '<p>Website :<a href="https://www.scenicalworld.com/">'+
      'https://www.scenicalworld.com/</a> '+
      '</div>'+
      '</div>';

    google.maps.event.addListener(marker7,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:contentString7
    });
  infowindow.open(map,marker7);
  });


//Dino Water Park Khon Kaen
  var marker8 = new google.maps.Marker({
     position : {lat:16.402034,lng:102.809936},
          map: map ,
          icon: image
        });
    var contentString8 = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">Dino Water Park Khon Kaen</h1>'+
      '<div id="bodyContent">'+
    '<p><img src="https://i.ytimg.com/vi/w-NxzhBjPCk/maxresdefault.jpg" width="400" height="200"></p>' +
      '<p>ที่อยู่:456 หมู่ 12 ถนน มิตรภาพ ตำบล เมืองเก่า อำเภอเมืองขอนแก่น ขอนแก่น 40000</p>'+
    '<p>ชั่วโมง: เปิด ⋅ ปิด 18:00</p>'+
    '<p>เวลาทำการอาจมีการเปลี่ยนแปลงใน วันฉัตรมงคล (วันหยุดชดเชย)</p>'+
      '<p>โทรศัพท์: 085 002 6565 </p>'+
    '<p>Website :<a href="http://www.dinowaterpark.com/">'+
      'http://www.dinowaterpark.com/</a> '+
      '</div>'+
      '</div>';

    google.maps.event.addListener(marker8,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:contentString8
    });
  infowindow.open(map,marker8);
  });

//Usotel Water Park
  var marker9 = new google.maps.Marker({
     position : {lat:17.426394,lng:102.784214},
          map: map ,
          icon: image
        });
    var contentString9 = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">Usotel Water Park</h1>'+
      '<div id="bodyContent">'+
    '<p><img src="https://ed.files-media.com/ud/book/content/1/146/436212/Usotel_Water_Park1.jpg" width="400" height="200"></p>' +
      '<p>ที่อยู่:288/8 พิบูลย์ ตำบล บ้านเลื่อม อำเภอเมืองอุดรธานี อุดรธานี 41000</p>'+
    '<p>ชั่วโมง: เปิด ⋅ ปิด 20:00</p>'+
    '<p>เวลาทำการอาจมีการเปลี่ยนแปลงใน วันฉัตรมงคล (วันหยุดชดเชย)</p>'+
      '<p>โทรศัพท์: - </p>'+
    '<p>Website :<a href="http://www.usotelwaterland.com/">'+
      'http://www.usotelwaterland.com/</a> '+
      '</div>'+
      '</div>';
    google.maps.event.addListener(marker9,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:contentString9
    });
  infowindow.open(map,marker9);
  });
//------------------------------------------------------------------------------------------------------------------



  //---------------------------------------------------------ภาคกลาง---------------------------------------------------------
  //สวนสยามทะเลกรุงเทพฯ
  var marker10 = new google.maps.Marker({
     position : {lat:13.807387,lng:100.693917},
          map: map ,
          icon: image
        });
    var contentString10 = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">สวนสยามทะเลกรุงเทพฯ</h1>'+
      '<div id="bodyContent">'+
    '<p><img src="https://www.thairath.co.th/media/EyWwB5WU57MYnKOteZth7viz2P5CP35iKSGUhrn0jG2dB1BwR2fNbO.jpg" width="400" height="200"></p>' +
      '<p>ที่อยู่:203 ถนน สวนสยาม แขวง คันนายาว เขต คันนายาว กรุงเทพมหานคร 10230</p>'+
    '<p>ชั่วโมง: เปิด ⋅ ปิด 18:00</p>'+
    '<p>เวลาทำการอาจมีการเปลี่ยนแปลงใน วันฉัตรมงคล (วันหยุดชดเชย)</p>'+
      '<p>โทรศัพท์: 02 919 7200 </p>'+
    '<p>Website :<a href="https://www.siamparkcity.com/">'+
      'https://www.siamparkcity.com/</a> '+
      '</div>'+
      '</div>';
    google.maps.event.addListener(marker10,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:contentString10
    });
  infowindow.open(map,marker10);
  });


//สวนน้ำ Cartoon Network AMAZONE
  var marker11 = new google.maps.Marker({
     position : {lat:12.785206,lng:100.914927},
          map: map ,
          icon: image
        });
    var contentString11 = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">สวนน้ำ Cartoon Network AMAZONE</h1>'+
      '<div id="bodyContent">'+
    '<p><img src="https://promotions.co.th/wp-content/uploads/%E0%B9%82%E0%B8%9B%E0%B8%A3%E0%B9%82%E0%B8%A1%E0%B8%8A%E0%B8%B1%E0%B9%88%E0%B8%99-%E0%B8%AA%E0%B8%A7%E0%B8%99%E0%B8%99%E0%B9%89%E0%B8%B3-Cartoon-network-Amazone.jpg" width="400" height="200"></p>' +
      '<p>ที่อยู่:888 Moo8 NaJomtien, Najomtien, อำเภอ สัตหีบ ชลบุรี 20250</p>'+
    '<p>ชั่วโมง: เปิด ⋅ ปิด 19:00</p>'+
    '<p>เวลาทำการอาจมีการเปลี่ยนแปลงใน วันฉัตรมงคล (วันหยุดชดเชย)</p>'+
      '<p>โทรศัพท์:  033 004 999 </p>'+
    '<p>Website :<a href="https://www.cartoonnetworkamazone.com/">'+
      'https://www.cartoonnetworkamazone.com/</a> '+
      '</div>'+
      '</div>';
    google.maps.event.addListener(marker11,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:contentString11
    });
  infowindow.open(map,marker11);
  });

//สวนน้ำรามายณะ
  var marker12 = new google.maps.Marker({
     position : {lat:12.749936,lng:100.961667},
          map: map ,
          icon: image
        });
    var contentString12 = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">สวนน้ำรามายณะ</h1>'+
      '<div id="bodyContent">'+
    '<p><img src="https://ed.files-media.com/ud/review/1/149/446461/1Ramayana_Cover-850x567.jpg" width="400" height="200"></p>' +
      '<p>ที่อยู่:9 ถนน บานเย็น ตำบล นาจอมเทียน อำเภอ สัตหีบ ชลบุรี 20280</p>'+
    '<p>ชั่วโมง: เปิด ⋅ ปิด 18:00</p>'+
    '<p>เวลาทำการอาจมีการเปลี่ยนแปลงใน วันฉัตรมงคล (วันหยุดชดเชย)</p>'+
      '<p>โทรศัพท์:  033 005 929 </p>'+
    '<p>Website :<a href="https://www.ramayanawaterpark.com/">'+
      'https://www.ramayanawaterpark.com/</a> '+
      '</div>'+
      '</div>';
    google.maps.event.addListener(marker12,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:contentString12
    });
  infowindow.open(map,marker12);
  });



  var myParser = new geoXML3.parser({map: map ,afterParse:wpCallback});
    myParser.parse('Water Park My Mark3.kml');

  }

  function wpCallback(doc){
    //alert('test');
    wp_map = doc[0];
    mission = $('#mission').html().split(',');
    console.log(mission);
      if(mission.length==12){
        var kmlColor = {strokeColor:"#999999",fillOpacity:0};
        if(mission[3]==0)
          wp_map.placemarks[0].polygon.setOptions(kmlColor);
        if(mission[4]==0)
          wp_map.placemarks[1].polygon.setOptions(kmlColor);
        if(mission[5]==0)
          wp_map.placemarks[2].polygon.setOptions(kmlColor);
        if(mission[6]==0)
          wp_map.placemarks[6].polygon.setOptions(kmlColor);
        if(mission[7]==0)
          wp_map.placemarks[7].polygon.setOptions(kmlColor);
        if(mission[8]==0)
          wp_map.placemarks[8].polygon.setOptions(kmlColor);
        if(mission[9]==0)
          wp_map.placemarks[12].polygon.setOptions(kmlColor);
        if(mission[10]==0)
          wp_map.placemarks[13].polygon.setOptions(kmlColor);
        if(mission[11]==0)
          wp_map.placemarks[14].polygon.setOptions(kmlColor);
        if(mission[0]==0)
          wp_map.placemarks[20].polygon.setOptions(kmlColor);
        if(mission[1]==0)
          wp_map.placemarks[21].polygon.setOptions(kmlColor);
        if(mission[2]==0)
          wp_map.placemarks[22].polygon.setOptions(kmlColor);
      //console.log(doc[0]);
    }
  }
