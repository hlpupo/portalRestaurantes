<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class C_Activacion extends CI_Controller {
    function pn_activar_usuario($act)
    {
         $consulta =$this->db->get_where('pn_usser',array('codigo_activacion' => $act))->result();
         if(!empty($consulta))
         {
             $this->opcion = $this->db->update('pn_usser',array('section_active' => 1 ), array('id_usser' =>$consulta[0]->id_usser));
             echo $this->opcion;
         }
    }
}
?>
