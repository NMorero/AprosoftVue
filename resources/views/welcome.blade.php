@extends('layoutHome')

@section('content')
<div class="d-none d-lg-block d-md-block">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
          <div class="sidebar-heading">Aprosoft</div>
          <div class="list-group list-group-flush">
            <button class="list-group-item btnMenu" id="btnMenu1" onclick="activeBtn('btnMenu1', 'dashboard'); ">Tablero</button>
            <button class="list-group-item btnMenu" id="btnMenu2" onclick="activeBtn('btnMenu2', 'mission'); ">Control de mision</button>
            <button class="list-group-item btnMenu" id="btnMenu3" onclick="activeBtn('btnMenu3', 'status'); " disabled>Etado</button>
          </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Inactive components will be cached! -->
            <div id="header" class="">
                <div class="boxTitleRobot">
                    <span class="btnTina" id="btnTini">
                    Pacho
                    </span>
                </div>
            </div>
            <div id="dashboard" class="primaryContent">
                <div class="border boxInfo rounded p-2 pt-3">
                    <p class="mb-2 titleInfoData">Estado actual</p>
                    <div class="spanBoxInfo infoBoxData rounded text-center pt-1">
                        <span id="actualStatus">Disponible</span>
                    </div>

                    <div class="spanBoxInfo infoBoxData rounded text-left pl-2 pt-1">
                        <span id="actualDoingSpan">Haciendo:</span>
                    </div>

                    <div class="spanBoxInfo infoBoxData rounded text-left pl-2 pt-1">
                        <span>Siguiente: </span>
                    </div>
                </div>
                <div class="border boxInfo rounded p-2 pt-3">
                    <p class="mb-2 titleInfoData">Ordenes</p>
                    <div class="hoverButton infoBoxData rounded text-left pl-2 pt-1" data-toggle="modal" data-target="#chooseMissionModal">
                        <span>Elegir mision</span>
                    </div>

                    <button  class="hoverButton infoBoxData rounded text-left pl-2 pt-1" data-toggle="modal" data-target="#chooseTaskModal">
                        <span>Elegir tarea</span>
                    </button>

                    <div id="cancelActual" class="hoverButton infoBoxData rounded text-left pl-2 pt-1">
                        <span>Cancelar</span>
                    </div>
                </div>
                <div class="border boxInfo rounded p-2 pt-3 last">
                    <p class="mb-2 titleInfoData">Ultimas misiones</p>
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
                    <p class="mb-4 titleInfoData">Tareas</p>
                    <button id="" class="hoverButton infoBoxData rounded text-center pt-1" data-toggle="modal" data-target="#addTaskModal">
                        <span>Agregar</span>
                    </button>
                    <button id="" class="hoverButton infoBoxData rounded text-center pt-1" data-toggle="modal" data-target="#adminTaskModal">
                        <span>Administrar</span>
                    </button>
                </div>
                <div class="border boxInfo rounded p-2 pt-3">
                    <p class="mb-4 titleInfoData">Missions</p>
                    <button id="addTask" class="hoverButton infoBoxData rounded text-center pt-1" data-toggle="modal" data-target="#addMissionModal">
                        <span>Agregar</span>
                    </button>
                    <button class="hoverButton infoBoxData rounded text-center pl-2 pt-1 "  data-toggle="modal" data-target="#adminMissionModalcd ">
                        <span>Administrar</span>
                    </button>
                </div>
                <div id="mapBox2">
                    <div id="map2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- -->
