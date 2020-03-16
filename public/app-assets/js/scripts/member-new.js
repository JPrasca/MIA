/* 
Descripción:    Carga de los elementos restantes de la vista para registro de nuevos miembros
Autor:          J. Prasca
Fecha:          2020-03-16
*/
$(document).ready(function(){

    /** componente para escoger fechas */
    $('.datepicker').datepicker({
        firstDay: true, 
        format: 'yyyy-mm-dd',
        i18n: {
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
            weekdays: ["Domingo","Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
            weekdaysShort: ["Dom","Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
            weekdaysAbbrev: ["D","L", "M", "M", "J", "V", "S"],
            cancel: "Cancelar"
        },
        mask: true,
        yearRange: 50
    });

    /** para llenar la tabla de tipos de miembro/ministerio (tiene retraso de tiempo para esperar la promesa en la ejecución que 
     * trae los datos desde la petición [ver master_sub_blade.php]) */
    setTimeout(() => {

        /** se remueve el cero de la lista (no sirve en este caso el 'ninguno') */
        for(let i = 0; i < vMemberType.length; i++){
            if(vMemberType[i].Id == 0){
                vMemberType.splice(i, 1);
                break;
            }
        }

        /** se arma el componente datatable */
        $('#page-length-option').DataTable({
            data: vMemberType,
            searching: false,
            scrollY: "200px",
            scrollCollapse: true,
            paging: false,
            columnDefs: [
                { width: '20%', targets: 1 },
                { width: '80%', targets: 2},
                { visible: false, targets: [0]}
            ],
            columns: [
                { 
                    data: "Id", 
                    title: "Id"                    
                },
                {  
                   title: "Sel", 
                    /** se inserta un check con nombre dinámico para poder reconocerlo luego */
                   render: function(data, type, row, meta) { 
                       return `<label>
                                <input type="checkbox" value="` + row.Id + `" id="sel_` + row.Id + `" />
                                <span></span>
                                </label>`;   
                    }              
                },
                { 
                    data: "name", 
                    title: "Ministerio"                    
                }
            ]
        });

    }, 2000);
});

/* 
Descripción:    Obtiene los tipos de miembro/ministerio escogidos en la lista
Autor:          J. Prasca
Fecha:          2020-03-16
*/
const GetSelectedMemberType = () => {

    //si no tiene ninguno acaba en cero
    let sList = "0|";

    /** recorre todo el array de tipos y compara con lo que hay en la tabla esgido (a través de los id creados de los checks) */
    for(let i = 0; i < vMemberType.length; i++){   
        
        /** si esta escogido va para la cadena que se guardará en bd */
        if($("#sel_" + vMemberType[i].Id).prop("checked")){    
            
            /** si es cero y hay escogidos, entonces se reinicia la cadena para empezar a llenar */
            if(sList.includes("0")){
                sList = "";
            }
            sList += (vMemberType[i].Id) + "|";
        }
    }
    console.log(sList);
}





      


