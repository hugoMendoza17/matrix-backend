<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> </title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    </head>
<body>

<h2 class="card-title" align="center">Q-A MATRIX</h2>
<h2 class="card-title" align="center">CONSULTA DE USUARIOS</h2>
    <table  class="table table-responsive*md table-striped table-dark table-hover" align="center">
        <thead>
            <tr>
                <td>ID</td>
                <td>Usuario</td>
                <td>Contraseña</td>
                <td>TipodeUsuario</td>
                <td>Acción </td>
                <td>Acción </td>

            </tr>
        </thead>
        <tbody>
            @foreach($listado as $listaUsuario)
            <tr>
                <td>{{$listaUsuario->id_user}}</td>
                <td>{{$listaUsuario->name}}</td>
                <td>{{$listaUsuario->password}}</td>
                <td>{{$listaUsuario->tipoUsuario}}</td>
                <td> 
                    <form method="get" action="{{url('destroy', $listaUsuario->id_user)}}">
                    {{csrf_field()}}
                    <button class="btn btn-danger" type="submit">Delete</button>
                    </from>
                    <td><a href="{{url('edit', $listaUsuario->id_user)}}" class="btn btn-light">Editar</a></td>
                </tr>
            @endforeach
                
        </tbody>

    </table>
    <a href="formularioUsuario" class="btn btn-success"> NUEVO REGISTRO</a>

         
</body>
</html>