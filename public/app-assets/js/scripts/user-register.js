/** 
 * Autor:           Jesús Prasca
 * Fecha:           2020-06-20
 * Descripción:     Método guardar los datos de un usuario nuevo en base de datos
 * Modificación:      
 * */
function SignIn(){

    let jsonUser = {
        userName : document.querySelector("#username").value,
        email: document.querySelector("#email").value,
        password: document.querySelector("#password").value,
        password2: document.querySelector("#password-again").value
    };

    fetch(apiUrlBase + "userapp/insertUser?json=" + JSON.stringify(jsonUser), {
        method: 'POST',
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
            M.toast({html: "Guardado exitoso!...\n" + myJson.message });
            setTimeout(()=>{
                location.href = urlBase + 'login/' + myJson.token;
            }, 1000);
        }else{
            M.toast({html: "Algo ha ocurrido...\n" + myJson.message });
        }
    })
    .catch((error) => {
        M.toast({html: "Tenemos problemas para registrar los datos: \n"}); 
    });  
}



