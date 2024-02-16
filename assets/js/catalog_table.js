var searchBar = new URLSearchParams(window.location.search).get('searchBar');
var filter = new URLSearchParams(window.location.search).get('filter');

if(searchBar == null) searchBar = "";
if(filter == null) filter = "";

var table = new Tabulator("#catalog-table", {
    placeholder:"No Results Found",
    layout:"fitColumns",
    responsiveLayout:"collapse",
    maxHeight:"100%",
    ajaxURL:"/SAW/Progetto_SAW/private/get_catalog.php?searchBar=" + searchBar + "&filter=" + filter,
    columns:[
        {title:"Locandina", field:"img", formatter:"image", headerSort:false, formatterParams:{
            height:"120px",
            width:"80px",
            urlPrefix:"/SAW/Progetto_SAW/assets/img/film/",
            urlSuffix:".jpg"
        }},
        {title:"Nome", field:"nome"},
        {title:"Genere", field:"genere"},
        {title:"Regista", field:"regista"},
        {title:"Paese", field:"paese"},
        {title:"Anno", field:"anno"},
        {title:"Durata", field:"durata"},
        {title:"Casa di Produzione", field:"casa_produzione"},
        
    ]
});

table.on("rowClick", function(e, row){
    var data = row.getData();
    var url = "/SAW/Progetto_SAW/public/movie_page.php?NomeFilm=" + data.nome;
    window.location.href = url;
});