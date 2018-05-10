var test ;
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    if (response.status === 'connected') {
      //window.location ='https://angsila.cs.buu.ac.th/~58160266/ProWebser/Home.php';
      get_data_API();
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
/*
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('user_name').innerHTML = response.name ;
      console.log(response);

    });

    */
    FB.api('/me','GET',{"fields":"name,picture.width(150).height(150),email"},function(response) {
      //console.log(response);
      document.getElementById('user_name').innerHTML = response.name ;
      document.getElementById('user_email').innerHTML = response.email ;
      document.getElementById('user_pic').innerHTML = '<img src="'+response.picture.data.url+'" class="w3-circle" style="height:106px;width:106px" alt="Avatar">' ;
      block_btn_post(response.email);
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

function getMission(id){
  email = $('#user_email').html();
  console.log(email+" "+ id);
  if(email != null || email != ''){
    $.post("https://angsila.cs.buu.ac.th/~58160266/reatful/public/index.php/api/v1/missions",
          {
            email: email,
            id : id
          },
          function(data,status){
              //alert(data.status);
              //console.log(data);
              location.reload();
          });

  }

}

 function block_btn_post(email){
   $.post("https://angsila.cs.buu.ac.th/~58160266/reatful/public/index.php/api/v1/members",
         {
           email: email,
         },
         function(data,status){

             missions = [ data.result.mb_wp1,
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
                          data.result.mb_wp12
                        ];
             for(i=0;i<missions.length;i++){
                if($('#missionClick_btn_'+(i+1)).length)
                  if(missions[i]==1)
                    hidden_btn(i+1);
              }
        });
 }


function hidden_btn(num){
  img = '<br/><img src="https://angsila.cs.buu.ac.th/~58160266/pic_waterparks/james_curran.gif" height="100px" class="img-circle" alt="Cinque Terre">'
  $('#missionClick_btn_'+num).html(img);
}
