/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$("document").ready(function()
{
 $('.dropdown-toggle').dropdown()
}
)
function pn_EnregistrerUtilisateur()
{
    var grid = new pn_montrer_grid();
      grid.monter_liste_usser($("#pn_admin_conte_Gauche"));
}
var grid = new pn_montrer_grid();
function pn_MonterUtilisateur()
{
      grid.monter_liste_usser($("#pn_admin_conte_Gauche"));
}

function pn_montrer_grid()
{
   this.monter_liste_usser = function(div)
    {
    var self = this;
    var html = '<table id="pn_table_liste_user"></table> <div id="pager2"></div>'
    
    $(div).empty().html(html)
    $("#pn_table_liste_user").jqGrid({
         url:$.ruta.host+'index.php/navidad/c_administrateur/pn_find_usser',
            datatype: "json",
            colNames:['#','id','Nombre','Apellido','Correo Electronico','Provincia','Municipio','Tipo Usuario','Activa'],
            colModel:[
                {name:'no',          index:'no',          width:  3, align:"center" },
                {name:'id',          index:'id',          width:  3, align:"center" },
                {name:'nombre',   index:'nombre',   width: 20, align:"left" },
                {name:'apellido',        index:'apellido',   width: 20, align:"left" },
                {name:'correo',      index:'correo',      width:  40, align:"center" },
                {name:'provincia',   index:'provincia',   width: 15, align:"left" },
                {name:'municipio',        index:'municipio',   width: 15, align:"left" },
                {name:'tipo',        index:'tipo',   width: 15, align:"left" },
                {name:'activa',       index:'activa',       width:  8, align:"center" },            
            ],
            pager:"pager2",
            caption: "Listado de usuarios registrados en el portal ",
            rowNum:15, 
            sortname: 'id', 
            viewrecords: true, 
            sortorder: "desc",
            height      : 300,
            width       : 900
        })
        $("#pn_table_liste_user").jqGrid('hideCol','id');
        
        var htmtBtn='<span class="ui-icon admin_add_usser" id="pn_register_usser"></span><span class="ui-icon pn_mod_usser" id="pn_modifier_usser"></span><span class="ui-icon pn_del_usser" id="pn_effacer_usser"></span>'
        $("#pager2_left").html(htmtBtn)
        
        $("#pn_table_liste_user").ready(function(){
            self.pn_find_user();
        })
        $("#pn_mod_usser").val(0);
        $("#pn_register_usser").click(function(){
            $("#pn_show_status_true").hide();
            $("#pn_form_grud_usser").show();
            $("#pn_show_status_false").hide();
            $("#pn_add_prenom").val("");
            $("#pn_add_nom").val("");
            $("#pn_add_e_mail").val("");
            $("#pn_selectionner_Provincia").val(0);
            $("#pn_mod_usser").val(0);
                         
            //pn_cargar_municipio($("#pn_selectionner_municipio"),data[0].id_province)
            $("#pn_selectionner_municipio").val(0);
            $("#tipo_usuario").val(0);
            $("#pn_admin_registre_rest").hide();
            $("#tipo_pago_campana").val("");
            $("#pn_phone").val("");
            $("#pn_cif").val("");
            $("#pn_codigo_postal").val("");
            $("#pn_direccion").val("");
        })
        
        $("#pn_modifier_usser").click(function(){
            $("#pn_show_status_true").hide();
            $("#pn_show_status_false").hide();
	 var id = $("#pn_table_liste_user").jqGrid('getGridParam','selrow');
             if (id) 
                 {
                     var ret = $("#pn_table_liste_user").jqGrid('getRowData',id);
                     $.getJSON($.ruta.host+'index.php/navidad/c_administrateur/pn_get_usser', {"id_usser":ret.id},function(data){
                         //console.log(data);
                         $("#pn_add_prenom").val(data[0].nombre);
                         $("#pn_add_nom").val(data[0].apellidos);
                         $("#pn_add_e_mail").val(data[0].email);
                         $("#pn_selectionner_Provincia").val(data[0].id_province);
                         $("#pn_mod_usser").val(data[0].id_usser);
                         
                          pn_cargar_municipio($("#pn_selectionner_municipio"),data[0].id_province)
                         $("#pn_selectionner_municipio").val(data[0].id_municipalite);
                          $("#tipo_usuario").val(data[0].tipo_usser);
                           $("#pn_admin_registre_rest").hide();
                         if(data[0].tipo_usser == 3)
                             {
                               
                                $("#tipo_pago_campana").val(data[0].restaurante[0].id_tipo_registro);
                                $("#pn_phone").val(data[0].restaurante[0].telefono);
                                $("#pn_cif").val(data[0].restaurante[0].cif);
                                $("#pn_codigo_postal").val(data[0].restaurante[0].codigo_postal);
                                $("#pn_direccion").val(data[0].restaurante[0].direccion);
                                 $("#pn_admin_registre_rest").show();
                             }
                              $("#pn_form_grud_usser").show();
                     })
                 }
		
        })
        
         $("#pn_effacer_usser").click(function()
         {
             var html ="";
             var id = $("#pn_table_liste_user").jqGrid('getGridParam','selrow');
             if (id) 
             { 
                 var ret = $("#pn_table_liste_user").jqGrid('getRowData',id);
                 html = "Deseas eliminar el usuario seleccionado.";
              } 
             else { 
                 html ="Por favor selecione un usuario para eliminar"
             }
             var state =  false;
            $("#ejDialogError").remove();
		var ejDialog = $(document.createElement("div"))
		ejDialog.attr({"id":"ejDialogError"});
		$(document).append(ejDialog);
		ejDialog.dialog({autoOpen: false,bgiframe: false,title: "Eliminar usuario",width:'auto',resizable: false,
		  buttons:{
                      Aceptar: function()
                      {
                          if(state)
                              {
                                   state = false;
                                  $("#ejDialogError").remove();  
                                  grid.monter_liste_usser($("#pn_admin_conte_Gauche"));
                              }
                              else
                                  {
                                    $.post($.ruta.host+'index.php/navidad/c_administrateur/pn_effacer_usser',{"idUser":ret.id},function(data){
                                        if(data)
                                            {
                                                state = true
                                                $("#ejDialogError").html("Accion compeltada correctamente");
                                            }
                                    })
                                  }
                      },
                      Cancelar: function(){
                          $("#ejDialogError").remove();
                      }
                  },
                  modal: true
                })
                $("#ejDialogError").html(html)
                ejDialog.dialog("open");
        })
	 
  },
  this.pn_find_usera = function()
  {
      var self = this;
        var data = null;
        if(self._busqueda)
        {                   
                data = {"page":self.pageActual,"rows":20,"data":self.criterios,"id":self._scoPadre}
        }
        else
        {
                data = {"page":self.pageActual,"rows":15}
        }
        $.getJSON($.ruta.host+'index.php/navidad/c_administrateur/pn_find_usser', data, function(data)
		{ 
                    
                    self.pageActual = data.page;
                    self.pageTotal  = data.total;
                    var incicio     = data.start;
                    var finalC      = data.end
                    self.dataGrid   = data.rows;
                    for (var i = incicio; i < finalC; i++)
                        {
                                indice = i + 1;
                                var seccionActiva = ""
                                if(data.rows[i]['cell'][3] == '1')
                                    {
                                        seccionActiva = '<span class="ui-icon pn_action_correct" onclick="pn_changer_Seccion('+ data.rows[i]['cell'][1]+')"></span>'
                                    }
                                    else
                                        {
                                           seccionActiva = '<span class="ui-icon pn_action_incorrect" onclick="pn_changer_Seccion('+ data.rows[i]['cell'][1]+')"></span>'
                                        }
                                    
                                $("#pn_table_liste_user").addRowData(indice,
                                        {
                                                no          : indice <= 9 ? "0" + indice : indice ,
                                                id          : data.rows[i]['cell'][1] ,
                                                nombre: data.rows[i]['cell'][4],
                                                apellido:   data.rows[i]['cell'][5], 
                                                correo          : data.rows[i]['cell'][2],
                                                provincia      : data.rows[i]['cell'][6],
                                                municipio   : data.rows[i]['cell'][7],
                                                tipo   : data.rows[i]['cell'][8],
                                                activa        : seccionActiva
                                        }
                                );
                        }
                        
                })
  }
  
}

