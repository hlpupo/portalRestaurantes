<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of navidad
 *
 * @author rotceh
 */
class C_Navidad extends CI_Controller {

    function index() {
          $data['usser'] = $this->session->userdata('usserLog');
          if(!empty($data['usser']))
          switch ( $data['usser']['tipo'] )
          {
              case '1': {
                            $this->pn_montrer_admin();
                        }
                        break;
          case '2': {
                            $this->pn_vista_usser();
                        }
                        break;
                    case '3': {
                            $this->pn_vista_restaurante();
                        }
                        break;
                    case '5': {
                            $this->pn_comercial_venta();
                        }
                        break;
                    case '6': {
                            $this->pn_comercial_promocion();
                        }
          }
 else {
     
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $data["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $data_modele_Index["promociones_text"] = $this->Mod_Usser->get_Ultima_promociones('text');
        $data_modele_Index["promociones_img"] = $this->Mod_Usser->get_Ultima_promociones('img');
        $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_ultimos_anuncio();
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);

        $data_modele["dataindex"] = $this->load->view('navidad/view_corps_index', $data_modele_Index, true);
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocionRest['promocionComida'] = "";
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        $dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);

        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
 }
    }

    function pn_get_ultimos_anuncio() {

        json_encode($result);
    }

    function pn_login() {
        $email = $this->input->post("pn_e_mail");
        $pasw = $this->input->post("pn_password");
        $this->load->helper('string');

        if (preg_match('/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/', $email)) {
            $this->load->model('navidad/Mod_Enregistrer_Usser', 'Mod_Enregistrer_Usser');
             $this->load->library('encrypt');
             //$hash = $this->encrypt->sha1($pasw);
            $result = $this->Mod_Enregistrer_Usser->pn_verifiezUtilisateur($email, $pasw);
            if ($result) {
                $datosUser = array('nombre' => $result[0]->nombre, 'apellido' => $result[0]->apellidos, 'email' => $result[0]->email, 'tipo' => $result[0]->tipo_usser, 'id_usser' => $result[0]->id_usser);
                $this->session->set_userdata('usserLog', $datosUser);
                switch ($result[0]->tipo_usser) {
                    case '1': {
                            $this->pn_montrer_admin();
                        }
                        break;
                    case '2': {
                            $this->pn_vista_usser();
                        }
                        break;
                    case '3': {
                            $this->pn_vista_restaurante();
                        }
                        break;
                    case '5': {
                            $this->pn_comercial_venta();
                        }
                        break;
                    case '6': {
                            $this->pn_comercial_promocion();
                        }
                        break;

                    default:
                        break;
                }
            } else {
                redirect('', 'refresh');
            }
        } else {
            redirect('', 'refresh');
        }
    }

    function outlogin() {
        $this->session->sess_destroy();
        redirect('', 'refresh');
    }

    public function pn_montrer_admin() {
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);

        $this->load->view('navidad/view_publicite');
        //login
        //$data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $data_modele_Index["promociones_text"] = $this->Mod_Usser->get_Ultima_promociones('text');
        $data_modele_Index["promociones_img"] = $this->Mod_Usser->get_Ultima_promociones('img');
        $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_ultimos_anuncio();
        $data_modele_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', '', true);
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_corps_index', $data_modele_Index, true);
           //--------------------------------------
       //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
        $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocionRest['promocionComida'] = "";
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        //-----------------
        //$data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        //--------------------------------
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    public function pn_comercial_venta() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        //$data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_comercial_venta/view_comercial', $data_Rest, true);

        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $resutl = $this->Mod_Usser->pn_cmv_get_info($data['usser']["id_usser"]);
        $data_Publicidad_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_comercial_venta/view_cmv_config_restaurante', $resutl, true);
        //-----------------------------
        //$this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $data_modele_Index["promociones_text"] = $this->Mod_Usser->get_Ultima_promociones('text');
        $data_modele_Index["promociones_img"] = $this->Mod_Usser->get_Ultima_promociones('img');
        $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_ultimos_anuncio();


        $data_modele["dataindex"] = $this->load->view('navidad/view_corps_index', $data_modele_Index, true);
       // $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //$data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
         //--------------------------------------
       //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
        $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocionRest['promocionComida'] = "";
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        //-----------------
        //$data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        //--------------------------------
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    public function pn_comercial_promocion() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        //datos del config de la cuenta
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //config del CMP
        $resutl = $this->Mod_Usser->pn_cmp_get_info($data['usser']["id_usser"]);
        $data_Publicidad_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_comercial_promocion/view_cmp_config', $resutl, true);
        $data_modele_Index["promociones_text"] = $this->Mod_Usser->get_Ultima_promociones('text');
        $data_modele_Index["promociones_img"] = $this->Mod_Usser->get_Ultima_promociones('img');
        $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_ultimos_anuncio();

        $data_modele["dataindex"] = $this->load->view('navidad/view_corps_index', $data_modele_Index, true);
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //$data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        //--------------------------------------
       //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocionRest['promocionComida'] = "";
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        //-----------------
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_enregistrer() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        $data_usser['opcion'] = null;
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
            $data_usser["informacion"] = $this->load->view('navidad/view_usser/view_show_information', $data_usser, true);
        }

        $data_usser["tipoUsuario"] = $this->db->get('pn_nom_usser')->result();
        $data_usser["provincia"] = $this->db->get('pn_province')->result();
        $data_usser["condiciones"] = $this->db->get('pn_modalites_conditions')->result();
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_forme_usser_enregistrer', $data_usser, true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //$dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //$data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        
               //$------------Promociones------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_modele_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        //--
        
        
        
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_modele_Index, true);
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    /**
     * Recive los datos del formulario de registro
     */
    function pn_enregistrer_usser() {
        $email = $this->input->post("pn_add_e_mail");
        $nombre = $this->input->post("pn_add_prenom");
        $apell = $this->input->post("pn_add_nom");
        $prov = $this->input->post("pn_selectionner_Provincia");
        $muni = $this->input->post("pn_selectionner_municipio");
        $acep = $this->input->post("pn_option_condiciones");
        if (!empty($email) && !empty($nombre) && !empty($apell) && !empty($prov) && !empty($muni) && !empty($acep)) {
            $this->load->helper('string');
            if (preg_match('/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/', $email)) {
                $this->load->library('encrypt');
                 $pasw = random_string('alnum', 10);
                 $cod = random_string('alnum', 5);
                 $hash = $this->encrypt->sha1($pasw);
                $arr = array('tipo_usser' => '2', 'email' => $email, 'section_active' => 0, 'nombre' => $nombre, 'apellidos' => $apell, 
                    'id_province' => $prov, 'id_municipalite' => $muni, 'password' => $hash,'codigo_activacion'=>$cod);
                $this->opcion = $this->db->insert('pn_usser', $arr);
                // $this->pn_enregistrer();
            } else {
                $this->opcion = 0;
            }
        } else {
            $this->opcion = 0;
        }
         $texto = "Su cuenta a sido registrada para activar la cuenta acceda a este Link ";
         $texto .= base_url().'index.php/navidad/c_activacion/pn_activar_usuario/'.$cod;
         $texto.=" para acceder a la misma utilizara el usuario '$email' y el password '$pasw'";
         $this->pn_enviar_email($email,$texto);
        $this->pn_enregistrer();
    }

    /**
     * Vista del usuario normal que se ha registrado
     */
    function pn_vista_usser() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');

        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');

        //$data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_vista_usser', '', true);
        //-------------------

        $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_show_informacion_usuario', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');

        $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_ultimos_anuncio();
        $data_modele_Index["promociones_text"] = $this->Mod_Usser->get_Ultima_promociones('text');
        $data_modele_Index["promociones_img"] = $this->Mod_Usser->get_Ultima_promociones('img');
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
     
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_corps_index', $data_modele_Index, true);
           //$------------Promociones------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocionRest['promocionComida'] = "";
        
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        $dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        ///------------------------
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_change_pasword_usuario() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $data_usser['opcion'] = null;
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }

        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');

        $data_modele_Index["informacion"] = $this->load->view('navidad/view_usser/view_show_information', $data_usser, true);
        $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_show_informacion_usuario', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $data_modele_Index["promociones_text"] = $this->db->get_where('pn_promociones_restaurante', array('tipo_promocion' => 'text'))->result();
        $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_ultimos_anuncio();
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();


        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_change_password_usuario', $data_modele_Index, true);
                //$------------Promociones------------
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        $dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        ///------------------------
        
        
         $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
     
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    /* carga la vista del anuncio */

    function pn_view_anuncio() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        $data_usser["provincia"] = $this->db->get('pn_province')->result();
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_forme_anuncio', $data_usser, true);
             //$------------Promociones------------
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        $dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        ///------------------------
         $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_registrar_anuncio() {
        $prov = $this->input->post("pn_selectionner_Provincia");
        $mun = $this->input->post("pn_selectionner_municipio");
        $cant = $this->input->post("pn_cantidad_personas");
        $rango = $this->input->post("pn_select_rango");
        $descrip = $this->input->post("descripcion");
        $titulo = $this->input->post("pn_titulo");
        $fecha = $this->input->post("pn_fecha");
        if (!empty($prov) && !empty($mun) && !empty($cant) && !empty($rango) && !empty($descrip) && !empty($titulo) && !empty($fecha)) {
            $id_usser = $this->session->userdata('usserLog');
            $arr = array('nombre' => $titulo, 'montant_usser' => $cant, 'id_provincia' => $prov, 'id_municipio' => $mun,
                'id_usser' => $id_usser['id_usser'], 'descripcion' => $descrip, 'rango_gasto' => $rango, 'clasificacion' => 0, 'fecha' => $fecha);
            $this->opcion = $this->db->insert('pn_annonce', $arr);

            $this->pn_view_anuncio();
        } else {
            $this->opcion = 0;
            $this->pn_view_anuncio();
        }
    }

    function view_forme_usser_success($opcion) {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');

        $this->load->view('navidad/view_menu');
        $this->load->view('navidad/view_publicite');
        $data_usser["opcion"] = $opcion;
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_forme_usser_success', $data_usser, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    //Muestra la FT del restaurante desde la vista de usuario
    function pn_view_usser_FT_restaurante() {
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $id_Restaurante = $_REQUEST['idR'];
        $resutl = $this->Mod_Usser->pn_get_all_menu($id_Restaurante);
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['opcion'] = null;
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        $data_modele["menu"] = $resutl[0];
        $data_modele["fotos"] = $resutl[1];
        $cant = count($this->db->get_where('pn_restaurant_annonce', array('id_restaurant' => $id_Restaurante))->result());
        $data_modele["presupuesto"] = $cant;
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_usser_FT_restaurante', $data_modele, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_enregistrer_restaurante() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_forme_restaurant_enregistrer', '', true);
        //-------------------------------------------
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //--------------------------------------------
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_enregistrer_restaurante_gratis() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        //-
        $data_usser = "";
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        $data_usser["informacion"] = $this->load->view('navidad/view_usser/view_show_information', $data_usser, true);
        //-

        $data_usser["provincia"] = $this->db->get('pn_province')->result();
        $data_usser["condiciones"] = $this->db->get('pn_modalites_conditions')->result();
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_forme_restaurant_enregistrer_gratis', $data_usser, true);
        //-------------------------------------------
                  //$------------Promociones------------
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocionRest['promocionComida'] = "";
        
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        $dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        ///------------------------
        //--------------------------------------------
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_enregistrer_restaurante_pago_media() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        //-
        $data_usser = "";
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        $data_usser["informacion"] = $this->load->view('navidad/view_usser/view_show_information', $data_usser, true);
        //-
        $data_usser["tipo"] = 1;
        $data_usser["provincia"] = $this->db->get('pn_province')->result();
        $data_usser["condiciones"] = $this->db->get('pn_modalites_conditions')->result();
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_forme_restaurant_enregistrer_pago', $data_usser, true);
        //-------------------------------------------
                      //$------------Promociones------------
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocionRest['promocionComida'] = "";
        
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        $dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        ///------------------------
        //--------------------------------------------
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_enregistrer_restaurante_pago_completa() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        //-
        $data_usser = "";
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        $data_usser["informacion"] = $this->load->view('navidad/view_usser/view_show_information', $data_usser, true);
        //-
        $data_usser["tipo"] = 2;
        $data_usser["provincia"] = $this->db->get('pn_province')->result();
        $data_usser["condiciones"] = $this->db->get('pn_modalites_conditions')->result();
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_forme_restaurant_enregistrer_pago', $data_usser, true);
        //-------------------------------------------
                      //$------------Promociones------------
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocionRest['promocionComida'] = "";
        
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        $dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        ///------------------------
        //--------------------------------------------
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_enregistrer_restaurant_data() {
        $prov = $this->input->post("pn_selectionner_Provincia");
        $mun = $this->input->post("pn_selectionner_municipio");
        $nombre = $this->input->post("pn_add_prenom");
        $email = $this->input->post("pn_add_e_mail");
        $pn_phone = $this->input->post("pn_phone");
        $pn_cif = $this->input->post("pn_cif");
        $pn_direccion = $this->input->post("pn_direccion");
        $pn_codigo = $this->input->post("pn_codigo_postal");
        $pn_modo_registro = $this->input->post("pn_modo_registro");
        $tipo_pago_campana = $this->input->post("tipo_pago_campana");
        // echo $prov.'-'.$mun.'-'.$nombre.'-'.$email.'-'.$pn_phone.'-'.$pn_cif.'-'.$pn_direccion.'-'.$pn_codigo.'-'.$pn_modo_registro.'-'.$tipo_pago_campana;
        // die();
        if (!empty($prov) && !empty($mun) && !empty($nombre) && !empty($email) && !empty($pn_phone) && !empty($pn_cif) && !empty($pn_direccion) && !empty($pn_codigo)) {
            if (preg_match('/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/', $email)) {
                 $this->load->library('encrypt');
                 $pasw = random_string('alnum', 10);
                 $cod = random_string('alnum', 5);
                 $hash = $this->encrypt->sha1($pasw);
                if ($pn_modo_registro == 0) {
                    $tipo_pago_campana = 0;
                }
                $this->load->library('upload');
                $config['upload_path'] = 'application/views/navidad/upload/logoRestaurante';
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = 1024 * 2;
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                
                if ($this->upload->do_upload()) 
                    {
                    $dataImg = $this->upload->data();
                    $arr = array('tipo_usser' => '3', 'email' => $email, 'section_active' => 0, 'nombre' => $nombre, 'apellidos' => '',
                        'id_province' => $prov, 'id_municipalite' => '1', 'password' => $hash,'codigo_activacion'=>$cod);
                    $this->db->insert('pn_usser', $arr);
                    $usser_id = $this->db->insert_id();
                    $arr1 = array(
                        'direccion' => $pn_direccion,
                        'cif' => $pn_cif,
                        'telefono' => $pn_phone,
                        'codigo_postal' => $pn_codigo,
                        'id_usuario' => $usser_id,
                        'id_tipo_registro' => $tipo_pago_campana,
                        'logo'=> $dataImg["file_name"]
                    );
                    $this->opcion = $this->db->insert('pn_restaurant', $arr1);
                    $configTipoUser = $this->db->get_where('pn_config_nom_registro', array('id_nom_registro' => $tipo_pago_campana))->result();
                    $arr2 = array(
                        'cantPedidos' => 0,
                        'cantFotos' => 0,
                        'id_restaurante' => $usser_id
                    );
                    $this->opcion = $this->db->insert('pn_restaurant_datos_config', $arr2);
                } else {
                     echo $this->upload->display_errors();
                    $this->opcion = 0;
                }
            } else {
                $this->opcion = 0;
            }
        } else {

            $this->opcion = 0;
        }
         $texto = "Su cuenta a sido registrada para activar la cuenta acceda a este Link";
         $texto .= base_url().'index.php/navidad/c_activacion/pn_activar_usuario/'.$cod;
         $texto.="para acceder a la misma utilizara el usuario '$email' y el password '$pasw'";
         $this->pn_enviar_email($email,$texto);
        if ($pn_modo_registro == 0) {
            $this->pn_enregistrer_restaurante_gratis();
        } else if ($pn_modo_registro == 1) {
            $this->pn_enregistrer_restaurante_pago_media();
        } else {
            $this->pn_enregistrer_restaurante_pago_completa();
        }
    }

    function pn_vista_restaurante() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');

        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        //datos del config de la cuenta
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $resutl = $this->Mod_Usser->pn_config_datos_restaurante($data['usser']["id_usser"]);


        $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_ultimos_anuncio();
        $data_modele_Index["promociones_text"] = $this->Mod_Usser->get_Ultima_promociones('text');
        $data_modele_Index["promociones_img"] = $this->Mod_Usser->get_Ultima_promociones('img');
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_datos_config_restaurante', $resutl, true);
        //$data_modele["dataindex"] = $this->load->view('navidad/view_corps_index', $data_modele_Index, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_restaurant', $data_modele_Index, true);
             //$------------Promociones------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        //$dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        ///------------------------
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_view_restaurante_crear_ficha_tecnica() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $data_usser['opcion'] = null;
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        //datos del config de la cuenta
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $resutl = $this->Mod_Usser->pn_config_datos_restaurante($data['usser']["id_usser"]);
        $data_modele["dataUsser"] = $this->load->view('navidad/view_usser/view_datos_config_restaurante', $resutl, true);
        $data_modele["informacion"] = $this->load->view('navidad/view_usser/view_show_information', $data_usser, true);
        //mando a cargar las imagenes que tiene 
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_restaurante_crear_ficha_tecnica', $data_modele, true);
        //$------------Promociones------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        //$dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        ///------------------------
        
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_load_mis_imagenes() {
        $data['usser'] = $this->session->userdata('usserLog');
        $result = $this->db->get_where('pn_menu_fotos', array('id_restaurante' => $data['usser']["id_usser"]))->result();
        echo json_encode($result);
    }

    function pn_delete_mis_imagenes() {
        $data['usser'] = $this->session->userdata('usserLog');
        $idIMG = $this->input->post("idImg");
        $restul = $this->db->delete('pn_menu_fotos', array('id_foto' => $idIMG));
        $configTipoRegistroRestaurante = $this->db->get_where('pn_restaurant_datos_config', array('id_restaurante' => $data['usser']["id_usser"]))->result();
        $opcion = $this->db->update('pn_restaurant_datos_config', array('cantFotos' => ($configTipoRegistroRestaurante[0]->cantFotos - 1)), array('id_restaurante' => $data['usser']["id_usser"]));
        echo $restul;
    }

    function pn_guardar_menu() {

        $oper = $_REQUEST['oper'];
        $data['usser'] = $this->session->userdata('usserLog');
        if ($oper == 'add') {
            $arr = array('nombre' => $_REQUEST['nombre'], 'descripcion' => $_REQUEST['descripcion'], 'id_restaurante' => $data['usser']["id_usser"]);
            $this->opcion = $this->db->insert('pn_menu_restaurante', $arr);
        } else if ($oper == 'edit') {
            $opcion = $this->db->update('pn_menu_restaurante', array('nombre' => $_REQUEST['nombre'], 'descripcion' => $_REQUEST['descripcion']), array('id_menu ' => $_REQUEST['id']));
        } else if ($oper == 'del') {
            $this->db->delete('pn_menu_restaurante', array('id_menu' => $_REQUEST['id']));
        }
    }

    function pn_obtener_datos_menu() {
        $data['usser'] = $this->session->userdata('usserLog');

        $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction

        if (!$sidx)
            $sidx = 1; // connect to the database


        $result = $this->db->get_where('pn_menu_restaurante', array('id_restaurante' => $data['usser']["id_usser"]))->result();
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

                $response->rows[$a]['id'] = $result[$i]->id_menu; //id
                $response->rows[$a]['cell'] = array(($i + 1), $result[$i]->id_menu, $result[$i]->nombre, $result[$i]->descripcion);
                $a++;
            }

            echo (json_encode($response));
        }
    }

    function pn_obtener_menu_restaurante() {
        $data['usser'] = $this->session->userdata('usserLog');
        $result = $this->db->get_where('view_menu', array('id_restaurante' => $data['usser']["id_usser"]))->result();
        echo json_encode($result);
    }

    function pn_menu_foto_upload() {
        $data['usser'] = $this->session->userdata('usserLog');
        $resultRestaurante = $this->db->get_where('pn_restaurant', array('id_usuario' => $data['usser']["id_usser"]))->result();
        $configTipoRegistro = $this->db->get_where('pn_config_nom_registro', array('id_nom_registro' => $resultRestaurante[0]->id_tipo_registro))->result();
        $configTipoRegistroRestaurante = $this->db->get_where('pn_restaurant_datos_config', array('id_restaurante' => $data['usser']["id_usser"]))->result();
        if ($configTipoRegistroRestaurante[0]->cantFotos < $configTipoRegistro[0]->cantImg) {
            $this->load->library('upload');
            $config['upload_path'] = 'application/views/navidad/upload';
            $config['allowed_types'] = 'jpg|png|gif';
            $config['max_size'] = 1024 * 2;
            $config['encrypt_name'] = true;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload()) {
                echo $this->upload->display_errors();
                $this->pn_view_restaurante_crear_ficha_tecnica();
            } else {
                $dataImg = $this->upload->data();
                $arr = array('id_restaurante' => $data['usser']['id_usser'], 'url' => $dataImg["file_name"]);
                $this->pn_crear_thumb($dataImg["file_name"]);
                $this->opcion = $this->db->insert('pn_menu_fotos', $arr);
                $opcion = $this->db->update('pn_restaurant_datos_config', array('cantFotos' => ($configTipoRegistroRestaurante[0]->cantFotos + 1)), array('id_restaurante' => $data['usser']["id_usser"]));
                $this->pn_view_restaurante_crear_ficha_tecnica();
            }
        } else {
            $this->opcion = 2;
            $this->pn_view_restaurante_crear_ficha_tecnica();
        }
    }

    function pn_crear_thumb($img) {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = 'application/views/navidad/upload/prueba.jpg';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 75;
        $config['height'] = 50;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();

        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
        echo $this->image_lib->display_errors();
    }

    /*     * *
     * Muestra la ficha tecnica del restaurante
     * 
     */

    function pn_view_restaurante_ficha_tecnica() {
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $data['usser'] = $this->session->userdata('usserLog');
        $resutl = $this->Mod_Usser->pn_get_all_menu($data['usser']['id_usser']);
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $resultRestaurante = $this->db->get_where('pn_restaurant', array('id_usuario' => $data['usser']["id_usser"]))->result();
        $configTipoRegistro = $this->db->get_where('pn_config_nom_registro', array('id_nom_registro' => $resultRestaurante[0]->id_tipo_registro))->result();
        $configTipoRegistroRestaurante = $this->db->get_where('pn_restaurant_datos_config', array('id_restaurante' => $data['usser']["id_usser"]))->result();
        $data['pedidosHechos'] = $configTipoRegistroRestaurante[0]->cantPedidos;
        $data['pedidoTotal'] = $configTipoRegistro[0]->cantPedido;
        $data_usser['opcion'] = null;
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        $data_modele["menu"] = $resutl[0];
        $data_modele["fotos"] = $resutl[1];
        $cant = count($this->db->get_where('pn_restaurant_annonce', array('id_restaurant' => $data['usser']["id_usser"]))->result());
        $data_modele["presupuesto"] = $cant;
        //la parte del config
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $resutl = $this->Mod_Usser->pn_config_datos_restaurante($data['usser']["id_usser"]);
        //$------------Promociones------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        //$dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        ///------------------------
        $data_modele["dataUsser"] = $this->load->view('navidad/view_usser/view_datos_config_restaurante', $resutl, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_restaurante_ficha_tecnica', $data_modele, true);
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_view_ofertas_anuncio() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        //var_dump($data['usser']);
        $resultRestaurante = $this->db->get_where('pn_restaurant', array('id_usuario' => $data['usser']["id_usser"]))->result();
        $configTipoRegistro = $this->db->get_where('pn_config_nom_registro', array('id_nom_registro' => $resultRestaurante[0]->id_tipo_registro))->result();
        $configTipoRegistroRestaurante = $this->db->get_where('pn_restaurant_datos_config', array('id_restaurante' => $data['usser']["id_usser"]))->result();
        $data['pedidosHechos'] = $configTipoRegistroRestaurante[0]->cantPedidos;
        $data['pedidoTotal'] = $configTipoRegistro[0]->cantPedido;
        $data_usser['opcion'] = null;
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        //la parte del config
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $resutl = $this->Mod_Usser->pn_config_datos_restaurante($data['usser']["id_usser"]);
        $data_modele["dataUsser"] = $this->load->view('navidad/view_usser/view_datos_config_restaurante', $resutl, true);
         //$------------Promociones------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        //$dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        ///------------------------
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_restaurante_ofertas_anuncios', $data_modele, true);
         $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_show_aprovar_promocion() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        //var_dump($data['usser']);
        $resultRestaurante = $this->db->get_where('pn_restaurant', array('id_usuario' => $data['usser']["id_usser"]))->result();
        $configTipoRegistro = $this->db->get_where('pn_config_nom_registro', array('id_nom_registro' => $resultRestaurante[0]->id_tipo_registro))->result();
        $configTipoRegistroRestaurante = $this->db->get_where('pn_restaurant_datos_config', array('id_restaurante' => $data['usser']["id_usser"]))->result();
        $data['pedidosHechos'] = $configTipoRegistroRestaurante[0]->cantPedidos;
        $data['pedidoTotal'] = $configTipoRegistro[0]->cantPedido;
        $data_usser['opcion'] = null;
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        //la parte del config
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $resutl = $this->Mod_Usser->pn_config_datos_restaurante($data['usser']["id_usser"]);
        $data_modele["dataUsser"] = $this->load->view('navidad/view_usser/view_datos_config_restaurante', $resutl, true);
         //$------------Promociones------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        //$dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        ///------------------------
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_restaurante_aprovar_promocion', $data_modele, true);
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_get_aprovar_promocion() {
        $data['usser'] = $this->session->userdata('usserLog');
        $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction

        if (!$sidx)
            $sidx = 1; // connect to the database

        $result = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => $data['usser']["id_usser"]))->result();
        $count = count($result);

        //$result = $this->db->get_where('view_menu', array('id_restaurante' => $data['usser']["id_usser"]))->result();
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
            for ($i = $start; $i < $total; $i++) {
                if ($result[$i]->publicada == 1) {
                    $esta = "Publicado";
                } else {
                    $esta = "No publicado";
                }
                $response->rows[$a]['id'] = $result[$i]->id_promociones; //id
                $response->rows[$a]['cell'] = array($result[$i]->id_promociones, $result[$i]->nombre, $esta);
                $a++;
            }
            echo (json_encode($response));
        }
    }

    function pn_aceptar_promocion() {
        $id_promocion = $this->input->post("id_promocion");
        $data['usser'] = $this->session->userdata('usserLog');
        $result = $this->db->get_where('pn_promociones_restaurante', array('id_promociones' => $id_promocion))->result();
        if ($result[0]->activa_restaurante == 0) {
            $arr = array('publicada' => 1, 'activa_restaurante' => 1, 'activa' => 1);
        } else {
            $arr = array('publicada' => 1, 'activa_restaurante' => 0, 'activa' => 1);
        }
        $this->opcion = $this->db->update('pn_promociones_restaurante', $arr, array('id_promociones' => $id_promocion));
        echo $this->opcion;
    }

    function pn_get_promocion() {
        $result = $this->db->get_where('pn_promociones_restaurante', array('id_promociones' => $_REQUEST['id_promocion']))->result();
        echo json_encode($result);
    }

    function pn_view_restaurante_anuncios() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $data_usser['opcion'] = null;
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        //la parte del config
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
       // $resutl = $this->Mod_Usser->pn_config_datos_restaurante($data['usser']["id_usser"]);
        //$data_modele["configR"] = $this->load->view('navidad/view_usser/view_datos_config_restaurante', $resutl, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_restaurante_seguir_anuncios', '', true);
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_change_pasword_restaurante() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $data_usser['opcion'] = null;
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        $data_modele["informacion"] = $this->load->view('navidad/view_usser/view_show_information', $data_usser, true);
        //la parte del config
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $resutl = $this->Mod_Usser->pn_config_datos_restaurante($data['usser']["id_usser"]);
       $data_modele["dataUsser"] = $this->load->view('navidad/view_usser/view_datos_config_restaurante', $resutl, true);
         //$------------Promociones------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        //$dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        ///------------------------
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_change_password_restaurante', $data_modele, true);
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    //cambiar pasword
    function pn_change_password() {
        $this->load->library('encrypt');
        $data['usser'] = $this->session->userdata('usserLog');
        $pn_old_password = $this->input->post("pn_old_password");
        $pn_new_password = $this->input->post("pn_new_password");
        $pn_repeat_password = $this->input->post("pn_repeat_password");
        if (!empty($pn_old_password) && !empty($pn_new_password) && !empty($pn_repeat_password) && ($pn_new_password == $pn_repeat_password)) {
             $pn_old_password = $this->encrypt->sha1($pn_old_password);
            $usser = $this->db->get_where('pn_usser', array('id_usser' => $data['usser']["id_usser"], 'password' => $pn_old_password))->result();
            if (!empty($usser)) {
                 
                 $hash = $this->encrypt->sha1($pn_new_password);
                $this->opcion = $this->db->update('pn_usser', array('password' => $hash), array('id_usser' => $data['usser']["id_usser"]));
            } else {
                $this->opcion = 0;
            }
        } else {
            $this->opcion = 0;
        }
        echo $this->pn_change_pasword_usuario();
    }

    //muestra una interfaz para actualizar los datos
    function pn_view_update_datos_restaurante() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $data_usser['opcion'] = null;
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        $data_modele["informacion"] = $this->load->view('navidad/view_usser/view_show_information', $data_usser, true);
        //la parte del config
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $resutl = $this->Mod_Usser->pn_config_datos_restaurante($data['usser']["id_usser"]);
        $data_modele["dataUsser"] = $this->load->view('navidad/view_usser/view_datos_config_restaurante', $resutl, true);
         //$------------Promociones------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        //$dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        ///------------------------
        
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $dataR = $this->Mod_Usser->pn_get_data_restaurante($data['usser']["id_usser"]);
        $data_modele["dataRest"] = $dataR[0];
        $data_modele["provincia"] = $this->db->get('pn_province')->result();
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_forme_restaurant_update', $data_modele, true);
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_update_datos_restaurante() {
        $prov = $this->input->post("pn_selectionner_Provincia");
        $mun = $this->input->post("pn_selectionner_municipio");
        $nombre = $this->input->post("pn_add_prenom");
        $email = $this->input->post("pn_add_e_mail");
        $pn_phone = $this->input->post("pn_phone");
        $pn_cif = $this->input->post("pn_cif");
        $pn_direccion = $this->input->post("pn_direccion");
        $pn_codigo = $this->input->post("pn_codigo_postal");
        $pn_modo_registro = $this->input->post("pn_modo_registro");
        $tipo_pago_campana = $this->input->post("tipo_pago_campana");
        $id_usser = $this->input->post("pn_id_usser");
        //$opcion = $this->db->update('pn_restaurant_datos_config', array('cantPedidos' => ($configTipoRegistroRestaurante[0]->cantPedidos+1)),
        // array('id_restaurante' => $data['usser']["id_usser"]));

        if (!empty($prov) && !empty($mun) && !empty($nombre) && !empty($email) && !empty($pn_phone) && !empty($pn_cif) && !empty($pn_direccion) && !empty($pn_codigo)) {
            if (preg_match('/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/', $email)) {

                $arr = array('email' => $email, 'nombre' => $nombre, 'id_province' => $prov, 'id_municipalite' => $mun);
                $this->opcion = $this->db->update('pn_usser', $arr, array('id_usser' => $id_usser));
                $arr1 = array(
                    'direccion' => $pn_direccion,
                    'cif' => $pn_cif,
                    'telefono' => $pn_phone,
                    'codigo_postal' => $pn_codigo
                );
                $this->opcion = $this->db->update('pn_restaurant', $arr1, array('id_usuario' => $id_usser));

                $this->pn_view_update_datos_restaurante();
            } else {
                echo "datos email";
                $this->opcion = 0;
                $this->pn_view_update_datos_restaurante();
            }
        } else {
            echo "datos vacio";
            $this->opcion = 0;
            $this->pn_view_update_datos_restaurante();
        }
    }

    function pn_get_anuncio_restaurante() {
        $data['usser'] = $this->session->userdata('usserLog');
        $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction

        if (!$sidx)
            $sidx = 1; // connect to the database

        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $resultAux = $this->Mod_Usser->pn_get_all_anuncio($data['usser']["id_usser"])->result();

        $result = array();
        $i = 0;
        foreach ($resultAux as $value) {
            $dataAux = $this->db->get_where('pn_restaurant_annonce', array('id_restaurant' => $data['usser']["id_usser"], 'id_annonce' => $value->id_annonce))->result();
            $cant = count($dataAux);
            if ($cant == 0) {
                $result[$i++] = $value;
            }
        }
        //$result = $this->db->get_where('view_menu', array('id_restaurante' => $data['usser']["id_usser"]))->result();
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
            for ($i = $start; $i < $total; $i++) {

                $response->rows[$a]['id'] = $result[$i]->id_annonce; //id
                $response->rows[$a]['cell'] = array(($i + 1), $result[$i]->nombre, $result[$i]->cantUsser, $result[$i]->descripcion, $result[$i]->provincia, $result[$i]->municipio);
                $a++;
            }
            echo (json_encode($response));
        }
    }

    /**
     * Guarda la oferta del restaurante a un anuncio
     */
    function pn_oferta_restaurante_anuncion() {
        $form_anunc = $this->input->post("form_anunc");
        $id_anuncio = $this->input->post("id_anuncio");
        if (!empty($form_anunc) && !empty($id_anuncio)) {
            $data['usser'] = $this->session->userdata('usserLog');
            $arr = array('id_restaurant' => $data['usser']["id_usser"], 'id_annonce' => $id_anuncio, 'costo' => $form_anunc[0]['value'], 'descripcion' => $form_anunc[1]['value']);
            //mando a contar un valor para ese restaurante
            $resultRestaurante = $this->db->get_where('pn_restaurant', array('id_usuario' => $data['usser']["id_usser"]))->result();
            $configTipoRegistro = $this->db->get_where('pn_config_nom_registro', array('id_nom_registro' => $resultRestaurante[0]->id_tipo_registro))->result();
            $configTipoRegistroRestaurante = $this->db->get_where('pn_restaurant_datos_config', array('id_restaurante' => $data['usser']["id_usser"]))->result();
            if ($configTipoRegistroRestaurante[0]->cantPedidos < $configTipoRegistro[0]->cantPedido) {
                $result = $this->db->insert('pn_restaurant_annonce', $arr);
                $opcion = $this->db->update('pn_restaurant_datos_config', array('cantPedidos' => ($configTipoRegistroRestaurante[0]->cantPedidos + 1)), array('id_restaurante' => $data['usser']["id_usser"]));
                echo $result;
            } else {
                echo 3;
            }
        } else {
            echo 0;
        }
    }

    /**
     * Carga la vista con un listado de los anuncios que ha publicado el usuario 
     */
    function pn_view_mis_anuncio() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_lista_anuncio_usser', '', true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    //Muestra la lista de los anuncion que se me han sido ofertados
    function pn_get_lista_anuncio() {
        $data['usser'] = $this->session->userdata('usserLog');
        $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction

        if (!$sidx)
            $sidx = 1; // connect to the database
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $result = $this->Mod_Usser->pn_get_anuncio_usuario($data['usser']["id_usser"])->result();
        foreach ($result as $value) {
            $cantOfertaAnuncio["$value->id_annonce"] = $this->Mod_Usser->pn_get_cant_restaurante_anuncio($value->id_annonce)->result();
        }
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
            $response->rows[0]['cell'] = null;
            echo (json_encode($response));
        } else {
            $a = 0;
            for ($i = $start; $i < $total; $i++) {
                $cant = 0;
                $response->rows[$a]['id'] = $result[$i]->id_annonce; //id
                $id_anun = $result[$i]->id_annonce;
                if (isset($cantOfertaAnuncio["$id_anun"][0]->cantidad)) {
                    $cant = $cantOfertaAnuncio["$id_anun"][0]->cantidad;
                }
                $clasf = "";
                switch ($result[$i]->clasificacion) {
                    case 0:
                        $clasf = "En espera";
                        break;
                    case 1:
                        $clasf = "Cena pequeña";
                        break;
                    case 2:
                        $clasf = "Cena grande";
                        break;
                }
                $response->rows[$a]['cell'] = array(($i + 1), $result[$i]->nombre, $result[$i]->cantUsser, $result[$i]->descripcion, $result[$i]->provincia, $result[$i]->municipio, $cant, $clasf);
                $a++;
            }
            echo (json_encode($response));
        }
    }

    //Muestra un anuncio especifico
    function pn_show_anuncio_usser() {
        $id_anunc = $_REQUEST['id_an'];
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $result = $this->Mod_Usser->pn_get_anuncio_oferta_restuarante($id_anunc)->result(); //estos son los restaurantes que me han ofrecido 
        $anun = $this->db->get_where('pn_annonce', array('id_annonce' => $id_anunc))->result();
        //print_r($result);
        $dataR = array();
        $i = 0;
        foreach ($result as $value) {
            $leido = $this->pn_get_dialogo_no_leido($anun[0]->id_usser, $value->id_restaurante, $value->id_restaurante)->result();
            $dataR[$i++] = array('id_restaurante' => $value->id_restaurante, 'id_annonce' => $value->id_annonce, 'costo' => $value->costo, 'descripcion' => $value->descripcion, 'aceptado' => $value->aceptado, 'nombre' => $value->nombre, 'leido' => $leido[0]->leido);
        }
        $arrAxy = array($anun, $dataR);
        echo json_encode($arrAxy);
    }

    //acepta la ofeta entre el restaurante y el anuncio
    function pn_aceptar_oferta_anuncio_restaurante() {
        $id_anuncio = $this->input->post("id_anuncio");
        $id_restaurant = $this->input->post("id_restaurant");
        $tipo = $this->input->post("tipo");
        if ($tipo == "true") {
            $a = 1;
            $result = $this->db->get_where('pn_restaurant_annonce', array('id_annonce' => $id_anuncio))->result();
            $cant = FALSE;
            foreach ($result as $value) {
                if ($value->aceptado == 1) {
                    $cant = TRUE;
                }
            }
            if ($cant) {
                $opcion = 2;
            } else {
                $opcion = $this->db->update('pn_restaurant_annonce', array('aceptado' => $a), array('id_annonce' => $id_anuncio, 'id_restaurant' => $id_restaurant));
            }
        } else {
            $a = 0;
            $opcion = $this->db->update('pn_restaurant_annonce', array('aceptado' => $a), array('id_annonce' => $id_anuncio, 'id_restaurant' => $id_restaurant));
        }

        echo $opcion;
    }

    //mustra el dialogo entre ambos //esto lo pide el usuario pero para poder decir que el ya ha leido los msg del restaurnte hay que separar la funcion
    function pn_establecer_dialog() {
        $id_usser = $_REQUEST['id_usser'];
        $id_anuncio = $_REQUEST['id_anuncio'];
        $id_restaurante = $_REQUEST['id_restaurante'];
        $arr = array('id_anuncio' => $id_anuncio, 'id_usuario' => $id_usser, 'id_restaurante' => $id_restaurante);
        $result = $this->db->get_where('pn_dialogo', $arr)->result();
        if (empty($result)) {
            $result = $this->db->insert('pn_dialogo', $arr);
            echo NULL;
        } else {
            $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
            $result = $this->Mod_Usser->pn_get_conversacion($result[0]->id_dialogo)->result();
            $opcion = $this->db->update('pn_dialogo_texto', array('leido' => 1), array('remitente' => $id_restaurante));
            echo json_encode($result);
        }
    }

    function pn_establecer_dialog_restaurante() {
        $id_usser = $_REQUEST['id_usser'];
        $id_anuncio = $_REQUEST['id_anuncio'];
        $id_restaurante = $_REQUEST['id_restaurante'];
        $arr = array('id_anuncio' => $id_anuncio, 'id_usuario' => $id_usser, 'id_restaurante' => $id_restaurante);
        $result = $this->db->get_where('pn_dialogo', $arr)->result();
        if (empty($result)) {
            $result = $this->db->insert('pn_dialogo', $arr);
            $a = array();
            echo json_encode($a);
        } else {
            $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
            $result = $this->Mod_Usser->pn_get_conversacion($result[0]->id_dialogo)->result();
            $opcion = $this->db->update('pn_dialogo_texto', array('leido' => 1), array('remitente' => $id_usser));
            echo json_encode($result);
        }
    }

    function pn_get_dialogo_no_leido($id_usuario, $id_restaurante, $id_remitente) {
        $sql = "SELECT COUNT(pn_dialogo_texto.leido) as leido FROM pn_dialogo INNER JOIN pn_dialogo_texto ON (pn_dialogo.id_dialogo = pn_dialogo_texto.id_dialogo)
where pn_dialogo.id_restaurante = '$id_restaurante' and  pn_dialogo.id_usuario = '$id_usuario' and pn_dialogo_texto.remitente = '$id_remitente' and pn_dialogo_texto.leido = 0";

        return $this->db->query($sql);
    }

    //guarda y devuelve el ultmio tek
    function pn_guardar_dialog() {
        $id_usser = $this->input->post("id_usser");
        $id_dialog = $this->input->post("id_anuncio");
        $id_restaurante = $this->input->post("id_restaurante");
        $id_descripcion = $this->input->post("descripcion");
        $arr = array('id_anuncio' => $id_dialog, 'id_usuario' => $id_usser, 'id_restaurante' => $id_restaurante);
        $result = $this->db->get_where('pn_dialogo', $arr)->result();
        $time = date('Y-m-d H:i:s');
        $arrAux = array('remitente' => $id_usser, 'dialogo' => $id_descripcion, 'id_dialogo' => $result[0]->id_dialogo, 'fecha' => $time, 'leido' => 0);
        $result = $this->db->insert('pn_dialogo_texto', $arrAux);
        echo $result;
    }

    function pn_guardar_dialog_restaurante() {
        $id_usser = $this->input->post("id_usser");
        $id_dialog = $this->input->post("id_anuncio");
        $id_restaurante = $this->input->post("id_restaurante");
        $id_descripcion = $this->input->post("descripcion");
        $arr = array('id_anuncio' => $id_dialog, 'id_usuario' => $id_usser, 'id_restaurante' => $id_restaurante);
        $result = $this->db->get_where('pn_dialogo', $arr)->result();
        $time = date('Y-m-d H:i:s');
        $arrAux = array('remitente' => $id_restaurante, 'dialogo' => $id_descripcion, 'id_dialogo' => $result[0]->id_dialogo, 'fecha' => $time);
        $result = $this->db->insert('pn_dialogo_texto', $arrAux);
        echo $result;
    }

    function pn_get_restaurante_seguir_anuncio() {
        $data['usser'] = $this->session->userdata('usserLog');
        $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction

        if (!$sidx)
            $sidx = 1; // connect to the database

        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $result = $this->Mod_Usser->pn_get_restaurante_seguir_anuncio($data['usser']["id_usser"])->result();
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
            $response->rows[0]['cell'] = null;
            echo (json_encode($response));
        } else {
            $a = 0;
            for ($i = $start; $i < $total; $i++) {
                $response->rows[$a]['id'] = $result[$i]->id_annonce; //id
                if ($result[$i]->aceptado == 0) {
                    $texto = "En espera";
                } else {
                    $texto = "Aceptado";
                }
                $leido = $this->pn_get_dialogo_no_leido($result[$i]->id_usser, $result[$i]->id_restaurant, $result[$i]->id_usser)->result();
                $txtleido = '<span class="badge badge-important">' + $leido[0]->leido + '</span>';
                $response->rows[$a]['cell'] = array($result[$i]->id_annonce, $result[$i]->id_restaurant, $result[$i]->id_usser, $result[$i]->nombre, $result[$i]->montant_usser, $result[$i]->costo, $result[$i]->descripcion, $texto, $txtleido);
                $a++;
            }

            echo (json_encode($response));
        }
    }

    function pn_obtener_municipalite() {
        $result = $this->db->get_where('pn_municipalite', array('id_province' => $_REQUEST['id']))->result();
        echo json_encode($result);
    }

    //---------------------------- Todo lo del index
    function view_index_anuncio_seleccionado($anuncio) {

        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);

        $this->load->view('navidad/view_publicite');
        $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //$data_modele_Index["anuncio"] = $this->db->get_where('pn_annonce', array('id_annonce' => $anuncio))->result();
        //var_dump($data_modele_Index);
        $data_modele_Index["anuncio"] = $this->Mod_Usser->pn_get_anuncio($anuncio);
        $data_modele_Index["restaurantes"] = $this->Mod_Usser->pn_get_anuncio_oferta_restuarante($anuncio);
        //$data_modele["AnuncioProvinca"] = $this->Mod_Usser->pn_get_anuncio_provincia();
        //$data_modele_Index["provincia"] = $this->load->view('navidad/view_usser/view_cant_anuncio_provincia', $data_modele, true);

        $AnuncioProvinca["AnuncioProvinca"] = $this->Mod_Usser->pn_get_cant_anuncio_provincia();
        $AnuncioProvinca["title"] = "Anuncios por Provincia";
        $AnuncioProvinca["accion"] = "pn_seccion_anuncios_provincia";
        $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_cant_anuncio_provincia', $AnuncioProvinca, true);
        //-
        $data_find["provincia"] = $this->db->get('pn_province')->result();
        $data_modele_Index["busqueda"] = $this->load->view('navidad/view_usser/view_busqueda_restaurante', $data_find, true);
        
        //$----------------------------------------------
           //- 
        //-------------------
        //paginado
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/navidad/c_navidad/view_index_anuncio_seleccionado/'.$anuncio.'';
        $config['total_rows'] = count($data_modele_Index["restaurantes"]);
        $config['per_page'] = 5;
        $config['num_links'] = 5;
        $config['uri_segment'] = 5;
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = ' </ul></div>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active" ><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        //iniciamos la paginacion
        $this->pagination->initialize($config);
        $pagina = ($this->uri->segment(5) / $this->pagination->per_page) + 1;
        $data_modele_Index['link'] = $this->pagination->create_links();
        $data_modele_Index["start"] = ($this->pagination->per_page * $pagina) - $this->pagination->per_page;
        $data_modele_Index["end"] = ($this->pagination->per_page * $pagina);
        if ($data_modele_Index["end"] > $this->pagination->total_rows) {
            $data_modele_Index["end"] = $this->pagination->total_rows;
        }
        $data_modele_Index['link'] = $this->pagination->create_links();

        //var_dump($data_modele_Index["ultimos_Anuncios"]);
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_index_anuncio_seleccionado', $data_modele_Index, true);
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_paginado_restaurante() {
        
    }

    function pn_publicidad_comercial() {
        if (isset($inicio) && isset($fin)) {
            $inicio = 0;
            $fin = 3;
        }
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        // $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $data_modele_Index["promociones_text"] = $this->Mod_Usser->get_Ultima_promociones('text');
        $data_modele_Index["promociones_img"] = $this->Mod_Usser->get_Ultima_promociones('img');

        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        //--
        $AnuncioProvinca["AnuncioProvinca"] = $this->Mod_Usser->pn_get_restaurante_provincia();
        $AnuncioProvinca["title"] = "Restaurante por Provincia";
        $AnuncioProvinca["accion"] = "pn_show_restaurante_provincia";
        $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_cant_anuncio_provincia', $AnuncioProvinca, true);
        //-
        $data_find["provincia"] = $this->db->get('pn_province')->result();
        $data_modele_Index["busqueda"] = $this->load->view('navidad/view_usser/view_busqueda_restaurante', $data_find, true);
        
        //$----------------------------------------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        //$dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        //$dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        // $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_modele_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        //--
        $data_modele_Index["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_comercial_promociol', $data_modele_Index, true);
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_show_restaurante_provincia($dato) {
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        // $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $data_modele_Index["restaurantes"] = $this->Mod_Usser->pn_get_all_restaurante_provincia($dato);
        //--
        $AnuncioProvinca["AnuncioProvinca"] = $this->Mod_Usser->pn_get_restaurante_municipio($dato);
        //$data_modele_Index["provincia"] = $data_modele_Index["restaurantes"][0]->prenom;
        $AnuncioProvinca["title"] = "Restaurante por Zona";
        $AnuncioProvinca["accion"] = "pn_show_restaurante_zona";
        $AnuncioProvinca["idProv"] = $dato;
        $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_cant_anuncio_municipio', $AnuncioProvinca, true);
        //- 
        //-------------------
        //paginado
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/navidad/c_navidad/pn_seccion_anuncios';
        $config['total_rows'] = count($data_modele_Index["restaurantes"]);
        $config['per_page'] = 7;
        $config['num_links'] = 5;
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = ' </ul></div>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active" ><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        //iniciamos la paginacion
        $this->pagination->initialize($config);
        $pagina = ($this->uri->segment(3) / $this->pagination->per_page) + 1;
        $data_modele_Index['link'] = $this->pagination->create_links();
        $data_modele_Index["start"] = ($this->pagination->per_page * $pagina) - $this->pagination->per_page;
        $data_modele_Index["end"] = ($this->pagination->per_page * $pagina);
        if ($data_modele_Index["end"] > $this->pagination->total_rows) {
            $data_modele_Index["end"] = $this->pagination->total_rows;
        }
        $data_modele_Index['link'] = $this->pagination->create_links();
        //--------------
        //- 
        $url = anchor('navidad/c_navidad/pn_publicidad_comercial', 'Promociones');
        $data_modele_Index['barNav'] = '<ul class="breadcrumb"><li>' . $url . '</li></ul>';
        //--
          //$----------------------------------------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        //$dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        //$dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        // $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_modele_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        //--
        $data_find["provincia"] = $this->db->get('pn_province')->result();
        $data_modele_Index["busqueda"] = $this->load->view('navidad/view_usser/view_busqueda_restaurante', $data_find, true);

        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_restaurantes_provincias_municipio', $data_modele_Index, true);
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_show_restaurante_zona($dato, $provincia) {
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        // $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $data_modele_Index["restaurantes"] = $this->Mod_Usser->pn_get_all_restaurante_Zona($dato);

        //--
        //-------------------
        //paginado
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/navidad/c_navidad/pn_seccion_anuncios';
        $config['total_rows'] = count($data_modele_Index["restaurantes"]);
        $config['per_page'] = 7;
        $config['num_links'] = 5;
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = ' </ul></div>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active" ><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        //iniciamos la paginacion
        $this->pagination->initialize($config);
        $pagina = ($this->uri->segment(3) / $this->pagination->per_page) + 1;
        $data_modele_Index['link'] = $this->pagination->create_links();
        $data_modele_Index["start"] = ($this->pagination->per_page * $pagina) - $this->pagination->per_page;
        $data_modele_Index["end"] = ($this->pagination->per_page * $pagina);
        if ($data_modele_Index["end"] > $this->pagination->total_rows) {
            $data_modele_Index["end"] = $this->pagination->total_rows;
        }
        $data_modele_Index['link'] = $this->pagination->create_links();
        //--------------
        //$AnuncioProvinca["AnuncioProvinca"] = $this->Mod_Usser->pn_get_restaurante_municipio();
        $data_modele_Index["provincia"] = $data_modele_Index["restaurantes"][0]->prenom;
        //$AnuncioProvinca["title"] = "Restaurante por Zona";
        //$data_modele_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_cant_anuncio_provincia', $AnuncioProvinca, true);
        //- 
        $url = anchor('navidad/c_navidad/pn_publicidad_comercial', 'Promociones');
        $url1 = anchor('navidad/c_navidad/pn_show_restaurante_provincia/' . $provincia, 'Provincia');
        $data_modele_Index['barNav'] = '<ul class="breadcrumb"><li>' . $url . '<span class="divider">/</span></li>
            <li>' . $url1 . '</li></ul>';
        //--
           //$------------Promociones------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_modele_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        //--
        
        
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_restaurantes_provincias_municipio', $data_modele_Index, true);
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_seccion_anuncios() {

        if (!isset($pag)) {
            $pag = 1;
        }

        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');

        // $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //$data_modele_Index["promociones_text"] = $this->db->get_where('pn_promociones_restaurante', array('tipo_promocion' => 'text'))->result();
        $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_all_seccion_anuncio();
        //-- Esto funciona para la busqueda de anuncion dentro de los anuncios
        $data_find["provincia"] = $this->db->get('pn_province')->result();
        $data_modele_Index["busqueda"] = $this->load->view('navidad/view_usser/view_busqueda_anuncio', $data_find, true);
        //-------------------
        //paginado
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/navidad/c_navidad/pn_seccion_anuncios';
        $config['total_rows'] = count($data_modele_Index["ultimos_Anuncios"]);
        $config['per_page'] = 6;
        $config['num_links'] = 5;
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = ' </ul></div>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active" ><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        //iniciamos la paginacion
        $this->pagination->initialize($config);
        $pagina = ($this->uri->segment(4) / $this->pagination->per_page) + 1;
        $data_modele_Index['link'] = $this->pagination->create_links();
        $data_modele_Index["start"] = ($this->pagination->per_page * $pagina) - $this->pagination->per_page;
        $data_modele_Index["end"] = ($this->pagination->per_page * $pagina);
        if ($data_modele_Index["end"] > $this->pagination->total_rows) {
            $data_modele_Index["end"] = $this->pagination->total_rows;
        }
        $data_modele_Index['link'] = $this->pagination->create_links();
        //--------------
        $AnuncioProvinca["AnuncioProvinca"] = $this->Mod_Usser->pn_get_cant_anuncio_provincia();
        $AnuncioProvinca["title"] = "Anuncios por Provincia";
        $AnuncioProvinca["accion"] = "pn_seccion_anuncios_provincia";
        $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_cant_anuncio_provincia', $AnuncioProvinca, true);

        //$----------------------------------------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        //$dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        //$dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        //$dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
         $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_modele_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        //----------------------------
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_seccion_anuncio', $data_modele_Index, true);

        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_seccion_anuncios_PAG() {
        
    }

    function pn_seccion_anuncios_provincia($idp) {

        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        // $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //$data_modele_Index["promociones_text"] = $this->db->get_where('pn_promociones_restaurante', array('tipo_promocion' => 'text'))->result();
        $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_anuncio_provincia($idp);

        //--
        $AnuncioProvinca["AnuncioProvinca"] = $this->Mod_Usser->pn_get_cant_anuncio_zona($idp);
        $AnuncioProvinca["title"] = "Anuncios por Zona";
        $AnuncioProvinca["accion"] = "pn_seccion_show_anuncios_zona";
        $AnuncioProvinca["idProv"] = $idp;
        $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_cant_anuncio_municipio', $AnuncioProvinca, true);
        
        //paginado
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/navidad/c_navidad/pn_seccion_anuncios';
        $config['total_rows'] = count($data_modele_Index["ultimos_Anuncios"]);
        $config['per_page'] = 7;
        $config['num_links'] = 5;
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = ' </ul></div>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active" ><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        //iniciamos la paginacion
        $this->pagination->initialize($config);
        $pagina = ($this->uri->segment(3) / $this->pagination->per_page) + 1;
        $data_modele_Index['link'] = $this->pagination->create_links();
        $data_modele_Index["start"] = ($this->pagination->per_page * $pagina) - $this->pagination->per_page;
        $data_modele_Index["end"] = ($this->pagination->per_page * $pagina);
        if ($data_modele_Index["end"] > $this->pagination->total_rows) {
            $data_modele_Index["end"] = $this->pagination->total_rows;
        }
        $data_modele_Index['link'] = $this->pagination->create_links();
        //--------------
        
        $url = anchor('navidad/c_navidad/pn_seccion_anuncios', 'Anuncios');
        $data_modele_Index['barNav'] = '<ul class="breadcrumb"><li>' . $url . '</li></ul>';
        //- 
             //$------------Promociones------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        //$dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_modele_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        //--
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele_Index["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_seccion_anuncio', $data_modele_Index, true);

        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_seccion_show_anuncios_zona($idp, $provincia) {
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        // $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //$data_modele_Index["promociones_text"] = $this->db->get_where('pn_promociones_restaurante', array('tipo_promocion' => 'text'))->result();
        $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_anuncio_zona($idp);
        //paginado
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/navidad/c_navidad/pn_seccion_anuncios';
        $config['total_rows'] = count( $data_modele_Index["ultimos_Anuncios"]);
        $config['per_page'] = 7;
        $config['num_links'] = 5;
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = ' </ul></div>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active" ><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        //iniciamos la paginacion
        $this->pagination->initialize($config);
        $pagina = ($this->uri->segment(3) / $this->pagination->per_page) + 1;
        $data_modele_Index['link'] = $this->pagination->create_links();
        $data_modele_Index["start"] = ($this->pagination->per_page * $pagina) - $this->pagination->per_page;
        $data_modele_Index["end"] = ($this->pagination->per_page * $pagina);
        if ($data_modele_Index["end"] > $this->pagination->total_rows) {
            $data_modele_Index["end"] = $this->pagination->total_rows;
        }
        $data_modele_Index['link'] = $this->pagination->create_links();
        //--
        //$AnuncioProvinca["AnuncioProvinca"] = $this->Mod_Usser->pn_get_cant_anuncio_zona($idp);
        //$AnuncioProvinca["title"] = "Anuncios por Zona";
        //$AnuncioProvinca["accion"] = ""; 
        //$data_modele_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_cant_anuncio_municipio', $AnuncioProvinca, true);
        $url = anchor('navidad/c_navidad/pn_seccion_anuncios', 'Anuncios');
        $url1 = anchor('navidad/c_navidad/pn_seccion_anuncios_provincia/' . $provincia, 'Provincia');
        $data_modele_Index['barNav'] = '<ul class="breadcrumb"><li>' . $url . '<span class="divider">/</span></li>
            <li>' . $url1 . '</li></ul>';
        //- 
             //$------------Promociones------------
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocionRest['promocionPromocion'] = "";
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_modele_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        //--
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele_Index["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_seccion_anuncio', $data_modele_Index, true);

        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    // busca los anuncios Anuncios
    function pn_show_find() {
        $pn_find_Provincia = $this->input->post("pn_find_Provincia");
        $pn_find_municipio = $this->input->post("pn_find_municipio");
        $ultimosAnuncios = $this->input->post("ultimosAnuncios");
        $pn_find_clasificacion = $this->input->post("pn_find_clasificacion");

        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        // $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //-- Esto funciona para la busqueda de anuncion dentro de los anuncios
        $data_find["provincia"] = $this->db->get('pn_province')->result();
        $data_modele_Index["busqueda"] = $this->load->view('navidad/view_usser/view_busqueda_anuncio', $data_find, true);
        //----- manda a generar la sql con los datos que me pasan 
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->get_find_anuncio($pn_find_Provincia, $pn_find_municipio, $pn_find_clasificacion, $ultimosAnuncios);
        //--
        if ($pn_find_Provincia == -1 && $pn_find_municipio == -1) {
            $AnuncioProvinca["AnuncioProvinca"] = $this->Mod_Usser->pn_get_cant_anuncio_provincia();
            $AnuncioProvinca["title"] = "Anuncios por Provincia";
            $AnuncioProvinca["accion"] = "pn_seccion_anuncios_provincia";
            $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_cant_anuncio_provincia', $AnuncioProvinca, true);
        } else {
            $AnuncioProvinca["AnuncioProvinca"] = $this->Mod_Usser->pn_get_cant_anuncio_zona($pn_find_Provincia);
            $AnuncioProvinca["title"] = "Anuncios por Zona";
            $AnuncioProvinca["accion"] = "pn_seccion_show_anuncios_zona";
            $AnuncioProvinca["idProv"] = $pn_find_Provincia;
            $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_cant_anuncio_municipio', $AnuncioProvinca, true);
        }
        //paginado
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/navidad/c_navidad/pn_seccion_anuncios';
        $config['total_rows'] = count( $data_modele_Index["ultimos_Anuncios"]);
        $config['per_page'] = 7;
        $config['num_links'] = 5;
        $config['uri_segment'] = 4;
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = ' </ul></div>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active" ><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        //iniciamos la paginacion
        $this->pagination->initialize($config);
        $pagina = ($this->uri->segment(3) / $this->pagination->per_page) + 1;
        $data_modele_Index['link'] = $this->pagination->create_links();
        $data_modele_Index["start"] = ($this->pagination->per_page * $pagina) - $this->pagination->per_page;
        $data_modele_Index["end"] = ($this->pagination->per_page * $pagina);
        if ($data_modele_Index["end"] > $this->pagination->total_rows) {
            $data_modele_Index["end"] = $this->pagination->total_rows;
        }
        $data_modele_Index['link'] = $this->pagination->create_links();
        //--
        //- 
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_seccion_anuncio', $data_modele_Index, true);

        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    // busca los Restaurante
    function pn_show_find_restaurante() {
        $pn_find_Provincia = $this->input->post("pn_find_Provincia");
        $pn_find_municipio = $this->input->post("pn_find_municipio");
        $ultimosAnuncios = $this->input->post("ultimosAnuncios");
        $restaurante_Exitos = $this->input->post("restaurante_Exitos");

        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        // $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //-- Esto funciona para la busqueda de anuncion dentro de los anuncios
        $data_find["provincia"] = $this->db->get('pn_province')->result();
        $data_modele_Index["busqueda"] = $this->load->view('navidad/view_usser/view_busqueda_anuncio', $data_find, true);
        //----- manda a generar la sql con los datos que me pasan 
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $data_modele_Index["restaurantes"] = $this->Mod_Usser->get_find_restaurante($pn_find_Provincia, $pn_find_municipio, $restaurante_Exitos, $ultimosAnuncios);
       
        $data_modele_Index["provincia"] = "";
        if (!empty($data_modele_Index["restaurantes"])) {
//--
            if ($pn_find_Provincia == -1 && $pn_find_municipio == -1) {
                $AnuncioProvinca["AnuncioProvinca"] = $this->Mod_Usser->pn_get_restaurante_provincia();
                $AnuncioProvinca["title"] = "Restaurante por Provincia";
                $AnuncioProvinca["accion"] = "pn_show_restaurante_provincia";

                $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_cant_anuncio_provincia', $AnuncioProvinca, true);
            } else {
                $AnuncioProvinca["AnuncioProvinca"] = $this->Mod_Usser->pn_get_restaurante_municipio($pn_find_Provincia);
                $AnuncioProvinca["title"] = "Restaurante por Zona";
                $AnuncioProvinca["accion"] = "pn_show_restaurante_zona";
                $AnuncioProvinca["idProv"] = $pn_find_Provincia;

                $data_modele_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_cant_anuncio_municipio', $AnuncioProvinca, true);
            }
        }
        //paginado
        //-------------------
        //paginado
        //En el controlador cargamos las librerias
        //En el controlador cargamos las librerias
        $this->load->library('pagination');
        //Configuramos los datos de la paginacion
        if (!isset($pag)) {
            $pag = 1;
        }
        $config['base_url'] = base_url() . 'index.php/navidad/c_navidad/pn_show_find_restaurante';
        $config['total_rows'] = count($data_modele_Index["restaurantes"]);
        $config['per_page'] = 6;
        $config['num_links'] = 5;
        $config['uri_segment'] = 4;

        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = ' </ul></div>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&gt';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&lt';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active" ><a>';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';


        //iniciamos la paginacion
        $this->pagination->initialize($config);
        //Cargamos los datos para la tabla OJO! acá va el limit
        $pagina = ($this->uri->segment(4) / $this->pagination->per_page) + 1;

        $data_modele_Index['link'] = $this->pagination->create_links();
        $data_modele_Index["start"] = ($this->pagination->per_page * $pagina) - $this->pagination->per_page;
        $data_modele_Index["end"] = ($this->pagination->per_page * $pagina);
        if ($data_modele_Index["end"] > $this->pagination->total_rows) {
            $data_modele_Index["end"] = $this->pagination->total_rows;
        }


        $data_modele_Index['link'] = $this->pagination->create_links();

        //----------------
        $url = anchor('navidad/c_navidad/pn_publicidad_comercial', 'Promociones');
        $data_modele_Index['barNav'] = '<ul class="breadcrumb"><li>' . $url . '</li></ul>';
        //- 
        $data_find["provincia"] = $this->db->get('pn_province')->result();
        $data_modele_Index["busqueda"] = $this->load->view('navidad/view_usser/view_busqueda_restaurante', $data_find, true);
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        // $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_restaurantes_provincias_municipio', $data_modele_Index, true);
 $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }
    /**
     * Dado un restaurante muestra la FT
     * @param type $id
     */
    function pn_show_ficha_tecnica($id)
    {
       $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //$data['usser'] = $this->session->userdata('usserLog');
        //devuelve los datos del restaurnate
        $resutl = $this->Mod_Usser->pn_get_all_menu($id);
        $this->load->helper(array('form', 'url'));
        //$this->load->view('navidad/view_tete');
        $resultRestaurante = $this->db->get_where('pn_restaurant', array('id_usuario' => $id))->result();
       
        //$configTipoRegistro = $this->db->get_where('pn_config_nom_registro', array('id_nom_registro' => $resultRestaurante[0]->id_tipo_registro))->result();
        //$configTipoRegistroRestaurante = $this->db->get_where('pn_restaurant_datos_config', array('id_restaurante' => $data['usser']["id_usser"]))->result();
        //$data['pedidosHechos'] = $configTipoRegistroRestaurante[0]->cantPedidos;
        //$data['pedidoTotal'] = $configTipoRegistro[0]->cantPedido;
        //$data_usser['opcion'] = null;
        //if (isset($this->opcion)) {
         //   $data_usser['opcion'] = $this->opcion;
        //}
        //$this->load->view('navidad/view_menu', $data);
        //$this->load->view('navidad/view_publicite');
        $data_modeleFT["menu"] = $resutl[0];
        $data_modeleFT["fotos"] = $resutl[1];
        $cant = count($this->db->get_where('pn_restaurant_annonce', array('id_restaurant' => $id))->result());
        $data_modeleFT["presupuesto"] = $cant;
        //la parte del config
        //$this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //$resutl = $this->Mod_Usser->pn_config_datos_restaurante($data['usser']["id_usser"]);
        //$data_modele["configR"] = $this->load->view('navidad/view_usser/view_datos_config_restaurante', $resutl, true);
        //$data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_restaurante_ficha_tecnica', $data_modele, true);
        
        ////////
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $data["dataUsser"] = $this->load->view('navidad/view_Informations_Utilisateur', '', true);
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        
        
        
       
        
        

        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_Ficha_tecnica_general', $data_modeleFT, true);
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);  
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
        
        
    }
    function pn_enviar_email1() {
//      $this->load->library('email');
//      $config['protocol'] = 'smtp';
//        $config['smtp_port'] = '25';
//        $config['smtp_host'] = 'smtp.uci.cu';
//        $config['smtp_user'] = 'hlpupo';
//        $config['smtp_pass'] = 'Yoelvis *16';
//        
//        $config['charset'] = 'iso-8859-1';
//        $config['wordwrap'] = TRUE;
//        $this->email->initialize($config);
//      
//        $this->email->from('hlpupo@uci.cu', 'Hector Luis');
//        $this->email->to('hlpupo@uci.cu');
////        $this->email->cc('otro@otro-ejemplo.com');
////        $this->email->bcc('ellos@su-ejemplo.com');
//        $this->email->subject('Correo de Prueba');
//        $this->email->message('Probando la clase email');
//        $this->email->send();
//        echo $this->email->print_debugger();

        require_once 'Zend/Mail.php';
        require_once 'Zend/Mail/Transport/Smtp.php';


        $user = 'hlpupo@uci.cu';
        $pass = 'Alejandra *14';

        $mail = new Zend_Mail ();

        $transport_config = array('auth' => 'login',
            'username' => $user,
            'password' => $pass,
            'ssl' => 'tls',
            'port' => 25);

        $from = 'hlpupo@uci.cu';
        $msg = 'Hola';
        $subject = 'Asunto';
        $to = 'hlpupo@uci.cu';

        $transport = new Zend_Mail_Transport_Smtp('smtp.uci.cu', $transport_config);

        $mail->setDefaultTransport($transport);
        $mail->setBodyHtml(utf8_decode($msg));
        $mail->setFrom($user, $from);
        $mail->addTo($to, 'Some Recipient');
        $mail->setSubject($subject);
        $mail->send();
    }

    /**
     * Funcion para enviar msg
     * @param type $destinatario
     * @param type $mensaje
     */
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

}

?>
