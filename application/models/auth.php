<?php

class Auth extends CI_Model
{
	function ver_paciente($id)
	{
		$tmp = $this->db->from('pacientes')->where('id',$id)->limit(1)->get()->result_array();
		$tmp = $tmp[0];
		$tmp2 = $this->db->from('config')->limit(1)->get()->result_array();
		$tmp2 = $tmp2[0];
		return array_merge($tmp,$tmp2);
	}
	
	function ver_medico($id)
	{
		$tmp = $this->db->from('medicos')->where('id',$id)->limit(1)->get()->result_array();
		return $tmp[0];
	}
	
	function lista_pacientes()
	{
		return $this->db->from('pacientes')->get()->result_array();
	}

	function lista_medicos()
	{
		return $this->db->from('medicos')->get()->result_array();
	}
	
}
