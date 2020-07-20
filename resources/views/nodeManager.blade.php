<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/nodeManager.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
    <script src="js/nav2d.js"></script>
    <script type="text/javascript" src="http://static.robotwebtools.org/EaselJS/current/easeljs.min.js"></script>
    <script type="text/javascript" src="http://static.robotwebtools.org/EventEmitter2/current/eventemitter2.min.js"></script>
    <script src="js/roslibjs.js"></script>
    <script src="js/ros2djs.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/loading-bar.css')}}"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="{{asset('/js/loading-bar.js')}}"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/threeDots.css')}}">


    <title>Aprosoft</title>
</head>
<body class="bodyAlign" id="body">

    <img class="imgLogo" src="{{asset('reso/logoSaniRobo2.png')}}" alt="">

    <div class="middle text-center" id="starting">
        <h3 class="blinking">INICIANDO</h3>
        <span class="waitMessage">POR FAVOR ESPERE</span>
    </div>

    <div class="middle text-center" id="panel">
        <button class="buttonPanel" id="Controls">Controles</button>
        <button class="buttonPanel">Exploración</button>
        <button class="buttonPanel">Apagar</button>

        <button class="buttonPanelSmall" id="Controls">Controles</button>

        <button class="buttonPanelSmall2">Exploración</button>

        <button class="buttonPanelSmall3">Apagar</button>
    </div>

    <div id="controlsBox">
        <!-- JOYSTICK -->
        <div class="row my-4">
            <div class="col">
                <div class="d-flex justify-content-center" style="width: 210px; height: 210px;">
                    <div id="joystick"></div>
                </div>
            </div>
        </div>
    </div>


    {{-- <script src="{{asset('js/testNode.js')}}"></script> --}}
    <script>
        setTimeout(function(){
            var starting = document.getElementById('starting');
            starting.style.visibility = 'hidden';
            starting.style.opacity = 0;
            setTimeout(function(){
                starting.style.display = 'none';
                var panel = document.getElementById('panel');
                panel.style.display = 'flex';
                setTimeout(function(){
                    panel.style.visibility = 'visible';
                    panel.style.opacity = 1;
                }, 500);
            }, 500);
        }, 2000);

        var buttonControls = document.getElementById('Controls');
        buttonControls.addEventListener('click', function(){
            panel.style.display = 'none';
            var controlsBox = document.getElementById('controlsBox');
            controlsBox.style.display = 'block';
        });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/nipplejs/0.7.3/nipplejs.js"></script>
<script type="text/javascript" type="text/javascript">
    var ros = new ROSLIB.Ros({
      url : 'ws://10.42.0.1:9090'
    });

    // ros.on('connection', function() {
    //   document.getElementById("status").innerHTML = "Connected";
    // });

    // ros.on('error', function(error) {
    //   document.getElementById("status").innerHTML = "Error";
    // });

    // ros.on('close', function() {
    //   document.getElementById("status").innerHTML = "Closed";
    // });

    var txt_listener = new ROSLIB.Topic({
      ros : ros,
      name : '/txt_msg',
      messageType : 'std_msgs/String'
    });

    txt_listener.subscribe(function(m) {
      document.getElementById("msg").innerHTML = m.data;
      move(1, 0);
    });




  cmd_vel_listener = new ROSLIB.Topic({
      ros : ros,
      name : "/cmd_vel",
      messageType : 'geometry_msgs/Twist'
    });

    move = function (linear, angular) {
      var twist = new ROSLIB.Message({
        linear: {
          x: linear,
          y: 0,
          z: 0
        },
        angular: {
          x: 0,
          y: 0,
          z: angular
        }
      });
      cmd_vel_listener.publish(twist);
    }


    createJoystick = function () {
        var options = {
          zone: document.getElementById('joystick'),
          threshold: 0.1,
          position: { left: 50 + '%' },
          mode: 'static',
          size: 200,
          color: '#fff',
        };
        manager = nipplejs.create(options);

        linear_speed = 0;
        angular_speed = 0;

        self.manager.on('start', function (event, nipple) {
          console.log("Movement start");
      timer = setInterval(function () {
              move(linear_speed, angular_speed);
            }, 25);
        });

        self.manager.on('move', function (event, nipple) {
          console.log("Moving");
      max_linear = 0.05; // m/s
        max_angular = 0.05; // rad/s
        max_distance = 75.0; // pixels;
        linear_speed = Math.sin(nipple.angle.radian) * max_linear * nipple.distance/max_distance;
        angular_speed = -Math.cos(nipple.angle.radian) * max_angular * nipple.distance/max_distance;

        });

        self.manager.on('end', function () {
          console.log("Movement end");
       if (timer) {
              clearInterval(timer);
        }
        self.move(0, 0);
        });




      }
      window.onload = function () {
        createJoystick();
      }



  </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>



</body>
