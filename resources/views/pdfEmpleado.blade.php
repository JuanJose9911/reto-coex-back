<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Empleados</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $fecha }}</p>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Documento</th>
            <th>Nombre Completo</th>
            <th>Tipo Contrato</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Sueldo</th>
        </tr>

        
        <tr>
            <td>{{ $empleado->id }}</td>
            <td>{{ $empleado->documento }}</td>
            <td>{{ $empleado->nombre }} {{ $empleado->apellidos }}</td>
            <td>{{ $empleado->nomContrato }}</td>
            <td>{{ $empleado->telefono }}</td>
            <td>{{ $empleado->direccion }}</td>
            <td>{{ $empleado->sueldo }}</td>
        </tr>
    
    </table>
</body>
</html>