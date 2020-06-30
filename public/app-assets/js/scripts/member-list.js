
/* 
Descripción:    Carga inicial de la vista, tabla de miembros registrados
Autor:          J. Prasca
Fecha:          2020-02-10
*/
$(document).ready(function() {
    Initialize();
} );

/* 
Descripción:    Inicialización de componentes
Autor:          J. Prasca
Fecha:          2020-03-17
*/
const Initialize = () => {
    LoadDataTable();
}

/* 
Descripción:    Carga de datos en la tabla de miembros
Autor:          J. Prasca
Fecha:          2020-03-17
*/
const LoadDataTable = () => {
   /*petición fetch a la API REST */
   fetch(urlBase + 'api/member')
   .then(function(response) {
         if(response.ok){              
             return response.json();              
         }
   })
   .then(function(myJson) {
        let vList = myJson.list;//obtención del listado json
        let vMembers = [];// arreglo para tomar la lista
    
        setTimeout(() => {
            let sAuxData = "";
            /* llenado del vector */
            for(let i = 0; i < vList.length; i++){
                vMembers.push({
                    "Id": vList[i].Id,
                    "Identification": vList[i].identification,
                    "first_name": vList[i].first_name,
                    "last_name": vList[i].last_name,
                    "genre": vList[i].genre,
                    "phone": vList[i].phone,
                    "member_type_id": vList[i].member_type_id,                    
                    "member_type_id_hide": GetTypeNameString(vList[i].member_type_id),
                    "view": "Ver",
                    "edit": "Editar"
                });            
            }

            /** carga de información a la tabla de datos */
            $('#page-length-option').DataTable( {
                data: vMembers,
                columnDefs: [
                    { width: "20%", targets: [5 ,6] },
                    { width: "30%", targets: [2, 3] },
                    { width: '2%', targets: [4] },
                    { width: '1%', targets: [8, 9]},
                    { visible: false, targets: [0, 1, 7]}
                ],
                columns: [
                    { 
                        data: "Id", 
                        title: "Id",
                        
                    },
                    { 
                        data: "Identification", 
                        title: "Identificacion",
                        
                    },
                    { 
                        data: "last_name", 
                        title: "Apellidos"
                    },
                    { 
                        data: "first_name", 
                        title: "Nombres"
                    },
                    { 
                        data: "genre", 
                        title: "Sexo"
                    },
                    { 
                        data: "phone", 
                        title: "Teléfono"
                    },
                    { 
                        data: "member_type_id", 
                        title: "Tipo",
                        render:  (data, type, row, meta) => {
                            let vData = data.split('|');
                            vData.splice(vData.length - 1, 1);
                            let sSeparator = '';
                            data = '';
                            if(type === 'display'){
                                for(let i = 0; i < vData.length; i++){
                                    sSeparator = ((i + 1)%2 == 0)? '<br>': ''; 
                                    if(!isNaN(vData[i])){ 
                                        data += '<span style="font-size:10px; height: 26px; margin-bottom:0;" class="chip '+ vMemberType[vData[i] - 1].color_template2 +' lighten-4"><span style="" class="'+ vMemberType[vData[i] - 1].color_template +'-text">'+ vMemberType[vData[i] - 1].name +'</span></span>'+sSeparator;
                                    } 
                                    
                                }                         
                            }                        
                            return data;                        
                        }
                    },
                    { 
                        data: "member_type_id_hide", 
                        title: "TipoHide"                       
                    }, 
                    { 
                        data: "view", 
                        title: "Ver", 
                        render: function(data, type, row, meta){
                            if(type === 'display'){                                
                                data = '<a href="' + urlBase + 'member/view/' + row.Id + '"><i class="material-icons">remove_red_eye</i></a>';
                            }                        
                            return data;
                        }
                    },
                    { 
                        data: "edit", 
                        title: "Editar", 
                        render: function(data, type, row, meta){
                            if(type === 'display'){
                                data = '<a href="' + urlBase + 'member/edit/' + row.Id + '"><i class="material-icons">edit</i></a>';
                            }                        
                            return data;
                        }
                    }             
                ],
                scrollY: '50%',
                scrollCollapse: true            
            } );

            
            document.getElementById('progress-text').style.visibility = 'hidden'; 
            document.getElementById('progress').style.visibility = 'hidden';            
        }, 1500);
         
   });  
}

/* 
Descripción:    Obtener una cadena con los nombres de los tipos de área/membresía
Autor:          J. Prasca
Fecha:          2020-05-03
*/
const GetTypeNameString = (sTypeString) => {
        let vData = sTypeString.split('|');
        vData.splice(vData.length - 1, 1);
        let sSeparator = ' ';
        let sData = '';
        for(let i = 0; i < vData.length; i++){                                   
            if(!isNaN(vData[i])){ 
                sData += vMemberType[vData[i] - 1].name + sSeparator;
            }                                    
        }                         
                              
        return sData;  
}