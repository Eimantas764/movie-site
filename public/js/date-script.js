let currentDate = new Date();
let body = document.querySelector('body');
let ConvertedHour =  currentDate.getHours();
if(ConvertedHour > 12)
{
    ConvertedHour = ConvertedHour - 12;
}
if(ConvertedHour == 0)
{
    ConvertedHour = 12;
}

body.style.background = 'url("/php-darbai/filmuSvetaine/public/images/background' + ConvertedHour + '.jpg")';