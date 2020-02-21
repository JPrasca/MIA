
/* 
Descripción:    Carga inicial de la vista, tabla de miembros registrados
Autor:          J. Prasca
Fecha:          2020-02-10
*/
$(document).ready(function() {

    /*petición fetch a la API RESTFull */
    fetch(urlBase + 'api/member')
    .then(function(response) {
          if(response.ok){              
              return response.json();              
          }
    })
    .then(function(myJson) {
        let vList = myJson.list;//obtención del listado json
        let vMembers = [];// arreglo para tomar la lista

        /* llenado del vector */
        for(let i = 0; i < vList.length; i++){
            vMembers.push({
                "Identification": vList[i].Identification,
                "first_name": vList[i].first_name,
                "last_name": vList[i].last_name,
                "genre": vList[i].genre,
                "phone": vList[i].phone,
                "member_type_id": vList[i].member_type_id,
                "Edit": "Modificar esta monda",
                "View": "ver esta mierda"
            });            
        }

        /** carga de información a la tabla de datos */
        $('#page-length-option').DataTable( {
            data: vMembers, 
            columns: [
                { data: "Identification", title: "Identificacion" },
                { data: "last_name", title: "Apellidos" },
                { data: "first_name", title: "Nombres" },
                { data: "genre", title: "Sexo" },
                { data: "phone", title: "Teléfono" },
                { 
                    data: "member_type_id", 
                    title: "Tipo",
                    render:  (data, type, row, meta) => {
                        if(type === 'display'){
                            switch(data){
                            case 1:
                                data = '<span class="chip blue lighten-5"><span class="blue-text">Servidor</span></span>';
                                break;
                            case 2:
                                data = '<span class="chip green lighten-5"><span class="green-text">Producción</span></span>';
                                break;
                            default:
                                data = '<span class="chip orange lighten-5"><span class="orange-text">Membro común</span></span>';
                            }                            
                        }                        
                        return data;                        
                    }
                },
                { 
                    data: "Edit", 
                    title: "Editar",
                    render:  (data, type, row, meta) => {
                        if(type === 'display'){
                            data = '<a href=""><i class="material-icons">edit</i></a>';
                        }                        
                        return data;                        
                    },
                    width: "3%"
                },
                { 
                    data: "View", 
                    title: "Ver", 
                    render: function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href=""><i class="material-icons">remove_red_eye</i></a>';
                        }                        
                        return data;
                    },
                    width: "3%"
                }             
            ]
        } );          
    });
} );
