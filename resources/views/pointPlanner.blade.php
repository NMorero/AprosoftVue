<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">

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

    <link rel="stylesheet" href="css/pointPlanner.css">
    <title>Aprosoft</title>
</head>

<body class="bodyAlign" id="body">
    <img class="imgLogo" id="logo" src="{{asset('reso/logoSaniRobo2.png')}}" alt="">
    <div class="middle text-center" id="starting">
        <h3 class="blinking">INICIANDO</h3>
        <span class="waitMessage">POR FAVOR ESPERE</span>
    </div>

    <div class="middle text-center" id="poseBox">
        <span id="spanActualGoal">Posición actual: <span id="actualGoal"></span></span>
    </div>

    <div id="buttonsBox">

    </div>


    <script>
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
                }, 500);
            }, 2000);
        });
        var getGoal = new ROSLIB.Topic({
            ros : ros,
            name : '/move_base_simple/goal',
            messageType : 'geometry_msgs/PoseStamped'
        });
        getGoal.subscribe(function(goal) {
            console.log(goal);
            y = goal.pose.position.y;
            x = goal.pose.position.x;
            document.getElementById('actualGoal').innerHTML = `(${x}, ${y})`;
        });
    </script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.5.1.slim.min.js')}}" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="{{asset('js/popper.min.js')}}" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
