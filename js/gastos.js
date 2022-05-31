alert("si esta");
//solicitamos a vue.js
var Gastos = new Vue({
    el: "#Gastos",
    data: {
        gasto:[],
        Fecha:"",
        Concepto:"",
        Valor:"",
        Proveedor:""
    },
    methods:{
        //botones registrar
        registrar: async function(){
            alert("diste cli");
            Swal.fire(
                'Buen trabajo perro ',
                'You clicked the button!',
                'success'
              )
        },
        editar: async function(){},
        eliminar: function(){}

    },
    created: function(){},
    computed:{}

});

/*
$('#registrar').submit(function(e){
    alert("diste cli");
});

*/