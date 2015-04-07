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
class Model_Usser extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function pn_get_all_menu($user) {
        $menu = $this->db->get_where('pn_menu_restaurante', array('id_restaurante' => $user))->result();
        $fotos = $this->db->get_where('pn_menu_fotos', array('id_restaurante' => $user))->result();
        $resulta = array();
        $i = 0;
        foreach ($menu as $value) {

            $result['nombre'] = $value->nombre;
            $result['descripcion'] = $value->descripcion;
            $resulta[$i++] = $result;
        }

        return array($resulta, $fotos);
    }

    /*     * *
     * Muestra los anuncio segun los tipo de restaurante
     */

    function pn_get_all_anuncio($idrest) {
        $resultRestaurante = $this->db->get_where('pn_restaurant', array('id_usuario' => $idrest))->result();
        $tipoRegistro = $this->db->get_where('pn_nom_tipo_registro', array('id_nom_registro' => $resultRestaurante[0]->id_tipo_registro))->result();
        $configTipoRegistro = $this->db->get_where('pn_config_nom_registro', array('id_nom_registro' => $resultRestaurante[0]->id_tipo_registro))->result();
        $configTipoRegistroRestaurante = $this->db->get_where('pn_restaurant_datos_config', array('id_restaurante' => $idrest))->result();

        if ($resultRestaurante[0]->id_tipo_registro == 0) {
            $fecha = date_create('2012-11-01');
            $noviembreInicio = date_format($fecha, 'Y-m-d H:i:s');
            $fecha = date_create('2012-11-30');
            $noviembreFin = date_format($fecha, 'Y-m-d H:i:s');
            $concad = " pn_annonce.clasificacion = 1 AND pn_annonce.fecha > '$noviembreInicio' AND pn_annonce.fecha < '$noviembreFin'";
        } else if ($resultRestaurante[0]->id_tipo_registro == 1) {
            $fecha = date_create('2012-11-01');
            $noviembreInicio = date_format($fecha, 'Y-m-d H:i:s');
            $fecha = date_create('2012-11-30');
            $noviembreFin = date_format($fecha, 'Y-m-d H:i:s');
            $concad = " pn_annonce.clasificacion != 0 AND pn_annonce.fecha > '$noviembreInicio' AND pn_annonce.fecha < '$noviembreFin'";
        } else if ($resultRestaurante[0]->id_tipo_registro == 2) {

            $fecha = date_create('2012-11-01');
            $noviembreInicio = date_format($fecha, 'Y-m-d H:i:s');
            $fecha = date_create('2012-12-31');
            $noviembreFin = date_format($fecha, 'Y-m-d H:i:s');
            $concad = " pn_annonce.clasificacion != 0 AND pn_annonce.fecha > '$noviembreInicio' AND pn_annonce.fecha < '$noviembreFin'";
        }

        $sql = "SELECT 
                pn_province.prenom as provincia,pn_municipalite.prenom as municipio,pn_annonce.nombre,pn_annonce.montant_usser as cantUsser,pn_annonce.id_annonce,pn_annonce.descripcion,
                pn_annonce.rango_gasto,pn_annonce.clasificacion
              FROM
                pn_annonce INNER JOIN pn_province ON (pn_annonce.id_provincia = pn_province.id_province)
                INNER JOIN pn_municipalite ON (pn_annonce.id_municipio = pn_municipalite.id_municipalite)
                WHERE " . $concad . "";

        return $this->db->query($sql);
    }

    function pn_get_cant_restaurante_anuncio($id_anuncio) {
        $sql = 'SELECT count(pn_restaurant_annonce.id_restaurant) AS cantidad FROM pn_restaurant_annonce
WHERE pn_restaurant_annonce.id_annonce = "' . $id_anuncio . '" GROUP BY pn_restaurant_annonce.id_annonce';
        return $this->db->query($sql);
    }

    function pn_get_anuncio_usuario($id_usser) {
        $sql = "SELECT 
            pn_province.prenom as provincia,pn_municipalite.prenom as municipio,pn_annonce.nombre,pn_annonce.montant_usser as cantUsser,pn_annonce.id_annonce,pn_annonce.descripcion,
            pn_annonce.rango_gasto,pn_annonce.clasificacion
          FROM
            pn_annonce INNER JOIN pn_province ON (pn_annonce.id_provincia = pn_province.id_province)
            INNER JOIN pn_municipalite ON (pn_annonce.id_municipio = pn_municipalite.id_municipalite)
            WHERE pn_annonce.id_usser = '$id_usser' ";
        return $this->db->query($sql);
    }

    function pn_get_anuncio_oferta_restuarante($id_anun) {
        
        $sql = "SELECT pn_restaurant_annonce.id_restaurant as id_restaurante, pn_restaurant_annonce.id_annonce, costo, pn_restaurant.logo, 
            aceptado, aceptado, pn_usser.nombre FROM  pn_restaurant_annonce 
            INNER JOIN pn_restaurant ON (pn_restaurant_annonce.id_restaurant = pn_restaurant.id_usuario)
  INNER JOIN pn_usser ON (pn_restaurant.id_usuario = pn_usser.id_usser) where pn_restaurant_annonce.id_annonce ='$id_anun'  ";
        $restuarante = $this->db->query($sql)->result();
        $resultRestaurante = array();
        $a =0;
       
        foreach ($restuarante as $value) 
            {
             $sql = "SELECT COUNT(pn_restaurant_annonce.id_restaurant) AS cantidadPresupuesto FROM pn_restaurant
                INNER JOIN pn_restaurant_annonce ON (pn_restaurant.id_usuario = pn_restaurant_annonce.id_restaurant)
                WHERE pn_restaurant_annonce.id_restaurant = '$value->id_restaurante'
                GROUP BY pn_restaurant_annonce.id_restaurant";
            $cantPresEnviado = $this->db->query($sql)->result();
            $sql2 = "SELECT COUNT(pn_restaurant_annonce.id_restaurant) AS cantidadPresupuesto FROM pn_restaurant
                INNER JOIN pn_restaurant_annonce ON (pn_restaurant.id_usuario = pn_restaurant_annonce.id_restaurant)
                WHERE pn_restaurant_annonce.id_restaurant = '$value->id_restaurante' AND pn_restaurant_annonce.aceptado != 0 
                GROUP BY pn_restaurant_annonce.id_restaurant";
            
            $cantPresAcept = $this->db->query($sql2)->result();
            $datosResult = array();
             $datosResult['id_restaurante']= $value->id_restaurante;
             $datosResult['logo']= $value->logo;
            $datosResult['cantPresEnviado'] = 0;
            $datosResult['cantPresAcept'] = 0;
            if (!empty($cantPresEnviado)) {
                $datosResult['cantPresEnviado'] = $cantPresEnviado[0]->cantidadPresupuesto;
            }
            if (!empty($cantPresAcept)) {
                $datosResult['cantPresAcept'] = $cantPresAcept[0]->cantidadPresupuesto;
            }
            $tipoSql = "SELECT pn_nom_tipo_registro.nom_registro, pn_nom_tipo_registro.id_nom_registro FROM pn_restaurant
                INNER JOIN pn_nom_tipo_registro ON (pn_restaurant.id_tipo_registro = pn_nom_tipo_registro.id_nom_registro)
                WHERE pn_restaurant.id_usuario ='$value->id_restaurante' ";
            $tipo = $this->db->query($tipoSql)->result();
           
             $datosResult['tipo'] = $tipo[0]->nom_registro;
             $datosResult['valueTipo'] = $tipo[0]->id_nom_registro;
            $resultRestaurante[$a++] = $datosResult;
        }
       // var_dump($resultRestaurante);
        $arrayCompleta = array();
        $arrayMedia = array();
        $arrayGratis = array();
        $c =0;
        $m = 0;
        $g =0;
        $cant = count($resultRestaurante);
        foreach ($resultRestaurante as $value) 
            {
            switch ($value['valueTipo'])
            {
            case '2':
                {
                $arrayCompleta[$c++] = $value;
                }
                break;
             case '1':
                {
                $arrayMedia[$m++] = $value;
                }
                break;
             case '0':
                {
                $arrayGratis[$g++] = $value;
                }
                break;
            }
        }
        $resultRest = array();
        $pos = 0;
        $cantC = count($arrayCompleta);
        for($i =0;$i<$cantC;$i++)
        {
           $resultRest[$pos++] =  $arrayCompleta[$i];
        }
        $cantM = count($arrayMedia);
        for($i =0;$i<$cantM;$i++)
        {
            $resultRest[$pos++] =  $arrayMedia[$i];
        }
        $cantG = count($arrayGratis);
        for($i =0;$i<$cantG;$i++)
        {
            $resultRest[$pos++] =  $arrayGratis[$i];
        }
        return $resultRest;
    }

    //devuelbe los datos de config del restaurante
    function pn_config_datos_restaurante($idrest) {
        $sql = "SELECT COUNT(pn_restaurant_annonce.id_restaurant) AS cantidadPresupuesto FROM pn_restaurant
                INNER JOIN pn_restaurant_annonce ON (pn_restaurant.id_usuario = pn_restaurant_annonce.id_restaurant)
                WHERE pn_restaurant_annonce.id_restaurant = '$idrest'
                GROUP BY pn_restaurant_annonce.id_restaurant";
        $cantPresEnviado = $this->db->query($sql)->result();
        $sql2 = "SELECT COUNT(pn_restaurant_annonce.id_restaurant) AS cantidadPresupuesto FROM pn_restaurant
                INNER JOIN pn_restaurant_annonce ON (pn_restaurant.id_usuario = pn_restaurant_annonce.id_restaurant)
                WHERE pn_restaurant_annonce.id_restaurant = '$idrest' AND pn_restaurant_annonce.aceptado != 0 
                GROUP BY pn_restaurant_annonce.id_restaurant";
        $cantPresAcept = $this->db->query($sql2)->result();

        $resultRestaurante = $this->db->get_where('pn_restaurant', array('id_usuario' => $idrest))->result();
        $tipoRegistro = $this->db->get_where('pn_nom_tipo_registro', array('id_nom_registro' => $resultRestaurante[0]->id_tipo_registro))->result();
        $configTipoRegistro = $this->db->get_where('pn_config_nom_registro', array('id_nom_registro' => $resultRestaurante[0]->id_tipo_registro))->result();
        $configTipoRegistroRestaurante = $this->db->get_where('pn_restaurant_datos_config', array('id_restaurante' => $idrest))->result();

        $datosResult = array();
        $datosResult['cantPresEnviado'] = 0;
        $datosResult['cantPresAcept'] = 0;
        if (!empty($cantPresEnviado)) {
            $datosResult['cantPresEnviado'] = $cantPresEnviado[0]->cantidadPresupuesto;
        }
        if (!empty($cantPresAcept)) {
            $datosResult['cantPresAcept'] = $cantPresAcept[0]->cantidadPresupuesto;
        }

        $datosResult['tipoRegistro'] = $tipoRegistro[0]->nom_registro;

        $datosResult['configregistro']['pedidoTotal'] = $configTipoRegistro[0]->cantPedido;
        $datosResult['configregistro']['pedidosHechos'] = $configTipoRegistroRestaurante[0]->cantPedidos;
        $datosResult['configregistro']['FotosTotal'] = $configTipoRegistro[0]->cantImg;
        $datosResult['configregistro']['FotosHechas'] = $configTipoRegistroRestaurante[0]->cantFotos;
        return $datosResult;
    }

