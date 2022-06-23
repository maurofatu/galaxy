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
                if (element != "" || element != null) {
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
                    setTimeout(function () {
                        $("#" + element).val([response[0][element]]);
                        $("#" + element).trigger("change");
                    }, 500);
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
