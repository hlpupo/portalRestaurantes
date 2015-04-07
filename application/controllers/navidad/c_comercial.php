<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class C_Comercial extends CI_Controller {

    function index() {
        
    }

    function pn_view_alta_restaurante() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $data_usser['opcion'] = null;
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');

        //----------------------


        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $resutl = $this->Mod_Usser->pn_cmv_get_info($data['usser']["id_usser"]);
        $data_Publicidad_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_comercial_venta/view_cmv_config_restaurante', $resutl, true);

        $data['usser'] = $this->session->userdata('usserLog');
        $data_usser["provincia"] = $this->db->get('pn_province')->result();

        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_comercial_venta/view_form_alta_restaurante', $data_usser, true);
        //$data_modele["dataindex"] = $this->load->view('navidad/view_corps_index', $data_modele_Index, true);
        //$dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //$data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
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

    function pn_cmv_save_borrador() {
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
        $pn_Nota = $this->input->post("pn_Nota");
        $id_borrador = $this->input->post("pn_id_borrador");

        if ($pn_modo_registro == 0) {
            $tipo_pago_campana = 0;
        }
        $data['usser'] = $this->session->userdata('usserLog');
        $arr = array(
            'nota' => $pn_Nota,
            'nombre' => $nombre,
            'email' => $email,
            'direccion' => $pn_direccion,
            'id_provincia' => $prov,
            'id_municipio' => $mun,
            'cif' => $pn_cif,
            'telefono' => $pn_phone,
            'codigo_postal' => $pn_codigo,
            'tipo_pago' => $tipo_pago_campana,
            'id_comercial' => $data['usser']["id_usser"]
        );
        if (isset($id_borrador) && !empty($id_borrador)) {

            $opcion = $this->db->update('pn_borrador_form_restaurant', $arr, array('id_borrador' => $id_borrador));
        } else {
            $opcion = $this->db->insert('pn_borrador_form_restaurant', $arr);
        }
        echo $opcion;
    }

    function pn_cmv_save_restaurnate() {

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
        $id_borrador = $this->input->post("pn_id_borrador");
        $data['usser'] = $this->session->userdata('usserLog');

        if (!empty($prov) && !empty($mun) && !empty($nombre) && !empty($email)
                && !empty($pn_phone) && !empty($pn_cif) && !empty($pn_direccion) && !empty($pn_codigo)) {
            if (preg_match('/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/', $email)) {
                $pasw = random_string('alnum', 10);
                if ($pn_modo_registro == 0) {
                    $tipo_pago_campana = 0;
                }
                //busco otro correo
                $emailDat = $this->db->get_where('pn_usser', array('email' => $email))->result();
                if (empty($emailDat)) {
                    $arr = array('tipo_usser' => '3', 'email' => $email, 'section_active' => 1, 'nombre' => $nombre, 'apellidos' => '',
                        'id_province' => $prov, 'id_municipalite' => '1', 'password' => $pasw);
                    $this->db->insert('pn_usser', $arr);
                    $usser_id = $this->db->insert_id();
                    $arr1 = array(
                        'direccion' => $pn_direccion,
                        'cif' => $pn_cif,
                        'telefono' => $pn_phone,
                        'codigo_postal' => $pn_codigo,
                        'id_usuario' => $usser_id,
                        'id_tipo_registro' => $tipo_pago_campana
                    );
                    $this->opcion = $this->db->insert('pn_restaurant', $arr1);
                    $configTipoUser = $this->db->get_where('pn_config_nom_registro', array('id_nom_registro' => $tipo_pago_campana))->result();
                    $arr2 = array(
                        'cantPedidos' => 0,
                        'cantFotos' => 0,
                        'id_restaurante' => $usser_id
                    );
                    $this->opcion = $this->db->insert('pn_restaurant_datos_config', $arr2);
                    $this->db->delete('pn_borrador_form_restaurant', array('id_borrador' => $id_borrador));
                    //$this->pn_enregistrer_restaurante();
                } else {
                    $this->opcion = 3; //email
                }
            } else {
                $this->opcion = 2; //email
                //$this->pn_enregistrer_restaurante();
            }
        } else {

            $this->opcion = 0; //datos vacio
            //$this->pn_enregistrer_restaurante();
        }
        echo $this->opcion;
    }

    function pn_cmv_grid_restaurante_borrador() {
        $data['usser'] = $this->session->userdata('usserLog');

        $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction
        if (!$sidx)
            $sidx = 1; // connect to the database
        $result = $this->db->get_where('pn_borrador_form_restaurant', array('id_comercial' => $data['usser']["id_usser"]))->result();
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

                $response->rows[$a]['id'] = $result[$i]->id_borrador; //id
                $response->rows[$a]['cell'] = array($result[$i]->id_borrador, $result[$i]->nombre, $result[$i]->nota);
                $a++;
            }
            echo (json_encode($response));
        }
    }

    function pn_cmv_get_restaurante_borrador() {
        $id_borrador = $_REQUEST['id_borrador']; // get the requested page
        $result = $this->db->get_where('pn_borrador_form_restaurant', array('id_borrador' => $id_borrador))->result();
        echo json_encode($result);
    }

    function pn_change_pasword_cmv() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $data_usser['opcion'] = null;
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');


        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $resutl = $this->Mod_Usser->pn_cmv_get_info($data['usser']["id_usser"]);
        $data_Publicidad_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_comercial_venta/view_cmv_config_restaurante', $resutl, true);

        $data['usser'] = $this->session->userdata('usserLog');
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_comercial_venta/view_change_password_cmv', $data_usser, true);
        //$data_modele["dataindex"] = $this->load->view('navidad/view_corps_index', $data_modele_Index, true);
        //$dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //$data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
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

    function pn_change_password_cmv() {
        $data['usser'] = $this->session->userdata('usserLog');
        $pn_old_password = $this->input->post("pn_old_password");
        $pn_new_password = $this->input->post("pn_new_password");
        $pn_repeat_password = $this->input->post("pn_repeat_password");
        if (!empty($pn_old_password) && !empty($pn_new_password) && !empty($pn_repeat_password) && ($pn_new_password == $pn_repeat_password)) {
            $usser = $this->db->get_where('pn_usser', array('id_usser' => $data['usser']["id_usser"], 'password' => $pn_old_password))->result();
            if (!empty($usser)) {
                $this->opcion = $this->db->update('pn_usser', array('password' => $pn_new_password), array('id_usser' => $data['usser']["id_usser"]));
            } else {
                $this->opcion = 0;
            }
        } else {
            $this->opcion = 0;
        }
        echo $this->pn_change_pasword_cmv();
    }
      function pn_change_password_cmp() {
        $data['usser'] = $this->session->userdata('usserLog');
        $pn_old_password = $this->input->post("pn_old_password");
        $pn_new_password = $this->input->post("pn_new_password");
        $pn_repeat_password = $this->input->post("pn_repeat_password");
        if (!empty($pn_old_password) && !empty($pn_new_password) && !empty($pn_repeat_password) && ($pn_new_password == $pn_repeat_password)) {
            $usser = $this->db->get_where('pn_usser', array('id_usser' => $data['usser']["id_usser"], 'password' => $pn_old_password))->result();
            if (!empty($usser)) {
                $this->opcion = $this->db->update('pn_usser', array('password' => $pn_new_password), array('id_usser' => $data['usser']["id_usser"]));
            } else {
                $this->opcion = 0;
            }
        } else {
            $this->opcion = 0;
        }
        echo $this->pn_change_password_cmp();
    }

    //------------------Promociones
    function pn_crear_grud_promocion() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        //datos del config de la cuenta
        //$this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //$resutl = $this->Mod_Usser->pn_cmv_get_info($data['usser']["id_usser"]);
        //$data_Rest["configR"] = $this->load->view('navidad/view_usser/view_comercial_venta/view_cmv_config_restaurante', $resutl, true);
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');

        //-----------------
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //$resutl = $this->Mod_Usser->pn_cmv_get_info($data['usser']["id_usser"]);
        //$data_Publicidad_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_comercial_venta/view_cmv_config_restaurante', $resutl, true);
        //$data_modele_Index["promociones_text"] = $this->Mod_Usser->get_Ultima_promociones('text');
        //$data_modele_Index["promociones_img"] = $this->Mod_Usser->get_Ultima_promociones('img');
        //$data_modele_Index["ultimos_Anuncios"] = $this->Mod_Usser->pn_get_ultimos_anuncio();
        $resutl = $this->Mod_Usser->pn_cmp_get_info($data['usser']["id_usser"]);
        $data_Rest["configR"] = $this->load->view('navidad/view_usser/view_comercial_promocion/view_cmp_config', $resutl, true);
        $data_Rest["restaurante"] = $this->db->get_where('pn_usser', array('tipo_usser' => 3))->result();
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_comercial_promocion/view_grud_promocion', $data_Rest, true);


        //$data_modele["dataindex"] = $this->load->view('navidad/view_corps_index', $data_modele_Index, true);
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //$data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        
         //--------------------------------------
       //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
       //$dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
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

    function pn_cmp_shoe_promociones() {
        $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction
        if (!$sidx)
            $sidx = 1; // connect to the database
        $data['usser'] = $this->session->userdata('usserLog');
        $result = $this->db->get_where('pn_promociones_restaurante', array('author' =>$data['usser']["id_usser"]))->result();
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
                $text = '';
                if ($result[$i]->tipo_promocion == 'text') {
                    $text = "Texto";
                } else {
                    $text = "Imagen";
                }
                if ($result[$i]->activa == 1) {
                    $act = "Activo";
                } else {
                    $act = "No Activo";
                }
                $response->rows[$a]['cell'] = array($result[$i]->id_promociones, $result[$i]->nombre, $text, $act);
                $a++;
            }

            echo (json_encode($response));
        }
    }

    function pn_get_promociones() {
        $result = $this->db->get_where('pn_promociones_restaurante', array('id_promociones' => $_REQUEST['id_promociones']))->result();
        echo json_encode($result);
    }

    function pn_update_promociones() {
        $nombre = $this->input->post('pn_add_prenom');
        $pn_tipo_promocion = $this->input->post('pn_tipo_promocion');
        $texto = $this->input->post('pn_texto');
        $id_promocion = $this->input->post('pn_id_promocion');
        $pn_selectionner_restaurante = $this->input->post('pn_selectionner_restaurante');
        $data['usser'] = $this->session->userdata('usserLog');

        $this->opcion = 0;
        if ($pn_tipo_promocion != 'text') {
            $texto = "a";
        }
        if (!empty($nombre) && !empty($texto)) {
            if ($pn_tipo_promocion == 'text') {
                $arr = array('texto' => $texto, 'nombre' => $nombre, 'tipo_promocion' => 'text', 'id_restaurante' => $pn_selectionner_restaurante, 'author' => $data['usser']["id_usser"]);

                if (!empty($id_promocion)) {
                    $this->opcion = $this->db->update('pn_promociones_restaurante', $arr, array('id_promociones' => $id_promocion));
                } else {
                    $this->opcion = $this->db->insert('pn_promociones_restaurante', $arr);
                }
               
            } else {
                $this->load->library('upload');
                $config['upload_path'] = 'application/views/navidad/upload/promociones';
                $config['allowed_types'] = 'jpg|png|gif';
                $config['max_size'] = 1024 * 2;
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload()) {
                    echo $this->upload->display_errors();
                    //$this->pn_view_restaurante_crear_ficha_tecnica();
                } else {
                    $dataImg = $this->upload->data();
                    $arr = array('url' => $dataImg["file_name"], 'nombre' => $nombre, 'tipo_promocion' => 'img', 'id_restaurante' => $pn_selectionner_restaurante, 'author' => $data['usser']["id_usser"]);
                    if (!empty($id_promocion)) {
                        $img = $this->db->get_where('pn_promociones_restaurante', array('id_promociones' => $id_promocion))->result();
//                        $path = '../../views/navidad/upload/';
//                        unlink($path.$img[0]->url);
                        $this->load->helper("file");
                        $path = 'application/views/navidad/upload/' . $img[0]->url;
                        $a = delete_files($path);
                        $this->opcion = $this->db->update('pn_promociones_restaurante', $arr, array('id_promociones' => $id_promocion));
                    } else {
                        $this->opcion = $this->db->insert('pn_promociones_restaurante', $arr);
                    }
                }
            }
        }
          $texto = "Se ha creado una promoci&oacute;n para su restaurante entre al sistema para aprovarla o rechasarla.";
           $emailAux = $this->db->get_where('pn_usser', array('id_usser' => $pn_selectionner_restaurante))->result();    
         $this->pn_enviar_email($emailAux[0]->email,$texto);
        $this->pn_crear_grud_promocion();
    }

    function pn_del_promociones() {
        $id_promociones = $this->input->post('id_promociones');
        $restul = $this->db->delete('pn_promociones_restaurante', array('id_promociones' => $id_promociones));
        echo $restul;
    }

    function pn_activar_promociones() {
        $id_promociones = $_REQUEST['id_promociones'];

        $result = $this->db->get_where('pn_promociones_restaurante', array('id_promociones' => $id_promociones))->result();

        if ($result[0]->activa == 0) {
            $act = 1;
        } else {
            $act = 0;
        }

        $restul = $this->db->update('pn_promociones_restaurante', array('activa' => $act), array('id_promociones' => $id_promociones));
        echo $restul;
    }

    function pn_change_pasword_cmp() {
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
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $resutl = $this->Mod_Usser->pn_cmp_get_info($data['usser']["id_usser"]);
        $resutl["informacion"] = $this->load->view('navidad/view_usser/view_show_information', $data_usser, true);
             //--------------------------------------
       //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
        //$dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
        $dataPromocion["topRestaurante"] = $this->load->view('navidad/view_usser/view_top_dix_restaurante', $dataTopDix, true);
        $dataPromocion["promocionImgRest"] = $this->load->view('navidad/view_usser/view_publicidad_restaurante', $dataPromocionRest, true);
        //$dataPromocion["promocionAnuncio"] = $this->load->view('navidad/view_usser/view_publicidad_anuncios', '', true);
        $data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        $data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
        //-----------------
         $resutl = $this->Mod_Usser->pn_cmp_get_info($data['usser']["id_usser"]);
        $data_usser["configR"] = $this->load->view('navidad/view_usser/view_comercial_promocion/view_cmp_config', $resutl, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_comercial_promocion/view_change_password_cmp', $data_usser, true);
         $data["ultimos"] = $this->Mod_Usser->pn_get_ultimos_restaurantes();
        $data_modele["utlimosR"] = $this->load->view('navidad/view_usser/view_ultimos_restaurantes', $data, true);
        $this->load->view('navidad/view_corps', $data_modele);
        $this->load->view('navidad/view_piedPage');
    }

    function pn_crear_grud_usuario() {
        $this->load->helper(array('form', 'url'));
        $this->load->view('navidad/view_tete');
        $data['usser'] = $this->session->userdata('usserLog');
        $this->load->view('navidad/view_menu', $data);
        $this->load->view('navidad/view_publicite');
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        //$resutl = $this->Mod_Usser->pn_cmv_get_info($data['usser']["id_usser"]);
        //$data_Publicidad_Index["dataUsser"] = $this->load->view('navidad/view_usser/view_comercial_venta/view_cmv_config_restaurante', $resutl, true);
        $data_usser['opcion'] = null;
        if (isset($this->opcion)) {
            $data_usser['opcion'] = $this->opcion;
        }
        $resutl = $this->Mod_Usser->pn_cmp_get_info($data['usser']["id_usser"]);
        $data_show_usser["configR"] = $this->load->view('navidad/view_usser/view_comercial_promocion/view_cmp_config', $resutl, true);
        $data_usser["informacion"] = $this->load->view('navidad/view_usser/view_show_information', $data_usser, true);
        $data_usser["provincia"] = $this->db->get('pn_province')->result();
        $data_show_usser["show_usser"] = $this->load->view('navidad/view_usser/view_comercial_promocion/view_forme_registrar_usser_cmp', $data_usser, true);
        $data_modele["dataindex"] = $this->load->view('navidad/view_usser/view_comercial_promocion/view_grud_usuario', $data_show_usser, true);

        $dataPromocion['promocionPortal'] = $this->db->get_where('pn_promociones_restaurante', array('id_restaurante' => '-1'))->result();
        //$data_Publicidad_Index["publicidad"] = $this->load->view('navidad/view_index_publicidad', $dataPromocion, true);
        //$data_modele["areaPublicidad"] = $this->load->view('navidad/view_show_publicidad', $data_Publicidad_Index, true);
                 //--------------------------------------
       //esto es para que salgan 5 imagenes de prmocion ahi
        $dataPromocionRest['promocionImgRest'] = $this->Mod_Usser->get_randon_promociones('img');
        $dataTopDix["topDixRestaurante"] =$this->Mod_Usser->pn_get_top_dix_restaurante(); 
      // $dataPromocionRest['promocionPromocion'] = "";
        //$dataPromocionRest['promocionComida'] = "";
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

    function pn_enregistrer_usser_cmp() {
        $email = $this->input->post("pn_add_e_mail");
        $nombre = $this->input->post("pn_add_prenom");
        $apell = $this->input->post("pn_add_nom");
        $prov = $this->input->post("pn_selectionner_Provincia");
        $muni = $this->input->post("pn_selectionner_municipio");
        $updateUsser = $this->input->post("pn_id_usser_cmp");
        if( !empty($email) && !empty($nombre) && !empty($apell) && !empty($prov) && !empty($muni) )
        {
        $this->load->helper('string');
        if (preg_match('/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/', $email)) {
            $this->load->library('encrypt');
            $pasw = random_string('alnum', 10);
            $cod = random_string('alnum', 5);
            $hash = $this->encrypt->sha1($pasw);
            $arr = array('tipo_usser' => '2', 'email' => $email, 'section_active' => 0, 'nombre' => $nombre, 'apellidos' => $apell, 
                'id_province' => $prov, 'id_municipalite' => $muni, 'password' => $hash,'codigo_activacion'=>$cod);
            if(!empty($updateUsser))
            {
                $arrUpdate = array('email' => $email, 'nombre' => $nombre, 'apellidos' => $apell, 'id_province' => $prov, 'id_municipalite' => $muni);
                $this->opcion = $this->db->update('pn_usser', $arrUpdate, array('id_usser' => $updateUsser));
                
            }
            else
            {
                $this->opcion = $this->db->insert('pn_usser', $arr);
                $usser_id = $this->db->insert_id();
                $data['usser'] = $this->session->userdata('usserLog');
                $arr = array('id_usser_add' => $usser_id, 'id_comercialp' => $data['usser']["id_usser"]);
                $this->opcion = $this->db->insert('pn_comercial_promo_usser', $arr);
                $texto = "Su cuenta a sido registrada para activar la cuenta acceda a este Link";
                $texto = base_url().'index.php/navidad/c_activacion/pn_activar_usuario/'.$cod;
                $texto="para acceder a la misma utilizara el usuario '$email' y el password '$pasw'";
                
                $this->pn_enviar_email($email,$texto);
            }
            
        } else {
            $this->opcion = 0;
        }
        }
        else
        {
           $this->opcion = 0; 
        }
        $this->pn_crear_grud_usuario();
    }

    function pn_cmp_mis_usuarios() {
        $page = $_REQUEST['page']; // get the requested page
        $limit = $_REQUEST['rows']; // get how many rows we want to have into the grid
        $sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
        $sord = $_REQUEST['sord']; // get the direction
        if (!$sidx)
            $sidx = 1; // connect to the database
        $this->load->model('navidad/model_usser/model_usser', 'Mod_Usser');
        $data['usser'] = $this->session->userdata('usserLog');
        $result = $this->Mod_Usser->pn_cmp_mis_usuarios($data['usser']["id_usser"]);
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

                if ($result[$i]->section_active == 1) {
                    $act = "Activo";
                } else {
                    $act = "No Activo";
                }
                $response->rows[$a]['cell'] = array($result[$i]->id_usser, $result[$i]->nombre, $result[$i]->apellidos, $result[$i]->email, $act);
                $a++;
            }

            echo (json_encode($response));
        }
    }

    function pn_del_cmp_usser() {
        $id_promociones = $this->input->post('id_usuario');
        $restul = $this->db->delete('pn_usser', array('id_usser' => $id_promociones));
        echo $restul;
    }

    function pn_get_cmp_usser() {
        $id_promociones = $_REQUEST['id_usuario'];
        $sql = "SELECT pn_usser.nombre, pn_usser.id_usser, pn_usser.email, pn_usser.apellidos, pn_usser.section_active, pn_usser.id_province, pn_usser.id_municipalite
            FROM pn_usser WHERE pn_usser.id_usser = '$id_promociones'";
        echo json_encode($this->db->query($sql)->result());
    }
    /**
     * Funcion para enviar msg
     * @param type $destinatario
     * @param type $mensaje
     */
    function pn_enviar_email($destinatario,$mensaje)
    {
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
