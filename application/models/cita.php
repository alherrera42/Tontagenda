<?php

class Cita extends CI_Model
{
	function lista_consultorios()
	{
		return $this->db->from('consultorios')->get()->result_array();
	}
	
	function lista_consultas($vista_segura=FALSE, $fecha_inicio='', $fecha_fin = '')
	{
		if(! $fecha_inicio)
		{
			$fecha_inicio = time()-(60*60*24*7);
			$fecha_inicio = date('Y-m-d H:i:s',$fecha_inicio);
		}
		if(! $fecha_fin)
		{
			$fecha_fin = time()+(60*60*24*7);
			$fecha_fin = date('Y-m-d H:i:s',$fecha_fin);
		}
				
		
		$this->db->from('consultas');
		$this->db->where('fecha_inicio >=',$fecha_inicio);
		$this->db->where('fecha_fin <=',$fecha_fin);
		$tmp = $this->db->get()->result_array();
		return $tmp;
	}
	
	function horarios_disponibles($filtros, $datos)
	{
		// Horarios posibles
		$horarios = array();
		$ts_intervalo = ($datos['usuario']['citas_duracion']*60);
		$ts_hora_inicio = strtotime($datos['usuario']['citas_hora_inicio']);
		$ts_hora_fin = strtotime($datos['usuario']['citas_hora_fin']);
		for($c = $ts_hora_inicio; $c < $ts_hora_fin; $c+=$ts_intervalo)
			$horarios[] = "".date('H:i:s',$c);
		
		// Horarios libres
		$this->db->from('consultas');
		$this->db->where("fecha_inicio >= '".$filtros['dia']." 00:00:00'");
		$this->db->where("fecha_fin <= '".$filtros['dia']." 23:59:59'");
		$this->db->where('id_medico',$filtros['id_medico']);
		$this->db->or_where('id_consultorio',$filtros['id_consultorio']);
		$libres = $this->db->get()->result_array();
		
		for($c=0; $c<count($horarios); $c++)
		{
			foreach($libres as $l)
			{
				$t_cita_inicio = strtotime(substr($l['fecha_inicio'],10,15));
				$t_cita_fin = strtotime(substr($l['fecha_fin'],10,15));
				$t_inicio = strtotime($horarios[$c]);
				$t_fin = strtotime($horarios[$c+1]);
				
				if($t_cita_inicio<=$t_inicio AND $t_cita_fin>=$t_fin)
					unset($horarios[$c]);
			}
		}
		
		return $horarios;
	}
	
	function agendar($datos)
	{
		$this->db->insert('consultas',$datos);
		return $this->db->insert_id();
	}
	
	function ver($id_consulta)
	{
		$tmp = $this->db->from('consultas')->where('id',$id_consulta)->limit(1)->get()->result_array();
		$tmp = $tmp[0];
		
		$tmp_paciente = $this->db->from('pacientes')->where('id',$tmp['id_paciente'])->limit(1)->get()->result_array();
		$tmp['paciente'] = $tmp_paciente[0];
	
		$tmp_consultorio = $this->db->from('consultorios')->where('id',$tmp['id_consultorio'])->limit(1)->get()->result_array();
		$tmp['consultorio'] = $tmp_consultorio[0];
	
		$tmp_medico = $this->db->from('medicos')->where('id',$tmp['id_medico'])->limit(1)->get()->result_array();
		$tmp['medico'] = $tmp_medico[0];
		
		return $tmp;
	}
}
