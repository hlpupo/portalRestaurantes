$("document").ready(function()
    {
        $("#pn_enregistrer").hide();
        $("#pn_option_recuperer_passw").toggle(function(){
            $("#pn_enregistrer").show('clip');
        },function(){
            $("#pn_enregistrer").hide('clip');
        })
        $('.dropdown-toggle').dropdown()
        //   $("#pn_btn_enregistrer").click(function(){
        //       var email = $("#pn_e_mail_enregistrer").val();
        //       if(email.match(/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/))
        //           {
        //               $.post( $.ruta.host+'index.php/navidad/c_navidad/pn_enregistrer',{"email":email}, function(data){
        //                   
        //               })
        //           }
        //        else
        //            {
        //                $("#pn_cont_e_mail_enregistrer").addClass('error')
        //            }
        //   })  
  
        $("#pn_view_cont_forme_restaurant").ready(function()
        {
            $("#pn_swh_tipo_pago").hide();
            $("#pn_modo_registro_pago").click(function(){
                $("#pn_swh_tipo_pago").show();    
            })
            $("#pn_modo_registro").click(function(){
                $("#pn_swh_tipo_pago").hide();    
            })
        })
        pn_validar_registro(); 
        pn_validar_anuncio();
        pn_validar_restaurante();
    })
