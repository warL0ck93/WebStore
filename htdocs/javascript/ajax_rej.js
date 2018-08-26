function checkInDatabase(value)
{

    try
    {
                if(value!='')
                {

                    if (window.XMLHttpRequest)
                    {   
                        document.getElementById("error2").innerHTML="Wybrany login jest dostępny";
                        xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function()
                        {
                            if (this.readyState == 4 && this.status == 200)
                            {
                                if(xmlhttp.responseText.indexOf("true")!=-1)
                                    ;
                                else
                                {

                                    if(xmlhttp.responseText.indexOf("false")!=-1)
                                        document.getElementById("error2").innerHTML="Login nie jest unikalny";
                                    else
                                        throw new XMLHttpRequestException("Nieprawidłowa odpowiedź na zapytanie!");
                                }
                            }
                        };

                        xmlhttp.open("POST","ajax_reg.php",true);
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xmlhttp.send("login="+value);

                    }
                    else
                        throw new XMLHttpRequestException("Przeglądarka nie obsługuje AJAXa!");
                }
    }
    catch(e) 
    {
         document.getElementById("errorA").innerHTML="Błąd ajax"+e.message;
    }
}