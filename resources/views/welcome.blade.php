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

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Aprosoft</title>
</head>
<body>
    <!--<button id="start" > Start </button>
    <button id="reboot">Reiniciar</button>
    <button id="taskInit">TaskM</button>
    -->
    <div class="d-none d-lg-block d-md-block">

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
                            <div id="dashboardMissionBox" class="modal-body row justify-content-around m-0 p-3">

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




    <script src="{{asset('/js/rosConfig.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{asset('/js/robotics.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>



</body>
</html>
