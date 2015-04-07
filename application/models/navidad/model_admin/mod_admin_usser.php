<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Mod_Admin_Usser extends CI_Model
{
    function  __construct() {
        parent::__construct();
    }
   
     function pn_mod_mostre_usser()
    {
       $sql = 'SELECT pn_usser.id_usser,pn_usser.email,pn_usser.section_active,pn_usser.nombre,pn_usser.apellidos,pn_province.prenom as provincia,
           pn_municipalite.prenom as municipio,pn_nom_usser.groupe 
           FROM pn_nom_usser
           INNER JOIN pn_usser ON (pn_nom_usser.tipo_usser = pn_usser.tipo_usser) 
           INNER JOIN pn_province ON (pn_usser.id_province = pn_province.id_province) 
           INNER JOIN pn_municipalite ON (pn_usser.id_municipalite = pn_municipalite.id_municipalite)';
       return $this->db->query($sql);
       
    }
    function pn_mod_changer_seccion($id)
    {
        $consulta =$this->db->get_where('pn_usser',array('id_usser' => $id))->result();
         if($consulta[0]->section_active == 1)
         {
             $this->db->set('section_active',0);
         }
         else
         {
             $this->db->set('section_active',1);
         }
         $this->db->where('id_usser', $id);
         $this->db->update('pn_usser');
    }
    
    function mod_ajouter_usser($email, $grupo,$nombre, $apellidos,$prov, $mun)
    {
           $this->db->insert('pn_usser',array('email' =>$email ,'tipo_usser' => $grupo ,'nombre' =>$nombre ,'apellidos' => $apellidos,'id_province' =>$prov ,'id_municipalite' => $mun,'section_active' => 0 ));
           return $this->db->insert_id();
    }
    /**
     * Devuelve el municipio con la provincia
     */
    function get_municipio_prov($prov)
    {
        if(isset($prov))
        {
            $sql = "SELECT pn_province.prenom as provincia, pn_municipalite.prenom as municipio, pn_municipalite.id_municipalite, pn_municipalite.id_province
                FROM pn_province INNER JOIN pn_municipalite ON (pn_province.id_province = pn_municipalite.id_province) WHERE pn_province.id_province = '$prov'";
        }
       else 
           {
            $sql = "SELECT pn_province.prenom as provincia, pn_municipalite.prenom as municipio, pn_municipalite.id_municipalite, pn_municipalite.id_province
                FROM pn_province INNER JOIN pn_municipalite ON (pn_province.id_province = pn_municipalite.id_province)";
        }
        return $this->db->query($sql)->result();
    }
    //devuelve lac antidad de restaurante registrado y de que tipo
    function get_cant_tipo_registro_restaurante()
    {
       $sql = "SELECT  COUNT(pn_restaurant.id_tipo_registro) AS cantidad, pn_restaurant.id_tipo_registro, pn_nom_tipo_registro.nom_registro 
           FROM pn_nom_tipo_registro INNER JOIN pn_restaurant ON (pn_nom_tipo_registro.id_nom_registro = pn_restaurant.id_tipo_registro) 
           GROUP BY pn_restaurant.id_tipo_registro, pn_nom_tipo_registro.nom_registro"; 
       return $this->db->query($sql)->result();
    }
    function get_datos_trazas_restaurante()
    {
        $sql="SELECT pn_usser.nombre, pn_usser.email, pn_usser.id_usser FROM pn_restaurant INNER JOIN pn_usser ON (pn_restaurant.id_usuario = pn_usser.id_usser)";
         $restaurante = $this->db->query($sql)->result();
        
        $result =  array();
        $i =0;
        foreach ($restaurante as $value) {
            
             $sql = "SELECT COUNT(pn_restaurant_annonce.id_restaurant) AS cantidadPresupuesto FROM pn_restaurant
                INNER JOIN pn_restaurant_annonce ON (pn_restaurant.id_usuario = pn_restaurant_annonce.id_restaurant)
                WHERE pn_restaurant_annonce.id_restaurant = '$value->id_usser'
                GROUP BY pn_restaurant_annonce.id_restaurant";
        $cantPresEnviado = $this->db->query($sql)->result();
        $sql2 = "SELECT COUNT(pn_restaurant_annonce.id_restaurant) AS cantidadPresupuesto FROM pn_restaurant
                INNER JOIN pn_restaurant_annonce ON (pn_restaurant.id_usuario = pn_restaurant_annonce.id_restaurant)
                WHERE pn_restaurant_annonce.id_restaurant = '$value->id_usser' AND pn_restaurant_annonce.aceptado != 0 
                GROUP BY pn_restaurant_annonce.id_restaurant";
        $cantPresAcept = $this->db->query($sql2)->result();
        if(!empty($cantPresEnviado))
        {
        $cantSend = $cantPresEnviado[0]->cantidadPresupuesto;
        }
        else
        {
           $cantSend = 0; 
        }
         if(!empty($cantPresAcept))
        {
         $cantAcept= $cantPresAcept[0]->cantidadPresupuesto;
        
        }
        else
        {
           $cantAcept = 0; 
        }
       
        $result[$i++] =  array('nombre'=>$value->nombre,'email'=>$value->email,'id_usser'=>$value->id_usser,'presEnviado'=>$cantSend ,'presaceptado'=>$cantAcept);
        }
        
        return $result;
    }
        function pn_get_usser($id)
    {
       $sql = "SELECT pn_usser.id_usser,pn_usser.tipo_usser,pn_usser.email,pn_usser.section_active,pn_usser.nombre,pn_usser.apellidos,
           pn_province.prenom as provincia,
           pn_municipalite.prenom as municipio,pn_nom_usser.groupe,pn_usser.id_province,pn_usser.id_municipalite
           FROM pn_nom_usser
           INNER JOIN pn_usser ON (pn_nom_usser.tipo_usser = pn_usser.tipo_usser) 
           INNER JOIN pn_province ON (pn_usser.id_province = pn_province.id_province) 
           INNER JOIN pn_municipalite ON (pn_usser.id_municipalite = pn_municipalite.id_municipalite)
           WHERE pn_usser.id_usser='$id'";
       return $this->db->query($sql)->result();
       
    }
    function pn_get_datos_traza_usuario()
    {
        $sql = "SELECT pn_usser.email,pn_usser.nombre,pn_usser.tipo_usser,pn_usser.id_province,pn_usser.id_municipalite,pn_usser.id_usser,
                pn_annonce.id_annonce,COUNT(pn_restaurant_annonce.id_restaurant) AS presupuesto,pn_annonce.nombre as anuncio
                FROM pn_annonce
                INNER JOIN pn_usser ON (pn_annonce.id_usser = pn_usser.id_usser)
                INNER JOIN pn_restaurant_annonce ON (pn_annonce.id_annonce = pn_restaurant_annonce.id_annonce)
                GROUP BY pn_usser.email,pn_usser.nombre,pn_usser.tipo_usser,pn_usser.id_province,pn_usser.id_municipalite,pn_annonce.id_annonce,pn_annonce.nombre";
         return $this->db->query($sql)->result();
    }
    function pn_get_datos_config_tipo_registro()
    {
        $sql = "SELECT pn_nom_tipo_registro.nom_registro,pn_config_nom_registro.cantPedido,pn_config_nom_registro.cantImg,pn_nom_tipo_registro.id_nom_registro
        FROM pn_config_nom_registro INNER JOIN pn_nom_tipo_registro ON (pn_config_nom_registro.id_nom_registro = pn_nom_tipo_registro.id_nom_registro)";
         return $this->db->query($sql)->result();
    }
    function pn_get_ALL_comerciales()
    {
        $sql= "SELECT pn_usser.apellidos,pn_usser.nombre,pn_usser.email,pn_usser.tipo_usser
            FROM pn_usser WHERE pn_usser.tipo_usser = 5 OR pn_usser.tipo_usser = 6";
         return $this->db->query($sql)->result();
    }
   
}
?>
