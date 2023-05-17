// button click hide something
$(document).ready(function () {
    $("#btnFacturacion").click(function () {
        $("#frmApuntar").hide();
        $("#btnFacturacionManual").show();
        $("#frmP").show();
        $("#btnFacturacion").hide();

    });
    $("#btnFacturacionManual").click(function () {
        $("#frmApuntar").show();
        $("#btnFacturacionManual").hide();
        $("#frmP").hide();
        $("#btnFacturacion").show();

    });
   
});



