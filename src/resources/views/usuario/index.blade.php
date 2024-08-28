<!doctype html>
<html lang="pt">

<head>
    <x-header-layout />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>

    <div class="content-container">
        <main class="main-cntt">
            <div class="content-box">
                <a href="{{ route('usuario.create') }}" class="btnAdd btn">Novo Usuário +</a>
                <div class="table-responsive">
                    <table class="table" style="font-family: 'Roboto', sans-serif;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>CPF</th>
                                <th>Data de Nascimento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->id }}</td>
                                    <td>{{ $usuario->user->name ?? '' }}</td>
                                    <td>{{ $usuario->user->email ?? '' }}</td>
                                    <td>{{ $usuario->telefone }}</td>
                                    <td>{{ $usuario->cpf }}</td>
                                    <td>{{ $usuario->data_nascimento }}</td>

                                    <td class="action-icons">
                                        <a class="btn bi bi-pencil"
                                            href="{{ route('usuario.update', ['usuario' => $usuario]) }}""></a>

                                        <a class="btn bi bi-eye"></a>

                                        <form method="post"
                                            action="{{ route('usuario.destroy', ['usuario' => $usuario]) }}"
                                            onsubmit="return confirm('Deseja excluir este usuário?')"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn delete-button bi bi-trash"></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $usuarios->links() }}
                </div>
            </div>
        </main>

        <!-- ###########################################################################-->
        <!-- Pop-up para visualizar usuário -->
        <div id="userModal" class="modal" style="display: none;">
            <div class="modal-content">

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h2 style="text-align: left; margin: 0; font-size: 20px;">Visualizar Usuário</h2>
                    <span class="btnX close">&times;</span>

                </div>

                <form id="userForm" class="userForm">
                    <div>
                        <label for="userId">Id:</label>
                        <input type="text" id="userId" readonly>
                    </div>
                    <div>
                        <label for="userName">Nome:</label>
                        <input type="text" id="userName" readonly>
                    </div>
                    <div>
                        <label for="userEmail">Email:</label>
                        <input type="email" id="userEmail" readonly>
                    </div>
                    <div>
                        <label for="userPhone">Telefone:</label>
                        <input type="text" id="userPhone" readonly>
                    </div>
                    <div>
                        <label for="userCPF">CPF:</label>
                        <input type="text" id="userCPF" readonly>
                    </div>
                    <div>
                        <label for="userDOB">Data de Nascimento:</label>
                        <input type="text" id="userDOB" readonly>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <x-item-layout />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var viewModal = document.getElementById("userModal");
            var viewSpan = document.getElementsByClassName("close")[0];
            var editSpan = document.getElementsByClassName("close")[1];
            var addModal = document.getElementById("addUserModal");
            var btnAddUser = document.getElementById("btnAddUser");

            document.querySelectorAll('.bi-eye').forEach(function(button) {
                button.onclick = function(event) {
                    event.preventDefault();
                    var userId = this.closest('tr').querySelector('td:nth-child(1)').textContent;
                    var userName = this.closest('tr').querySelector('td:nth-child(2)').textContent;
                    var userEmail = this.closest('tr').querySelector('td:nth-child(3)').textContent;
                    var userPhone = this.closest('tr').querySelector('td:nth-child(4)').textContent;
                    var userCPF = this.closest('tr').querySelector('td:nth-child(5)').textContent;
                    var userDOB = this.closest('tr').querySelector('td:nth-child(6)').textContent;

                    document.getElementById('userId').value = userId;
                    document.getElementById('userName').value = userName;
                    document.getElementById('userEmail').value = userEmail;
                    document.getElementById('userPhone').value = userPhone;
                    document.getElementById('userCPF').value = userCPF;
                    document.getElementById('userDOB').value = userDOB;

                    viewModal.style.display = "block";
                };
            });


            viewSpan.onclick = function() {
                viewModal.style.display = "none";
            };


            window.onclick = function(event) {
                if (event.target == viewModal) {
                    viewModal.style.display = "none";
                }
            };
        });
    </script>
</body>

</html>
