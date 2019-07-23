const app = new Vue({

    el: '#series',
    data: {
        titulo : 'Series de La Alameda',
        series: [

        ],
        nuevaSerie:'',
        fondo : 'bg-success',
        color: true,
    },
    methods:{
        agregarSerie () {
         this.series.push({
             titulo: this.nuevaSerie, imagen:''
         });
         this.nuevaSerie = '';
         localStorage.setItem('series-alameda', JSON.stringify(this.series))
        }
    },
    created: function () {
        let datosDB = JSON.parse(localStorage.getItem('series-alameda'));
        if (datosDB === null){
            this.series = [];
        }else{
            this.series = datosDB;
        }
        
    }


})