/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function validate ()
         {
            console.log("We are validating");
            console.log(document.myForm.Name.value);
            var errorArray = new Array();
            if( document.myForm.Name.value == "" )
            {
                document.myForm.Name.focus() ;
                
                errorArray.push("You need a name");
            }
         
            if( document.myForm.EMail.value == "" )
            {
               document.myForm.EMail.focus() ;
               
               errorArray.push("You need a Email");
            }

            if( document.myForm.Zip.value == "" ||
                isNaN( document.myForm.Zip.value ) ||
                document.myForm.Zip.value.length != 5 )
            {
               document.myForm.Zip.focus() ;
               
               errorArray.push("You need a ZIP");
            }

            if( document.myForm.Country.value == "-1" )
            {
               errorArray.push("You need a Country");
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