function AcceptCookies(saveCookies)
{
    if(saveCookies == 1)
    {
        var now = new Date();
        var time = now.getTime();
        time += 365 * 24 * 3600 * 1000;
        now.setTime(time);
        document.cookie = 'cookiesAccepted=' + 'yes' + '; expires=' + now.toUTCString() + '; path=/';
    }

    if(getCookie("cookiesAccepted") == 'yes')
    {
        document.getElementById('cookies').style.visibility='hidden';
        document.getElementById('cookie-accept').style.visibility='hidden';
    }
    else
    {
        document.getElementById('cookies').style.visibility='visible';
        document.getElementById('cookie-accept').style.visibility='visible';
    }
}


function getCookie(name)
{
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}