document.addEventListener("DOMContentLoaded", function(ev){ 
    document.querySelector("form").addEventListener("submit", function(ev){ 
      if (!userValide || !firstNameValide || !lastNameValide || !passwordValide)
        ev.preventDefault();
    }); 
  
      const userName = document.getElementsByName("username")[0]; 
      let userValide = false;
      let firstNameValide = false;
      let lastNameValide = false;
      let passwordValide = false;
      userName.addEventListener("blur", (e) => {
        if (userName.value.length >= 5 && userName.value.length <= 20)
          userValide = true; 
        else  
          userValide = false;
      }); 
      //ajouter validation pour username
      const email = document.getElementsByName("email")[0];
      const firstName = document.getElementsByName("firstName")[0];
      const lastName = document.getElementsByName("lastName")[0];
      const password = document.getElementsByName("password")[0];
      let deniedRegex =  /([^a-zA-Z])/i;
      let emailRegex = /[a-zA-Z0-9]+@[a-zA-Z0-9.-]+\.[a-z]{2,4}/g;
      
      [firstName, lastName].forEach(function(champ){
        champ.addEventListener("blur", (e) => {
          if (!champ.value.match(deniedRegex && (champ.value.length >= 2 && champ.value.length <= 30))){
            if (champ.name === "firstName")
              firstNameValide = true;
            if (champ.name === "lastName")
              lastNameValide = true;           
          }
          else{
            if (champ.name === "firstName")
              firstNameValide = false;
            if (champ.name === "lastName")
              lastNameValide = false;   
          }
        });
      });
      password.addEventListener("blur", (e) => {
        if (password.value.length >= 6 && password.value.length <= 50){
          passwordValide = true;
          console.log(passwordValide);
        }
      });
      email.addEventListener("blur", (e) => {
        
      });
  });
