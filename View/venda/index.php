<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Sisquitanda</title>
    </head>
    <body>
        <a href="index.php?controller=venda&action=create">Nova venda</a>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Cliente</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>                
                <?php foreach ($this->vendas as $venda): ?>
                    <tr>
                        <td><?php echo $venda->id; ?></td>
                        <td><?php echo $venda->cli_nome; ?></td>
                        <td><a href="index.php?controller=venda&action=update">Alterar</a></td>
                        <td><a href="index.php?controller=venda&action=delete">Excluir</a></td>
                    </tr>
                <?php endforeach; ?>                
            </tbody>
        </table>
    </body>
</html>    