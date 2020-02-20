

//////////////////////////////////////////////
// AJAX FUNCTION TO LOAD ALL THE FREE RACKS //
//////////////////////////////////////////////
function loadRacks(base, shelveId, remove = true){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {

        if(this.readyState == 4 && this.status == 200){
            
            data = JSON.parse(this.responseText);
            var rack = document.getElementById("rack");
            if(remove){
                rack.innerHTML = "";
            }
            for (i in data) {
                var option = document.createElement("option");
                option.text = data[i];
                option.value = data[i];
                rack.add(option);
            }
            
        }

    };

    xhttp.open("GET", base + "/dashboard/ajax/rack/" + shelveId, true);
    xhttp.send();

}


////////////////////////////////////////////////////////////
// AJAX FUNCTION TO LOAD ALL THE CORRIDORS FREE POSITIONS //
////////////////////////////////////////////////////////////
function loadCorridor(base, corridorId, remove = true){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {

        if(this.readyState == 4 && this.status == 200){
            
            data = JSON.parse(this.responseText);
            var position = document.getElementById("position");
            if(remove){
                position.innerHTML = "";
            }
            for (i in data) {
                var option = document.createElement("option");
                option.text = data[i];
                option.value = data[i];
                position.add(option);
            }
            
        }

    };

    xhttp.open("GET", base + "/dashboard/ajax/corridor/" + corridorId, true);
    xhttp.send();

}

//////////////////////////////////////////////
// AJAX FUNCTION TO LOAD ALL THE FREE RACKS //
//////////////////////////////////////////////
function loadCorridorLetter(base, shelfId){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {

        if(this.readyState == 4 && this.status == 200){
            
            document.getElementById("corridor_letter").innerHTML = this.responseText;
            
        }

    };

    xhttp.open("GET", base + "/dashboard/ajax/cletter/" + shelfId, true);
    xhttp.send();

}


/////////////////////////////
// SHOW THE SHELVE CONTENT //
/////////////////////////////
function showShelve(code){

    var element = document.getElementById(code);
    var result = document.getElementById('shelve-result');
    var codeS = document.getElementById('shelve-code');
    codeS.innerHTML = code;
    if(element){
        var content = element.innerHTML;
        result.innerHTML = ''
        + '<div class="p-2 w-100">'
        + content
        + '<div>';
    
        result.classList.remove('d-none');
        result.classList.add('d-flex');
        result.classList.add('justify-content-between');
    }else{
        result.innerHTML = '<p>NO HAY NINGUNA ESTANTERÍA DEFINIDA EN ESTA POSICIÓN</p>';
    }

}


//////////////////////
// ASIDE RESPONSIVE //
//////////////////////
var btnNavBar = document.getElementById('navbar');
btnNavBar.addEventListener('click', function(){
    var aside = document.getElementById('aside');
    if(aside.classList.contains('show-left')){
        aside.classList.remove('show-left');
        btnNavBar.style.position = 'inherit';
        btnNavBar.style.zIndex = '0';
        btnNavBar.innerHTML = '<i class="fas fa-bars"></i>';
    }else{
        aside.classList.add('show-left');
        btnNavBar.style.position = 'fixed';
        btnNavBar.style.zIndex = '2';
        btnNavBar.innerHTML = '<i class="fas fa-times"></i>';
    }
});
