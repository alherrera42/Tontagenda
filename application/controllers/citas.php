<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Citas extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	function agendar()
	{
		$this->load->model('auth');
		$this->load->model('cita');
		
		$datos['dia'] = $_POST['dia'] ? $_POST['dia'] : date('Y-m-d');
		
		// En lo que queda la parte de autentificacion, se llamara al paciente 1
		$id_paciente = 1;
		$datos['usuario'] = $this->auth->ver_paciente($id_paciente); 
		$datos['medicos'] = $this->auth->lista_medicos();
		$datos['consultorios'] = $this->cita->lista_consultorios();
		//$datos['consultas'] = $this->cita->lista_consultas($vista_segura, $datos['dia']);
		$datos['horarios'] = $this->cita->horarios_disponibles($_POST,$datos); 
		
		if($_POST['id_medico'] AND $_POST['id_consultorio'] AND $_POST['id_paciente'] AND $_POST['agendar'])
		{
			
			// Comprobaciones de seguridad para evitar sobrecarga por paciente
			
			// Insertar la consulta, pues ha sido confirmada
			$fecha_inicio = strtotime($datos['dia']." ".$_POST['horario']);
			$fecha_fin = $fecha_inicio + $datos['usuario']['citas_duracion']*60;
			$fecha_inicio = date('Y-m-d H:i:s',$fecha_inicio);
			$fecha_fin = date('Y-m-d H:i:s',$fecha_fin);
			$o = array(
				'id_paciente' => $id_paciente,
				'id_medico' => $_POST['id_medico'],
				'id_consultorio' => $_POST['id_consultorio'],
				'fecha_inicio' => $fecha_inicio,
				'fecha_fin' => $fecha_fin,
				'observaciones' => $_POST['observaciones']
			); 
			$id_consulta = $this->cita->agendar($o);
			$datos['consulta'] = $this->cita->ver($id_consulta);
			
			// Comprobar que no este solapada
			$solapada = false;
			if($solapada)
			{
				$this->cita->eliminar($id_consulta);
			}
			else
				// Redirigir
				header('Location: '.site_url("citas/ver/{$id_consulta}"));
		}
			
		$this->load->view('header',$datos);
		$this->load->view('agendar',$datos);
		$this->load->view('footer');
	}
	
	function ver($id_consulta)
	{
		$this->load->model('cita');
		$cita = $this->cita->ver($id_consulta);
		print_r($cita);
		echo "<a href='".base_url()."'>Volver</a>";
	}
	
	function calendario()
	{
		$this->load->model('cita');
		$this->load->model('auth');
		
		$fecha_inicio = $_POST['fecha_inicio'];
		$fecha_fin = $_POST['fecha_fin'];
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
				
		$datos['fecha_inicio'] = $fecha_inicio;
		$datos['fecha_fin'] = $fecha_fin;
		$datos['citas'] = $this->cita->lista_consultas(FALSE, $fecha_inicio, $fecha_fin);
		
		$id_paciente = 1;
		$datos['usuario'] = $this->auth->ver_paciente($id_paciente); 
		$datos['medicos'] = $this->auth->lista_medicos();
		
		$this->load->view('header',$datos);
		$this->load->view('calendario',$datos);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
