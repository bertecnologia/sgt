<!DOCTYPE html>
<html>

<head>
    <title>Lista de Participantes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .cpf-invalido {
            background-color: #FFC0CB;
            color: #B22222;
        }

        .cpf-duplicado {
            background-color: #FFFF00;
            color: #000000;
        }

        .float-right {
            float: right;
        }
    </style>

</head>

<body>
    <div class="container">
        <h1>Participantes do Treinamento <?php echo intval($_GET['id']) ?></h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'connect.php';
                $id_treinamento = intval($_GET['id']);
                $sql = "SELECT * FROM participantes WHERE id_treinamento = '$id_treinamento' ORDER BY nome ASC";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td contenteditable='true'>{$row['nome']}</td>";
                    echo "<td contenteditable='true'>{$row['cpf']}</td>";
                    echo "<td><button class='btn btn-danger remove' data-id='{$row['id']}'>Remover</button></td>";
                    echo "</tr>";
                }

                $conn->close();
                ?>

            </tbody>
        </table>
        <button class="btn btn-primary" id="add">Adicionar</button>
        <button class="btn btn-success" id="save">Salvar</button>
        <button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#importModal">
            Importar CSV
        </button>




    </div>

    <!-- Modal de confirmação de remoção -->
    <div class="modal fade" id="confirmRemoveModal" tabindex="-1" role="dialog" aria-labelledby="confirmRemoveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmRemoveModalLabel">Remover participante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza de que deseja remover o participante?<br>
                    Nome: <span id="nomeToRemove"></span><br>
                    CPF: <span id="cpfToRemove"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmRemove">Remover</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de sucesso de atualização -->
    <div class="modal fade" id="successUpdateModal" tabindex="-1" role="dialog" aria-labelledby="successUpdateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successUpdateModalLabel">Sucesso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Dados atualizados com sucesso!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="location.reload();">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de CPF inválido -->
    <div class="modal fade" id="invalidCpfModal" tabindex="-1" role="dialog" aria-labelledby="invalidCpfModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invalidCpfModalLabel">CPF Inválido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    CPF inválido: <span id="invalidCpf"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de CPF duplicado -->
    <div class="modal fade" id="duplicateCpfModal" tabindex="-1" role="dialog" aria-labelledby="duplicateCpfModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="duplicateCpfModalLabel">CPF Duplicado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    CPF duplicado: <span id="duplicateCpf"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Importar arquivo CSV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="import.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id_treinamento; ?>">
                        <div class="form-group">
                            <label>Selecione o arquivo CSV:</label>
                            <input type="file" name="arquivo_csv" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" value="Importar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        function validarCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g, '');
            if (cpf == '') return false;
            if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
                return false;
            var add = 0;
            for (i = 0; i < 9; i++)
                add += parseInt(cpf.charAt(i)) * (10 - i);
            var rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(9)))
                return false;
            add = 0;
            for (i = 0; i < 10; i++)
                add += parseInt(cpf.charAt(i)) * (11 - i);
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(10)))
                return false;
            return true;
        }

        $(document).on('click', '.remove', function() {
            const nome = $(this).closest('tr').find('td:eq(1)').text();
            const cpf = $(this).closest('tr').find('td:eq(2)').text();
            $('#nomeToRemove').text(nome);
            $('#cpfToRemove').text(cpf);
            $('#confirmRemoveModal').modal('show');
            $('#confirmRemove').data('row', $(this).closest('tr'));
        });

        $('#confirmRemove').click(function() {
            const row = $(this).data('row');
            const id = row.find('.remove').data('id');

            $.ajax({
                url: 'remover_participante.php',
                method: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response === 'success') {
                        row.remove();
                        $('#confirmRemoveModal').modal('hide');
                    } else {
                        alert('Ocorreu um erro ao remover o participante!');
                    }
                }
            });
        });


        $('#add').click(function() {
            $('tbody').append('<tr><td></td><td contenteditable="true"></td><td contenteditable="true"></td><td><button class="btn btn-danger remove">Remover</button></td></tr>');
            marcarLinhasDuplicadas();
        });

        function marcarLinhasDuplicadas() {
            const cpfList = [];
            const duplicateRows = [];

            $('tbody tr').each(function() {
                const cpf = $(this).find('td:eq(2)').text();
                if (cpfList.includes(cpf)) {
                    duplicateRows.push(cpf);
                } else {
                    cpfList.push(cpf);
                }
            });

            $('tbody tr').each(function() {
                const cpf = $(this).find('td:eq(2)').text();
                if (duplicateRows.includes(cpf)) {
                    $(this).addClass('cpf-duplicado');
                } else {
                    $(this).removeClass('cpf-duplicado');
                }
            });
        }

        $('#save').click(function() {
            const participantes = [];
            let cpfInvalidoEncontrado = false;
            let cpfDuplicadoEncontrado = false;

            $('tbody tr').each(function() {
                const id = $(this).find('td:eq(0)').text();
                const nome = $(this).find('td:eq(1)').text();
                const cpf = $(this).find('td:eq(2)').text();

                // Remove a classe 'cpf-invalido' caso já exista
                $(this).find('td:eq(2)').removeClass('cpf-invalido');

                if (!validarCPF(cpf)) {
                    $('#invalidCpf').text(cpf);
                    $('#invalidCpfModal').modal('show');
                    cpfInvalidoEncontrado = true;

                    // Adiciona a classe 'cpf-invalido' ao campo CPF inválido
                    $(this).find('td:eq(2)').addClass('cpf-invalido');
                    marcarLinhasDuplicadas();
                    return false;
                }

                // ...

                if (!cpfDuplicadoEncontrado) {
                    for (const participante of participantes) {
                        if (participante.cpf === cpf) {
                            $('#duplicateCpf').text(cpf);
                            $('#duplicateCpfModal').modal('show');
                            cpfDuplicadoEncontrado = true;
                            marcarLinhasDuplicadas();
                            return false;
                        }
                    }
                }


                participantes.push({
                    id: id,
                    nome: nome,
                    cpf: cpf
                });
            });

            if (!cpfInvalidoEncontrado && !cpfDuplicadoEncontrado) {
                $.ajax({
                    url: 'atualizar_participantes.php',
                    method: 'POST',
                    data: {
                        participantes: participantes,
                        id_treinamento: <?php echo $id_treinamento; ?>
                    },
                    success: function(response) {
                        if (response === "success") {
                            $('#successUpdateModal').modal('show');
                        } else {
                            alert('Ocorreu um erro ao atualizar os dados!');
                        }
                    }
                });
            } else {
                marcarLinhasDuplicadas();
            }
        });
    </script>
</body>

</html>