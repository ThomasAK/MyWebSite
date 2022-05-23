function validateMain()
{
        console.log("We are validating");
        console.log(document.myForm.fname.value);
        var errorArray = new Array();
        var namesSet = false;
        var phoneSet = false;
        
        if(!document.myForm.fname.value == ""){
            if(!/^[a-zA-Z]+$/.test(document.myForm.fname.value)){
                document.myForm.fname.focus();
                errorArray.push("Numbers in first name");
            }
            namesSet = true;
        }
        if(!document.myForm.lname.value == ""){
            if(!/^[a-zA-Z]+$/.test(document.myForm.lname.value)){
                document.myForm.lname.focus();
                errorArray.push("Numbers in last name");
            }
            namesSet = true;
        }
        
        if(!document.myForm.phone.value == ""){
            if(!/^[0-9]+$/.test(document.myForm.phone.value)){
                document.myForm.phone.focus();
                errorArray.push("Phone number must be all numbers");
            }
            phoneSet = true;
        }
        if(!phoneSet && !namesSet){
            errorArray.push("Enter First or Last name or phone number to search");
        }
       
        
        
        if(errorArray.length > 0) {
                var errorReport = document.getElementById("errorlog");
                errorString = "<ul>";
                for(i = 0; i<errorArray.length; i++){
                    errorString = errorString + "<li>" + errorArray[i] + "</li>";
                }
                errorString = errorString + "</ul>";
                errorReport.innerHTML =errorString;
                return false;
            }
            return true;
}   

function validate ()
         {
            console.log("We are validating");
            console.log(document.myForm.fname.value);
            var errorArray = new Array();
            
            if(!/^[a-zA-Z]+$/.test(document.myForm.fname.value) || document.myForm.fname.value == ""){
                document.myForm.fname.focus();
                errorArray.push("No first name or numbers in name");
            }
            
            if(!/^[a-zA-Z]+$/.test(document.myForm.lname.value) || document.myForm.lname.value == ""){
                document.myForm.lname.focus();
                errorArray.push("No last name or numbers in name");
            }
            
            if(!/^[0-9]+$/.test(document.myForm.phone.value) || document.myForm.phone.value == ""){
            document.myForm.phone.focus();
            errorArray.push("Phone blank or contains letters");
        }
            
            if(document.myForm.address.value == ""){
                document.myForm.address.focus();
                errorArray.push("No address");
            }

            if( document.myForm.zip.value == "" ||
                isNaN( document.myForm.zip.value ) ||
                document.myForm.zip.value.length != 5 )
            {
               document.myForm.zip.focus() ;
               
               errorArray.push("zip blank or not atleast 5 digits");
            }
            
            if(document.myForm.city.value == ""){
                document.myForm.city.focus();
                errorArray.push("No city");
            }
            
            if(document.myForm.state.value == ""){
                document.myForm.state.focus();
                errorArray.push("No state");
            }
            
            if(document.myForm.month.value == ""){
                document.myForm.month.focus();
                errorArray.push("No month");
            }
            
            if(document.myForm.day.value == ""){
                document.myForm.day.focus();
                errorArray.push("No day");
            }
            
            if(document.myForm.year.value == ""){
                document.myForm.year.focus();
                errorArray.push("No year");
            }
            
            if(document.myForm.username.value == ""){
                document.myForm.username.focus();
                errorArray.push("No username");
            }
            
            if(document.myForm.password.value == ""){
                document.myForm.password.focus();
                errorArray.push("No password");
            }
            
            if(document.myForm.sex.value == ""){
                document.myForm.sex.focus();
                errorArray.push("No sex");
            }
            
            if(document.myForm.relation.value == ""){
                document.myForm.relation.focus();
                errorArray.push("No relation");
            }

            
            if(errorArray.length > 0) {
                var errorReport = document.getElementById("errorlog");
                errorString = "<ul>";
                for(i = 0; i<errorArray.length; i++){
                    errorString = errorString + "<li>" + errorArray[i] + "</li>";
                }
                errorString = errorString + "</ul>";
                errorReport.innerHTML =errorString;
                return false;
            }
            return true;
         }
         
          