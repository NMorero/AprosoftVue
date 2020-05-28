<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto:wght@400;500&family=Ubuntu&display=swap" rel="stylesheet">
    <script src="js/nav2d.js"></script>
    <script type="text/javascript" src="http://static.robotwebtools.org/EaselJS/current/easeljs.min.js"></script>
    <script type="text/javascript" src="http://static.robotwebtools.org/EventEmitter2/current/eventemitter2.min.js"></script>
    <script src="js/roslibjs.js"></script>
    <script src="js/ros2djs.js"></script>
    <title>Aprosoft</title>
</head>
<body>
    <div>
        <div class="d-flex" id="wrapper">

            <!-- Sidebar -->
            <div class="bg-light border-right" id="sidebar-wrapper">
              <div class="sidebar-heading">Aprosoft</div>
              <div class="list-group list-group-flush">

                <button class="list-group-item btnMenu" id="btnMenu1" onclick="activeBtn('btnMenu1', 'dashboard'); ">Dashboard</button>
                <button class="list-group-item btnMenu" id="btnMenu2" onclick="activeBtn('btnMenu2', 'mission'); ">Mission</button>
                <button class="list-group-item btnMenu" id="btnMenu3" onclick="activeBtn('btnMenu3', 'status'); ">Status</button>

              </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
            <!-- Inactive components will be cached! -->
            <div id="header" class="">

                <div class="boxTitleRobot">
                    <span class="btnTina" id="btnTini">
                    Tini
                    </span>

                </div>

            </div>


                <div id="dashboard" class="primaryContent">
                    <div class="border boxInfo rounded p-2 pt-3">
                        <p class="mb-2 titleInfoData">Actual status</p>
                        <div class="spanBoxInfo infoBoxData rounded text-center pt-1">
                            <span id="actualStatus">Available</span>
                        </div>

                        <div class="spanBoxInfo infoBoxData rounded text-left pl-2 pt-1">
                            <span>Doing:</span>
                        </div>

                        <div class="spanBoxInfo infoBoxData rounded text-left pl-2 pt-1">
                            <span>Next: </span>
                        </div>
                    </div>

                    <div class="border boxInfo rounded p-2 pt-3">
                        <p class="mb-2 titleInfoData">Orders</p>
                        <div class="hoverButton infoBoxData rounded text-left pl-2 pt-1">
                            <span>Choose mission</span>
                        </div>

                        <div class="hoverButton infoBoxData rounded text-left pl-2 pt-1">
                            <span>Choose task</span>
                        </div>

                        <div class="hoverButton infoBoxData rounded text-left pl-2 pt-1">
                            <span>Cancel</span>
                        </div>
                    </div>

                    <div class="border boxInfo rounded p-2 pt-3 last">
                        <p class="mb-2 titleInfoData">Last missions</p>
                        <div class="spanBoxInfo infoBoxData rounded text-left pl-2 pt-1">
                            <span>Repartir</span>
                        </div>

                        <div class="spanBoxInfo infoBoxData rounded text-left pl-2 pt-1">
                            <span>Buscar</span>
                        </div>

                        <div class="spanBoxInfo infoBoxData rounded text-left pl-2 pt-1">
                            <span>Llevar a Leo</span>
                        </div>
                    </div>

                    <div id="mapBox">
                        <div id="map">

                        </div>
                    </div>
                </div>


                <div id="mission" class="primaryContent" >

                    <div class="border boxInfo rounded p-2 pt-3">
                        <p class="mb-4 titleInfoData">Missions</p>
                        <div class="hoverButton infoBoxData rounded text-center pt-1">
                            <span>Add</span>
                        </div>

                        <div class="hoverButton infoBoxData rounded text-center pl-2 pt-1 ">
                            <span>Administrate</span>
                        </div>

                    </div>




                    <div id="mapBox2">
                        <div id="map2">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




    <script>
        var title = document.getElementById('actualStatus');
            title.innerHTML = 'Disconected';
        var ros = new ROSLIB.Ros({
        url : 'ws://localhost:9090'
        });

        ros.on('connection', function() {
            title.innerHTML = 'Available';
            console.log('Connected to websocket server.');
            document.getElementById('btnTini').style.backgroundColor = '#04e53c';
        });

        ros.on('error', function(error) {
            title.innerHTML = 'Disconected';
            console.log('Error connecting to websocket server: ', error);
            document.getElementById('btnTini').style.backgroundColor = '#ed5353';
        });

        var mapBox = document.getElementById('mapBox');
        var newWidth = ((mapBox.offsetHeight * 160) / 288);
        var res = mapBox.offsetWidth - newWidth;

        document.getElementById('map').style.marginLeft = res/2 + 'px';


        var viewer = new ROS2D.Viewer({
        divID : 'map',
        width : newWidth,
        height : mapBox.offsetHeight ,

        });
        let gridClient = new NAV2D.OccupancyGridClientNav({
            ros : ros,
            rootObject : viewer.scene,
            viewer: viewer,
            serverName: '/move_base'
        });
        // Scale the canvas to fit to the map

        var ip = ['localhost']
        var robotMarkers = [];
        var topics = [];

        var createFunc = function (handlerToCall, discriminator, robotMarker) {
                return discriminator.subscribe(function(pose){
                    robotMarker.x = pose.pose.pose.position.x;
                    robotMarker.y = -pose.pose.pose.position.y;
                    var quaZ = pose.pose.pose.orientation.z;
                    var degreeZ = 0;
                    if( quaZ >= 0 ) {
                        degreeZ = quaZ / 1 * 180
                    } else {
                        degreeZ = (-quaZ) / 1 * 180 + 180
                    };
                    robotMarker.rotation = -degreeZ + 35;
                })
            }

        for(let i = 0; i < ip.length; i++){
                let ros = new ROSLIB.Ros({
                    url : 'ws://' + ip[i] + ':9090'
                });
                // Setup the map client.
                var robotMarker = new ROS2D.NavigationArrow({
                    size : 0.25,
                    strokeSize : 0.05,
                    pulse: true,
                    fillColor: createjs.Graphics.getRGB(254, 25, 200, 0.65)
                });
                robotMarkers.push(robotMarker)
                var poseTopic = new ROSLIB.Topic({
                    ros: ros,
                    name: '/amcl_pose',
                    messageType: 'geometry_msgs/PoseWithCovarianceStamped'
                });
                topics.push(poseTopic);
                createFunc('subscribe', poseTopic, robotMarker);
            }

        for(let i = 0; i < robotMarkers.length; i++){
                gridClient.rootObject.addChild(robotMarkers[i]);
            }


                // Monitoring /move_base/result
        var move_baseListener = new ROSLIB.Topic({
            ros : ros,
            name : '/move_base/result',
            messageType : 'move_base_msgs/MoveBaseActionResult'
        });
        var title = document.getElementById('actualStatus');
            console.log(title.innerHTML);
        move_baseListener.subscribe(function(actionResult) {
            console.log('Received message on ' + move_baseListener.name + 'status: 1');
            title.innerHTML = 'Available';

            // actionResult.status.status == 2 (goal cancelled)
            // actionResult.status.status == 3 (goal reached)
        //    move_baseListener.unsubscribe();
        });

        var move_baseListenerFeed = new ROSLIB.Topic({
            ros : ros,
            name : '/move_base/feedback',
            messageType : 'move_base_msgs/MoveBaseActionFeedback'
        });

        move_baseListenerFeed.subscribe(function(actionResult) {
            console.log('Received message on feedbacfk ' + actionResult);
            title.innerHTML = 'Ocupied';
        });


        var move_baseListenerStatus = new ROSLIB.Topic({
            ros : ros,
            name : '/move_base/feedback',
            messageType : 'move_base_msgs/MoveBaseActionFeedback'
        });

        move_baseListenerStatus.subscribe(function(actionResult) {
            console.log('Received message on feedbacfk ' + actionResult);

        });

            document.getElementById('btnMenu1').style.background = 'linear-gradient(to right, #8111f9, #58abef)';
            document.getElementById('btnMenu1').style.color = '#ffffff';




    </script>

    <script>
        function activeBtn(btn, content){
                var btns = document.querySelectorAll('.btnMenu');
                btns.forEach(btn => {
                    btn.style.background = '#F8F9FA';
                    btn.style.color = '#000000';
                });
                document.getElementById(btn).style.background = 'linear-gradient(to right, #8111f9, #58abef)';
                document.getElementById(btn).style.color = 'white';

                var primaryContents = document.querySelectorAll('.primaryContent');

                primaryContents.forEach(content => {
                    content.style.display = 'none';
                });
                document.getElementById(content).style.display = 'block';
            }
    </script>

</body>
</html>
