<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pn_enregistrer_usser
 *
 * @author alejandra
 */
class Mod_Enregistrer_Usser extends CI_Model
{
    function  __construct() {
        parent::__construct();
    }
    function pn_verifiezUtilisateur($user,$pasw)
    {
        $consulta =  $this->db->get_where('pn_usser', array('email' => $user,'password'=>$pasw,'section_active'=> 1));
        return $consulta->result();
    }
}

?>
