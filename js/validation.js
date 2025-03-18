const validation =new justvalidate ("#signup");

validation 
      .addField("#name",[

      {
        rule :"required"
      }

    ])

    .addField("#email", [
        {
            rule:"required"
        },
        {
            rule: "email"
        },
        {
            validator: (value) => () =>{
                return fetch("validate-email.php?email" + encodeURIcomponent(value))
                .then(function(response) {
                    return response.json();
                })
                .then(function(json){
                    return json.available;

                })
            },
            errorMassage : "email already taken"
        }
    ])
    .addField("#password" , [
        {
            rule:"required"
        },
        {
            rule:"password"
        }
    ])
    .addfield("#password_confirmation" ,[
        {
            validator:(value, fields) => {
                return value === fields["#password"].elem.value;
            },
            errorMassage: "password should match"
        }

    ])

    .onsuccess((event)=>{
        document.getElementById("signup") .submit()
    });