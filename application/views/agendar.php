
	<h2>Agendar cita</h2>
	<form method='post' action=''>
		<input type='hidden' name='id_paciente' value='<?=$usuario['id']?>' />
		<input type='date' name='dia' value='<?=$dia?>' required onchange='javascript:this.form.submit();' />
		<select name='id_consultorio' required onchange='javascript:this.form.submit();'>
			<option value=''>Seleccione un consultorio...</option>
		<?php foreach($consultorios as $c) { ?>
			<option value='<?=$c['id']?>' <?php if($_POST['id_consultorio']==$c['id']) echo "selected"; ?>><?=$c['consultorio']?> (de <?=$c['horario_inicio']?> a <?=$c['horario_fin']?>)</option>
		<?php } ?>
		</select>
		<select name='id_medico' required onchange='javascript:this.form.submit();'>
			<option value=''>Seleccione un médico...</option>
		<?php foreach($medicos as $c) { ?>
			<option value='<?=$c['id']?>' <?php if($_POST['id_medico']==$c['id']) echo "selected"; ?>>
				<?=$c['nombre']?> <?=$c['apellido_paterno']?> a <?=$c['apellido_materno']?> (<?=$c['especialidad']?>)
			</option>
		<?php } ?>
		</select>
		<select name='horario' required>
			<option value=''>Seleccione un horario...</option>
		<?php foreach($horarios as $c) { ?>
			<option value='<?=$c?>' <?php if($_POST['horario']==$c) echo "selected"; ?>><?=$c?></option>
		<?php } ?>
		</select>
		<input type='text' name='observaciones' placeholder='Inserte una nota para el asistente (opcional)' />
		<input type='submit' name='agendar' value='Agendar' />
	</form>