//    
    function pn_get_conversacion($id_anun) {
        $sql = "SELECT pn_usser.nombre, pn_dialogo_texto.id_dialogo_texto, pn_dialogo_texto.remitente, pn_dialogo_texto.dialogo, pn_dialogo_texto.id_dialogo,
            pn_dialogo_texto.fecha FROM pn_usser INNER JOIN pn_dialogo_texto ON (pn_usser.id_usser = pn_dialogo_texto.remitente) 
            where pn_dialogo_texto.id_dialogo ='$id_anun'  ORDER BY pn_dialogo_texto.fecha ASC";
        return $this->db->query($sql);
    }

    //obtiene los anuncio que pertencen a un restaurante que previamente el ya a ofertado
    function pn_get_restaurante_seguir_anuncio($id_rest) {
        $sql = "SELECT pn_annonce.id_usser, pn_annonce.montant_usser, pn_restaurant_annonce.descripcion, pn_restaurant_annonce.costo,
            pn_restaurant_annonce.aceptado, pn_restaurant_annonce.id_restaurant, pn_restaurant_annonce.id_annonce, pn_annonce.nombre
          FROM pn_annonce INNER JOIN pn_restaurant_annonce ON (pn_annonce.id_annonce = pn_restaurant_annonce.id_annonce)
            INNER JOIN pn_restaurant ON (pn_restaurant_annonce.id_restaurant = pn_restaurant.id_usuario)
            where pn_restaurant.id_usuario ='$id_rest'";
        return $this->db->query($sql);
    }

    //devuelve los ultimos anuncio
    function pn_get_ultimos_anuncio() {
        $sql = "SELECT   pn_municipalite.id_municipalite, pn_municipalite.prenom as municipio, pn_province.id_province, pn_province.prenom as provincia, pn_annonce.nombre,
                pn_annonce.fecha, pn_annonce.descripcion, pn_annonce.id_annonce
                FROM pn_province INNER JOIN pn_annonce ON (pn_province.id_province = pn_annonce.id_provincia)
                INNER JOIN pn_municipalite ON (pn_annonce.id_municipio = pn_municipalite.id_municipalite)
                WHERE pn_annonce.clasificacion !=0
                ORDER BY pn_annonce.id_annonce DESC LIMIT 0,6";
        return $this->db->query($sql)->result();
    }

    //devuelve los ultimos anuncio
    function pn_get_ultimos_restaurantes() {
        $sql = "SELECT pn_usser.nombre, pn_restaurant.id_restaurant,pn_restaurant.id_usuario,pn_restaurant.logo, pn_usser.email
                FROM pn_restaurant INNER JOIN pn_usser ON (pn_restaurant.id_usuario = pn_usser.id_usser)
                ORDER BY pn_restaurant.id_restaurant DESC LIMIT 0,14";


        return $this->db->query($sql)->result();
    }

    /**
     * Dado el id devuelve el anuncio
     * @param type $id
     * @return type
     */
    function pn_get_anuncio($id) {
        $sql = "SELECT   pn_municipalite.id_municipalite, pn_municipalite.prenom as municipio, pn_province.id_province, pn_province.prenom as provincia, pn_annonce.nombre,
                pn_annonce.fecha, pn_annonce.descripcion, pn_annonce.id_annonce
                FROM pn_province INNER JOIN pn_annonce ON (pn_province.id_province = pn_annonce.id_provincia)
                INNER JOIN pn_municipalite ON (pn_annonce.id_municipio = pn_municipalite.id_municipalite)
                WHERE pn_annonce.clasificacion !=0 and pn_annonce.id_annonce = '$id'";
        return $this->db->query($sql)->result();
    }

    function pn_get_data_restaurante($idusser) {
        $sql = "SELECT pn_usser.id_usser,pn_usser.email,pn_usser.nombre,pn_usser.apellidos,pn_usser.id_province,pn_usser.id_municipalite,pn_restaurant.direccion,
                pn_restaurant.cif, pn_restaurant.telefono,pn_restaurant.codigo_postal,pn_restaurant.id_usuario
                FROM pn_restaurant INNER JOIN pn_usser ON (pn_restaurant.id_usuario = pn_usser.id_usser)
                WHERE pn_usser.id_usser = '$idusser'";
        return $this->db->query($sql)->result();
    }

    //cofig datos comercial de venta
    function pn_cmv_get_info($idUsser) {
        $sqlGratis = "SELECT pn_usser.id_usser FROM pn_restaurant INNER JOIN pn_usser ON (pn_restaurant.id_usuario = pn_usser.id_usser)
                INNER JOIN pn_nom_tipo_registro ON (pn_restaurant.id_tipo_registro = pn_nom_tipo_registro.id_nom_registro) 
                WHERE pn_nom_tipo_registro.id_nom_registro = 0 GROUP BY pn_usser.id_usser";
        $sqlMedia = "SELECT pn_usser.id_usser FROM pn_restaurant INNER JOIN pn_usser ON (pn_restaurant.id_usuario = pn_usser.id_usser)
                INNER JOIN pn_nom_tipo_registro ON (pn_restaurant.id_tipo_registro = pn_nom_tipo_registro.id_nom_registro) 
                WHERE pn_nom_tipo_registro.id_nom_registro = 1 GROUP BY pn_usser.id_usser";
        $sqlcompleto = "SELECT pn_usser.id_usser FROM pn_restaurant INNER JOIN pn_usser ON (pn_restaurant.id_usuario = pn_usser.id_usser)
                INNER JOIN pn_nom_tipo_registro ON (pn_restaurant.id_tipo_registro = pn_nom_tipo_registro.id_nom_registro) 
                WHERE pn_nom_tipo_registro.id_nom_registro = 2 GROUP BY pn_usser.id_usser";
        $resutl['gratis'] = count($this->db->query($sqlGratis)->result());
        $resutl['media'] = count($this->db->query($sqlMedia)->result());
        $resutl['completa'] = count($this->db->query($sqlcompleto)->result());
        $resutl['borrador'] = count($this->db->get_where('pn_borrador_form_restaurant', array('id_comercial' => $idUsser))->result());
        return $resutl;
    }

    /**
     * DEvuelve la cantidad de anuncio por provincia
     */
    function pn_get_cant_anuncio_provincia() {
        $sql = "SELECT count(pn_annonce.id_annonce) AS cantidad, pn_province.prenom, pn_province.id_province
            FROM pn_annonce INNER JOIN pn_province ON (pn_annonce.id_provincia = pn_province.id_province)
            WHERE pn_annonce.clasificacion!= 0
            GROUP BY pn_province.prenom, pn_province.id_province";
        return $this->db->query($sql)->result();
    }
    function pn_get_cant_anuncio_zona($prov)
    {
        $sql="SELECT COUNT(pn_annonce.id_annonce) AS cantidad,pn_annonce.id_municipio,pn_municipalite.prenom 
              FROM pn_annonce INNER JOIN pn_municipalite ON (pn_annonce.id_municipio = pn_municipalite.id_municipalite)
               WHERE pn_annonce.clasificacion!= 0 AND pn_annonce.id_provincia = '$prov'
              GROUP BY pn_annonce.id_municipio";
         return $this->db->query($sql)->result();
    }
    //devuelve todos los anuncios
    function pn_get_all_seccion_anuncio() {
        $sql = "SELECT pn_annonce.nombre,pn_annonce.fecha, pn_annonce.clasificacion, pn_annonce.rango_gasto, pn_annonce.descripcion, pn_annonce.id_usser,
            pn_annonce.id_provincia, pn_annonce.montant_usser, pn_annonce.id_annonce, pn_annonce.id_municipio,
             pn_province.prenom as provincia,pn_municipalite.prenom as municipio
            FROM pn_annonce INNER JOIN pn_municipalite ON (pn_annonce.id_municipio = pn_municipalite.id_municipalite)
            INNER JOIN pn_province ON (pn_annonce.id_provincia = pn_province.id_province) WHERE pn_annonce.clasificacion!= 0 
            ORDER BY pn_annonce.id_annonce DESC ";
        return $this->db->query($sql)->result();
    }
    //devuelve los anuncionde una zona determinada
    function pn_get_anuncio_provincia($zona)
    {
        $sql = "SELECT pn_annonce.nombre,pn_annonce.fecha, pn_annonce.clasificacion, pn_annonce.rango_gasto, pn_annonce.descripcion, pn_annonce.id_usser,
            pn_annonce.id_provincia, pn_annonce.montant_usser, pn_annonce.id_annonce, pn_annonce.id_municipio,
            pn_province.prenom as provincia,pn_municipalite.prenom as municipio
            FROM pn_annonce
            INNER JOIN pn_municipalite ON (pn_annonce.id_municipio = pn_municipalite.id_municipalite)
            INNER JOIN pn_province ON (pn_annonce.id_provincia = pn_province.id_province)
            WHERE pn_annonce.clasificacion!= 0 AND pn_annonce.id_provincia = '$zona'";
        return $this->db->query($sql)->result();
    }
        //devuelve los anuncionde una zona determinada
    function pn_get_anuncio_zona($zona)
    {
        $sql = "SELECT pn_annonce.nombre,pn_annonce.fecha, pn_annonce.clasificacion, pn_annonce.rango_gasto, pn_annonce.descripcion, pn_annonce.id_usser,
            pn_annonce.id_provincia, pn_annonce.montant_usser, pn_annonce.id_annonce, pn_annonce.id_municipio,
            pn_province.prenom as provincia,pn_municipalite.prenom as municipio
            FROM pn_annonce
            INNER JOIN pn_municipalite ON (pn_annonce.id_municipio = pn_municipalite.id_municipalite)
            INNER JOIN pn_province ON (pn_annonce.id_provincia = pn_province.id_province)
            WHERE pn_annonce.clasificacion!= 0 AND pn_annonce.id_municipio = '$zona'";
        return $this->db->query($sql)->result();
    }

    /**
     * DEvuelve la cantidad de restaunrate por provincia
     */
    function pn_get_restaurante_provincia() {
        $sql = "SELECT count(pn_restaurant.id_restaurant) AS cantidad,pn_province.id_province,
  pn_province.prenom FROM pn_restaurant INNER JOIN pn_usser ON (pn_restaurant.id_usuario = pn_usser.id_usser)
  INNER JOIN pn_province ON (pn_usser.id_province = pn_province.id_province)
 WHERE pn_usser.section_active != 0 GROUP BY pn_province.prenom";
        return $this->db->query($sql)->result();
    }
      //DEVUELVE LA CANTIDAD DE RESTAURANTE POR MUNICIPIO
      function pn_get_restaurante_municipio($prov) {
        $sql = "SELECT count(pn_municipalite.id_municipalite) AS cantidad,pn_municipalite.id_province,
            pn_municipalite.prenom, pn_municipalite.id_municipalite as id_municipio FROM pn_restaurant 
            INNER JOIN pn_usser ON (pn_restaurant.id_usuario = pn_usser.id_usser)
            INNER JOIN pn_municipalite ON (pn_usser.id_municipalite = pn_municipalite.id_municipalite)
            WHERE  pn_municipalite.id_province = '$prov' AND pn_usser.section_active != 0 GROUP BY  pn_municipalite.id_province";
        return $this->db->query($sql)->result();
    }
   function pn_get_all_restaurante_provincia($idprov) {
        $sql = "SELECT pn_usser.nombre,pn_usser.email,pn_usser.id_usser,pn_restaurant.direccion,pn_restaurant.telefono,pn_restaurant.logo,pn_province.prenom
            FROM pn_restaurant INNER JOIN pn_usser ON (pn_restaurant.id_usuario = pn_usser.id_usser)
            INNER JOIN pn_province ON (pn_usser.id_province = pn_province.id_province)
            
            WHERE pn_usser.section_active != 0 AND pn_province.id_province= '$idprov'";
        return $this->db->query($sql)->result();
    }
       function pn_get_all_restaurante_Zona($idprov) {
        $sql = "SELECT  pn_usser.id_municipalite, pn_usser.id_province, pn_usser.nombre, pn_usser.email, pn_usser.tipo_usser,
  pn_usser.id_usser, pn_restaurant.direccion,
  pn_municipalite.prenom FROM pn_restaurant INNER JOIN pn_usser ON (pn_restaurant.id_usuario = pn_usser.id_usser)
  INNER JOIN pn_municipalite ON (pn_usser.id_municipalite = pn_municipalite.id_municipalite)
            WHERE pn_usser.section_active != 0 AND pn_municipalite.id_municipalite= '$idprov'";
        return $this->db->query($sql)->result();
    }
  
    //funcion que devuel los ultimas promociones
    function get_Ultima_promociones($tipo) {
        $sql = "SELECT  pn_promociones_restaurante.url, pn_promociones_restaurante.texto, pn_promociones_restaurante.nombre,
                pn_promociones_restaurante.id_restaurante, pn_promociones_restaurante.tipo_promocion, pn_promociones_restaurante.id_promociones
                FROM pn_promociones_restaurante WHERE tipo_promocion = '$tipo' ORDER BY pn_promociones_restaurante.id_promociones DESC LIMIT 0,3";
        return $this->db->query($sql)->result();
    }
     //funcion que devuel los 5 promociones aleatorias
    function get_randon_promociones($tipo) {
        $sql = "SELECT  pn_promociones_restaurante.url, pn_promociones_restaurante.texto, pn_promociones_restaurante.nombre,
                pn_promociones_restaurante.id_restaurante, pn_promociones_restaurante.tipo_promocion, pn_promociones_restaurante.id_promociones
                FROM pn_promociones_restaurante WHERE tipo_promocion = '$tipo' ORDER BY RAND() LIMIT 0,5";
        return $this->db->query($sql)->result();
    }
    //busqueda para los anuncios
    function get_find_anuncio($prov,$mun,$tipo,$ultimos)
    {
        $sqlGeneral = "SELECT  pn_annonce.nombre, pn_annonce.fecha, pn_annonce.clasificacion, pn_annonce.rango_gasto, pn_annonce.descripcion,
                       pn_annonce.id_usser, pn_annonce.id_provincia, pn_annonce.montant_usser, pn_annonce.id_annonce, pn_annonce.id_municipio,
                       pn_province.prenom as provincia,pn_municipalite.prenom as municipio
                       FROM pn_annonce
                       INNER JOIN pn_municipalite ON (pn_annonce.id_municipio = pn_municipalite.id_municipalite)
                       INNER JOIN pn_province ON (pn_annonce.id_provincia = pn_province.id_province) 
                       WHERE pn_annonce.clasificacion != 0";
        if(!empty($prov)&& ($prov)!= -1)
        {
            
           $sqlGeneral.=" AND pn_annonce.id_provincia= '$prov' "; 
        }
        
        if(!empty($mun) && ($mun)!= -1)
        {
            $sqlGeneral.=" AND pn_annonce.id_municipio= '$mun' "; 
        }
        if(!empty($tipo))
        {
                $sqlGeneral.=" AND pn_annonce.clasificacion= '$tipo' ";  
        }
        if($ultimos)
        {
             $sqlGeneral.=" ORDER BY pn_annonce.id_annonce DESC LIMIT 0,50"; 
           
        }
           
         return $this->db->query($sqlGeneral)->result();
    }
     function get_find_restaurante($prov,$mun,$restaurante_Exitos,$ultimos)
    {
        $sqlGeneral = "SELECT  pn_province.prenom AS provincia, pn_municipalite.prenom AS municipio, pn_usser.nombre,pn_usser.email, pn_usser.id_usser, 
            pn_restaurant.direccion, pn_restaurant.telefono, pn_restaurant.logo
            FROM pn_restaurant
            INNER JOIN pn_usser ON (pn_restaurant.id_usuario = pn_usser.id_usser)
            INNER JOIN pn_municipalite ON (pn_usser.id_municipalite = pn_municipalite.id_municipalite)
            INNER JOIN pn_province ON (pn_usser.id_province = pn_province.id_province)
            WHERE pn_usser.section_active != 0
            ";
        $sqlGeneralAux = "SELECT  pn_province.prenom AS provincia, pn_municipalite.prenom AS municipio, pn_usser.nombre, pn_usser.id_usser,pn_usser.email,
            pn_restaurant.direccion, pn_restaurant.telefono, COUNT(pn_restaurant_annonce.aceptado) AS exito, pn_restaurant.logo
            FROM pn_restaurant_annonce
            INNER JOIN pn_restaurant ON (pn_restaurant_annonce.id_restaurant = pn_restaurant.id_usuario)
            INNER JOIN pn_usser ON (pn_restaurant.id_usuario = pn_usser.id_usser)
            INNER JOIN pn_municipalite ON (pn_usser.id_municipalite = pn_municipalite.id_municipalite)
            INNER JOIN pn_province ON (pn_usser.id_province = pn_province.id_province)
            WHERE pn_usser.section_active != 0
            ";
        $sqlGeneralA = "";
        $sqlGeneralAuLTI="";
        if(!empty($prov)&& ($prov)!= -1)
        {
            
           $sqlGeneral.=" AND pn_usser.id_province= '$prov' "; 
           $sqlGeneralA.=" AND pn_usser.id_province= '$prov' "; 
        }
        
        if(!empty($mun) && ($mun)!= -1)
        {
            $sqlGeneral.=" AND pn_usser.id_municipalite= '$mun' "; 
            $sqlGeneralA.=" AND pn_usser.id_municipalite= '$mun' "; 
        }
      
        if($ultimos)
        {
             $sqlGeneral.=" ORDER BY pn_usser.id_usser DESC LIMIT 0,50"; 
             $sqlGeneralAuLTI.=" ORDER BY pn_usser.id_usser DESC LIMIT 0,50"; 
           
        }
          if(!empty($restaurante_Exitos))
        {
              $sqlGeneral = "";
                $sqlGeneral.=" ORDER BY exito DESC";  
                $sqlGeneral=$sqlGeneralAux.$sqlGeneralA.$sqlGeneral;
        }
           //$sqlGeneral.=" GROUP BY pn_usser.id_usser";
          
          RETURN ($this->db->query($sqlGeneral)->result());
    }
    
    function pn_cmp_mis_usuarios($iduser)
    {
        $sql = "SELECT pn_usser.nombre, pn_usser.id_usser, pn_comercial_promo_usser.id_comercialp, pn_usser.email, pn_usser.apellidos,pn_usser.section_active
                FROM pn_comercial_promo_usser INNER JOIN pn_usser ON (pn_comercial_promo_usser.id_usser_add = pn_usser.id_usser)
                WHERE  pn_comercial_promo_usser.id_comercialp ='$iduser' ";
         RETURN ($this->db->query($sql)->result());
    }
    function pn_cmp_get_info($cmp)
    {
        $data['usser'] = $this->session->userdata('usserLog');
        $sqlUser = "SELECT pn_comercial_promo_usser.id_usser_add, pn_comercial_promo_usser.id_comercialp, pn_usser.email, pn_usser.section_active
                    FROM pn_comercial_promo_usser INNER JOIN pn_usser ON (pn_comercial_promo_usser.id_usser_add = pn_usser.id_usser)
                    WHERE   pn_comercial_promo_usser.id_comercialp = '$cmp'";
        $resultUsser = $this->db->query($sqlUser)->result();
        $totalUser = count($resultUsser);
        $totalReg = 0;
        $totalUnReg = 0;    
        foreach ($resultUsser as $value) {
            if($value->section_active == 0)
            {
                $totalUnReg++;
            }
            else
            {
            $totalReg++;
            }
        }
        $cantP= $this->db->get_where('pn_promociones_restaurante', array('author' =>$data['usser']["id_usser"],'activa'=>1))->result();
        $totalP = count($cantP);
        $cantPAct = 0;
        $cantPDest = 0;
        foreach ($cantP as $value)
            {
            if($value->activa_restaurante == 0)
            {
                $cantPDest++;
            }
            else
            {
                $cantPAct++;
            }
        }
        $datos_cmp = array("totalUser"=>$totalUser,"reg"=>$totalReg,"unreg"=>$totalUnReg,'cantPromoHecha' =>$totalP,
            'cantPromoAct' =>$cantPAct,'cantPromoDesact' =>$cantPDest);
        
        
       return $datos_cmp;
    }
    function pn_get_top_dix_restaurante()
    {
        $sql = "SELECT  pn_usser.email, pn_usser.nombre, pn_usser.tipo_usser, pn_usser.id_province, pn_usser.id_municipalite, 
            COUNT(pn_restaurant_annonce.aceptado) AS aceptado, pn_restaurant.telefono, pn_restaurant.direccion,
  COUNT(pn_restaurant_annonce.id_restaurant) AS envios, ((COUNT(pn_restaurant_annonce.aceptado) * 100) / COUNT(pn_restaurant_annonce.id_restaurant)) AS promedio
FROM pn_restaurant_annonce INNER JOIN pn_restaurant ON (pn_restaurant_annonce.id_restaurant = pn_restaurant.id_usuario)
  INNER JOIN pn_usser ON (pn_restaurant.id_usuario = pn_usser.id_usser)
GROUP BY pn_restaurant_annonce.id_restaurant ORDER BY promedio DESC LIMIT 0,10";
         RETURN ($this->db->query($sql)->result());
    }
}

?>