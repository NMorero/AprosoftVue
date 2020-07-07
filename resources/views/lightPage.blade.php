<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <script src="js/nav2d.js"></script>
    <script type="text/javascript" src="http://static.robotwebtools.org/EaselJS/current/easeljs.min.js"></script>
    <script type="text/javascript" src="http://static.robotwebtools.org/EventEmitter2/current/eventemitter2.min.js"></script>
    <script src="js/roslibjs.js"></script>
    <script src="js/ros2djs.js"></script>
    <link rel="stylesheet" href="css/lightStyle.css">

    <title>Aprosoft</title>
</head>
<body>
    <div class="batteryContainer">
        <div class="batteryOuter"><div id="batteryLevel"></div></div>
        <div class="batteryBump"></div>
      </div>
    <div id="boxInfo">

        <span id="status" >Off</span>
    </div>
    <div class="container">

        <svg version="1.1" id="hei-loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-16 5.5 115.3 141.5" style="enable-background:new -16 5.5 115.3 141.5;" xml:space="preserve">

          <g id="bulb_1_">
            <path id="bulb-body-fill" class="st0 " d="M79.7,67.8c0-18.4-16.9-33.2-37.7-33.2S4.3,49.4,4.3,67.8c0,7.3,2.7,14,7.1,19.4
              c0.5,0.7,15.5,21.9,16.7,30.8c1.3,9.1,1.3,11.5,1.3,11.5h25.2c0,0,0-2.4,1.3-11.5c1.3-8.9,16.2-30,16.7-30.8
              C77.1,81.8,79.7,75.1,79.7,67.8" />
            <path id="bulb-body" class="st1" d="M79.4,67.8c0-18.4-16.9-33.2-37.7-33.2S4,49.4,4,67.8c0,7.3,2.7,14,7.1,19.4
              c0.5,0.7,15.5,21.9,16.7,30.8c1.3,9.1,1.3,11.5,1.3,11.5h25.2c0,0,0-2.4,1.3-11.5c1.3-8.9,16.2-30,16.7-30.8
              C76.8,81.8,79.4,75.1,79.4,67.8" />
            <g>
              <line id="one" class="st2 " x1="-15.3" y1="36.8" x2="-4.8" y2="47.4" />
              <line id="two" class="st2 " x1="-3.4" y1="16.6" x2="8.1" y2="32.7" />
              <line id="three" class="st2 " x1="21" y1="13.2" x2="24.5" y2="26.8" />
              <line id="four" class="st2 " x1="41.4" y1="5.5" x2="42.3" y2="24.9" />
              <line id="five" class="st2 " x1="61.9" y1="14.2" x2="57.8" y2="27.9" />
              <line id="six" class="st2 " x1="88.2" y1="19.4" x2="74.5" y2="34" />
              <line id="seven" class="st2 " x1="98.7" y1="40" x2="86.2" y2="48.8" />
            </g>
            <line id="middle-screw" class="st1" x1="25.9" y1="138.5" x2="58" y2="138.5" />
            <line id="bottom-screw" class="st1" x1="25.9" y1="146" x2="58" y2="146" />
          </g>
        </svg>

      </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script>
        var ros = new ROSLIB.Ros({
            url : 'ws://192.168.0.12:9090'
        });

        ros.on('connection', function() {
            console.log('Connected to websocket server.');
        });

        ros.on('error', function(error) {
            console.log('Error connecting to websocket server: ', error);
        });
        var lamp_status = new ROSLIB.Topic({
            ros : ros,
            name : '/lamp_status',
            messageType : 'std_msgs/Bool'
        });

        var lamp_goal = new ROSLIB.Topic({
            ros : ros,
            name : '/lamp_goal',
            messageType : 'std_msgs/Bool'
        });

        lamp_status.subscribe(function(status) {
          if(status.data == false){
              $('#bulb-body-fill').addClass('bulb-body-fill');
              $('#one').addClass('oneAnimation');
              $('#two').addClass('twoAnimation');
              $('#three').addClass('threeAnimation');
              $('#four').addClass('fourAnimation');
              $('#five').addClass('fiveAnimation');
              $('#six').addClass('sixAnimation');
              $('#seven').addClass('sevenAnimation');
              $('#status').html("On");
          }else{
              $('#bulb-body-fill').removeClass('bulb-body-fill');
              $('#one').removeClass('oneAnimation');
              $('#two').removeClass('twoAnimation');
              $('#three').removeClass('threeAnimation');
              $('#four').removeClass('fourAnimation');
              $('#five').removeClass('fiveAnimation');
              $('#six').removeClass('sixAnimation');
              $('#seven').removeClass('sevenAnimation');
              $('#status').html("Off");
          }
    });

        $('#bulb-body-fill').click(function(){
            // $('#bulb-body-fill').toggleClass('bulb-body-fill');
            // $('#one').toggleClass('oneAnimation');
            // $('#two').toggleClass('twoAnimation');
            // $('#three').toggleClass('threeAnimation');
            // $('#four').toggleClass('fourAnimation');
            // $('#five').toggleClass('fiveAnimation');
            // $('#six').toggleClass('sixAnimation');
            // $('#seven').toggleClass('sevenAnimation');
            if($('#bulb-body-fill').hasClass('bulb-body-fill')){
                console.log('Apagar');
                var goal = new ROSLIB.Message({
                    data: false
                });
                lamp_goal.publish(goal);
            }else{
              console.log('Prender');
                var goal = new ROSLIB.Message({
                    data: true
                });
                lamp_goal.publish(goal);
            }
        });

        var battery_status = new ROSLIB.Topic({
            ros : ros,
            name : '/bat_status',
            messageType : 'sensor_msgs/BatteryState'
        });
        battery_status.subscribe(function(battertyStatus) {
            var maxBattery = 12.75;
            var minBattery = 9.3;
            var maxPerc = maxBattery - minBattery;
            var percentage = 100 - (((12.75 - battertyStatus.voltage) * 100) / maxPerc);
            console.log(percentage);
            document.getElementById('batteryLevel').style.width = percentage+"%";
            if(percentage > 100){
                document.getElementById('batteryLevel').style.backgroundColor = '#6cf76c';
                document.getElementById('batteryLevel').style.width = "100%";
            }else if(percentage >= 80 && percentage < 100){
                document.getElementById('batteryLevel').style.backgroundColor = '#6cf76c';
            }else if(percentage >= 60 && percentage < 80){
                document.getElementById('batteryLevel').style.backgroundColor = '#c8f86b';
            }else if(percentage >= 40 && percentage < 60){
                document.getElementById('batteryLevel').style.backgroundColor = '#eef76c';
            }else if(percentage >= 15 && percentage < 40){
                document.getElementById('batteryLevel').style.backgroundColor = '#f7b46c';
            }else if(percentage >= 2 && percentage < 15){
                document.getElementById('batteryLevel').style.backgroundColor = '#f76c6c';
            }else{
                document.getElementById('batteryLevel').style.backgroundColor = '#f76c6c';
                document.getElementById('batteryLevel').style.width = "1%";
            }

        });

    </script>

</body>
