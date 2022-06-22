function buscarcapitan(e) {
    var cedula = e.target.value;
    if (cedula == "") {
        $("#nombrelider").val("");
        return false;
    }
    $.ajax({
        method: "GET",
        url: "/searchcapitan/" + cedula,
        success: function (response) {
            $("#nombrelider").val(response.nombres);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            $("#cedulalider").val("");
            $("#nombrelider").val("");
            swal({
                title: XMLHttpRequest.statusText,
                text: XMLHttpRequest.responseJSON.message,
                icon: "error",
            });
        },
    });
}

function buscarjugadores(e) {
    var cedula = e.target.value;
    if (cedula == "") {
        $("#capitan").val("");
        return false;
    }
    $.ajax({
        method: "GET",
        url: "/searchjugadores/" + cedula,
        beforeSend: function (){
            $('#tablejug tbody').html('');
        },
        success: function (response) {
            if (response == "") {
                swal({
                    title: "Error",
                    text: "No se encontró jugadores",
                    icon: "error",
                });
                return;
            }
            var table = $('#tablejug tbody');
            var cont = 0;
            response.forEach((item) => {
                cont++;
                let row = document.createElement('tr');

                let data0 = document.createElement('td');
                data0.innerHTML = cont;
                let data1 = document.createElement('td');
                data1.innerHTML = item.cedula;
                let data2 = document.createElement('td');
                data2.innerHTML = item.nombres;
                let data3 = document.createElement('td');
                data3.innerHTML = item.celular;
                let data4 = document.createElement('td');
                data4.innerHTML = item.municipio;
                let data5 = document.createElement('td');
                data5.innerHTML = item.depvot;
                let data6 = document.createElement('td');
                data6.innerHTML = item.munvot;
                let data7 = document.createElement('td');
                data7.innerHTML = item.lugvot;

                row.appendChild(data0);
                row.appendChild(data1);
                row.appendChild(data2);
                row.appendChild(data3);
                row.appendChild(data4);
                row.appendChild(data5);
                row.appendChild(data6);
                row.appendChild(data7);

                table.append(row);

            });

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            swal({
                title: XMLHttpRequest.statusText,
                text: XMLHttpRequest.responseJSON.message,
                icon: "error",
            });
        },
    });
}

function infojugador(e){
    let cedula = e.target.value;
    $.ajax({
        method: "GET",
        url: "/infojugador/" + cedula,
        success: function (response) {
            if (response == "") {
                swal({
                    title: "Error",
                    text: "No se encontró información",
                    icon: "error",
                });
                return;
            }
            let campos = [
                "aporte",
                "barrio",
                "cedula",
                "celular",
                "comuna",
                "depvot",
                "direccion",
                "email",
                "fecnac",
                "genero",
                "lugvot",
                "mesvot",
                "municipio",
                "munvot",
                "nombres",
                "profesion",
                "empleado",
                "cargo",
                "zona",
                "whatsapp",
            ];

            let campos2 = [
                "poblacion",
                "ocupacion",
                "vivienda",
                "tipdis",
                "nivedu",
            ];

            campos.forEach(element => {
                if(element != "" || element != null){
                    document.getElementById(element).value=response[0][element];
                }
                if(element == 'empleado' &&  response[0][element] == 'S'){
                    $("#divcargo").show();
                }
            });

            campos2.forEach(element => {
                if(element != "" || element != null){
                        $('#'+element).val([response[0][element]]);
                        $('#'+element).trigger('change');
                }
            });


        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            swal({
                title: XMLHttpRequest.statusText,
                text: XMLHttpRequest.responseJSON.message,
                icon: "error",
            });
        },
    });
}

function fempleado(e){
    console.log(e.target.value);
    if(e.target.value == 'S'){
        $("#divcargo").show();
    }else{
        $("#divcargo").hide();
    }
}
