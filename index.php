<?php
    function __autoload($class_name) {
    require_once 'class/' . $class_name . '.php';
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Crud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="https://bootswatch.com/4/lux/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>
<body>
    <?php
        $user= new Users();

        if(isset($_POST['cadastrar'])):
            $nome = $_POST['nome'];
            $email = $_POST['email'];

            $user->setNome($nome);
            $user->setEmail($email);
            $user->insert();
        endif;

    ?>

    <?php
        if(isset($_POST['atualizar'])) :
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];

            $user->setNome($nome);
            $user->setEmail($email);
            if($user->update($id)) {
                header('Location: http://localhost/crud/');
            }
        endif;
    ?>

    <?php
        if(isset($_GET['acao']) && $_GET['acao'] == 'apagar') :
            $id = (int)$_GET['id'];
            $user->delete($id);
        endif;
    ?>

    <?php
        if(isset($_GET['acao']) && $_GET['acao'] == 'editar') :

            $id = (int)$_GET['id'];
            $result = $user->find($id);
    ?>
       <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto mt-5">
                    <h5 class="modal-title ml-4 mb-3">Atualizar Membro</h5>
                    <form method="POST" action="">
                                <div class="form-group">
                                    <input type="text" name="nome" class="form-control" placeholder="Nome" value="<?php echo $result->nome; ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $result->email; ?>" required>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $result->id; ?>">
                                <div class="modal-footer">
                                    <input type="submit" name="atualizar" class="btn btn-block btn-primary" value="Atualizar">
                                </div>
                    </form>
                </div>
            </div>
       </div>
    <?php
        endif;
    ?>


    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mt-5" data-toggle="modal" data-target="#exampleModal">
                Cadastrar Dados
                </button>
                <!-- <hr> -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-4" id="exampleModalLabel">Cadastrar Membro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" name="nome" class="form-control" placeholder="Nome" required>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                             <div class="modal-footer">
                                <input type="submit" name="cadastrar" class="btn btn-block btn-primary" value="Cadastrar">
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
                </div>

               <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($user->findAll() as $key => $value): ?>
                        <tr>
                            <td><?php echo $value->id; ?></td>
                            <td><?php echo $value->nome; ?></td>
                            <td><?php echo $value->email; ?></td>
                            <td>
                                <a class="btn text-secondary btn-editar" href="<?php echo 'index.php?acao=editar&id='.$value->id; ?>"> 
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                 <a class="btn text-secondary" href="<?php echo 'index.php?acao=apagar&id=' . $value->id; ?>"> 
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="js/jquery.js"></script>
    <script src="js/poper.js"></script>
    <script src="js/bootstrap.js"></script>
    <script scr="js/main.js"></script>
</body>
</html>