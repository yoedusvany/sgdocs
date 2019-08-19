$(document).ready(function(){

    $(document).on('switchChange.bootstrapSwitch', function(e, s) {
        //capturo el id numerico del SwitchInput que se dio clic
        var id = e.target.id.substring(2);

        if (s === true){
            var temp = getOrden(id);
            $('#tspin'+id).prop( "disabled", false );
            $('#hidden'+id).prop( "disabled", false );
            $('#tspin'+id).val(temp);
        }else{
            $('#tspin'+id).prop( "disabled", true);
            $('#hidden'+id).prop( "disabled", true);
        }
    });

    function getOrden(id) {
        var totalElementos = $( "input[name='cantidadCampos']").val();
        var usados = [];

        for (i = 1; i <= totalElementos; i++){
            if ($('#tspin'+i).attr('disabled') !== "disabled"){
                if (!usados.includes($('#tspin'+i).val())){
                    usados.push($('#tspin'+i).val());
                }
            }
        }

        if (usados.length > 0){
            for (i = 1; i <= totalElementos; i++){
                if (usados.includes(i.toString()) !== true ){
                    return i;
                }
            }
        }else{
            return 1;
        }
    }




});