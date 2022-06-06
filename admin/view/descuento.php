<h1 class="text-center">Descuento</h1>
<a class="btn btn-success" href="descuento.php?accion=create" role="button">Agregar</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Prenda</th>
            <th scope="col">Porcentaje Descuento</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $cont=0; foreach($descuento as $desc):?>
        <tr>
            <td><?php echo $desc["id_descuento"];?></td>
            
            <td><?php echo $desc["prenda"];?></td>
            
            <td><?php echo $desc["porcentaje_desc"];?></td>

            <td><a href="descuento.php?accion=delete&id=<?php echo $desc["id_descuento"];?>&idp=<?php echo $desc["id_prenda"]; ?>" role="button"><i
                        style="color: #D54040;" class="fa-solid fa-trash-can fa-2x"></i></a>
                
            </td>
        </tr>
        <?php $cont++; endforeach;  
            ?>
    </tbody>
</table>
<p class="text-right"><?php echo "Se encontraron: " .$cont. " registros."; ?></p>