function pn_changer_Seccion(id)
{
     $.post($.ruta.host+'index.php/navidad/c_administrateur/pn_changer_seccion', {'pn_usser_id':id}, function(){
         grid.monter_liste_usser($("#pn_admin_conte_Gauche"));
     })
}


///--------------------------------------------------------------------------------------------
//----- Pedido ------------
//------------------------------------------------------------------

function pn_Mostrar_pedidos()
{
    $("#pn_table_liste_user").jqGrid({ 
        url:$.ruta.host+'index.php/navidad/c_administrateur/pn_ver_solicitudes', 
        datatype: "json",
        height: 250,
        width       : 650,
        rowNum:15, 
        colNames:['id','Nombre', 'Canitdad', 'descripcion','Rango'], 
        colModel:[ 
            {name:'id',index:'id', width:60, sorttype:"int"}, 
            {name:'nombre',index:'nombre', width:90, sorttype:"date"}, 
            {name:'cantidad',index:'cantidad', width:50}, 
            {name:'descripcion',index:'descripcion', width:350, sortable:false} ,
            {name:'rango',index:'rango', width:50, align:"right",sorttype:"float",align:"center" }

        ], 
        multiselect: true,
         viewrecords: true,
            sortorder: "desc",
            pager:"pager_pedido",
        caption: "Anuncios publicados" });
        $("#pn_table_liste_user").jqGrid('hideCol','id');
        $("#pn_table_liste_user").jqGrid('navGrid','#pager_pedido',{edit:false,add:false,del:false});
         var htmtBtn='<span class="ui-icon admin_add_usser" id="pn_register_usser"></span>'
        $("#pager_pedido_left").html(htmtBtn)
        $("#pn_show_status_true").hide();
        $("#pn_show_status_false").hide();
        $("#pn_clasif_anuncio").load($.ruta.host+'application/views/navidad/view_admin/view_admin_clasificar_anuncio.xhtml',function(){
            
            $("#pn_show_status_true").hide();
            $("#pn_show_status_false").hide();
            $("#pn_btn_clasificar").click(function(){
                var cant = $("#pn_table_liste_user").jqGrid('getGridParam','selarrrow');
                console.log(cant)
                if(cant.length > 0)
                    {
                        $.post($.ruta.host+'index.php/navidad/c_administrateur/pn_clasificar_solicitudes', 
                        {"anuncio_id":cant,"clasificacion":$("#pn_admin_clasificacion_aununcio").val()},function(data){
                           if(data == 1)
                           {
                              $("#pn_show_status_true").show();
                              $("#pn_show_status_false").hide(); 
                           }
                           else
                               {
                                   $("#pn_show_status_true").hide();
                                   $("#pn_show_status_false").show();
                               }
                        })
                    }
                  else
                      {
                         $("#pn_show_status_false").show();
                         $("#pn_msg_error").html("Debes seleccionar al menos un anuncio para clasificar.")
                      }
                      jQuery("#pn_table_liste_user").trigger('reloadGrid'); 
            })
        })
        
}
function pn_eliminar_pedidos()
{
    $("#pn_table_liste_user").jqGrid({ 
        url:$.ruta.host+'index.php/navidad/c_administrateur/pn_ver_All_anuncio', 
        datatype: "json",
        height: 650,
        width       : 650,
        rowNum:30, 
        colNames:['id','Nombre', 'Canitdad', 'descripcion','Rango'], 
        colModel:[ 
            {name:'id',index:'id', width:60, sorttype:"int"}, 
            {name:'nombre',index:'nombre', width:90, sorttype:"date"}, 
            {name:'cantidad',index:'cantidad', width:50}, 
            {name:'descripcion',index:'descripcion', width:350, sortable:false} ,
            {name:'rango',index:'rango', width:50, align:"right",sorttype:"float",align:"center" }

        ], 
       
         viewrecords: true,
            sortorder: "desc",
            pager:"pager_pedido",
        caption: "Anuncios publicados" });
        $("#pn_table_liste_user").jqGrid('hideCol','id');
        $("#pn_table_liste_user").jqGrid('navGrid','#pager_pedido',{edit:false,add:false,del:false});
         var htmtBtn='<span class="ui-icon pn_del_usser" id="pn_del_anuncio"></span>'
        $("#pager_pedido_left").html(htmtBtn)
        $("#pn_show_status_true").hide();
        $("#pn_show_status_false").hide();
        $("#pn_del_anuncio").click(function()
        {
             var id = jQuery("#pn_table_liste_user").jqGrid('getGridParam','selrow'); 
             if(id)
                 {
                  var ret = jQuery("#pn_table_liste_user").jqGrid('getRowData',id);                  
                 console.log(ret);
             $.post($.ruta.host+'index.php/navidad/c_administrateur/pn_del_anuncio',{"id_annonce":ret.id},function(data){
                            jQuery("#pn_table_liste_user").trigger('reloadGrid'); 
                        })
                 }
                 else
                     {
                        $("#pn_show_status_false").show();
                         $("#pn_msg_error").html("Debes seleccionar al menos un anuncio para clasificar.")  
                     }
        })
        
}
function pn_show_zona()
{
  $("#pn_admin_show_table_provincia").empty();
  $("#pn_admin_show_table_provincia").jqGrid({ 
        url:$.ruta.host+'index.php/navidad/c_administrateur/pn_ver_provincia', 
        datatype: "json",
        height: 260,
        width       :370,
        rowNum:12, 
        colNames:['id','Provincia'], 
        colModel:[ 
            {name:'id',index:'id', width:60, sorttype:"int"}, 
            {name:'nombre',index:'nombre', width:320, sorttype:"date",editable:true}
        ], 
       
        viewrecords: true,
        sortorder: "desc",
        pager:"pn_admin_show_table_provincia_pager2",
        editurl: $.ruta.host+'index.php/navidad/c_administrateur/pn_add_provincia', // this is dummy existing url
        //editurl: 'server.php', // this is dummy existing url
        caption: "Listado de provincia",
        onSelectRow: function(ids)
        { 
            var ret = jQuery("#pn_admin_show_table_provincia").jqGrid('getRowData',ids);
            if(ids == null) 
            { 
                ids=0; 
                if(jQuery("#pn_admin_show_table_municipio").jqGrid('getGridParam','records') >0 ) 
                {
                  jQuery("#pn_admin_show_table_municipio").jqGrid('setGridParam',{url:$.ruta.host+'index.php/navidad/c_administrateur/pn_ver_municipio?q=1&id='+ids,page:1}); 
                jQuery("#pn_admin_show_table_municipio").jqGrid('setCaption',"Listado de municipio de la provincia : "+ret.nombre) .trigger('reloadGrid'); 
                } 
            } 
            else 
            { 
                jQuery("#pn_admin_show_table_municipio").jqGrid('setGridParam',{url:$.ruta.host+'index.php/navidad/c_administrateur/pn_ver_municipio?q=1&id='+ids,page:1}); 
                jQuery("#pn_admin_show_table_municipio").jqGrid('setCaption',"Listado de municipio de la provincia : "+ret.nombre) .trigger('reloadGrid'); 
            }
        }
    });
      jQuery("#pn_admin_show_table_provincia").jqGrid('navGrid','#pn_admin_show_table_provincia_pager2',{});
      jQuery("#pn_admin_show_table_provincia").jqGrid('hideCol',"id");
      
       $("#pn_admin_show_table_municipio").empty();
  $("#pn_admin_show_table_municipio").jqGrid({ 
        url:$.ruta.host+'index.php/navidad/c_administrateur/pn_ver_municipio', 
        datatype: "json",
        height: 260,
        width       :430,
        rowNum:12, 
        colNames:['id','Municipio','provincia'], 
        colModel:[ 
            {name:'id',index:'id', width:60, sorttype:"int"}, 
            {name:'nombre',index:'nombre', width:150, sorttype:"date",editable:true},
            {name:'provincia',index:'provincia',width:150, editable: true, edittype:"select", 
                editoptions:
                    {dataUrl:$.ruta.host+'index.php/navidad/c_administrateur/pn_get_all_provincia', defaultValue:'Intime'}, 
                    formoptions:{ rowpos:3,elmprefix:"&nbsp;&nbsp;&nbsp;&nbsp;" }
            }
        ], 
       editurl: $.ruta.host+'index.php/navidad/c_administrateur/pn_add_municipio', // this is dummy existing url
        viewrecords: true,
        sortorder: "desc",
        pager:"pn_admin_show_table_municipio_pager2",
        caption: "Listado de municipio" });
    
     jQuery("#pn_admin_show_table_municipio").jqGrid('navGrid','#pn_admin_show_table_municipio_pager2',{});
      //jQuery("#pn_admin_show_table_municipio").jqGrid('hideCol',"provincia");
     jQuery("#pn_admin_show_table_municipio").jqGrid('hideCol',"id");
    
    
}

