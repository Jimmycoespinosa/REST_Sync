<body>
    <div class="container">
        <div class="row">
            <a href="<?php echo base_url(); ?>/Home/" class="btn btn-success" 'role="button" ><i class="bi bi-house"></i></a>
            <a href="<?php echo base_url(); ?>/Home/Formulario" class="btn btn-primary" role="button" >Nuevo</a>
        </div>
        <div class="row">
            <table class="table">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">deleted_at</th>
                    <th scope="col">acciones</th>
                </tr>
                <? if($users): ?>
                    <?php foreach($users as $user): ?>
                        <?= "<tr scope='row' >"; ?>
                        <?= "<td>".$user['id']."</td>";?>
                        <?= "<td>".$user['name']."</td>";?>
                        <?= "<td>".$user['email']."</td>";?>
                        <?= "<td>".$user['deleted_at']."</td>";?>
                        <td>
                            <a href="<?php echo base_url(); ?>/Home/Editar/<?php echo $user['id']; ?>" class="btn btn-warning" 'role="button" ><i class="bi bi-pencil-square"></i></a>
                            <a href="<?php echo base_url(); ?>/Home/Borrar?id=<?php echo $user['id']; ?>" class="btn btn-danger" 'role="button" ><i class="bi bi-trash"></i></a>            
                        </td>
                    <?php endforeach; ?>
                <? endif;?>
            </table>
            <?php 
                if($paginador){
                    echo $paginador->links(); 
                }
            ?>
        </div>
    </div>
</body>
</html>