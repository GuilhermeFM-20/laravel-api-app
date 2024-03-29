@extends('header')

@section('body')
<div class="flex-center position-ref ">
    <div class="flex-center position-ref ">
        <div class="container pt-3">
            <div class="card">
                <div class="col-md-6">
                    <h2>Atualizar</h2>
                </div>
                <hr>
                <div class="form-group row p-2">
                    <div class="col-md-6">
                        <label>Nome:</label>
                        <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Email:</label>
                        <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row  p-2">
                    <div class="col-md-6">
                        <label>Senha:</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Confirmar Senha:</label>
                        <input type="password" name="password_verify" id="password_verify" class="form-control">
                    </div>
                </div>     
                <div class="form-group row  p-2">
                    <div class="col-md-6">
                        <a href="/" class="btn btn-info">Voltar</a>
                        <input type="button" class="btn btn-success" value="Gravar" id="btnSubmit">
                    </div>
                </div>                          
        </div>
    </div>
</div>
<script>

    $(document).on('click', '#btnSubmit', function() {
        $.ajax({
        url: "http://localhost:8000/api/users/"+{{$user->id}},
        type: "PUT",
        data: {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
            password_verify: document.getElementById('password_verify').value,
        },
        success: function(data) {
            window.location.href = "http://localhost:8000/";
            alert(data.msg);
        },
        error: function(error) {
            Object.keys(error.responseJSON.errors).forEach((chave) => {
                const valor = error.responseJSON.errors[chave];
                alert(`Aviso: ${valor}`);
            }); 
        }
        });
    });
    
</script>
@endsection
