<?php
include "db.php";
$images = get_imgs();
?>


		<?php if(count($images)>0):?>

		<h1>Imagenes</h1>
		<br><br>

				<table class="table table-bordered">
					<thead>
						<th>Imagen</th>
						<th>
					</thead>
			<?php foreach($images as $img):?>
				<tr>
				<td><img src="<?php echo $img->folder.$img->src; ?>" style="width:240px;">				</td>
				<td>
				<a class="btn btn-success" href="<?php echo $img->folder.$img->src; ?>">Ver</a> 
				<a class="btn btn-danger" href="./delete.php?id=<?php echo $img->id; ?>">Eliminar</a>
			</td>
				</tr>
			<?php endforeach;?>
</table>
		<?php else:?>

			<h4 class="alert alert-warning">No hay imagenes!</h4>
		<?php endif; ?>

