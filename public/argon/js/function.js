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
        beforeSend: function () {
            $("#tablejug tbody").html("");
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
            var table = $("#tablejug tbody");
            var cont = 0;
            response.forEach((item) => {
                cont++;
                let row = document.createElement("tr");

                let data0 = document.createElement("td");
                data0.innerHTML = cont;
                let data1 = document.createElement("td");
                data1.innerHTML = item.cedula;
                let data2 = document.createElement("td");
                data2.innerHTML = item.nombres;
                let data3 = document.createElement("td");
                data3.innerHTML = item.celular;
                let data4 = document.createElement("td");
                data4.innerHTML = item.municipio;
                let data5 = document.createElement("td");
                data5.innerHTML = item.depvot;
                let data6 = document.createElement("td");
                data6.innerHTML = item.munvot;
                let data7 = document.createElement("td");
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

function infojugador(e) {
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
                "barrio2",
                "cedula",
                "celular",
                "comuna2",
                "depvot",
                "direccion",
                "email",
                "fecnac",
                "genero",
                "lugvot",
                "mesvot",
                "munvot",
                "nombres",
                "profesion",
                "empleado",
                "cargo",
                "zona",
                "whatsapp",
                "postgrado",
                "liderotro",
            ];

            let campos2 = [
                "poblacion",
                "ocupacion",
                "vivienda",
                "tipdis",
                "nivedu",
                "etnia",
                "profesion",
                "municipio",
                "comuna",
                "barrio",
                "lider",
                "nohijos",
            ];

            campos.forEach((element) => {
                if (element == "municipio") {
                    if ((value = response[0][element] == "81001")) {
                        $("#domcomuna").show(200);
                        $("#domcomuna2").hide(200);
                        $("#comuna").attr("required", "");
                        $("#comuna2").removeAttr("required");
                    } else {
                        $("#domcomuna2").show(200);
                        $("#domcomuna").hide(200);
                        $("#comuna2").attr("required", "");
                        $("#comuna").removeAttr("required");
                    }
                }
                if(element == "empleado" && (response[0][element] == "F" || response[0][element] == "I")){
                    $("#divcargo").show(200);
                    $("#cargo").attr("required", "");
                }
                if ((element != "" || element != null) && response[0][element] != undefined ) {
                    document.getElementById(element).value =
                        response[0][element];
                }
            });

            campos2.forEach((element) => {
                if (element != "" || element != null) {
                    $("#" + element).val([response[0][element]]);
                    $("#" + element).trigger("change");
                }
                if (element == "barrio") {
                    console.log(response[0][element]);
                    setTimeout(function () {
                        $("#" + element).val([response[0][element]]);
                        $("#" + element).trigger("change");
                    }, 500);
                }
                if(element == "lider" && response[0][element] == "6"){
                    $("#divcargo").show(200);
                    $("#cargo").attr("required", "");
                }
            });

            let infohijos = JSON.parse(response[0].infohijos??"{}");

            Object.keys(infohijos).forEach(function(key) {
                setTimeout(function () {
                    $("#" + key).val([infohijos[key]]);
                    $("#" + key).trigger("change");
                }, 500);
            })
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

function fempleado(e) {
    if (e.target.value == "F" || e.target.value == "I") {
        $("#divcargo").show(200);
        $("#cargo").attr("required", "");
    } else {
        $("#divcargo").hide(200);
        $("#cargo").removeAttr("required");
        $("#cargo").val("");
    }
}

function fpostgrado(e) {
    let profesiones = [5, 6, 7];

    if (profesiones.find((i) => i == e.target.value)) {
        $("#divpostgrado").show();
        $("#postgrado").attr("required", "");
    } else {
        $("#divpostgrado").hide();
        $("#postgrado").removeAttr("required");
        $("#postgrado").val("");
    }
}

function flider(e) {

    if (e.target.value == '6') {
        $("#divlider").show();
        $("#lider").attr("required", "");
    } else {
        $("#divlider").hide();
        $("#lider").removeAttr("required");
        $("#lider").val("");
    }
}

function fmunicipio(e) {
    if (e.target.value == "81001") {
        $("#domcomuna").show(200);
        $("#domcomuna2").hide(200);
        $("#comuna").attr("required", "");
        $("#comuna2").removeAttr("required");
        $("#dombarrio").show(200);
        $("#dombarrio2").hide(200);
        $("#barrio").attr("required", "");
        $("#barrio2").removeAttr("required");
    } else {
        $("#domcomuna2").show(200);
        $("#domcomuna").hide(200);
        $("#comuna2").attr("required", "");
        $("#comuna").removeAttr("required");
        $("#dombarrio2").show(200);
        $("#dombarrio").hide(200);
        $("#barrio2").attr("required", "");
        $("#barrio").removeAttr("required");
    }
}

function fcomuna(e) {
    console.log(e.target.value);
    let id = e.target.value;

    if (id == ''){
        return;
    }

    $.ajax({
        method: "GET",
        url: "/searchbarrio/" + id,
        success: function (response) {
            let select = document.getElementById("barrio");
            select.innerHTML =
                '<option value="" selected disabled>Seleccione...</option>';
            console.log(response);
            response.forEach((element) => {
                const option = document.createElement("option");
                option.value = element.id;
                option.text = element.detalle;
                select.appendChild(option);
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

function createInputSons(e){
    let nohijos = e.target.value;
    const estructura_id = {
        'div': 'div-son',
        'select': 'ranghijo'
    }

    if(nohijos < 0){
        e.target.value = 0;
        nohijos = e.target.value;
    }else if(nohijos > 100){
        e.target.value = 100;
        nohijos = e.target.value;
    }


    const hijos = document.getElementsByName("son");
    let noinputs = hijos.length;
    if(nohijos < noinputs){
        for(var i = noinputs; i > nohijos; i--){
            if(i == 1){
                $(`#${estructura_id.div}${i}`).hide(200)
                $(`#${estructura_id.select}${i}`).removeAttr("required");
            }else{
                $(`#${estructura_id.div}${i}`).remove();
            }
        }
    }else{
        const divInputs = $("#input_sons");
        if(nohijos >= 1){
            $(`#${estructura_id.div}1`).show(200)
            $(`#${estructura_id.select}1`).attr("required", true);
        }
        let options = '';

        $("#ranghijo1 option").each(function(){
            const value = $(this).attr('value');
            const text = $(this).text();
            options += `<option ${!value ? 'disabled selected':''} value="${value}"> ${text} </option>`
         });

        for(var i = noinputs + 1 ; i <= nohijos; i++ ){
            if(i > 1){
                divInputs.append(
                    $('<div>',{
                        'class':'col-md-3',
                        'name': 'son',
                        'id':`${estructura_id.div}${i}`,
                    }).append(
                        $('<div>',{
                            'class':"form-group",
                            'html' :
                                `<label for="ranghijo1">Rango Edad Hijo ${i}</label>
                                <select class="form-control js-example-basic-single" name="ranghijo${i}" id="ranghijo${i}"required>
                                ${options}
                                </select>`
                        })
                    )
                );
                $(`#ranghijo${i}`).select2();
            }
        }
    }

}
