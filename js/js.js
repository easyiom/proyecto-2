function showPass() {
    var x = document.getElementById("login_password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function valids(event) {

    let email = document.getElementById("login_username").value,
        password = document.getElementById("login_password").value,
        Msg = document.getElementById("mensaje"),
        MsgP = document.getElementById("mensajeP"),
        inputM = document.getElementById("login_username"),
        inputP = document.getElementById("login_password");

    notNullEmail(event, email, Msg, inputM);
    notNullPass(event, password, MsgP, inputP);
}

function notNullEmail(event, email, Msg, inputM) {

    if (email == "") {
        event.preventDefault();
        Msg.innerHTML = 'El correo no puede estar vacío.'
        Msg.style.color = 'red';
        inputM.style.border = '1px solid  red';
        inputM.classList.add("red");
        return false;
    } else {
        if (preventSqlinjectionEmail(event, email, Msg, inputM)) {
            return true;
        } else {
            return false;
        }
        // mailRegEx(event, email, Msg);
    }
}

function preventSqlinjectionEmail(event, email, Msg, inputM) {
    if (email.includes(" ") || email.includes("'") || email.includes('"') || email.includes("`") || email.includes("´")) {
        event.preventDefault();
        Msg.innerHTML = 'El correo contiene carácteres no válidos.';
        inputM.style.border = '1px solid  red';
        Msg.style.color = 'red';
        return false;
    } else {
        if (mailRegEx(event, email, Msg, inputM)) {
            return false;
        } else {
            return false;
        }
    }
}

function mailRegEx(event, email, Msg, inputM) {
    if (!(/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(email).toLowerCase())) {
        event.preventDefault();
        Msg.innerHTML = 'Introduce una dirección de correo válida.'
        Msg.style.color = 'red';
        inputM.style.border = '1px solid  red';
        return false;
    } else {
        return true;
    }
}

function notNullPass(event, password, MsgP, inputP) {
    if (password == "") {
        event.preventDefault();
        MsgP.innerHTML = 'La contraseña no puede estar vacía.'
        MsgP.style.color = 'red';
        inputP.style.border = '1px solid  red';
        return false;
    } else {
        preventSqlinjectionPass(event, password, MsgP, inputP);
    }
}

function preventSqlinjectionPass(event, password, MsgP, inputP) {
    if (password.includes("'") || password.includes('"') || password.includes(" ") || password.includes("`") || password.includes("´")) {
        event.preventDefault();
        MsgP.innerHTML = 'La contraseña contiene carácteres no válidos.'
        MsgP.style.color = 'red';
        inputP.style.border = '1px solid  red';
        return false;
    } else {
        return true;
    }
}
///////////////
//settear cookie en el menu para la selección de salas
//////////////
$(document).ready(function() {
    $(".sala").each(function(index) {
        console.log(index + 1);
        $(this).click(function() {
            Cookies.set('sala', 'sala' + (index + 1))
            $('.sala form').submit();
        });


    })


});

//////////////
//Cargar sala cookie
//////////////
$(document).ready(function() {
    if (Cookies.get('sala') != 'nada') {
        console.log(Cookies.get('sala'));
        $("body .region-mesas").addClass(Cookies.get('sala'));
    }
});

//////////////
//Poner si la mesa esta ocupadada
//////////////
$(document).ready(function() {
    $(".mesa img").each(function(index) {
        if ($(this).attr("data-status") != "Libre") {
            $(this).addClass('ocupada');
        }

    })
    $(".mesa").each(function(index) {
        if ($(this).attr("data-status") == "Ocupado/Reservado") {
            $(this).removeClass('btn-abrirPop');
            $(this).addClass('btn-abrirPop2');
        } else if ($(this).attr("data-status") == "Mantenimiento") {
            $(this).removeClass('btn-abrirPop');
            $(this).removeClass('btn-abrirPop2');
        }
    })

});
//////////////
//POPUP
//////////////




$(document).ready(function() {
    $(".btn-abrirPop").each(function(index) {
        $(this).click(function() {
            $(".crearReserva .idMesa").val($(this).attr('data-id'))
            console.log($(this).attr('data-id'))
        });
    })
    $(".btn-abrirPop2").each(function(index) {
        $(this).click(function() {
            $(".editarReserva .idMesa").val($(this).attr('data-id'))
            $(".editarReserva .nombreRes").html($(this).attr('data-nombrereser'))
            $(".editarReserva .fechaini").html($(this).attr('data-inires'))
            console.log($(this).attr('data-id'))
            console.log($(this).attr('data-nombrereser'))
        });
    })
    $(".btn-abrirPop4").each(function(index) {
        $(this).click(function() {
            $(".cerrarInci .data-id-inci").val($(this).attr('data-id-inci'))
            $(".cerrarInci .data-mes").val($(this).attr('data-mes'))


        });
    })
    $(".btn-abrirPop6").each(function(index) {
        $(this).click(function() {
            $(".hreserva .hiddensala").val($(this).attr('data-id'))


        });
    })

    $(".btn-abrirPop8").each(function(index) {
        $(this).click(function() {
            $(".modUser .hiddenuser").val($(this).attr('data-id'))


        });
    })



});

$(document).ready(function() {
    $(".btn-cerrarPop").click(function() {
        $("#overlay").removeClass('active');
        $(".popup").removeClass('active');
        $(".popup").addClass('hide')
    });
    $(".btn-abrirPop").click(function() {
        $("#popup").removeClass('hide');
        $("#overlay").addClass('active');
        $("#popup").addClass('active');
        $("#popup2").addClass('hide');
    });


    $(".btn-abrirPop2").click(function() {
        $("#popup2").removeClass('hide');
        $("#overlay").addClass('active');
        $("#popup2").addClass('active');
        $("#popup").addClass('hide');
    });

    $(".btn-abrirPop3").click(function() {
        $("#popup3").removeClass('hide');
        $("#overlay").addClass('active');
        $("#popup3").addClass('active');
        $("#popup").addClass('hide');
    });

    $(".btn-abrirPop4").click(function() {
        $("#popup4").removeClass('hide');
        $("#overlay").addClass('active');
        $("#popup4").addClass('active');
        $("#popup").addClass('hide');
    });
    $(".btn-abrirPop6").click(function() {
        $("#popup6").removeClass('hide');
        $("#overlay").addClass('active');
        $("#popup6").addClass('active');
        $("#popup").addClass('hide');
    });
    $(".btn-abrirPop7").click(function() {
        $("#popup7").removeClass('hide');
        $("#overlay").addClass('active');
        $("#popup7").addClass('active');
        $("#popup").addClass('hide');
    });
    $(".btn-abrirPop8").click(function() {
        $("#popup8").removeClass('hide');
        $("#overlay").addClass('active');
        $("#popup8").addClass('active');
        $("#popup").addClass('hide');
    });
    $(".btn-abrirPop10").click(function() {
        $("#popup10").removeClass('hide');
        $("#overlay").addClass('active');
        $("#popup10").addClass('active');
        $("#popup").addClass('hide');
    });
    $(".btn-abrirPop11").click(function() {
        $("#popup11").removeClass('hide');
        $("#overlay").addClass('active');
        $("#popup11").addClass('active');
        $("#popup").addClass('hide');
    });
});


////////Obtener valores del id



// function getvalues(id) {
//     var name = $(`.nombre[data*='${id}` + "||'").attr('data-name');
//     var surname = $(`.apellido[data*='${id}` + "||'").attr('data-sur');
//     var email = $(`.email[data*='${id}` + "||'").attr('data-mail');
//     var age = $(`.edad[data*='${id}` + "||'").attr('data-age');

//     console.log(name + "  " + age + "  " + id);
//     $("#popup2 #nombre").val(name);
//     $("#popup2 #apellido").val(surname);
//     $("#popup2 #edad").val(age);
//     $("#popup2 #id").val(id);
// }