<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
  <style>
    body{
      justify-content: center;
    align-items: center;
    display: flex;
    flex-direction: column;
    }
  </style>
  <script>

    // Enable pusher logging - don't include this in production
    $(document).ready(async function () {

let ip =await getip();
Pusher.logToConsole = false;

    var pusher = new Pusher('c51c138b7b2caeb836e0', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe(ip);
    var channelscaner = pusher.subscribe('scaner'+ip);

    
    channel.bind('App\\Events\\loginqr', function(data) {
      
      $('#name').html(data?.user?.name+' đã đăng nhập');
    });
    channelscaner.bind('App\\Events\\onScaner', function(data) {
      $('#name').html('Vui lòng xác nhận trên thiết bị yêu cầu đăng nhập');
      $('#showimg').attr('src',`https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlCV9Hrjk4jOdUmEewLah4n3v9IxKnnsySVBsaJv0T5bzmHfZ9Ff0fd43PH2lmdbw47os&usqp=CAU`);
    });
      callapi();

    });
    let callapi = async ()=>{
      let ip =await getip();
      let date = new Date();
      let json = JSON.stringify({ip:ip,time:date.getTime(),browser:detectBrowser()});
      // console.log(json);
      $('#showimg').attr('src',`https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${json}`);
    }
    let getip=async ()=> {
      let ip =await $.getJSON('https://api.ipify.org/?format=json');
      return ip?.ip;
    }
    function detectBrowser() { 
    if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) {
        return 'Opera';
    } else if(navigator.userAgent.indexOf("Chrome") != -1 ) {
        return 'Chrome';
    } else if(navigator.userAgent.indexOf("Safari") != -1) {
        return 'Safari';
    } else if(navigator.userAgent.indexOf("Firefox") != -1 ){
        return 'Firefox';
    } else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) {
        return 'IE';//crap
    } else {
        return 'Unknown';
    }
} 
  </script>
</head>
<body>
  <img id="showimg" src="" alt="">
  <h1><span id="name">Quet QR để đăng nhập</span></h1>
</body>