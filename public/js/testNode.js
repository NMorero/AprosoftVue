var ros = new ROSLIB.Ros({
    url : 'ws://192.168.1.84:9090'
});

ros.on('connection', function() {
    console.log('Connected to websocket server.');
    setTimeout(function(){
        document.getElementById('starting').style.display = 'none';
    var element = document.getElementById("body");
    element.classList.remove("bodyAlign")
    document.getElementById('exploration').style.display = 'block';
    }, 3000);

});

ros.on('error', function(error) {
    console.log('Error connecting to websocket server: ', error);
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

function wait(ms){
    var start = new Date().getTime();
    var end = start;
    while(end < start + ms) {
        end = new Date().getTime();
    }
}

var i = 1;
var startBtn = document.getElementById('start');
startBtn.addEventListener('click', function(){
    var twist = new ROSLIB.Message({
        data: true
    });
    start.publish(twist);

    document.getElementById('exploration').style.display = 'none';
    var element = document.getElementById("body");
    element.classList.add("bodyAlign")
    document.getElementById('exploring').style.display = 'block';
});

var explore_status = new ROSLIB.Topic({
    ros : ros,
    name : '/explore_status',
    messageType : 'std_msgs/Bool'
});

var flagExplo = 0;

explore_status.subscribe(function(explore) {
    flagExplo++;
    if(flagExplo == 2){
        console.log('Listo explore');
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
            var element = document.getElementById("body");
            element.classList.remove("bodyAlign")
            document.getElementById('exploring').style.display = 'none';
            document.getElementById('exploreEnd').style.display = 'block';
    }
});

var start = new ROSLIB.Topic({
    ros : ros,
    name : '/start',
    messageType : 'std_msgs/Bool'
});

var mapStatus = new ROSLIB.Topic({
    ros : ros,
    name : '/mapstatus',
    messageType : 'std_msgs/Bool'
});

var btnRedo = document.getElementById('redoBtn');
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

var btnDone = document.getElementById('saveBtn');
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
//end