function pn_show_promociones_grid()
{
    $("#pn_admin_show_table_promociones_texto").jqGrid({ 
        url:$.ruta.host+'index.php/navidad/c_administrateur/pn_admin_shoe_promociones', 
        datatype: "json",
        height: 250,
        width       : 850,
        rowNum:10, 
        colNames:['id','Nombre','Tipo','Autor'], 
        colModel:[ 
            {name:'id',index:'id', width:60, sorttype:"int"}, 
            {name:'nombre',index:'nombre', width:90},
            {name:'tipo',index:'tipo', width:20},
             {name:'autor',index:'autor', width:20}
        ], 
         viewrecords: true,
            sortorder: "desc",
            pager:"pn_admin_show_table_promociones_textopager2",
        caption: "Promociones" });
        $("#pn_admin_show_table_promociones_texto").jqGrid('hideCol','id');
        $("#pn_admin_show_table_promociones_texto").jqGrid('navGrid','#pn_admin_show_table_promociones_textopager2',{edit:false,add:false,del:false});
         var htmtBtn='<span class="ui-icon admin_add_usser" id="pn_add_promociones_ico" ></span><span class="ui-icon pn_mod_usser" id="pn_update_promociones_ico"></span><span class="ui-icon pn_del_usser" id="pn_del_promociones_ico"></span>'
        $("#pn_admin_show_table_promociones_textopager2_left").html(htmtBtn)
        $("#pn_add_promociones_ico").click(function(){
            $("#pn_show_status_slect").hide();
            $("#pn_show_img").hide();
            $("#pn_add_prenom").val('');
            $("#pn_tipo_promocion").val('');  
            $("#pn_texto").val('');
            $("#pn_add_promociones").show();
            $("#pn_tipo_promocion").change(function(){
                    if($(this).val() == 'text')
                        {
                            $("#pn_promocion_txt").show();
                            $("#pn_promocion_img").hide();
                            $("#pn_show_img").hide();
                        }
                     else
                        {
                            $("#pn_promocion_txt").hide();
                            $("#pn_promocion_img").show(); 
                            $("#pn_show_img").hide();
                        }
                })
        })
        $("#pn_update_promociones_ico").click(function(){
             var id = $("#pn_admin_show_table_promociones_texto").jqGrid('getGridParam','selrow');
             if(id)
                 {
                      $("#pn_show_status_slect").hide();
                 
              var ret = jQuery("#pn_admin_show_table_promociones_texto").jqGrid('getRowData',id);
                    $.getJSON($.ruta.host+'index.php/navidad/c_administrateur/pn_get_promociones', {"id_promociones":ret.id}, function(data){
                          $("#pn_add_promociones").show();
                          $("#pn_add_prenom").val(data[0].nombre);
                          if(data[0].tipo_promocion == 'text')
                              {
                                  $("#pn_texto").val(data[0].texto);
                                  $("#pn_show_img").hide();
                                  $("#pn_promocion_img").hide();
                                  $("#pn_promocion_txt").show();
                              }
                            else
                                {
                                    $("#pn_promocion_txt").hide();
                                    $("#pn_promocion_img").show(); 
                                    $("#pn_show_img").show();
                                    var img = $("#pn_show_img").find('img');
                                    $(img).attr('src',$.ruta.host+'/application/views/navidad/upload/'+data[0].url)
                                }
                          $("#pn_tipo_promocion").val(data[0].tipo_promocion);   
                          $("#pn_tipo_promocion").unbind('change'); 
                          $("#pn_id_promocion").val(data[0].id_promociones);
                    });
                 }
                 else
                     {
                         $("#pn_show_status_slect").show();
                     }
        })
        $("#pn_del_promociones_ico").click(function(){
             var id = $("#pn_admin_show_table_promociones_texto").jqGrid('getGridParam','selrow');
             if(id)
                 {
                      $("#pn_show_status_slect").hide();
                 
              var ret = jQuery("#pn_admin_show_table_promociones_texto").jqGrid('getRowData',id);
                    $.post($.ruta.host+'index.php/navidad/c_administrateur/pn_del_promociones', {"id_promociones":ret.id}, function(data){
                          if(data == '1')
                              {
                                  
                              }
                           else
                               {
                                   
                               }
                               jQuery("#pn_admin_show_table_promociones_texto").trigger('reloadGrid'); 
                          
                    });
                 }
                 else
                     {
                         $("#pn_show_status_slect").show();
                     }
        })
        
}
//ver trazas restaunrate
function pn_show_trazas_restaurante_grid()
{
    $("#pn_trazas_restuarante_table").jqGrid({ 
        url:$.ruta.host+'index.php/navidad/c_administrateur/pn_get_obtener_todos_restaurantes', 
        datatype: "json",
        height: 550,
        width       : 600,
        rowNum:25, 
        colNames:['id','Nombre','Correo','Enviados','Acepatdos'], 
        colModel:[ 
            {name:'id',index:'id', width:10, sorttype:"int"}, 
            {name:'nombre',index:'nombre', width:90},
            {name:'correo',index:'correo', width:90},
            {name:'cantenviada',index:'cantenviada', width:50,align:"center"},
            {name:'cantaceptada',index:'cantaceptada', width:50,align:"center"}
        ], 
         viewrecords: true,
            sortorder: "desc",
            pager:"pn_trazas_restuarante_table_pager2",
        caption: "Acciones de los restaurantes" });
        $("#pn_trazas_restuarante_table").jqGrid('hideCol','id');
}

