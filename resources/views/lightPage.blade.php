<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
    <script src="js/nav2d.js"></script>
    <script type="text/javascript" src="http://static.robotwebtools.org/EaselJS/current/easeljs.min.js"></script>
    <script type="text/javascript" src="http://static.robotwebtools.org/EventEmitter2/current/eventemitter2.min.js"></script>
    <script src="js/roslibjs.js"></script>
    <script src="js/ros2djs.js"></script>

    <style>
    body {
        padding-top: 25vh;
        background-color: rgba(156, 210, 210, .8);
      }

      svg {
        width: 100%;
      }

      .container {
        width: 200px;
        margin: 3em auto;
      }

      .st0 {
        fill: #FFFFFF;
      }

      .st1 {
        fill: none;
        stroke: #FFFFFF;
        stroke-width: 4;
        stroke-miterlimit: 10;
      }

      .st2 {
        fill: none;
        opacity: .5;
        stroke: #FFFFFF;
        stroke-width: 2;
        stroke-miterlimit: 10;
      }

      #one {
        -webkit-transform-origin: center;
        -ms-transform-origin: center;
        transform-origin: center;
      }

      .oneAnimation{
        -webkit-animation: line-glow 1s .1s infinite;
        animation: line-glow 1s .1s infinite;
      }

      #two {
        -webkit-transform-origin: center;
        -ms-transform-origin: center;
        transform-origin: center;
      }

      .twoAnimation{
        -webkit-animation: line-glow 1s .2s infinite;
        animation: line-glow 1s .2s infinite;
      }

      #three {
        -webkit-transform-origin: center;
        -ms-transform-origin: center;
        transform-origin: center;
      }

      .threeAnimation{
        -webkit-animation: line-glow 1s .3s infinite;
        animation: line-glow 1s .3s infinite;
      }

      #four {
        -webkit-transform-origin: center;
        -ms-transform-origin: center;
        transform-origin: center;
      }

      .fourAnimation{
        -webkit-animation: line-glow 1s .4s infinite;
        animation: line-glow 1s .4s infinite;
      }

      #five {
        -webkit-transform-origin: center;
        -ms-transform-origin: center;
        transform-origin: center;
      }

      .fiveAnimation{
        -webkit-animation: line-glow 1s .5s infinite;
        animation: line-glow 1s .5s infinite;
      }

      #six {
        -webkit-transform-origin: center;
        -ms-transform-origin: center;
        transform-origin: center;
      }

      .sixAnimation{
        -webkit-animation: line-glow 1s .6s infinite;
        animation: line-glow 1s .6s infinite;
      }

      #seven {
        -webkit-transform-origin: center;
        -ms-transform-origin: center;
        transform-origin: center;
      }

      .sevenAnimation{
        -webkit-animation: line-glow 1s .7s infinite;
        animation: line-glow 1s .7s infinite;
      }

      #bulb-body-fill{
          cursor: pointer;
          opacity: 0;
      }

      .bulb-body-fill {
        -webkit-animation: bulb-on 1s ease infinite;
        animation: bulb-on 1s ease infinite;
      }

      @-webkit-keyframes line-glow {
        10% {
          -webkit-transform: scale(1.2);
          transform: scale(1.2);
          opacity: 1;
        }
      }

      @keyframes line-glow {
        10% {
          -webkit-transform: scale(1.2);
          transform: scale(1.2);
          opacity: 1;
        }
      }

      @-webkit-keyframes bulb-on {
        0% {
          opacity: 0;
        }
        100% {
          opacity: 1;
        }
      }

      @keyframes bulb-on {
        0% {
          opacity: 0;
        }
        100% {
          opacity: 1;
        }
      }
      #status{
        position: relative;
        top: 10px;
        left: 50%;
      }
      </style>
    <title>Aprosoft</title>
</head>
<body>
    <span id="status">Status: </span>
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
            url : 'ws://localhost:9090'
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
          console.log('Status:' + status);
          if(status == true){
              $('#bulb-body-fill').addClass('bulb-body-fill');
              $('#one').addClass('oneAnimation');
              $('#two').addClass('twoAnimation');
              $('#three').addClass('threeAnimation');
              $('#four').addClass('fourAnimation');
              $('#five').addClass('fiveAnimation');
              $('#six').addClass('sixAnimation');
              $('#seven').addClass('sevenAnimation');
          }else{
              $('#bulb-body-fill').removeClass('bulb-body-fill');
              $('#one').removeClass('oneAnimation');
              $('#two').removeClass('twoAnimation');
              $('#three').removeClass('threeAnimation');
              $('#four').removeClass('fourAnimation');
              $('#five').removeClass('fiveAnimation');
              $('#six').removeClass('sixAnimation');
              $('#seven').removeClass('sevenAnimation');
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


    </script>

</body>
