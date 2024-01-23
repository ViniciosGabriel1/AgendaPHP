statusDrop = "oculto";
function dropdownMenu(){
    var dropdownMenu = document.getElementById('dropdown')

    if(statusDrop == "oculto"){
        dropdownMenu.style.display="flex";
        statusDrop = "aberto";
    }else{
        dropdownMenu.style.display="none";
        statusDrop = "oculto";
    }


}