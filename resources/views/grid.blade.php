
@extends('header')

@section('body')
<div class="flex-center position-ref ">
    <div class="container pt-3">
        <div class="card ">
            <div class="row m-2">
                <a href="/create" class="btn btn-success">Adicionar</a>
            </div>

            <table class="table">
                <thead class="thead">
                    <tr>
                        <th>Id</th>
                        <th class="esq">Nome</th>
                        <th class="esq">Email</th>
                        <th width="5"></th>
                        <th width="5"></th>
                    </tr>
                    
                </thead>
                <tbody id="tbody">
      
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    
    function deleteUser(id){
        $.ajax({
            url: "http://localhost:8000/api/users/"+id,
            type: "DELETE",
            success: function(data) {
                window.location.reload();
                alert(data.msg);
            }
        });
    }

    $.ajax({
        url: "http://localhost:8000/api/users/",
        type: "GET",
        dataType: "json",
        success: function(data) {
            data.forEach(value => {
                document.getElementById('tbody').innerHTML += `<tr>
                                    <th>${value.id}</th>
                                    <th class="esq">${value.name}</th>
                                    <th class="esq">${value.email}</th>
                                    <th><a href="/update/${value.id}" class="btn btn-info">Editar</a></th>
                                    <th><a onclick="deleteUser(${value.id})" class="btn btn-danger">Excluir</a></th>
                                </tr>`;
            });
        }
    });
    
</script>


@endsection