function pn_show_trazas_usuario_grid(){
        $("#pn_trazas_usuario_table").jqGrid({ 
        url:$.ruta.host+'index.php/navidad/c_administrateur/pn_get_obtener_todos_usuarios', 
        datatype: "json",
        height: 550,
        width       : 600,
        rowNum:25, 
      colNames:['id','Nombre','Correo','Anuncio','Presupuesto recivido'], 
        colModel:[ 
            {name:'id',index:'id', width:10, sorttype:"int"}, 
            {name:'nombre',index:'nombre', width:90},
            {name:'correo',index:'correo', width:90},
            {name:'cantenviada',index:'cantenviada', width:90,align:"left"},
            {name:'cantaceptada',index:'cantaceptada', width:50,align:"center"}
        ], 
        
         viewrecords: true,
            sortorder: "desc",
            pager:"pn_trazas_restuarante_table_pager2",
        caption: "Acciones de los usuarios" });
        $("#pn_trazas_restuarante_table").jqGrid('hideCol','id');
}
//funcion que recive el select y le adiciona los option
function pn_cargar_municipio(div,id)
{
    $.getJSON($.ruta.host+'index.php/navidad/c_navidad/pn_obtener_municipalite',{
        "id":id
    },function(data){
        $(div).empty();
        for(var i =0; i< data.length; i++)
        {
            var option = "<option value="+data[i].id_municipalite +">"+ data[i].prenom+"</option>"
            $(div).append(option);
        }
    })
}