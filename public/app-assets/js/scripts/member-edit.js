/* 
Descripción:    Carga de los elementos restantes de la vista para registro de nuevos miembros
Autor:          J. Prasca
Fecha:          2020-03-16
*/
$(document).ready(function(){

    try{
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
                        let bIsChecked = false;
                        for(let i= 0; i < vMemberTypeSelectList.length; i++ ){
                            if(row.Id == vMemberTypeSelectList[i]){
                                bIsChecked = true;
                                break;
                            }
                        }


                        return `<label>
                                    <input type="checkbox" name="selectType" value="` + row.Id + `" id="sel_` + row.Id + `" ` + ((bIsChecked)? `checked="checked"` :``) + `/>
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
    }catch(e){
        M.toast({html: "Ha ocurrido un error al iniciar" + e.message });
    }
});

/* 
Descripción:    Obtiene los tipos de miembro/ministerio escogidos en la lista
Autor:          J. Prasca
Fecha:          2020-03-16
*/
const GetSelectedMemberType = () => {

    try{
        //si no tiene ninguno acaba en cero
        let sList = "0|";

        /** se toman todos los checkbox seleccionados */
        let vSelection = document.querySelectorAll("input[name='selectType']:checked");

        /** recorre todo el array de tipos y compara con lo que hay en la tabla esgido (a través de los id creados de los checks) */
        for(let i = 0; i < vSelection.length; i++){          
                
                /** si es cero y hay escogidos, entonces se reinicia la cadena para empezar a llenar */
                if(sList.includes("0")){
                    sList = "";
                }
                sList += (vSelection[i].value) + "|";
        }
        return sList;
    }catch(e){
        M.toast({html: "Ha ocurrido un error en el método GetSelectedMemberType(): \n" + e.message});
    }
}

/** 
 * Autor:           Jesús Prasca
 * Fecha:           2020-03-16
 * Descripción:     Mensaje de confirmación de guardado
 * Modificación:      
 * */
const SaveMemberConfirm = () => {

    try{
        swal({
            title: "Seguro/a que deseas guardar esta info?",
            text: "Si no has olvidado nada, puedo almacenar todo esto",
            buttons: {
                OK: {
                    text: "Si, guardar",
                    value: "OK",
                },
                cancel: "No, cancela!"
            },
            icon: "warning"
          })
          .then((value) => {
            switch (value) {
            case "OK":
                SaveMemberComplete();
                break;           
            default:
                swal("De acuerdo, se cancela todo");
            }
          });
          
    }catch(e){
        M.toast({html: "Ha ocurrido un error en el método SaveMemberConfirm(): \n" + e.message});
    }
    let objMemberInfo = new Object();
    //objMemberInfo.Identification = document.querySelector("#idNumber").g
}


/** 
 * Autor:           Jesús Prasca
 * Fecha:           2020-03-21
 * Descripción:     Método guardar los datos de un miembro nuevo en base de datos
 * Modificación:      
 * */
const SaveMemberComplete = () => {

    let dtAuxDate = new Date();
    let nDay = dtAuxDate.getDate();
    let nMonth = dtAuxDate.getMonth() + 1;
    let nYear = dtAuxDate.getFullYear();

    let jsonMember = {
        Id: iMemberId,
        Identification: document.querySelector("#idNumber").value,
        firstName: document.querySelector("#firstName").value,
        lastName: document.querySelector("#lastName").value,
        genre: document.querySelector("#genre").value,
        birthDate: document.querySelector("#birthDate").value,
        adress: document.querySelector("#adress").value,
        email: document.querySelector("#email").value,
        phone: document.querySelector("#contactNum").value,
        occupation: document.querySelector("#occupation").value,
        memberType: GetSelectedMemberType(),
        registrationDate: nYear + "-" + nMonth + "-" + nDay
    };

    fetch(urlBase + "api/member/updateMember?json=" + JSON.stringify(jsonMember), {
        method: 'PUT',
        headers:{
            'Content-Type': 'application/json'
        }
    })
    .then((response) => {
          if(response.ok){              
              return response.json();              
          }
    })
    .then((myJson) => {
        if(myJson.status == "success"){
            $(".btn-reset").trigger("click");
            swal({
                title: "Guardado exitoso!",
                text: myJson.message, 
                icon: "success",
                buttons: {
                    stayHere: {
                        text: "Continuar aquí",
                        value: "stayHere"
                    },
                    goToList: { 
                        text: "Ver listado",
                        value: "goToList"
                    }
                }
            }).then((value) => {
                switch(value){
                    case "stayHere":
                        break;
                    case "goToList":
                        window.location.href = urlBase + "member/view";
                        break;
                }
            });
        }else{
            swal({
                title: "Algo ha ocurrido",
                text: myJson.message, 
                icon: "error",
                buttons: {
                    OK: "Aceptar"
                }                
            }); 
        }

    })
    .catch((error) => {
        swal({
            title: "Algo ha ocurrido",
            text: "Verifica que todo lo que seleccionaste sea correcto", 
            icon: "error",
            buttons: ["OK"]                
        }); 
    });
}

      


