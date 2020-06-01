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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
                <button class="list-group-item btnMenu" id="btnMenu3" onclick="activeBtn('btnMenu3', 'status'); " disabled>Status</button>
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
                            <span id="actualDoingSpan">Doing:</span>
                        </div>

                        <div class="spanBoxInfo infoBoxData rounded text-left pl-2 pt-1">
                            <span>Next: </span>
                        </div>
                    </div>

                    <div class="border boxInfo rounded p-2 pt-3">
                        <p class="mb-2 titleInfoData">Orders</p>
                        <div class="hoverButton infoBoxData rounded text-left pl-2 pt-1" data-toggle="modal" data-target="#chooseMissionModal">
                            <span>Choose mission</span>
                        </div>

                        <button  class="hoverButton infoBoxData rounded text-left pl-2 pt-1" data-toggle="modal" data-target="#chooseTaskModal">
                            <span>Choose task</span>
                        </button>

                        <div id="cancelActual" class="hoverButton infoBoxData rounded text-left pl-2 pt-1">
                            <span>Cancel</span>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="chooseTaskModal" tabindex="-1" role="dialog" aria-labelledby="chooseTaskModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bgDegraded">
                            <h5 class="modal-title" id="chooseTaskModalLabel">Choose task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div id="bodyModalTasksDashboard" class="modal-body row justify-content-around m-0 p-3">


                            </div>
                            <div class="modal-footer bgDegraded">
                            <button type="button" class="btn bg-none text-white" data-dismiss="modal">Cancel</button>

                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- ----- END MODAL -->

                     <!-- Modal -->
                     <div class="modal fade" id="chooseMissionModal" tabindex="-1" role="dialog" aria-labelledby="chooseMissionModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bgDegraded">
                            <h5 class="modal-title" id="chooseMissionModalLabel">Choose mission</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body row justify-content-around m-0 p-3">
                                <button class="boxInfoModal text-black col-3 mx-1 p-1 text-center border rounded my-2">
                                    <h6>Mission 1</h6>
                                    <span>
                                        Ir a posicion 1 <br> Ir a posicion 2
                                    </span>
                                </button>
                                <button class="boxInfoModal text-black col-3 mx-1 p-1 text-center border rounded my-2">
                                    <h6>Mission 2</h6>
                                    <span>
                                        Ir a posicion 4 <br> Ir a posicion 1 <br> Ir a posicion 2
                                    </span>

                                </button>
                                <button class="boxInfoModal text-black col-3 mx-1 p-1 text-center border rounded my-2">
                                    <h6>Mission 3</h6>
                                    <span>
                                        Ir a posicion 2 <br> Ir a posicion 1 <br> Ir a posicion 4
                                    </span>

                                </button>
                            </div>
                            <div class="modal-footer bgDegraded">
                            <button type="button" class="btn bg-none text-white" data-dismiss="modal">Cancel</button>

                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- ----- END MODAL -->


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
                        <p class="mb-4 titleInfoData">Tasks</p>
                        <button id="" class="hoverButton infoBoxData rounded text-center pt-1" data-toggle="modal" data-target="#addTaskModal">
                            <span>Add</span>
                        </button>

                        <button id="" class="hoverButton infoBoxData rounded text-center pt-1" data-toggle="modal" data-target="#adminTaskModal">
                            <span>Administrate</span>
                        </button>

                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="adminTaskModal" tabindex="-1" role="dialog" aria-labelledby="adminTaskModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bgDegraded">
                            <h5 class="modal-title" id="adminTaskModalLabel">Tasks</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div id="bodyModalTasksMission" class="modal-body row justify-content-around m-0 p-3">
                                <div class="boxInfoModal col-3 mx-1 p-1 text-center border rounded my-2">
                                    <span>Ir a posicion 1</span>
                                </div>

                            </div>
                            <div class="modal-footer bgDegraded">
                            <button type="button" class="btn bg-none text-white" data-dismiss="modal">Close</button>
                            <button type="button" class="btn border bg-none text-white">Save changes</button>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- ----- END MODAL -->

                    <!-- Modal -->
                    <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bgDegraded">
                            <h5 class="modal-title" id="addTaskModalLabel">Add Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body row justify-content-around m-0 p-3">
                                <form action="">

                                </form>
                            </div>
                            <div class="modal-footer bgDegraded">
                            <button type="button" class="btn bg-none text-white" data-dismiss="modal">Close</button>
                            <button type="button" class="btn border bg-none text-white">Save changes</button>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- ----- END MODAL -->


                    <div class="border boxInfo rounded p-2 pt-3">
                        <p class="mb-4 titleInfoData">Missions</p>
                        <button id="addTask" class="hoverButton infoBoxData rounded text-center pt-1" data-toggle="modal" data-target="#addMissionModal">
                            <span>Add</span>
                        </button>

                        <button class="hoverButton infoBoxData rounded text-center pl-2 pt-1 "  data-toggle="modal" data-target="#adminMissionModalcd ">
                            <span>Administrate</span>
                        </button>

                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="adminMissionModal" tabindex="-1" role="dialog" aria-labelledby="adminMissionModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bgDegraded">
                            <h5 class="modal-title" id="adminMissionModalLabel">Choose mission</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body row justify-content-around m-0 p-3">
                                <button class="boxInfoModal text-black col-3 mx-1 p-1 text-center border rounded my-2">
                                    <h6>Mission 1</h6>
                                    <span>
                                        Ir a posicion 1 <br> Ir a posicion 2
                                    </span>
                                </button>
                                <button class="boxInfoModal text-black col-3 mx-1 p-1 text-center border rounded my-2">
                                    <h6>Mission 2</h6>
                                    <span>
                                        Ir a posicion 4 <br> Ir a posicion 1 <br> Ir a posicion 2
                                    </span>

                                </button>
                                <button class="boxInfoModal text-black col-3 mx-1 p-1 text-center border rounded my-2">
                                    <h6>Mission 3</h6>
                                    <span>
                                        Ir a posicion 2 <br> Ir a posicion 1 <br> Ir a posicion 4
                                    </span>

                                </button>
                            </div>
                            <div class="modal-footer bgDegraded">
                            <button type="button" class="btn bg-none text-white" data-dismiss="modal">Cancel</button>

                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- ----- END MODAL -->

                    <!-- Modal -->
                    <div class="modal fade" id="addMissionModal" tabindex="-1" role="dialog" aria-labelledby="addMissionModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bgDegraded">
                            <h5 class="modal-title" id="addMissionModalLabel">Add Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body row justify-content-around m-0 p-3">
                                <form action="">

                                </form>
                            </div>
                            <div class="modal-footer bgDegraded">
                            <button type="button" class="btn bg-none text-white" data-dismiss="modal">Close</button>
                            <button type="button" class="btn border bg-none text-white">Save changes</button>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- ----- END MODAL -->



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
        var actualDoingSpan = document.getElementById('actualDoingSpan');
            title.innerHTML = 'Disconected';
        var ros = new ROSLIB.Ros({
            url : 'ws://186.108.202.172:9090'
        });

        ros.on('connection', function() {
            title.innerHTML = 'Available';
            console.log('Connected to websocket server.');
            document.getElementById('btnTini').style.backgroundColor = '#11dbca';
        });

        ros.on('error', function(error) {
            title.innerHTML = 'Disconected';
            console.log('Error connecting to websocket server: ', error);
            document.getElementById('btnTini').style.backgroundColor = '#ed5353';
        });

        var mapBox = document.getElementById('mapBox');
        var newWidth = ((mapBox.offsetHeight * 220) / 288);
        var res = mapBox.offsetWidth - newWidth;

        document.getElementById('map').style.marginLeft = res/2 + 'px';


        var viewer = new ROS2D.Viewer({
        divID : 'map',
        width : newWidth,
        height : mapBox.offsetHeight ,

        });
        var gridClient = new ROS2D.OccupancyGridClient({
        ros : ros,
        rootObject : viewer.scene
        });

        gridClient.on('change', function(){
        viewer.scaleToDimensions(gridClient.currentGrid.width, gridClient.currentGrid.height);
        viewer.shift(gridClient.currentGrid.pose.position.x, gridClient.currentGrid.pose.position.y);
        });


         // ----------------------------------------- //


         document.getElementById('map2').style.marginLeft = res/2 + 'px';
        // Create the main viewer.
        var viewer2 = new ROS2D.Viewer({
        divID : 'map2',
        width : newWidth,
        height : mapBox.offsetHeight ,
        });

        // Setup the map client.
        let gridClient2 = new NAV2D.OccupancyGridClientNav({
            ros : ros,
            rootObject : viewer2.scene,
            viewer: viewer2,
            serverName: '/move_base'
        });
        // Scale the canvas to fit to the map

        // Scale the canvas to fit to the map

        var ip = ['186.108.202.172', '186.108.202.172'];
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
            gridClient.rootObject.addChild(robotMarkers[0]);
            gridClient2.rootObject.addChild(robotMarkers[1]);



                // Monitoring /move_base/result


        var task_manager_feedback = new ROSLIB.Topic({
            ros : ros,
            name : '/task_manager/feedback',
            messageType : 'simulation_msgs/TaskManagerActionFeedback'
        });

        task_manager_feedback.subscribe(function(feedback) {
            console.log('feedback' + feedback.feedback.goal_name);
            actualDoingSpan.innerHTML = 'Doing: ' + feedback.feedback.goal_name;
            title.innerHTML = 'Ocupied';
        });

        var task_manager_result = new ROSLIB.Topic({
            ros : ros,
            name : '/task_manager/result',
            messageType : 'simulation_msgs/TaskManagerActionResult'
        });

        task_manager_result.subscribe(function(feedback) {
            actualDoingSpan.innerHTML = 'Doing: None';
            title.innerHTML = 'Available';
        });



        var amcl_poseEcho = new ROSLIB.Topic({
            ros : ros,
            name : '/amcl_pose',
            messageType : 'geometry_msgs/PoseWithCovarianceStamped'
        });

        function getActualPose(){
            amcl_poseEcho.subscribe(function(pose) {
                console.log('x: ' + pose.pose.pose.position.x);
                console.log('y: ' + pose.pose.pose.position.y);
            amcl_poseEcho.unsubscribe();
            });
        }
        getActualPose();
        var add = document.getElementById('addTask');
        add.addEventListener("click", getActualPose);

        //var senGoal = document.getElementById('sendGoal');
        //senGoal.addEventListener("click", sendGoal);
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


        function sendGoalPosition(goal_name, x, y){
            var taskManager = new ROSLIB.ActionClient({
                ros : ros,
                serverName : '/task_manager',
                actionName : 'simulation_msgs/TaskManagerAction'
            });
            var positionVec3 = new ROSLIB.Vector3(null);
            var orientation = new ROSLIB.Quaternion({x:0, y:0, z:0, w:1.0});

            positionVec3.x = x;
            positionVec3.y = y;

            var pose = new ROSLIB.Pose({
                position : positionVec3,
                orientation : orientation
            });
            /*var goalEx = new ROSLIB.Goal({
                actionClient : actionClient,
                goalMessage : {
                    target_pose : {
                    header : {
                        frame_id : 'map'
                    },
                    pose : pose
                    }
                }
                });
                */
            var goal = new ROSLIB.Goal({
                actionClient : taskManager,
                goalMessage : {
                    type : 2,
                    goal_name: goal_name,
                    x: pose.position.x,
                    y: pose.position.y,
                    z: pose.orientation.z,
                    w: pose.orientation.w,
                    }
                });
            goal.send();
        }

        function sendGoalTime(goal_name, wait_time){
            var taskManager = new ROSLIB.ActionClient({
                ros : ros,
                serverName : '/task_manager',
                actionName : 'simulation_msgs/TaskManagerAction'
            });
            var goal = new ROSLIB.Goal({
                actionClient : taskManager,
                goalMessage : {
                    type : 1,
                    goal_name: goal_name,
                    wait_time: wait_time
                    }
                });
            goal.send();
        }




    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>

        document.getElementById('btnMenu1').style.backgroundColor = '#681be5';
        document.getElementById('btnMenu1').style.color = '#ffffff';


        function activeBtn(btn, content){
                var btns = document.querySelectorAll('.btnMenu');
                btns.forEach(btn => {
                    btn.style.background = '#F8F9FA';
                    btn.style.color = '#000000';
                });
                document.getElementById(btn).style.backgroundColor = '#681be5';
                document.getElementById(btn).style.color = 'white';

                var primaryContents = document.querySelectorAll('.primaryContent');

                primaryContents.forEach(content => {
                    content.style.display = 'none';
                });
                document.getElementById(content).style.display = 'block';
            }


            /* axios.post('/user', {
                firstName: 'Fred',
                lastName: 'Flintstone'
            })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });

            */

            var divTasksDashboard = document.getElementById('bodyModalTasksDashboard');
            var divTasksMission = document.getElementById('bodyModalTasksMission')

            axios.get('/getTasks')
            .then(function (response) {
                // handle success
                console.log(response.data);
                response.data.forEach(task => {
                    if(task.type == 1){
                        var templateDashboard = `
                        <button onclick="sendGoalTime('${task.goal_name}', ${task.wait_time})" class="boxInfoModal text-black col-3 mx-1 p-1 text-center border rounded my-2">
                            <span>${task.goal_name}</span>
                        </button>
                    `;
                    }else{
                        var templateDashboard = `
                        <button onclick="sendGoalPosition('${task.goal_name}', ${task.x}, ${task.y})" class="boxInfoModal text-black col-3 mx-1 p-1 text-center border rounded my-2">
                            <span>${task.goal_name}</span>
                        </button>
                    `;
                    }



                    var templateMission = `
                        <div class="boxInfoModal col-3 mx-1 p-1 text-center border rounded my-2">
                            <span>${task.goal_name}</span>
                        </div>
                    `

                    divTasksDashboard.innerHTML = divTasksDashboard.innerHTML.concat(templateDashboard);
                    divTasksMission.innerHTML = divTasksMission.innerHTML.concat(templateMission);
                });
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });

    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
