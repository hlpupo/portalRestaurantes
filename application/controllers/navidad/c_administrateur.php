<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class C_Administrateur extends CI_Controller {

    function index() {
//       $this->load->view('navidad/view_tete');
//       $this->load->view('navidad/view_menu');      
//       $this->load->view('navidad/view_publicite');     
//       $data_modele["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
//       $data_modele["adminAction"] = "asd";
//       $this->load->view('navidad/view_corps',$data_modele);
//       $this->load->view('navidad/view_piedPage');
        
    }
    function pn_view_admin_gestionar_usser()
    {
        $this->load->view('navidad/view_tete_admin');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
         
        $this->load->view('navidad/view_publicite');
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $this->load->model('navidad/model_admin/Mod_Admin_Usser', 'Admin_Usser');
        $data_usser["provincia"] = $this->db->get('pn_province')->result();
        $data_usser["tipousuario"] = $this->db->get('pn_nom_usser')->result();
         $data_usser['opcion'] = null;
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
            $data_usser["informacion"] = $this->load->view('navidad/view_usser/view_show_information', $data_usser, true);
        }
        $data_modele_Index["cuerpoAdmin"] = $this->load->view('navidad/view_admin/view_gestionar_usuario',$data_usser, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_admin/view_admin_index_gestionar', $data_modele_Index, true);
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
        //-------------------------------------
        
    }
    
    function pn_find_usser() {
        $this->load->model('navidad/model_admin/Mod_Admin_Usser', 'Admin_Usser');
        $data['usser'] = $this->session->userdata('usserLog');

        $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction


        if (!$sidx)
            $sidx = 1; // connect to the database

       
            $result = $this->Admin_Usser->pn_mod_mostre_usser()->result();
$count = count($result);
        //$count = $row['count'];
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit * $page - $limit;

        $total = ($limit * $page);

        if ($total > $count) {
            $total = $count;
        }


        $response->page = $page;        // current page
        $response->total = $total_pages; // total pages
        $response->records = $count;       // total records
        $response->start = $start;       // total records

        if ($count == 0) {
            $response->rows[0]['cell'] = array();
            echo (json_encode($response));
        } else {
            $a = 0;
            
            for ($i = $start; $i < $total; $i++) 
            {
                 $response->rows[$a]['id'] = $result[$i]->id_usser; //id
                $response->rows[$a]['cell'] = array( ($i+1),$result[$i]->id_usser,$result[$i]->nombre,$result[$i]->apellidos, $result[$i]->email, $result[$i]->provincia, $result[$i]->municipio ,$result[$i]->groupe, $result[$i]->section_active);
  
                $a++;
            }

            echo (json_encode($response));
        }
    }
    function pn_changer_seccion()
    {
         $this->load->model('navidad/model_admin/Mod_Admin_Usser', 'Admin_Usser');
         $this->Admin_Usser->pn_mod_changer_seccion( $this->input->post('pn_usser_id'));
    }
    function pn_view_ajouter_usser()
    {
        $data_modele["arrayGroup"] = $this->db->get('pn_nom_usser')->result();
        $data_modele["provincia"] = $this->db->get('pn_province')->result();
        //$data_modele["municipio"] = $this->db->get('pn_municipalite')->result();
        echo $this->load->view('navidad/view_admin/view_forme_enregistrer', $data_modele, true);
    }
    function pn_ajouter_usser()
    {
        $nombre = $this->input->post("pn_add_prenom");
        $apellido = $this->input->post("pn_add_nom");
        $email = $this->input->post("pn_add_e_mail");
        $prov = $this->input->post("pn_selectionner_Provincia");
        $mun = $this->input->post("pn_selectionner_municipio");
        
        $tipo_usuario = $this->input->post("tipo_usuario");
        $pn_mod_usser = $this->input->post("pn_mod_usser");
         
         
        $pn_phone = $this->input->post("pn_phone");
        $pn_cif = $this->input->post("pn_cif");
        $pn_direccion = $this->input->post("pn_direccion");
        $pn_codigo = $this->input->post("pn_codigo_postal");
        
        $pn_modo_registro = $this->input->post("pn_modo_registro");
        $update = false;
        if (preg_match('/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/', $email)) 
        {
            if($pn_mod_usser == 0)
            {
            $this->load->library('encrypt');
            $pasw = random_string('alnum', 10);
            $cod = random_string('alnum', 5);
            $hash = $this->encrypt->sha1($pasw);
            $arr = array('tipo_usser' =>  $tipo_usuario, 'email' => $email, 'section_active' => 1, 'nombre' => $nombre, 'apellidos' => $apellido,
                   'id_province' => $prov, 'id_municipalite' => $mun, 'password' => $hash,'codigo_activacion'=>$cod);
               $this->opcion=$this->db->insert('pn_usser', $arr);
               $usser_id = $this->db->insert_id();
                if($tipo_usuario == 3)
                {
                   $arr1 = array(
                       'direccion' => $pn_direccion,
                       'cif' => $pn_cif,
                       'telefono' => $pn_phone,
                       'codigo_postal' => $pn_codigo,
                       'id_usuario' => $usser_id,
                       'id_tipo_registro' => $pn_modo_registro

                   );
                   $this->opcion = $this->db->insert('pn_restaurant', $arr1);
                   $arr2 = array(
                       'cantPedidos' => 0,
                       'cantFotos' => 0,
                       'id_restaurante' => $usser_id
                   );
                   $this->opcion = $this->db->insert('pn_restaurant_datos_config', $arr2);
                }
            }
            else
            {
                 $arr = array('tipo_usser' =>  $tipo_usuario, 'email' => $email, 'section_active' => 1, 'nombre' => $nombre, 'apellidos' => $apellido,
                   'id_province' => $prov, 'id_municipalite' => $mun);
                $this->opcion=$this->db->update('pn_usser', $arr, array('id_usser' => $pn_mod_usser));
                if($tipo_usuario == 3)
                {
                   $arr1 = array(
                       'direccion' => $pn_direccion,
                       'cif' => $pn_cif,
                       'telefono' => $pn_phone,
                       'codigo_postal' => $pn_codigo,                       
                       'id_tipo_registro' => $pn_modo_registro

                   );
                    $this->opcion=$this->db->update('pn_restaurant', $arr1, array('id_usuario' => $pn_mod_usser));
                }
                $update = TRUE;
            }
             if($this->opcion == 1 && $update == FALSE)
               {
                   $texto = "Su cuenta a sido registrada para activar la cuenta acceda a este Link </br>";
                   $texto .= base_url().'index.php/navidad/c_activacion/pn_activar_usuario/'.$cod;
                   $texto.=" </br> para acceder a la misma utilizara el usuario '$email' y el password '$pasw'";
                   $this->pn_enviar_email($email,$texto);
               }
        }
        else
        {
            $this->opcion = 0;
        }
        $this->pn_view_admin_gestionar_usser();
         

    }
    function pn_obtenir_municipalite()
    {
        
        $consulta =$this->db->get_where('pn_municipalite',array('id_province' => $this->input->post('id_prov')))->result();
        echo json_encode($consulta);
    }
    function pn_effacer_usser()
    {
        $id = $this->input->post('idUser');
        $consulta =$this->db->delete('pn_usser',array('id_usser' => $id));
        echo $consulta;
    }
    function pn_get_usser()
    {
        $id = $_REQUEST['id_usser'];
         $this->load->model('navidad/model_admin/Mod_Admin_Usser', 'Admin_Usser');
        
        
        $consulta = $this->Admin_Usser->pn_get_usser($id);;
        if($consulta[0]->tipo_usser == 3)
        {
            $res =$this->db->get_where('pn_restaurant',array('id_usuario' => $id))->result();
            $consulta[0]->restaurante = $res;
        }
        echo json_encode($consulta);
    }
    function pn_ver_solicitudes()
    {
       $data['usser'] = $this->session->userdata('usserLog');

        $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction

        if (!$sidx)
            $sidx = 1; // connect to the database


        $result = $this->db->get_where('pn_annonce', array('clasificacion' => 0))->result();
        $count = count($result);
        //$count = $row['count'];
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit * $page - $limit;

        $total = ($limit * $page);

        if ($total > $count) {
            $total = $count;
        }


        $response->page = $page;        // current page
        $response->total = $total_pages; // total pages
        $response->records = $count;       // total records
        $response->start = $start;       // total records
        //$response->end = $total;       // total records
        if ($count == 0) {
            $response->rows[0]['cell'] = array();
            echo (json_encode($response));
        } else {
            $a = 0;
            for ($i = $start; $i < $total; $i++) {

                $response->rows[$a]['id'] = $result[$i]->id_annonce; //id
                $response->rows[$a]['cell'] = array( $result[$i]->id_annonce, $result[$i]->nombre, $result[$i]->montant_usser,$result[$i]->descripcion,$result[$i]->rango_gasto);
                $a++;
            }

            echo (json_encode($response));
        }
    }
     function pn_ver_All_anuncio()
    {
       $data['usser'] = $this->session->userdata('usserLog');

        $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction

        if (!$sidx)
            $sidx = 1; // connect to the database


        $result = $this->db->get('pn_annonce')->result();
        $count = count($result);
        //$count = $row['count'];
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit * $page - $limit;

        $total = ($limit * $page);

        if ($total > $count) {
            $total = $count;
        }


        $response->page = $page;        // current page
        $response->total = $total_pages; // total pages
        $response->records = $count;       // total records
        $response->start = $start;       // total records
        //$response->end = $total;       // total records
        if ($count == 0) {
            $response->rows[0]['cell'] = array();
            echo (json_encode($response));
        } else {
            $a = 0;
            for ($i = $start; $i < $total; $i++) {

                $response->rows[$a]['id'] = $result[$i]->id_annonce; //id
                $response->rows[$a]['cell'] = array( $result[$i]->id_annonce, $result[$i]->nombre, $result[$i]->montant_usser,$result[$i]->descripcion,$result[$i]->rango_gasto);
                $a++;
            }

            echo (json_encode($response));
        }
    }
    function  pn_clasificar_solicitudes()
    {
        $id_anuncio = $this->input->post('anuncio_id');
        $clasificacion = $this->input->post('clasificacion');
        foreach ($id_anuncio as $value) {
           $opcion =  $this->db->update('pn_annonce', array('clasificacion' => $clasificacion), array('id_annonce' => $value));
        }
        echo $opcion;
    }
    
    function pn_admin_admin_zona()
    {
         $this->load->view('navidad/view_tete_admin');
         $data['usser'] = $this->session->userdata('usserLog');

        $this->load->view('navidad/view_admin/view_menu_admin',$data);
        $data_modele["adminAction"] = $this->load->view('navidad/view_admin/view_admin_gestionar_zona', '', true);
        $this->load->view('navidad/view_admin/view_admin', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }
    function pn_ver_provincia()
    {
        $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction
        if (!$sidx)
            $sidx = 1; // connect to the database
        $result = $this->db->get('pn_province')->result();
        $count = count($result);
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit * $page - $limit;
        $total = ($limit * $page);
        if ($total > $count) {
            $total = $count;
        }
        $response->page = $page;        // current page
        $response->total = $total_pages; // total pages
        $response->records = $count;       // total records
        $response->start = $start;       // total records
        //$response->end = $total;       // total records
        if ($count == 0) {
           $response->rows[0]['cell'] = null;
            echo (json_encode($response));
        } else {
            $a = 0;
            for ($i = $start; $i < $total; $i++) {

                $response->rows[$a]['id'] = $result[$i]->id_province; //id
                $response->rows[$a]['cell'] = array( $result[$i]->id_province , $result[$i]->prenom);
                $a++;
            }

            echo (json_encode($response));
        }
    }
    function pn_add_provincia()
    {
      $oper = $_REQUEST['oper'];
      if($oper == 'add')
      {
         $arr = array('prenom' => $_REQUEST['nombre']);
         $result = $this->db->insert('pn_province', $arr);
      }
      else if($oper == 'edit')
      {
         $opcion =  $this->db->update('pn_province', array('prenom' => $_REQUEST['nombre']), array('id_province ' =>  $_REQUEST['id']));
      }
      else if($oper == 'del')
      {
        $this->db->delete('pn_province', array('id_province' => $_REQUEST['id']));
      }
      
    }
    function pn_get_all_provincia()
    {
        $result = $this->db->get('pn_province')->result();
        $html = '<select>';
        foreach ($result as $value) {
           
            $html .= '<option value ='.$value->id_province.' >'.$value->prenom.'</option>';
        }
        $html .= '</select>';
        echo $html;
    }
    function pn_ver_municipio()
    {
        $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction
        if (!$sidx)
            $sidx = 1; // connect to the database
         $this->load->model('navidad/model_admin/Mod_Admin_Usser', 'Admin_Usser');
        if(isset($_REQUEST['id']))
        {
            $result = $this->Admin_Usser->get_municipio_prov($_REQUEST['id']);
        }
        else
        {
            $result = $this->Admin_Usser->get_municipio_prov(NULL);
        }
        
        $count = count($result);
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit * $page - $limit;
        $total = ($limit * $page);
        if ($total > $count) {
            $total = $count;
        }
        $response->page = $page;        // current page
        $response->total = $total_pages; // total pages
        $response->records = $count;       // total records
        $response->start = $start;       // total records
        //$response->end = $total;       // total records
        if ($count == 0) {
            //$response->rows[0]['cell'] = null;
            echo (json_encode($response));
        } else {
            $a = 0;
            for ($i = $start; $i < $total; $i++) {

                $response->rows[$a]['id'] = $result[$i]->id_municipalite; //id
                $response->rows[$a]['cell'] = array( $result[$i]->id_municipalite , $result[$i]->municipio, $result[$i]->provincia);
                $a++;
            }

            echo (json_encode($response));
        }
    }
    function pn_add_municipio()
    {
      $oper = $_REQUEST['oper'];
      if($oper == 'add')
      {
         $arr = array('prenom' => $_REQUEST['nombre'],'id_province' => $_REQUEST['provincia']);
         $result = $this->db->insert('pn_municipalite', $arr);
      }
      else if($oper == 'edit')
      {
         $opcion =  $this->db->update('pn_municipalite', array('prenom' => $_REQUEST['nombre'],'id_province' => $_REQUEST['provincia']), array('id_municipalite ' =>  $_REQUEST['id']));
      }
      else if($oper == 'del')
      {
        $this->db->delete('pn_municipalite', array('id_municipalite' => $_REQUEST['id']));
      }
      
    }
    function pn_admin_gestion_promociones()
    {
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $data["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        

        $data_usser['opcion'] = null;
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        $data_modele["informacion"] = $this->load->view('navidad/view_admin/view_show_information', $data_usser, true);
        $data_modele["restaurante"] = $this->db->get_where('pn_usser', array('tipo_usser' => 3))->result();
        //$data_modele["adminAction"] = $this->load->view('navidad/view_admin/view_forme_promociones', $data_modele, true);
        $data_modele["dataindex"]= $this->load->view('navidad/view_admin/view_forme_promociones', $data_modele, true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $data_modele_Index["promociones_text"] = $this->Mod_Usser->get_Ultima_promociones('text');
        $data_modele_Index["promociones_img"] = $this->Mod_Usser->get_Ultima_promociones('img');
        $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_ultimos_anuncio();
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);

        //$data_modele["dataindex"] = $this->load->view('navidad/view_corps_index', $data_modele_Index, true);
        
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
        $dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);

        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }
    function pn_admin_shoe_promociones()
    {
              $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction
        if (!$sidx)
            $sidx = 1; // connect to the database
        $result = $this->db->get('pn_promociones_restaurante')->result();
        $count = count($result);
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit * $page - $limit;
        $total = ($limit * $page);
        if ($total > $count) {
            $total = $count;
        }
        $response->page = $page;        // current page
        $response->total = $total_pages; // total pages
        $response->records = $count;       // total records
        $response->start = $start;       // total records
        //$response->end = $total;       // total records
        if ($count == 0) {
           $response->rows[0]['cell'] = array();
            echo (json_encode($response));
        } else {
            $a = 0;
            for ($i = $start; $i < $total; $i++) {

                $response->rows[$a]['id'] = $result[$i]->id_promociones; //id
                $text ='';
                if($result[$i]->tipo_promocion == 'text')
                {
                    $text = "Texto";
                }
                else
                {
                    $text = "Imagen";
                }
                 $usser = $this->db->get_where('pn_usser',array('id_usser' =>$result[$i]->author  ))->result();
                $response->rows[$a]['cell'] = array( $result[$i]->id_promociones , $result[$i]->nombre,$text,$usser[0]->nombre);
                $a++;
            }

            echo (json_encode($response));
        }
    }
    function pn_get_promociones()
    {
         $result = $this->db->get_where('pn_promociones_restaurante',array('id_promociones' => $_REQUEST['id_promociones']))->result();
         echo json_encode($result);
    }
    function pn_update_promociones()
    {
         $nombre= $this->input->post('pn_add_prenom');
         $pn_tipo_promocion = $this->input->post('pn_tipo_promocion');
         $texto = $this->input->post('pn_texto');
         $id_promocion = $this->input->post('pn_id_promocion');
         $pn_selectionner_restaurante = $this->input->post('pn_selectionner_restaurante');
          $data['usser'] = $this->session->userdata('usserLog');
         
          $this->opcion = 0;
          if($pn_tipo_promocion != 'text')
          {
              $texto = "a";
          }
         if(!empty($nombre) && !empty($texto))
         {
             if($pn_tipo_promocion == 'text')
             {
                 $arr = array('texto' =>$texto , 'nombre' => $nombre,'tipo_promocion'=>'text','id_restaurante'=>$pn_selectionner_restaurante,'author'=>$data['usser']["id_usser"]);
                
                 if(!empty($id_promocion))
                 {
                     $this->opcion = $this->db->update('pn_promociones_restaurante',$arr, array('id_promociones' =>$id_promocion));
                 }
                 else
                 {
                 $this->opcion = $this->db->insert('pn_promociones_restaurante', $arr);
                 }
             }
             else
             {
                $this->load->library('upload');
                $config['upload_path'] = 'application/views/navidad/upload/promociones';
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = 1024 * 2;
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload()) 
                    {
                    echo $this->upload->display_errors();
                    //$this->pn_view_restaurante_crear_ficha_tecnica();
                } else 
                    {
                    $dataImg = $this->upload->data();
                    $arr = array('url' => $dataImg["file_name"] , 'nombre' => $nombre,'tipo_promocion'=>'img','id_restaurante'=>$pn_selectionner_restaurante,'author'=>$data['usser']["id_usser"]);
                    if(!empty($id_promocion))
                    {
                        $img = $this->db->get_where('pn_promociones_restaurante',array('id_promociones' => $id_promocion))->result();
//                        $path = '../../views/navidad/upload/';
//                        unlink($path.$img[0]->url);
                        $this->load->helper("file");
                        $path =  'application/views/navidad/upload/'.$img[0]->url;
                        $a = delete_files($path);
                        $this->opcion = $this->db->update('pn_promociones_restaurante',$arr, array('id_promociones' =>$id_promocion));
                    }
                    else
                    {
                       $this->opcion = $this->db->insert('pn_promociones_restaurante', $arr);
                    }
                }
                
             }  
         }
         $this->pn_admin_gestion_promociones();
    }
  function pn_del_promociones()
    {
         $id_promociones= $this->input->post('id_promociones');
         $restul = $this->db->delete('pn_promociones_restaurante', array('id_promociones' => $id_promociones)); 
         echo $restul;
    }
    
    function pn_ver_trazas_restaurante()
    {
         $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $data["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        //login
        //$data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
         $this->load->model('navidad/model_admin/Mod_Admin_Usser', 'Admin_Usser');
       // $data_modele_Index["promociones_text"] = $this->Mod_Usser->get_Ultima_promociones('text');
       // $data_modele_Index["promociones_img"] = $this->Mod_Usser->get_Ultima_promociones('img');
       // $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_ultimos_anuncio();
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        
        $data["cantRestauranteRegistro"] = $this->Admin_Usser->get_cant_tipo_registro_restaurante();
        $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_admin/view_cantidad_restaurante_registro', $data, true);
        
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
        //$dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_modele_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        
        
        $data_modele_Index["cuerpoAdmin"] = $this->load->view('navidad/view_admin/view_trazas_restaurante','', true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_admin/view_admin_traza', $data_modele_Index, true);

        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
       
    }
    
    function pn_get_obtener_todos_restaurantes()
    {
                     $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction
        if (!$sidx)
            $sidx = 1; // connect to the database
        $this->load->model('navidad/model_admin/Mod_Admin_Usser', 'Admin_Usser');
        $result =$this->Admin_Usser->get_datos_trazas_restaurante();
       
        $count = count($result);
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit * $page - $limit;
        $total = ($limit * $page);
        if ($total > $count) {
            $total = $count;
        }
        $response->page = $page;        // current page
        $response->total = $total_pages; // total pages
        $response->records = $count;       // total records
        $response->start = $start;       // total records
        //$response->end = $total;       // total records
        if ($count == 0) {
           $response->rows[0]['cell'] = array();
            echo (json_encode($response));
        } else {
            $a = 0;
           
            for ($i = $start; $i < $total; $i++) {
                $response->rows[$a]['id'] = $result[$i]['id_usser']; //id
                $response->rows[$a]['cell'] = array( $result[$i]['id_usser'] ,$result[$i]['nombre'],$result[$i]['email'],$result[$i]['presEnviado'], $result[$i]['presaceptado']);
                $a++;
            }

            echo (json_encode($response));
        } 
    }
    
     function pn_ver_trazas_usuarios()
    {
         $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        //$data["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        //login
        //$data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
         $this->load->model('navidad/model_admin/Mod_Admin_Usser', 'Admin_Usser');
        //$data_modele_Index["promociones_text"] = $this->Mod_Usser->get_Ultima_promociones('text');
        //$data_modele_Index["promociones_img"] = $this->Mod_Usser->get_Ultima_promociones('img');
        //$data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_ultimos_anuncio();
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        
        //$data["cantRestauranteRegistro"] = $this->Admin_Usser->get_cant_tipo_registro_restaurante();
       // $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_admin/view_cantidad_restaurante_registro', $data, true);
        
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
        //$dataPromocionRest['promocionPromocion'] = "";
        $dataPromocionRest['promocionComida'] = "";
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_modele_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        
        
        $data_modele_Index["cuerpoAdmin"] = $this->load->view('navidad/view_admin/view_trazas_usuario','', true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_admin/view_admin_traza', $data_modele_Index, true);

        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
       
    }
    function pn_get_obtener_todos_usuarios()
    {
                     $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction
        if (!$sidx)
            $sidx = 1; // connect to the database
        $this->load->model('navidad/model_admin/Mod_Admin_Usser', 'Admin_Usser');
        $result =$this->Admin_Usser->pn_get_datos_traza_usuario();
       
        $count = count($result);
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit * $page - $limit;
        $total = ($limit * $page);
        if ($total > $count) {
            $total = $count;
        }
        $response->page = $page;        // current page
        $response->total = $total_pages; // total pages
        $response->records = $count;       // total records
        $response->start = $start;       // total records
        //$response->end = $total;       // total records
        if ($count == 0) {
           $response->rows[0]['cell'] = array();
            echo (json_encode($response));
        } else {
            $a = 0;
           
            for ($i = $start; $i < $total; $i++) {
                $response->rows[$a]['id'] = $result[$i]->id_usser; //id
                $response->rows[$a]['cell'] = array( $result[$i]->id_usser ,$result[$i]->nombre,$result[$i]->email,$result[$i]->anuncio, $result[$i]->presupuesto);
                $a++;
            }

            echo (json_encode($response));
        } 
    }

     function pn_config_Tipo_registro()
    {
         $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        //login
        //$data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
         $this->load->model('navidad/model_admin/Mod_Admin_Usser', 'Admin_Usser');
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        
        //$data["cantRestauranteRegistro"] = $this->Admin_Usser->get_cant_tipo_registro_restaurante();
       // $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_admin/view_cantidad_restaurante_registro', $data, true);
        
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
        $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocionRest['promocionComida'] = "";
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_modele_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        $datosconfig["tipConfig"] = $this->Admin_Usser->pn_get_datos_config_tipo_registro(); 
        
        $data_modele_Index["cuerpoAdmin"] = $this->load->view('navidad/view_admin/view_config_tipo_registro',$datosconfig, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_admin/view_admin_traza', $data_modele_Index, true);

        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
       
    }
    function pn_get_data_config()
    {
        $consulta =$this->db->get_where('pn_config_nom_registro',array('id_nom_registro' => $_REQUEST['idconfig']))->result();
        echo json_encode($consulta);
        
    }
    function pn_update_config()
    {
        $cantP = $this->input->post('pn_cant_presupuesto');
        $cantF = $this->input->post('pn_cant_fotos');
        $tipo = $this->input->post('tipo_config');
        if(!empty($cantP) && !empty($cantF))
        {
            $arr = array('cantPedido' =>  $cantP, 'cantImg' => $cantF);
            $this->opcion=$this->db->update('pn_config_nom_registro', $arr, array('id_nom_registro' => $tipo));
        }
        $this->pn_config_Tipo_registro();
        
    }
      function pn_admin_gestion_anuncios()
    {
        //----------------------------------------------------------------------------------
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');

        $data_usser['opcion'] = null;
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        //$data_modele["informacion"] = $this->load->view('navidad/view_admin/view_show_information', $data_usser, true);
        $data_modele["restaurante"] = $this->db->get_where('pn_usser', array('tipo_usser' => 3))->result();
        //$data_modele["adminAction"] = $this->load->view('navidad/view_admin/view_forme_promociones', $data_modele, true);
        $data_modele["dataindex"]= $this->load->view('navidad/view_admin/view_aprovar_anuncio', $data_modele, true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //$data_modele_Index["promociones_text"] = $this->Mod_Usser->get_Ultima_promociones('text');
        //$data_modele_Index["promociones_img"] = $this->Mod_Usser->get_Ultima_promociones('img');
       // $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_ultimos_anuncio();
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);

        //$data_modele["dataindex"] = $this->load->view('navidad/view_corps_index', $data_modele_Index, true);
        
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
        $dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);

        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }
      function pn_admin_del_anuncios()
    {
        //----------------------------------------------------------------------------------
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');

        $data_usser['opcion'] = null;
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        //$data_modele["informacion"] = $this->load->view('navidad/view_admin/view_show_information', $data_usser, true);
        $data_modele["restaurante"] = $this->db->get_where('pn_usser', array('tipo_usser' => 3))->result();
        //$data_modele["adminAction"] = $this->load->view('navidad/view_admin/view_forme_promociones', $data_modele, true);
        $data_modele["dataindex"]= $this->load->view('navidad/view_admin/view_eliminar_anuncio', $data_modele, true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //$data_modele_Index["promociones_text"] = $this->Mod_Usser->get_Ultima_promociones('text');
        //$data_modele_Index["promociones_img"] = $this->Mod_Usser->get_Ultima_promociones('img');
       // $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_ultimos_anuncio();
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);

        //$data_modele["dataindex"] = $this->load->view('navidad/view_corps_index', $data_modele_Index, true);
        
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
        $dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);

        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }
    function pn_del_anuncio()
    {
        $id = $this->input->post('id_annonce');
        $consulta =$this->db->delete('pn_annonce',array('id_annonce' => $id));
        echo $consulta;
    }
    function pn_admin_send_msg_comercial()
    {
        //----------------------------------------------------------------------------------
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');

        $data_usser['opcion'] = null;
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        //$data_modele["informacion"] = $this->load->view('navidad/view_admin/view_show_information', $data_usser, true);
        //$data_modele["restaurante"] = $this->db->get_where('pn_usser', array('tipo_usser' => 3))->result();
        //$data_modele["adminAction"] = $this->load->view('navidad/view_admin/view_forme_promociones', $data_modele, true);
        $this->load->model('navidad/model_admin/Mod_Admin_Usser', 'Admin_Usser');
         $dataComerciales['comerciales'] = $this->Admin_Usser->pn_get_ALL_comerciales();
        
        
        $data_modele["dataindex"]= $this->load->view('navidad/view_admin/view_send_msg', $dataComerciales, true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //$data_modele_Index["promociones_text"] = $this->Mod_Usser->get_Ultima_promociones('text');
        //$data_modele_Index["promociones_img"] = $this->Mod_Usser->get_Ultima_promociones('img');
       // $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_ultimos_anuncio();
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);

        //$data_modele["dataindex"] = $this->load->view('navidad/view_corps_index', $data_modele_Index, true);
        
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
        $dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);

        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }
    function pn_send_msg()
    {
        $data['usser'] = $this->session->userdata('usserLog');
         $pn_list_destinatario = $this->input->post('pn_list_destinatario');
         $pn_msg = $this->input->post('pn_msg');
         if(!empty($pn_list_destinatario) && !empty($pn_msg))
         {
             $remitente = explode(",", $pn_list_destinatario);
             foreach ($remitente as $value) {
                  $result = $this->db->get_where('pn_usser',array('email' => $value))->result();
                  $arr = array('msg' =>  $pn_msg, 'remitente' => $data['usser']["id_usser"], 'destinatario' => $result[0]->id_usser);
               $this->opcion=$this->db->insert('pn_mensaje', $arr);
             }
         }
         $this->pn_admin_send_msg_comercial();
    }


    function pn_enviar_email($destinatario, $mensaje) {
        var_dump($destinatario);
        var_dump($mensaje);
//        require("phpmailer.php");//incluir libreria
//        new PHPMailer();
//        $mail->Host = "localhost";
//        $mail->Username = "********";
//        $mail->Password = "*******";
//        $mail->Port = 25; // Puerto a utilizar
//        $mail->From = "contacto@readyforsoft.com";
//        $mail->FromName = "Ready fo Soft";
//        $mail->Subject = "Solicitud de servicio";
//        $mail->AddAddress("contacto@readyforsoft.com","Contacto");
//        $body  = 'cuerpo';
//        $mail->Body = $body;
//        $mail->Send();
    }
    //-------------------------------------------------------------------------
    //--- Gestionde Usuario
    
}



?>