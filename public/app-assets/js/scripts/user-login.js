/** 
 * Autor:           Jesús Prasca
 * Fecha:           2020-06-29
 * Descripción:     Método para enviar los datos de formulario de inicio de sesión
 * Modificación:      
 * */
const LogIn = () => {

    let jsonUser = {
        userName : document.querySelector("#username").value,
        //email: document.querySelector("#email").value,
        password: document.querySelector("#password").value
    };

    fetch(apiUrlBase + "userapp/logIn?json=" + JSON.stringify(jsonUser), {
        method: 'GET',
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
            M.toast({html: myJson.message }); 
            setTimeout(()=>{
                location.href = urlBase + 'login/' + myJson.token;
            }, 1000);
            console.log(myJson.data);
        }else{
            M.toast({html: myJson.message });
        }
    })
    .catch((error) => {
        M.toast({html: "Tenemos problemas para procesar los datos: \n"}); 
    });  
}

document.querySelector("#a-login").addEventListener("click", LogIn);