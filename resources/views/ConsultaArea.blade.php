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
<h2 class="card-title" align="center">CONSULTA DE AREAS</h2>
    <table  class="table table-responsive*md table-striped table-dark table-hover" align="center">
        <thead>
            <tr>
                <td>ID</td>
                <td>Areas</td>
                <td>description</td>
                <td>Fecha</td>
                <td>Acción </td>
                <td>Acción </td>

            </tr>
        </thead>
        <tbody>
            @foreach($listado as $listaAreas)
            <tr>
                <td>{{$listaAreas->id_areas}}</td>
                <td>{{$listaAreas->nameArea}}</td>
                <td>{{$listaAreas->description}}</td>
                <td>{{$listaAreas->fecha}}</td>
                <td> 
                    <form method="get" action="{{url('destroy', $listaAreas->id_areas)}}">
                    {{csrf_field()}}
                    <button class="btn btn-danger" type="submit">Delete</button>
                    </from>
                    <td><a href="{{url('edit', $listaAreas->id_areas)}}" class="btn btn-light">Editar</a></td>
                </tr>
            @endforeach
                
        </tbody>

    </table>
    <a href="formularioUsuario" class="btn btn-success"> Registar nueva area</a>

         
</body>
</html>