function pn_validar_registro()
{
    $('#contact-form').validate({
        rules: {
            pn_add_prenom: {
                minlength: 2,
                required: true
            },
            pn_add_nom: {
                minlength: 2,
                required: true
            },
            pn_selectionner_Provincia: {
                required: true
            },
            pn_selectionner_Provincia: {
                required: true
            },
            pn_add_e_mail: {
                required: true,
                email: true
            },
	     
            pn_option_condiciones: {
                required: true
            }
        },
        messages: {
            pn_add_prenom: 'Debe ingresar el nombre',
            pn_add_nom: 'Debe ingresar el apellido',
            pn_selectionner_Provincia: {
                required: 'Debe ingresar el número de documento de identidad', 
                number: 'Debe ingresar un número'
            },
            pn_add_e_mail: {
                required: 'Debe ingresar un correo electr&oacute;nico', 
                email: 'Direcci&oacute;n de correo electr&oacute;nico inv&aacute;lido'
            },
            pn_option_condiciones: 'Debes aceptar los terminos de condiciones y uso.'
        },
        highlight: function(label) {
            $(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
            .text('OK!').addClass('valid')
            .closest('.control-group').addClass('success');
        }
    });
}
function pn_validar_anuncio()
{
    $('#anuncio-form').validate({
        rules: {
            pn_cantidad_personas: {
                required: true,
                number:true
            },            
            pn_selectionner_Provincia: {
                required: true
            },
            pn_selectionner_municipio: {
                required: true
            },
            pn_select_rango: {
                required: true
            },
            pn_titulo: {
                required: true
            },
            pn_fecha: {
                required: true,
                date:true
            }
            
        },
        messages: {
            pn_cantidad_personas: {
                required: 'Debe ingresar la cantidad de comensales', 
                number: 'Debe ingresar un n&uacute;mero'
            }           
        },
        highlight: function(label) {
            $(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
            .text('OK!').addClass('valid')
            .closest('.control-group').addClass('success');
        }
    });
}

function pn_validar_restaurante()
{
  
    $('#registre-form_pago').validate({
        rules: {
            pn_phone: {
                required: true,
                number:true
            },            
            pn_selectionner_Provincia: {
                required: true
            },
            pn_selectionner_municipio: {
                required: true
            },
            pn_cif: {
                required: true
            },          
            pn_add_prenom: {
                minlength: 2,
                required: true
            },
            pn_direccion: {
                minlength: 2,
                required: true
            },            
            pn_add_e_mail: {
                required: true,
                email: true
            },	     
            pn_option_condiciones: {
                required: true
            }          
        },
        messages: {
            pn_add_prenom: 'Debe ingresar el nombre',
            pn_phone: 'Digito invalido',
            pn_cif: 'Digito invalido',
            pn_selectionner_Provincia: {
                required: 'Debe ingresar el número de documento de identidad', 
                number: 'Debe ingresar un número'
            },
            pn_add_e_mail: {
                required: 'Debe ingresar un correo electr&oacute;nico', 
                email: 'Debe ingresar una direcci&oacute;n </br>de correo electr&oacute;nico valido'
            },
            pn_option_condiciones: 'Debes aceptar los terminos de condiciones y uso.'
           
        },
        highlight: function(label) {
            $(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
            .text('OK!').addClass('valid')
            .closest('.control-group').addClass('success');
        }
    });
    $('#registre-form').validate({
        rules: {
            pn_phone: {
                required: true,
                number:true
            },            
            pn_selectionner_Provincia: {
                required: true
            },
            pn_selectionner_municipio: {
                required: true
            },
            pn_cif: {
                required: true
            },          
            pn_add_prenom: {
                minlength: 2,
                required: true
            },
            pn_direccion: {
                minlength: 2,
                required: true
            },            
            pn_add_e_mail: {
                required: true,
                email: true
            },	     
            pn_option_condiciones: {
                required: true
            }          
        },
        messages: {
            pn_add_prenom: 'Debe ingresar el nombre',
            pn_phone: 'Digito invalido',
            pn_cif: 'Digito invalido',
            pn_selectionner_Provincia: {
                required: 'Debe ingresar el número de documento de identidad', 
                number: 'Debe ingresar un número'
            },
            pn_add_e_mail: {
                required: 'Debe ingresar un correo electr&oacute;nico', 
                email: 'Debe ingresar una direcci&oacute;n </br>de correo electr&oacute;nico valido'
            },
            pn_option_condiciones: 'Debes aceptar los terminos de condiciones y uso.'
           
        },
        highlight: function(label) {
            $(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
            .text('OK!').addClass('valid')
            .closest('.control-group').addClass('success');
        }
    });
}
$("#pn_show_ficha_tecnica").ready(function(){
    pn_grid_ficha_tecnica(); 
    pn_validar_menu_FT();
    $('#myTab a:first').tab('show');
    $('a[data-toggle="tab"]').on('shown', function (e) {
        e.target // activated tab
        e.relatedTarget // previous tab
         pn_load_mis_imagenes();
    })
 
})
function pn_load_mis_imagenes()
{
    $.getJSON($.ruta.host+'index.php/navidad/c_navidad/pn_load_mis_imagenes',{},function(data){
        var html = '<ul class="thumbnails" id="pn_fotos_li">'
          for(var i =0; i< data.length;i++)
              {
                html+='<li class="" ><div class="thumbnail">'
                html +='<a rel="example_group" href=# >'
                html +='<img width="75" height="75" id="'+data[i].id_foto+'" src="'+$.ruta.host+'/application/views/navidad/upload/'+data[i].url+'" alt="">'
                html +='</a></div><div id="pn_del_mis_imagenes" class="pn_delete"></div></li>'
              }
             html+='</ul>'
        $("#pn_ver_img").empty().html(html);
        var img  =$("#pn_fotos_li").find('.pn_delete').each(function() {
            $(this).click(function()
                {
                    var img =$(this).parent().find('img').attr('id');
                    $.post($.ruta.host+'index.php/navidad/c_navidad/pn_delete_mis_imagenes',{'idImg':img},function(data){
                       
                         pn_load_mis_imagenes();
                    })
            })
        })
    });
}
    
function pn_grid_ficha_tecnica()
{
    var html = '<table id="pn_show_grid_FT"></table> <div id="pn_rest_lista_menu_pager2"></div>'
    
    $("#pn_show_ficha_tecnica").empty().html(html)
    var a = $("#pn_show_ficha_tecnica");
    if(a)
    {
        $("#pn_show_grid_FT").jqGrid({
            url:$.ruta.host+'index.php/navidad/c_navidad/pn_obtener_datos_menu', 
            datatype: "json",
            colNames:['#','id','Nombre','Descripcion'],
            colModel:[
            {name:'no', index:'no',width:  3, align:"center"},
            {name:'id', index:'id',width:  3, align:"center"},
            {name:'nombre',index:'nombre',width: 20,align:"left" ,editable:true,editrules:{required:true}},
            {name:'descripcion',index:'descricpio', width: 20, align:"left",editable:true,editrules:{required:true},
            edittype:"textarea",editoptions:{rows:"4",cols:"20"}
        }
                         
        ],
        pager:"pn_rest_lista_menu_pager2",
        caption: "Listado de los menus disponibles. ",
        rowNum:5, 
        sortname: 'id', 
        viewrecords: true,
        sortorder: "desc",
        height      : 111,
        width       : 550,
        editurl: $.ruta.host+'index.php/navidad/c_navidad/pn_guardar_menu' // this is dummy existing url
    })
    $("#pn_show_grid_FT").jqGrid('hideCol','id');
    //$("#pn_show_grid_FT").jqGrid('navGrid','#pn_rest_lista_menu_pager2',{});

    $("#pn_show_grid_FT").jqGrid('navGrid','#pn_rest_lista_menu_pager2', {
        view:false
    }, //options 
    {height:230,width : 365,reloadAfterSubmit:false, jqModal:false, closeOnEscape:true}, // edit options 
    {height:230,width : 365,reloadAfterSubmit:false,jqModal:false, closeOnEscape:true, closeAfterAdd: true}, // add options 
    {reloadAfterSubmit:false,jqModal:false, closeOnEscape:true} // del options 
    );
        
}
}
function pn_validar_menu_FT()
{
    $('#pn_form_menu').validate({
        rules: {
            pn_ft_nombre: {
                required: true
            },
            pn_ft_descripcion: {
                required: true
            }
        },
        messages: {
                   
        },
        highlight: function(label) {
            $(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
            .text('OK!').addClass('valid')
            .closest('.control-group').addClass('success');
        }
    });
}

function pn_grid_restaurante_anuncio()
{
    var html = '<table id="pn_show_restaurante_anuncio_table"></table> <div id="pn_anunc_rest_pager2"></div>'
    
    $("#pn_show_restaurante_anuncio").empty().html(html)
    var a = $("#pn_show_restaurante_anuncio");
    if(a)
    {
        $("#pn_show_restaurante_anuncio_table").jqGrid({
            url:$.ruta.host+'index.php/navidad/c_navidad/pn_get_anuncio_restaurante', 
            datatype: "json",
            colNames:['id','Nombre', 'CanT', 'Descripcion','Provincia','Munucipio'], 
            colModel:[ 
            {name:'id',index:'id', width:60, sorttype:"int"}, 
            {
                name:'nombre',
                index:'nombre', 
                width:90, 
                sorttype:"date"
            }, 

            {
                name:'cantidad',
                index:'cantidad', 
                width:50
            }, 

            {
                name:'descripcion',
                index:'descripcion', 
                width:350, 
                sortable:false
            } ,
{
                name:'provincia',
                index:'provincia', 
                width:90, 
                sorttype:"date"
            }, 

            {
                name:'municipio',
                index:'municipio', 
                width:90, 
                sorttype:"date"
            }

            ],
            pager:"pn_anunc_rest_pager2",
            caption: "Listado de los anuncios. ",
            rowNum:5, 
            sortname: 'id', 
            viewrecords: true,
            sortorder: "desc",
            height      : 111,
            width       : 610            
        })
        $("#pn_show_restaurante_anuncio_table").jqGrid('hideCol','id');
        $("#pn_show_restaurante_anuncio_table").jqGrid('navGrid','#pn_anunc_rest_pager2',{
            edit:false,
            add:false,
            del:false
        });
        var htmtBtn='<span class="ui-icon admin_add_usser" id="pn_register_usser"></span>'
        $("#pn_anunc_rest_pager2_left").html(htmtBtn)
        $("#pn_cont_ofertas_anuncio").load($.ruta.host+'application/views/navidad/html/usser/view_resturante_resp_aununcio.xhtml',function(){
            pn_validar_form_restaurant_offert();
            $("#pn_show_status_true").hide();
            $("#pn_show_status_false").hide();
            $("#pn_show_status_tipo").hide();            
        })      
    }
}
function pn_validar_form_restaurant_offert()
{
    $('#pn_restaurant_ofert_form').validate({
        rules: {
            pn_anun_costo: {
                required: true,
                number:true
            },
            pn_anun_descripcion: {
                required: true
            }
        },
        messages: {
                   
        },
        highlight: function(label) {
            $(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
            .text('OK!').addClass('valid')
            .closest('.control-group').addClass('success');
            
        },
        submitHandler: function(form) {

            var cant = $("#pn_show_restaurante_anuncio_table").jqGrid('getGridParam','selrow');
            if(cant.length > 0)
            {
                var data = $(form).serializeArray();
                $.post($.ruta.host+'index.php/navidad/c_navidad/pn_oferta_restaurante_anuncion', 
                {
                    "form_anunc":data,
                    'id_anuncio':cant
                },function(data){
                    if(data == 1)
                    {
                        $("#pn_show_status_true").show();
                        $("#pn_show_status_false").hide(); 
                        $("#pn_show_status_tipo").hide();
                    }
                    else if(data == 3)
                    {
                        $("#pn_show_status_true").hide();
                        $("#pn_show_status_tipo").show();
                        $("#pn_show_status_false").hide();
                    }
                    else
                    {
                        $("#pn_show_status_true").hide();
                        $("#pn_show_status_tipo").hide();
                        $("#pn_show_status_false").show();
                    }
                    jQuery("#pn_show_restaurante_anuncio_table").trigger('reloadGrid');   
                })
            }
            else
            {
                $("#pn_show_status_false").show();
                $("#pn_msg_error").html("Debes seleccionar al menus un anuncio para clasificar.") 
            }
        }
    });
}
function pn_grid_Lista_anuncio()
{
    var html = '<table id="pn_show_lista_anuncio_table"></table> <div id="pn_view_lista_anuncio_pager2"></div>'
    $("#pn_view_lista_anuncio_usser").empty().html(html)
    $("#pn_show_lista_anuncio_table").jqGrid({
        url:$.ruta.host+'index.php/navidad/c_navidad/pn_get_lista_anuncio', 
        datatype: "json",
        colNames:['id','Nombre', 'CanT', 'Descripcion','Provincia','Munucipio','Ofertas','Estado'], 
        colModel:[ 
        {
            name:'id',
            index:'id', 
            width:60, 
            sorttype:"int"
        }, 

        {
            name:'nombre',
            index:'nombre', 
            width:90, 
            sorttype:"date"
        }, 

        {
            name:'cantidad',
            index:'cantidad', 
            width:50
        }, 

        {
            name:'descripcion',
            index:'descripcion', 
            width:350, 
            sortable:false
        } ,
{
            name:'provincia',
            index:'provincia', 
            width:90
        }, 

        {
            name:'municipio',
            index:'municipio', 
            width:90
        },

        {
            name:'cantrest',
            index:'cantrest', 
            width:90
        },

        {
            name:'estado',
            index:'estado', 
            width:90
        }

        ],
        onSelectRow: function(ids)
        { 
            var cant = $("#pn_show_lista_anuncio_table").jqGrid('getGridParam','selrow');
            pn_get_all_restaurante_anuncio(cant);
        },
        pager:"pn_view_lista_anuncio_pager2",
        caption: "Listado de los anuncios. ",
        rowNum:5, 
        sortname: 'id', 
        viewrecords: true,
        sortorder: "desc",
        height      : 111,
        width       : 950            
    })
    $("#pn_show_lista_anuncio_table").jqGrid('hideCol','id');
    $("#pn_show_lista_anuncio_table").jqGrid('navGrid','#pn_view_lista_anuncio_pager2',{
        edit:false,
        add:false,
        del:false
    });
}
function pn_get_all_restaurante_anuncio(cant)
{
    if(cant != "")
    {
        $.getJSON($.ruta.host+'index.php/navidad/c_navidad/pn_show_anuncio_usser',{
            "id_an":cant
        },function(data){
            pn_get_all_restaurante_anuncioAux(data)
        })
    }
}
function pn_get_all_restaurante_anuncioAux(data)
{
    //$("#pn_view_lista_anuncio_usser").hide();
    var self = this;
    self.data=data;
    $.dataPrueba = data;
    $("#pn_view_lista_anuncio_usser_ctr").empty();
    $("#pn_view_lista_anuncio_usser_ctr").load($.ruta.host+'application/views/navidad/html/usser/view_anuncio_ofertas.html',function(){
        var anuncion =  self.data[0];
        $("#pn_view_anuncio_usser_dialog").empty();
        $("#pn_show_anuncio_oferta_anuncio_nombre").html(anuncion[0].nombre)
        $("#pn_show_anuncio_oferta_anuncio_cant").html(anuncion[0].montant_usser)
        $("#pn_show_anuncio_oferta_anuncio_descripcion").html(anuncion[0].descripcion)
        var restaurante = self.data[1];
        var html = '<table class="table table-bordered"><tbody><tr><td >Nombre</td><td> Costo</td><td> Descripci&oacute;n</td><td> Contratar</td><td> Ficha tecnica</td><td> Dialogo</td></tr>'
            
        for(var i = 0; i < restaurante.length;i++)
        {
            html += '<tr>'
            html += '<td>'+ restaurante[i].nombre+'</td>'
            html += '<td>'+ restaurante[i].costo+'</td>'
            html += '<td>'+ restaurante[i].descripcion+'</td>'
            var dialog = '';
                    
            if(restaurante[i].aceptado == 0)
            {
                html += '<td> <span class="ui-icon pn_action_incorrect" onclick="pn_aceptar_ofertas('+ (anuncion[0].id_annonce)+','+(restaurante[i].id_restaurante)+',true)"></span></td>'
                dialog +='<div class="pn_commet_dialog" onclick="pn_establecer_dialogo('+ (anuncion[0].id_usser)+','+ (anuncion[0].id_annonce)+','+(restaurante[i].id_restaurante)+')"> <span class="badge badge-important">'+restaurante[i].leido+'</span></div>'
            }
            else
            {
                html += '<td> <span class="ui-icon pn_action_correct" onclick="pn_aceptar_ofertas('+ (anuncion[0].id_annonce)+','+(restaurante[i].id_restaurante)+',false)"></span></td>'
                              
                dialog +='<span  onclick="pn_establecer_dialogo('+ (anuncion[0].id_usser)+','+ (anuncion[0].id_annonce)+','+(restaurante[i].id_restaurante)+')">Dialog <span class="badge badge-important">'+restaurante[i].leido+'</span></span>'
            }
                    
                   
                    
                    
            html += '<td> <a href="'+$.ruta.host+'/index.php/navidad/c_navidad/pn_view_usser_FT_restaurante?idR='+restaurante[i].id_restaurante+'">ver ficha</a> </td>'
            html += '<td>'+ dialog +'</td>'
            html += '</tr>  '
        }
          
          
        html += '</tbody></table>'
        $("#pn_show_anuncio_oferta_rest").empty().html(html);
    })
    
}

function pn_aceptar_ofertas(id_anuncio, id_rest, tipo)
{
    $("#ejDialogError").remove();
    var ejDialog = $(document.createElement("div"))
    ejDialog.attr({
        "id":"ejDialogError"
    });
    $(document).append(ejDialog);
    var obj = {
        "id_anuncio":id_anuncio,
        "id_restaurant":id_rest,
        "tipo":tipo
    }
    console.log(obj);
    ejDialog.dialog({
        autoOpen: false,
        bgiframe: false,
        title: "Acpetar oferta",
        width:'auto',
        resizable: false,
        buttons:{
            Aceptar: function()
            {
                $.post($.ruta.host+'index.php/navidad/c_navidad/pn_aceptar_oferta_anuncio_restaurante',obj,function(data){
                    $("#ejDialogError").remove(); 
                    pn_mostrar_msg_cambio_restaurante(data,obj)
                })
            },
            Cancelar: function()
            {
                $("#ejDialogError").remove();
            }   
        },
        modal: true,
        width:'450'
    });
    var restaurante = $.dataPrueba[1];
    var restFinal = null;
    for(var i =0; i<restaurante.length; i++)
    {
        if(id_rest == restaurante[i].id_restaurante)
        {
            restFinal =restaurante[i];
        }
    }
    if(tipo)
    {
        var txt="Usted de desea aceptar la oferta </br>del resturante: "+ restFinal.nombre +"</br>"
        txt+= "con un costo de "+ restFinal.costo +"</br>"
    }
    else
    {
        var txt="Usted de desea rechasar la oferta </br>del resturante: "+ restFinal.nombre +"</br>"
        txt+= "con un costo de "+ restFinal.costo +"</br>"
    }
    $("#ejDialogError").html(txt);
    ejDialog.dialog("open");
}
function pn_mostrar_msg_cambio_restaurante(val,obj)
{
    $("#ejDialogError").remove();
    var ejDialog = $(document.createElement("div"))
    ejDialog.attr({
        "id":"ejDialogError"
    });
    $(document).append(ejDialog);
    ejDialog.dialog({
        autoOpen: false,
        bgiframe: false,
        title: "Acpetar oferta",
        width:'auto',
        resizable: false,
        buttons:{
            Aceptar: function()
            {
                $("#ejDialogError").remove(); 
                var cant = $("#pn_show_lista_anuncio_table").jqGrid('getGridParam','selrow');
                pn_get_all_restaurante_anuncio(cant);
            },   
            Cancelar: function()
            {
                $("#ejDialogError").remove();
                var cant = $("#pn_show_lista_anuncio_table").jqGrid('getGridParam','selrow');
                pn_get_all_restaurante_anuncio(cant);
            }   
        },
        modal: true,
        width:'450'
    });

    switch (val)
    {
        case '1':
        {
            if(obj.tipo == true)
            {
                var txt="Contrato enviado." 
            }
            else
            {
                var txt="Contrato cancelado correctamente." 
            }
                    
        }
        break;   
        case '0':
        {
            var txt="Ocurrio un error en el proceso, intente nuevamente." 
        }
        break;
        case '2':
        {
            var txt="Ya usted tiene un contrato previo por favor cancele su contrato y vuelva a intentar." 
        }
        break;
    }
       
    $("#ejDialogError").html(txt);
    ejDialog.dialog("open");
}
  
function pn_establecer_dialogo(id_usser,id_anuncio,id_restaurante)
{
    $("#pn_view_anuncio_usser_dialog").html('<div id="pn_cont_dialog"></div><div id="pn_cont_form_dialog"></div>');
    pn_show_establecer_dialogo(id_usser,id_anuncio,id_restaurante,$("#pn_cont_dialog"),$("#pn_cont_form_dialog"))
}
//muestra el espaciodel dialogo  
function pn_show_establecer_dialogo(id_usser,id_anuncio,id_restaurante,div_cont_dialog,div_form_cont_dialog)
{
    self.objDialog={
        "id_usser":id_usser,
        "id_anuncio":id_anuncio,
        "id_restaurante":id_restaurante
    }
    $.getJSON($.ruta.host+'index.php/navidad/c_navidad/pn_establecer_dialog',self.objDialog,function(data){
          
        var html = '';
        for(var i =0;i<data.length;i++)
        {
            html += '<div class="comment-main spacer">'
            html += '<div class="tbl2 clearfix floatfix">'
            html += '<span class="comment-avatar"></span>'
            html += '<span class="comment_actions" style="float:right">#'+(i+1)+'</span>'
            html += '<span class="comment-name">'+data[i].nombre+'</span><br>'
            html += '<span class="small">'+data[i].fecha+'</span></div>'
            html += '<div class="tbl1 comment_message"><!--comment_message-->'+data[i].dialogo+'</div></div>'
        }
                    
        $(div_cont_dialog).html(html);
        var html = '<div class="pn_respond_dialog">'
          html+='<label>Responder</label><textarea id="pn_comentar_dialog" class="span5"></textarea><input type="button" value="Comentar" id="pn_comentar_dialog_btn" class="btn btn-danger"/></div>'                  
        $(div_form_cont_dialog).html(html);
        $("#pn_comentar_dialog_btn").click(function()
        {
            pn_guardar_dialog(self.objDialog,$("#pn_comentar_dialog").val(),div_cont_dialog);
            $("#pn_comentar_dialog").val('')
        })
    })
}
function pn_guardar_dialog(obj,descripcion,div)
{
    var self = this;
    self.obj = obj;
    self.obj.descripcion = descripcion;
    $.post($.ruta.host+'index.php/navidad/c_navidad/pn_guardar_dialog', obj,function(data){
        var html = '<div class="comment-main spacer">'
        html += '<div class="tbl2 clearfix floatfix">'
        html += '<span class="comment-avatar"></span>'
        html += '<span class="comment_actions" style="float:right"></span>'
        html += '<span class="comment-name">Yo</span><br>'
        html += '<div class="tbl1 comment_message"><!--comment_message-->'+self.obj.descripcion +'</div></div>'
        $(div).append(html);
        
    })
}

function pn_show_grid_seguir_anuncio()
{
    $("#pn_show_seguir_anuncio_table").jqGrid({
        url:$.ruta.host+'index.php/navidad/c_navidad/pn_get_restaurante_seguir_anuncio', 
        datatype: "json",
        colNames:['id_anuncio','id_anuncio','id_anuncio','Nombre anuncio', 'CanT', 'Costo','Descripcion','Estado','Mensajes'], 
        colModel:[ 
            {name:'id_anuncio',index:'id_anuncio', width:30, sorttype:"int"}, 
            {name:'id_rest',index:'id_rest', width:30, sorttype:"int"}, 
            {name:'id_usario',index:'id_usario', width:30, sorttype:"int"}, 
            {name:'nombre',index:'nombre', width:90, sorttype:"date"}, 
            {name:'cantidad',index:'cantidad', width:50}, 
            {name:'costo',index:'costo', width:90},
            {name:'descripcion',index:'descripcion', width:350, sortable:false},
            {name:'estado',index:'estado', width:50},
            {name:'msg',index:'msg', width:50,sorttype:"string"}
        ],
        pager:"pn_show_seguir_anuncio_pager2",
        caption: "Listado de los anuncios ofertados. ",
        rowNum:5, 
        sortname: 'id', 
        viewrecords: true,
        sortorder: "desc",
        height      : 111,
        width       : 950,
        onSelectRow: function(ids)
        { 
            var id = jQuery("#pn_show_seguir_anuncio_table").jqGrid('getGridParam','selrow'); 
            if (id)
            { 
                var ret = jQuery("#pn_show_seguir_anuncio_table").jqGrid('getRowData',id);
                var obj={
                    'id_anuncio':ret.id_anuncio,
                    'id_restaurante':ret.id_rest
                    }
                $("#pn_show_dialog_anuncio").html('<div id="pn_cont_dialog"></div><div id="pn_cont_form_dialog"></div>');
                pn_show_establecer_dialogo_restaurante(ret.id_usario,ret.id_anuncio,ret.id_rest,$("#pn_cont_dialog"),$("#pn_cont_form_dialog"))
                    
            } 
            else
            {         
                var html ='<div class=" alert alert-block alert-error fade in" id="pn_show_status_false">'
                html +='<span class="alert-heading">Debes seleccionar un anuncio.</span></div>'
                $("#pn_show_dialog_anuncio").html(html); 
            }
        }
    })
    $("#pn_show_seguir_anuncio_table").jqGrid('hideCol','id_anuncio');
    $("#pn_show_seguir_anuncio_table").jqGrid('hideCol','id_rest');
    $("#pn_show_seguir_anuncio_table").jqGrid('hideCol','id_usario');
    $("#pn_show_seguir_anuncio_table").jqGrid('navGrid','#pn_show_seguir_anuncio_pager2',{
        edit:false,
        add:false,
        del:false
    });
}

function pn_show_establecer_dialogo_restaurante(id_usser,id_anuncio,id_restaurante,div_cont_dialog,div_form_cont_dialog)
{
    self.objDialog={
        "id_usser":id_usser,
        "id_anuncio":id_anuncio,
        "id_restaurante":id_restaurante
    }
    $.getJSON($.ruta.host+'index.php/navidad/c_navidad/pn_establecer_dialog_restaurante',self.objDialog,function(data){
          
        var html = '';
        for(var i =0;i<data.length;i++)
        {
            html += '<div class="comment-main spacer">'
            html += '<div class="tbl2 clearfix floatfix">'
            html += '<span class="comment-avatar"></span>'
            html += '<span class="comment_actions" style="float:right">#'+(i+1)+'</span>'
            html += '<span class="comment-name">'+data[i].nombre+'</span><br>'
            html += '<span class="small">'+data[i].fecha+'</span></div>'
            html += '<div class="tbl1 comment_message"><!--comment_message-->'+data[i].dialogo+'</div></div>'
        }
                    
        $(div_cont_dialog).html(html);
        var html = '<div><textarea id="pn_comentar_dialog"></textarea><input type="button" value="Comentar" id="pn_comentar_dialog_btn" /></div>'                  
        $(div_form_cont_dialog).html(html);
        $("#pn_comentar_dialog_btn").click(function()
        {
            
            pn_guardar_dialog_restaurante(self.objDialog,$("#pn_comentar_dialog").val(),div_cont_dialog);
            $("#pn_comentar_dialog").val('')
        })
    })
}
function pn_guardar_dialog_restaurante(obj,descripcion,div)
{
    var self = this;
    self.obj = obj;
    self.obj.descripcion = descripcion;
    $.post($.ruta.host+'index.php/navidad/c_navidad/pn_guardar_dialog_restaurante', obj,function(data){
        var html = '<div class="comment-main spacer">'
        html += '<div class="tbl2 clearfix floatfix">'
        html += '<span class="comment-avatar"></span>'
        html += '<span class="comment_actions" style="float:right"></span>'
        html += '<span class="comment-name">Yo</span><br>'
        html += '<div class="tbl1 comment_message"><!--comment_message-->'+self.obj.descripcion +'</div></div>'
        $(div).append(html);
        
    })
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

function pn_show_grid_aprovar_promocion()
{
    $("#pn_show_aprovar_promocion_table").jqGrid({
        url:$.ruta.host+'index.php/navidad/c_navidad/pn_get_aprovar_promocion', 
        datatype: "json",
        colNames:['id_promocion','Nombre','Estado'], 
        colModel:[ 
            {name:'id_promocion',index:'id_promocion', width:30, sorttype:"int"}, 
            {name:'nombre',index:'nombre', width:250, sorttype:"date"}, 
            {name:'estado',index:'estado', width:50, sorttype:"date"}
        ],
        pager:"pn_show_aprovar_promocion_table_pager2",
        caption: "Listado promociones. ",
        rowNum:5, 
        sortname: 'id', 
        viewrecords: true,
        sortorder: "desc",
        height      : 111,
        width       : 610,
        onSelectRow: function(ids)
        { 
            var id = jQuery("#pn_show_aprovar_promocion_table").jqGrid('getGridParam','selrow'); 
            if (id)
            { 
                var ret = jQuery("#pn_show_aprovar_promocion_table").jqGrid('getRowData',id);
                var obj={
                    'id_promocion':ret.id_rest
                    }
                 
                    $.getJSON($.ruta.host+'index.php/navidad/c_navidad/pn_get_promocion',  {"id_promocion":ret.id_promocion}, function(data){
                   if(data[0].tipo_promocion == "img")
                       {
                            $("#pn_aprovar_promocion_texto").hide();
                            $("#pn_aprovar_promocion_img").show();
                            $("#pn_aprovar_promocion_nombre_img").html(data[0].nombre)
                            $("#pn_aprovar_promocion_img_img").attr('src',$.ruta.host+'application/views/navidad/upload/'+data[0].url)
                       }
                    else
                        {
                             $("#pn_aprovar_promocion_texto").show();
                            $("#pn_aprovar_promocion_img").hide();
                            $("#pn_aprovar_promocion_nombre").html(data[0].nombre)
                            $("#pn_aprovar_promocion_descripcion").html(data[0].texto)
                        }
               })
                
                    
            } 
        }
    })
    $("#pn_show_aprovar_promocion_table").jqGrid('hideCol','id_promocion');
    $("#pn_show_aprovar_promocion_table").jqGrid('navGrid','#pn_show_aprovar_promocion_table_pager2',{
        edit:false,
        add:false,
        del:false
    });
    
    $("#pn_btn_aprovar_promocion ").click(function(){
        var id = jQuery("#pn_show_aprovar_promocion_table").jqGrid('getGridParam','selrow'); 
        var ret = jQuery("#pn_show_aprovar_promocion_table").jqGrid('getRowData',id);
        $.post($.ruta.host+'index.php/navidad/c_navidad/pn_aceptar_promocion',  {"id_promocion":ret.id_promocion},function(){
            jQuery("#pn_show_aprovar_promocion_table").trigger('reloadGrid'); 
        })
    })
    $("#pn_btn_aprovar_promocion_txt ").click(function(){
        var id = jQuery("#pn_show_aprovar_promocion_table").jqGrid('getGridParam','selrow'); 
        var ret = jQuery("#pn_show_aprovar_promocion_table").jqGrid('getRowData',id);
        $.post($.ruta.host+'index.php/navidad/c_navidad/pn_aceptar_promocion',  {"id_promocion":ret.id_promocion},function(){
             jQuery("#pn_show_aprovar_promocion_table").trigger('reloadGrid'); 
        })
    })
}


//comercial de venta
function pn_cmv_save_borrador(data)
{
    $.post($.ruta.host+'index.php/navidad/c_comercial/pn_cmv_save_borrador',data,function(data){
        if(data == '1')
            {
                 $("#pn_show_status_false").hide();
                  $("#pn_show_status_true").show();
                  $("#pn_show_status_email").hide();
                  
                $("#pn_view_cmv_cont_forme_restaurant").hide();
                jQuery("#pn_cmv_alta_restaurante_grid_table").trigger('reloadGrid');  
                
            }
            else
                {
                   $("#pn_show_status_false").show();
                    $("#pn_show_status_true").hide();
                    $("#pn_show_status_email").hide(); 
                }
    })
}
//comercial de venta
function pn_cmv_save_restaurante(data)
{
    $.post($.ruta.host+'index.php/navidad/c_comercial/pn_cmv_save_restaurnate',data,function(data){
        if(data == '1')
            {
                //$("#pn_view_cmv_cont_forme_restaurant").hide();
                jQuery("#pn_cmv_alta_restaurante_grid_table").trigger('reloadGrid');   
                  $("#pn_show_status_false").hide();
                  $("#pn_show_status_true").show();
                  $("#pn_show_status_email").hide();
            }
        else if(data == '3')
            {
                  $("#pn_show_status_false").hide();
                $("#pn_show_status_true").hide();
                $("#pn_show_status_email").show();
            }
        else if(data == 0)
            {
                  $("#pn_show_status_false").show();
                    $("#pn_show_status_true").hide();
                    $("#pn_show_status_email").hide();
            }
    })
}
function pn_cmv_grid_restaurante_borrador()
{
     $("#pn_cmv_alta_restaurante_grid_table").jqGrid({
        url:$.ruta.host+'index.php/navidad/c_comercial/pn_cmv_grid_restaurante_borrador', 
        datatype: "json",
        colNames:['id_borrador','Nombre anuncio', 'Descripcion'], 
        colModel:[ 
            {name:'id_borrador',index:'id_anuncio', width:30, sorttype:"int"}, 
            {name:'nombre',index:'nombre', width:90, sorttype:"date"}, 
            {name:'descripcion',index:'descripcion', width:350, sortable:false},
        ],
        pager:"pn_cmv_alta_restaurante_grid_pager2",
        caption: "Listado de los anuncios ofertados. ",
        rowNum:5, 
        sortname: 'id', 
        viewrecords: true,
        sortorder: "desc",
        height      : 130,
        width       : 650,
        onSelectRow: function(ids)
        { 
            $("#pn_show_status_false").hide();
                  $("#pn_show_status_true").hide();
                  $("#pn_show_status_email").hide();
             $("#pn_view_cmv_cont_forme_restaurant").show();
            var id = jQuery("#pn_cmv_alta_restaurante_grid_table").jqGrid('getGridParam','selrow'); 
            if (id)
            { 
                var ret = jQuery("#pn_cmv_alta_restaurante_grid_table").jqGrid('getRowData',id);
                var obj={
                    'id_borrador':ret.id_borrador
                    }
                $.getJSON($.ruta.host+'index.php/navidad/c_comercial/pn_cmv_get_restaurante_borrador',obj,function(data){
                    
                   $("#pn_view_cmv_cont_forme_restaurant").show();
                   pn_cmv_show_restaurante_borrador(data[0])
                })
            } 
            else
            {         
                var html ='<div class=" alert alert-block alert-error fade in" id="pn_show_status_false">'
                html +='<span class="alert-heading">Debes seleccionar un anuncio.</span></div>'
                //$("#pn_show_dialog_anuncio").html(html); 
            }
        }
    })
    $("#pn_cmv_alta_restaurante_grid_table").jqGrid('hideCol','id_borrador');
    $("#pn_cmv_alta_restaurante_grid_table").jqGrid('navGrid','#pn_cmv_alta_restaurante_grid_pager2',{
        edit:false,
        add:false,
        del:false
    });
     var htmtBtn='<span class="ui-icon admin_add_usser" id="pn_cmv_add_restaurante"></span>'
        $("#pn_cmv_alta_restaurante_grid_pager2_left").html(htmtBtn)
        $("#pn_cmv_add_restaurante").click(function(){
            //$("#pn_cmv_alta_restaurante_grid_table").hide();
             $("#pn_add_prenom").val('');
            $("#pn_add_e_mail").val('');
            $("#pn_phone").val('');
            $("#pn_cif").val('');
            $("#pn_codigo_postal").val('');
            $("#pn_direccion").val('');
            $("#pn_Nota").val('');
             $("#pn_id_borrador").val('');
             $("#pn_swh_tipo_pago").hide() 
                $("#pn_modo_registro").attr('checked',true) 
                $("#pn_cmv_nota").hide();
                $("#pn_show_status_false").hide();
                  $("#pn_show_status_true").hide();
                  $("#pn_show_status_email").hide();
            $("#pn_view_cmv_cont_forme_restaurant").show();
        })
}
function pn_cmv_show_restaurante_borrador(data)
{
    $("#pn_add_prenom").val(data.nombre);
    $("#pn_add_e_mail").val(data.email);
    $("#pn_phone").val(data.telefono);
    $("#pn_cif").val(data.cif);
    $("#pn_codigo_postal").val(data.codigo_postal);
    $("#pn_direccion").val(data.direccion);
    $("#pn_Nota").val(data.nota);
     $("#pn_id_borrador").val(data.id_borrador);
    $("#pn_cmv_nota").show('clip');
    
    switch(data.tipo_pago)
    {
        case '1':
            {
               $("#pn_modo_registro_pago").attr('checked',true) 
               $("#tipo_pago_campana").val(1) 
               $("#pn_swh_tipo_pago").show()                
            }
            break
        case '2':
            {
                $("#pn_modo_registro_pago").attr('checked',true) 
                $("#tipo_pago_campana").val(2) 
                $("#pn_swh_tipo_pago").show()                 
            }
            break
        case '0':
            {
               $("#pn_swh_tipo_pago").hide() 
                $("#pn_modo_registro").attr('checked',true) 
               
            }
            break    
    }
    $("#pn_cmv_save_borrador").unbind().click(function(){
         pn_cmv_save_borrador($("#pn_cmv_alta_restaurante_form").serializeArray());
    })
    
    
}
//comercial de promocions

function pn_cmp_promociones_grid()
{
    $("#pn_cmp_show_table_promociones_texto").jqGrid({ 
        url:$.ruta.host+'index.php/navidad/c_comercial/pn_cmp_shoe_promociones', 
        datatype: "json",
        height: 200,
        width       : 790,
        rowNum:10, 
        colNames:['id','Nombre','Tipo', 'Estado'], 
        colModel:[ 
            {name:'id',index:'id', width:60, sorttype:"int"}, 
            {name:'nombre',index:'nombre', width:90},
            {name:'tipo',index:'tipo', width:20},
            {name:'estado',index:'estado', width:20}
        ], 
         viewrecords: true,
            sortorder: "desc",
            pager:"pn_cmp_show_table_promociones_textopager2",
        caption: "Promociones" });
      
        $("#pn_cmp_show_table_promociones_texto").jqGrid('hideCol','id');
        $("#pn_cmp_show_table_promociones_texto").jqGrid('navGrid','#pn_cmp_show_table_promociones_textopager2',{edit:false,add:false,del:false});
         var htmtBtn='<span class="ui-icon admin_add_usser" id="pn_add_promociones_ico" ></span><span class="ui-icon pn_mod_usser" id="pn_update_promociones_ico"></span><span class="ui-icon pn_del_usser" id="pn_del_promociones_ico"></span><span class="ui-icon pn_del_usser" id="pn_act_promociones_ico"></span>'
        $("#pn_cmp_show_table_promociones_textopager2_left").html(htmtBtn)
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
             var id = $("#pn_cmp_show_table_promociones_texto").jqGrid('getGridParam','selrow');
             if(id)
                 {
                      $("#pn_show_status_slect").hide();
                 
              var ret = jQuery("#pn_cmp_show_table_promociones_texto").jqGrid('getRowData',id);
                    $.getJSON($.ruta.host+'index.php/navidad/c_comercial/pn_get_promociones', {"id_promociones":ret.id}, function(data){
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
                          $("#pn_selectionner_restaurante").val(data[0].id_restaurante);   
                          
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
             var id = $("#pn_cmp_show_table_promociones_texto").jqGrid('getGridParam','selrow');
             if(id)
                 {
                      $("#pn_show_status_slect").hide();
                 
              var ret = jQuery("#pn_cmp_show_table_promociones_texto").jqGrid('getRowData',id);
                    $.post($.ruta.host+'index.php/navidad/c_comercial/pn_del_promociones', {"id_promociones":ret.id}, function(data){
                          if(data == '1')
                              {
                                  
                              }
                           else
                               {
                                   
                               }
                               jQuery("#pn_cmp_show_table_promociones_texto").trigger('reloadGrid'); 
                          
                    });
                 }
                 else
                     {
                         $("#pn_show_status_slect").show();
                     }
        })
        $("#pn_act_promociones_ico").click(function(){
             var id = $("#pn_cmp_show_table_promociones_texto").jqGrid('getGridParam','selrow');
             if(id)
                 {
                      $("#pn_show_status_slect").hide();
                    var ret = jQuery("#pn_cmp_show_table_promociones_texto").jqGrid('getRowData',id);
                    $.getJSON($.ruta.host+'index.php/navidad/c_comercial/pn_activar_promociones', {"id_promociones":ret.id}, function(data){
                         if(data == '1')
                              {
                                  
                              }
                           else
                               {
                                   
                               }
                               jQuery("#pn_cmp_show_table_promociones_texto").trigger('reloadGrid'); 
                    })
                 }
               else
                   {
                      $("#pn_show_status_slect").show();  
                   }
        })
        
}

function pn_cmp_grud_usuario_grid()
{
    $("#pn_cmp_show_table_usuario").jqGrid({ 
        url:$.ruta.host+'index.php/navidad/c_comercial/pn_cmp_mis_usuarios', 
        datatype: "json",
        height: 200,
        width       : 790,
        rowNum:10, 
        colNames:['id','Nombre','Apellidos', 'Correo','Estado'], 
        colModel:[ 
            {name:'id',index:'id', width:60, sorttype:"int"}, 
            {name:'nombre',index:'nombre', width:30},
            {name:'apellidos',index:'apellidos', width:30},
            {name:'email',index:'email', width:30},
            {name:'estado',index:'estado', width:20}
        ], 
         viewrecords: true,
            sortorder: "desc",
            pager:"pn_cmp_show_table_usuario_pager2",
        caption: "Gestionar usuarios" });
      
        $("#pn_cmp_show_table_usuario").jqGrid('hideCol','id');
        $("#pn_cmp_show_table_usuario").jqGrid('navGrid','#pn_cmp_show_table_usuario_pager2',{edit:false,add:false,del:false});
         var htmtBtn='<span class="ui-icon pn_mod_usser" id="pn_update_cmp_usser_ico"></span><span class="ui-icon pn_del_usser" id="pn_del_cmp_usser_ico"></span>'
        $("#pn_cmp_show_table_usuario_pager2_left").html(htmtBtn)
        $("#pn_del_cmp_usser_ico").click(function(){
            var id = $("#pn_cmp_show_table_usuario").jqGrid('getGridParam','selrow');
             if(id)
                 {
                      $("#pn_show_status_slect").hide();
                 
              var ret = jQuery("#pn_cmp_show_table_usuario").jqGrid('getRowData',id);
                    $.post($.ruta.host+'index.php/navidad/c_comercial/pn_del_cmp_usser', {"id_usuario":ret.id}, function(data){
                          if(data == '1')
                              {
                                  
                              }
                           else
                               {
                                   
                               }
                               jQuery("#pn_cmp_show_table_usuario").trigger('reloadGrid'); 
                          
                    });
                 }
                 else
                     {
                         $("#pn_show_status_slect").show();
                     }
        })
        $("#pn_update_cmp_usser_ico").click(function(){
             var id = $("#pn_cmp_show_table_usuario").jqGrid('getGridParam','selrow');
             if(id)
                 {
                      $("#pn_show_status_slect").hide();
                 
              var ret = jQuery("#pn_cmp_show_table_usuario").jqGrid('getRowData',id);
                    $.getJSON($.ruta.host+'index.php/navidad/c_comercial/pn_get_cmp_usser', {"id_usuario":ret.id}, function(data){
                          
                          $("#pn_add_prenom").val(data[0].nombre);
                          $("#pn_add_nom").val(data[0].apellidos);
                          $("#pn_add_e_mail").val(data[0].email);
                          $("#pn_selectionner_Provincia").val(data[0].id_province);
                         $("#pn_selectionner_municipio").val(data[0].id_municipalite);
                          $("#pn_id_usser_cmp").val(data[0].id_usser);   
                         
                    });
                 }
                 else
                     {
                         $("#pn_show_status_slect").show();
                     }
        })
        
        
}
