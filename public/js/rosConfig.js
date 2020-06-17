var title = document.getElementById('actualStatus');
var actualDoingSpan = document.getElementById('actualDoingSpan');
    title.innerHTML = 'Desconectado';
var ros = new ROSLIB.Ros({
    url : 'ws://192.168.1.84:9090'
});

ros.on('connection', function() {
    title.innerHTML = 'Disponible';
    console.log('Connected to websocket server.');
    document.getElementById('btnTini').style.backgroundColor = '#11dbca';
});

ros.on('error', function(error) {
    title.innerHTML = 'Desconectado';
    console.log('Error connecting to websocket server: ', error);
    document.getElementById('btnTini').style.backgroundColor = '#ed5353';
});

var mapBox = document.getElementById('mapBox');
var newWidth = 160;
var res = mapBox.offsetWidth - newWidth;
document.getElementById('map').style.marginLeft = res/2 + 'px';
var viewer = new ROS2D.Viewer({
divID : 'map',
width : 160,
height : 288 ,
});

var gridClient = new ROS2D.OccupancyGridClient({
ros : ros,
rootObject : viewer.scene
});

gridClient.on('change', function(){
viewer.scaleToDimensions(gridClient.currentGrid.width, gridClient.currentGrid.height);
viewer.shift(gridClient.currentGrid.pose.position.x, gridClient.currentGrid.pose.position.y);
});

document.getElementById('map2').style.marginLeft = res/2 + 'px';
// Create the main viewer.
var viewer2 = new ROS2D.Viewer({
divID : 'map2',
width : 160,
height : 288 ,
});

// Setup the map client.
let gridClient2 = new NAV2D.OccupancyGridClientNav({
    ros : ros,
    rootObject : viewer2.scene,
    viewer: viewer2,
    serverName: '/move_base'
});

var ip = ['192.168.1.84', '192.168.1.84'];
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

function sendGoalPosition(goal_name, x1, y1){
    var taskManager = new ROSLIB.ActionClient({
        ros : ros,
        serverName : '/task_manager',
        actionName : 'simulation_msgs/TaskManagerAction'
    });
    var positionVec3 = new ROSLIB.Vector3(null);
    var orientation = new ROSLIB.Quaternion({x:0, y:0, z:0, w:1.0});

    positionVec3.x = x1;
    positionVec3.y = y1;

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

function wait(ms){
    var start = new Date().getTime();
    var end = start;
    while(end < start + ms) {
        end = new Date().getTime();
    }
    }

function sendMission(id){
    axios.get('/getMissions')
    .then(function (response) {
        // handle success
        console.log(response.data);
        var missions = response.data;
        var i;
        for (i = 0; i < missions.length; i++) {
            if(missions[i].id = id){
                missions[i].tasks.forEach(task => {

                    if(task.type == 1){
                        console.log('tipo 1');
                        sendGoalTime(task.goal_name, task.wait_time);

                    }
                    if(task.type == 2){
                        console.log('tipo 2');
                        sendGoalPosition(task.goal_name, task.x, task.y);

                    }
                    wait(2000);
                });
                break;
            }
        }
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    })
    .then(function () {
        // always executed
    });
}

    /*
    var explore_status = new ROSLIB.Topic({
    ros : ros,
    name : '/explore_status',
    messageType : 'std_msgs/Bool'
});

explore_status.subscribe(function(explore) {
    console,log('Listo explore: ' + explore);
});

var start = new ROSLIB.Topic({
    ros : ros,
    name : '/start',
    messageType : 'std_msgs/Bool'
});

var startBtn = document.getElementById('start');
startBtn.addEventListener('click', function(){
    console.log('btnStartClick');
    var twist = new ROSLIB.Message({
        data: true
    });
    start.publish(twist);
});

var mapStatus = new ROSLIB.Topic({
    ros : ros,
    name : '/mapstatus',
    messageType : 'std_msgs/Bool'
});

var rebootBtn = document.getElementById('reboot');
rebootBtn.addEventListener('click', function(){
    console.log('btnRebootClick');

    var twist2 = new ROSLIB.Message({
        data: 2
    });
    mapStatus.publish(twist2);
});

var taskInitBtn = document.getElementById('taskInit');
taskInitBtn.addEventListener('click', function(){
    var twist3 = new ROSLIB.Message({
        data: 1
    });
    mapStatus.publish(twist3);
});

    */

//
