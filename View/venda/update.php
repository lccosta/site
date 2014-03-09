<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Sisquitanda</title>
        <script type="text/javascript" src="scripts/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $('a#adicionar').click(function(event){
                    event.preventDefault();
                    var tr = $('<tr></tr>');
                    var td1 = $('<td></td>').text($('select#produtos').val()).append($('<input type="hidden" name="prod_id[]" />').val($('select#produtos').val()));
                    var td2 = $('<td></td>').text($('select#produtos option:selected').text());
                    var td3 = $('<td></td>').text($('input#item_quantidade').val()).append($('<input type="hidden" name="quantidade[]" />').val($('input#item_quantidade').val()));
                    var td4 = $('<td></td>').text($('input#item_valor_unitario').val()).append($('<input type="hidden" name="valor_unitario[]" />').val($('input#item_valor_unitario').val()));
                    
                    $(tr).append($(td1)).append($(td2)).append($(td3)).append($(td4));
                    
                    $('table#produtos tbody').append($(tr));
                });
            });
        </script>
    </head>
    <body>
        <form method="post" action="index.php?controller=venda&action=create">
            <label>
                <span>Cliente</span>        
                <select name="cli_id">
                    <?php foreach ($this->clientes as $cliente): ?>
                        <option value="<?php echo $cliente->id; ?>"><?php echo $cliente->nome; ?></option>
                    <?php endforeach; ?>
                </select>
            </label>

            <br />

            <label>
                <span>Produto</span>        
                <select name="produtos" id="produtos">
                    <?php foreach ($this->produtos as $produto): ?>
                        <option value="<?php echo $produto->id; ?>"><?php echo $produto->nome; ?></option>
                    <?php endforeach; ?>                
                </select>
            </label>

            <br />

            <label>
                <span>Quantidae</span>
                <input type="text" name="item_quantidade" id="item_quantidade" />
            </label>

            <br />

            <label>
                <span>Valor</span>
                <input type="text" name="item_valor_unitario" id="item_valor_unitario" />
            </label>

            <a id="adicionar" href="#">Adicionar produto</a>

            <br />

            <table id="produtos">
                <thead>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                </thead>

                <tbody>                
                </tbody>
            </table>

            <input type="submit" name="enviar" value="Salvar" />
        </form>
    </body>
</html>    