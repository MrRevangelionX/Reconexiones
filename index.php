<?php
    require_once('./assets/db.php');

    $consulta = "select
                    SCC.codcliente as CODIGO,
                    SSD.codctaservicio as CUENTA,
                    GC.nomcliente1 + ' ' + GC.nomcliente2 + ' ' + GC.apellidocliente1 + ' ' + GC.apellidocliente2 as CLIENTE,
                    CAST( SSD.fechatransaccion AS Date ) as FECHA_PAGO,
                    GS.nomsucursal as SUCURSAL,
                    GP.nomproyecto as PROYECTO,
                    SCC.poligono as POLIGONO,
                    SCC.lote as LOTE
                from ser_servicios_det SSD
                inner join ser_cuenta_cliente SCC on SCC.codctaservicio = SSD.codctaservicio
                inner join gen_cliente GC on GC.codcliente = SCC.codcliente
                inner join gen_sucursal GS on GS.codsucursal = SCC.codsucursal
                inner join gen_proyecto GP on GP.codproyecto = SCC.codproyecto
                where fechatransaccion between CAST( GETDATE() - 30 AS Date ) and CAST( GETDATE() AS Date )
                and SSD.codtiposervicio = 1
                and SSD.codtipotransaccion = 62
                and SSD.estadocancelado = 1
                order by SSD.fechatransaccion desc";

    $resultado = Query($consulta);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RECONEXIONES | SEAC</title>
    <link rel="shortcut icon" href="./assets/images/Logo SEAC.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>
</head>
<body>
    <header>
        <div class="header">
            <nav class="navbar navbar-expand-lg navbar-success bg-success  justify-content-between">
                <h1 class="navbar-brand text-light mx-3">SEAC | Informe de Reconexiones</h1>
                <img class="img-fluid" src="./assets/images/Logo SEAC.png" alt="Seguridad Activa de El Salvador">
            </nav>
        </div>
    </header>
    <main>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <span class="m-0 font-weight-bold text-primary">Reconexiones de Servicios de Agua</span>
                </div>
                <div class="card-body">
                    <div>
                        <table class="table table-bordered rounded" id="table_reconections" name="table_reconections" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-info">
                                    <th>CODIGO</th>
                                    <th>CUENTA</th>
                                    <th>CLIENTE</th>
                                    <th>FECHA PAGO</th>
                                    <th>SUCURSAL</th>
                                    <th>PROYECTO</th>
                                    <th>POLIGONO</th>
                                    <th>LOTE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($resultado as $row){
                                        echo "<tr class='table-success'>";
                                        echo    "<td>".$row['CODIGO']."</td>";
                                        echo    "<td>".$row['CUENTA']."</td>";
                                        echo    "<td>".$row['CLIENTE']."</td>";
                                        echo    "<td>".$row['FECHA_PAGO']."</td>";
                                        echo    "<td>".$row['SUCURSAL']."</td>";
                                        echo    "<td>".$row['PROYECTO']."</td>";
                                        echo    "<td>".$row['POLIGONO']."</td>";
                                        echo    "<td>".$row['LOTE']."</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.2/r-2.2.9/datatables.min.js"></script>
<script src="./assets/js/app.js"></script>
</body>
</html>