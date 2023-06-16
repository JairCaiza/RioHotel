<?php
require_once("../controlador/frmConfig.php");
$ruta = new classConfig();
$dirSelect = $ruta->rutaSelect();

session_start();
$usuario = $_SESSION['usuario'];
if ($usuario == '')
    header("Location: ../index.html");
else {
    $perfilUser = json_decode(file_get_contents($dirSelect . 'opc=dosDatos&cual=1&dato1=' . $usuario . '&dato2=1'), true);
    $rolesUser = json_decode(file_get_contents($dirSelect . 'opc=unDato&cual=1&dato=' . $usuario), true);
    if (!$perfilUser['resultado'])
        header("Location: ../index.html");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RioHotel</title>

    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../controlador/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../controlador/alertifyjs/css/themes/default.css">
    <script src="../controlador/alertifyjs/alertify.js"></script>
    <script src="../controlador/recusoIngresoHotel.js"></script>
    <script src="../controlador/recursosSelectHotel.js"></script>
    <script src="../controlador/recursosHotel.js"></script>
</head>


<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="frmAdminInicio.php" class="site_title"><i class="fa fa-building-o"></i> <span>Rio Hotel</span></a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?php echo $perfilUser['respDatos'][0]['foto'] ?>" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Bienvenido,</span>
                            <h2> <?php echo $perfilUser['respDatos'][0]['strPersona_Nombres'] . ' ' . $perfilUser['respDatos'][0]['strPersona_Apellidos'] ?> </h2>
                        </div>
                    </div>
                    <br />
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">

                                <li><a><i class="fa fa-home"></i> Hotel <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="frmAdminHabitaciones.php">Habitaciones</a></li>
                                        <li><a href="frmAdminTipoHabitacion.php">Tipo Habitaciones</a></li>
                                        <li><a href="frmAdminEstHabitacion.php">Estado Habitaciones</a></li>
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-home"></i> Reservaciones <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="frmReservaHabitacion.php">Habitaciones Disponibles</a></li>
                                        <li><a href="frmReservaHabitacion.php">Mis Reservaciones</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo $perfilUser['respDatos'][0]['foto'] ?>" alt=""><?php echo $perfilUser['respDatos'][0]['strPersona_Nombres'] . ' ' . $perfilUser['respDatos'][0]['strPersona_Apellidos'] . " (" . $perfilUser['respDatos'][0]['strTipoUsuario_Detalle'] . ")" ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <?php
                                    for ($j = 0; $j < count($rolesUser['respDato']); $j++) {
                                        echo "<a class='dropdown-item' href=''> " . $rolesUser['respDato'][$j]['strTipoUsuario_Detalle'] . "</a>";
                                    }
                                    ?>
                                    <a class="dropdown-item" href="login.html"><i class="fa fa-user pull-right"></i> Perfil</a>
                                    <a class="dropdown-item" href="login.html"><i class="fa fa-sign-out pull-right"></i> Salir</a>
                                </div>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Tipo de Habitaciones <small>registro de tipo de habitaciones </small></h3>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>RioHotel <small>tipo de Habitaciones</small>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-AdminTipoHabitacion"> Nuevo Tipo </button>
                                    </h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box table-responsive">
                                                <table id="tblAdminTipoHabitacion" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 40%;">Detalle</th>
                                                            <th style="width: 10%;">Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodyAATipoHabitacion">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal-AdminTipoHabitacion">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Registro de Tipo de Habitación</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <label style="margin-top: 15px;">Detalle:</label>
                                    <textarea class="form-control" id="txtAATHDetalle" rows="3" placeholder="Ingrese la descripción de la habitación"></textarea>

                                    <label style="margin-top: 15px;">Estado</label>
                                    <select id="cmdAATipoHEstado" class="form-control">
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>

                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary" onclick="ingresoAdTipoHabitacion()">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    RioHotel Riobamba
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <script src="../vendors/nprogress/nprogress.js"></script>
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="../build/js/custom.min.js"></script>


    <script type="text/javascript">
        $(function() {
            verAdminDataHotel(2, 2, 'tbodyAATipoHabitacion');
        });

        function ingresoAdTipoHabitacion() {
            guardarFormDataHotel(4, $('#txtAATHDetalle').val(), $('#cmdAATipoHEstado').val(), 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na',
            'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na');
        }
    </script>
</body>

</html>