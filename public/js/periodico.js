// button click hide something
$(document).ready(function () {
    $("#btnFacturacion").click(function () {
        $("#frmApuntar").hide();
        $("#btnFacturacionManual").show();

    });
    $("#btnFacturacionManual").click(function () {
        $("#frmApuntar").show();
        $("#btnFacturacionManual").hide();
    });
   
});



