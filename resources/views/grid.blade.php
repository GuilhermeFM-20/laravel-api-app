
@extends('header')

@section('body')
<div class="flex-center position-ref ">
    <div class="container pt-3">
        <div class="card ">
            <div class="row m-2">
                <div class="col-md-4 mb-3">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <a href="/create" class="btn btn-success mr-4">Adicionar</a>
                        <button type="submit" id="btn" class="input-group-text" id="inputGroupPrepend2" >🔎</button>
                        <input type="text" class="form-control" id="filter" placeholder="Busca" aria-describedby="inputGroupPrepend2">
                      </div>
                    </div>
                  </div>
            </div>

            <table class="table">
                <thead class="thead">
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Email</th>
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
        if(confirm(`O registro do id ${id} será excluído.`)){
            $.ajax({
                url: "http://localhost:8000/api/users/"+id,
                type: "DELETE",
                success: function(data) {
                    window.location.reload();
                    alert(data.msg);
                }
            });
        }
    }

    function editUser(id) {
        sessionStorage.setItem("id", id);
        window.location.href = "/update";
    }
    

    $.ajax({
        url: "http://localhost:8000/api/users/",
        type: "GET",
        dataType: "json",
        success: function(data) {
            data.forEach(value => {
                document.getElementById('tbody').innerHTML += `<tr>
                                    <th>${value.id}</th>
                                    <th>${value.name}</th>
                                    <th>${value.email}</th>
                                    <th><a onclick="editUser(${value.id})" class="btn btn-info">Editar</a></th>
                                    <th><a onclick="deleteUser(${value.id})" class="btn btn-danger">Excluir</a></th>
                                </tr>`;
            });
        }
    });

    $('#btn').click(function() {
        $.ajax({
            url: "http://localhost:8000/api/users/",
            type: "GET",
            data: {
                filter: document.getElementById('filter').value
            },
            dataType: "json",
            success: function(data) {
                var tbody = document.getElementById('tbody');
                tbody.innerHTML = '';
                data.forEach(value => {
                    tbody.innerHTML += `<tr>
                                        <th>${value.id}</th>
                                        <th>${value.name}</th>
                                        <th>${value.email}</th>
                                        <th><a onclick="editUser(${value.id})" class="btn btn-info">Editar</a></th>
                                        <th><a onclick="deleteUser(${value.id})" class="btn btn-danger">Excluir</a></th>
                                    </tr>`;
                });
            }
        });
    });
    
</script>


@endsection
