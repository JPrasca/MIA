

$(document).ready(function() {

    fetch(urlBase + '/api/member')
    .then(function(response) {
          if(response.ok){              
              return response.json();
              
          }
    })
    .then(function(myJson) {
        var listado = myJson.list;
        let objMember = [];
        for(let i = 0; i < listado.length; i++){
            objMember.push({
                "Identification": listado[i].Identification,
                "first_name": listado[i].first_name,
                "last_name": listado[i].last_name,
                "genre": listado[i].genre,
                "phone": listado[i].phone,
                "member_type_id": listado[i].member_type_id,
                "Edit": "Modificar esta monda",
                "View": "ver esta mierda"
            });            
        }

        $('#page-length-option').DataTable( {
            data: objMember, 
            columns: [
                { data: "Identification", title: "Identificacion" },
                { data: "first_name", title: "Apellidos" },
                { data: "last_name", title: "Nombre" },
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
            ],

        } );  

        
    });

} );
