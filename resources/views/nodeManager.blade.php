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
    <script type="text/javascript" src="{{asset('js/easeljs.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/eventEmitter2.min.js')}}"></script>
    <script src="js/roslibjs.js"></script>
    <script src="js/ros2djs.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/loading-bar.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/slick.css')}}"/>
    {{-- <script type="text/javascript" src="{{asset('/js/loading-bar.js')}}"></script> --}}
    <link rel="stylesheet" href="{{asset('/css/threeDots.css')}}">


    <title>Aprosoft</title>
</head>
<body class="bodyAlign" id="body">

    <img class="imgLogo" id="logo" src="{{asset('reso/logoSaniRobo2.png')}}" alt="">

    <div class="middle text-center" id="starting">
        <h3 class="blinking">INICIANDO</h3>
        <span class="waitMessage">POR FAVOR ESPERE</span>
    </div>

    <div class="middle text-center" id="panel">
        <button class="buttonPanel1" id="Controls">Controles</button>
        <button class="buttonPanel2" id="Explorer">Exploración</button>
        <button class="buttonPanel3">Apagar</button>

        <button class="buttonPanelSmall" id="Controls1">Controles</button>

        <button class="buttonPanelSmall2" id="Explorer1">Exploración</button>

        <button class="buttonPanelSmall3">Appagar</button>
    </div>

    <div id="controlsBox">
        <div id="rotateDevice">
            <img src="{{asset('/reso/rotateDevice.png')}}" alt="">
        </div>
        <!-- JOYSTICK -->
        <div class="row my-4">
            <div class="col">
                <div class="d-flex justify-content-center" style="width: 210px; height: 210px;">
                    <div id="joystick"></div>
                </div>
            </div>
        </div>
        <div class="lightControls">
            <button id="lightBtn" class="">Lights: Off</button>
        </div>
    </div>

    <div class="middle text-center" id="explorationBox">
        <h3 class="blinking">Explorando</h3>
        <span class="waitMessage">POR FAVOR ESPERE</span>
    </div>

    <div class="middle text-center" id="exploreEnd">
        <div id="map">

        </div>
        <button id="buttonSaveMap">Guardar</button>
        <button id="buttonRedoMap">Rehacer</button>
    </div>

    <div class="middle text-center" id="booting">
        <h3 class="blinking">Reiniciando</h3>
        <span class="waitMessage">POR FAVOR ESPERE</span>
    </div>
    {{-- <script src="{{asset('js/testNode.js')}}"></script> --}}
    <script>


        var buttonControls1 = document.getElementById('Controls');
        buttonControls1.addEventListener('click', function(){
            panel.style.display = 'none';
            var controlsBox = document.getElementById('controlsBox');
            controlsBox.style.display = 'block';
        });
        var buttonControls2 = document.getElementById('Controls1');
        buttonControls2.addEventListener('click', function(){
            panel.style.display = 'none';
            var controlsBox = document.getElementById('controlsBox');
            controlsBox.style.display = 'block';
        });
        var logo = document.getElementById('logo');
        logo.addEventListener('click', function(){
            panel.style.display = 'block';
            controlsBox.style.display = 'none';
        });

    </script>
    <script type="text/javascript" src="{{asset('js/nipple.js')}}"></script>
<script type="text/javascript" type="text/javascript">
    var ros = new ROSLIB.Ros({
      url : 'ws://10.42.0.1:9090'
    });

    ros.on('connection', function() {
    console.log('si')
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

});

    var start = new ROSLIB.Topic({
        ros : ros,
        name : '/start',
        messageType : 'std_msgs/Bool'
    });

    var buttonExplorer = document.getElementById('Explorer');
    buttonExplorer.addEventListener('click', function(){
        panel.style.display = 'none';
        var explorationBox = document.getElementById('explorationBox');
        explorationBox.style.display = 'block';
        var twist = new ROSLIB.Message({
            data: true
        });
        start.publish(twist);
    });
    var buttonExplorer2 = document.getElementById('Explorer2');
    if(buttonExplorer2){
        buttonExplorer2.addEventListener('click', function(){
        panel.style.display = 'none';
        var explorationBox = document.getElementById('explorationBox');
        explorationBox.style.display = 'block';
        var twist = new ROSLIB.Message({
            data: true
        });
        start.publish(twist);
    });
    }
    var mapStatus = new ROSLIB.Topic({
        ros : ros,
        name : '/mapstatus',
        messageType : 'std_msgs/Int16'
    });

    var explore_status = new ROSLIB.Topic({
    ros : ros,
    name : '/explore_status',
    messageType : 'std_msgs/Bool'
    });

    var flagExplo = 0;

    explore_status.subscribe(function(explore) {
    flagExplo++;
    if(flagExplo == 1){
        setTimeout(function(){
            console.log('Listo explore');
            var viewer = new ROS2D.Viewer({
                divID : 'map',
                width : 350,
                height : 350 ,
            });
            var gridClient = new ROS2D.OccupancyGridClient({
                ros : ros,
                rootObject : viewer.scene
            });

            gridClient.on('change', function(){
                viewer.scaleToDimensions(gridClient.currentGrid.width, gridClient.currentGrid.height);
                viewer.shift(gridClient.currentGrid.pose.position.x, gridClient.currentGrid.pose.position.y);
            });
            var element = document.getElementById("body");
            element.classList.remove("bodyAlign")
            document.getElementById('explorationBox').style.display = 'none';
            document.getElementById('exploreEnd').style.display = 'block';
        }, 3000)
    }
});
var btnRedo = document.getElementById('buttonRedoMap');
btnRedo.addEventListener('click', function(){
    var twist3 = new ROSLIB.Message({
        data: 2
    });
    mapStatus.publish(twist3);
    var element = document.getElementById("body");
        element.classList.add("bodyAlign")
        document.getElementById('exploreEnd').style.display = 'none';
        document.getElementById('booting').style.display = 'block';
    setTimeout(function(){
        window.location.href = '/';
    }, 12000);
})

var btnDone = document.getElementById('buttonSaveMap');
btnDone.addEventListener('click', function(){
    console.log('btnSave');
    var twist3 = new ROSLIB.Message({
        data: 1
    });
    mapStatus.publish(twist3);
    var element = document.getElementById("body");
        element.classList.add("bodyAlign")
        document.getElementById('exploreEnd').style.display = 'none';
        document.getElementById('saving').style.display = 'block';
    setTimeout(function(){
        window.location.href = '/home';
    }, 15000);

})
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
              document.getElementById('lightBtn').innerHTML = 'Lights: Off';
          }else{
            document.getElementById('lightBtn').innerHTML = 'Lights: On';
          }
    });
    var btnLight = document.getElementById('lightBtn');
    btnLight.addEventListener('click', function(){
        if($('#lightBtn').hasClass('on')){
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
      max_linear = 0.2; // m/s
        max_angular = 0.5; // rad/s
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
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.5.1.slim.min.js')}}" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="{{asset('js/popper.min.js')}}" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>



</body>
