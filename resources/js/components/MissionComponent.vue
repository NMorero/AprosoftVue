<template>
    <div id="dashboard">
       <div class="border boxInfo rounded p-2 pt-3">
            <p class="mb-2 titleInfoData">Actual status</p>
            <div class="bg-primary infoBoxData rounded text-center ">
                <span>Ocupied</span>
            </div>

            <div class="bg-primary infoBoxData rounded text-center ">
                <span>Doing: {{actualDoing}}</span>
            </div>

            <div class="bg-primary infoBoxData rounded text-center ">
                <span>Next: </span>
            </div>
        </div>

        <div class="border boxInfo rounded p-2 pt-3">
            <p class="mb-2 titleInfoData">Orders</p>
            <div class="bg-primary infoBoxData rounded text-center ">
                <span>Choose mission</span>
            </div>

            <div class="bg-primary infoBoxData rounded text-center ">
                <span>Choose task</span>
            </div>

            <div class="bg-primary infoBoxData rounded text-center ">
                <span>Cancel</span>
            </div>
        </div>

        <div class="border boxInfo rounded p-2 pt-3 last">
            <p class="mb-2 titleInfoData">Last missions</p>
            <div class="bg-primary infoBoxData rounded text-center ">
                <span>Repartir</span>
            </div>

            <div class="bg-primary infoBoxData rounded text-center ">
                <span>Buscar</span>
            </div>

            <div class="bg-primary infoBoxData rounded text-center ">
                <span>Llevar a Leo</span>
            </div>
        </div>

        <div id="mapBox2">
            <div id="map2">

            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted(){
        var ros = new ROSLIB.Ros({
        url : 'ws://localhost:9090'
        });

        var mapBox = document.getElementById('mapBox2');
        var newWidth = (mapBox.offsetHeight * 160) / 288;
        var res = mapBox.offsetWidth - newWidth;

        document.getElementById('map2').style.marginLeft = res/2 + 'px';


        var viewer = new ROS2D.Viewer({
        divID : 'map2',
        width : newWidth,
        height : mapBox.offsetHeight,
        });
        let gridClient = new ROS2D.OccupancyGridClient({
            ros : ros,
            rootObject : viewer.scene,
        });
        // Scale the canvas to fit to the map
        gridClient.on('change', function(){
            viewer.scaleToDimensions(gridClient.currentGrid.width, gridClient.currentGrid.height);
            viewer.shift(gridClient.currentGrid.pose.position.x, gridClient.currentGrid.pose.position.y);
        });
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
    },
    data(){
        return{
            actualDoing: 'Actual Mission',

        }
    }
}
</script>
