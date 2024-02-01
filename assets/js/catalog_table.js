        //catalog_table.js
        var searchBar = new URLSearchParams(window.location.search).get('searchBar');
        var filter = new URLSearchParams(window.location.search).get('filter');
        if(searchBar == null) searchBar = "";
        if(filter == null) filter = "";
        var table = new Tabulator("#catalog-table", {
            placeholder:"No Results Found",
            layout:"fitColumns", //fit columns to width of data (optional)
            responsiveLayout:"collapse", //hide columns that dont fit on the table
            maxHeight:"100%", //do not let table get bigger than the height of its parent element
            ajaxURL:"/SAW/Progetto_SAW/private/get_catalog.php?searchBar=" + searchBar + "&filter=" + filter, //ajax URL
            columns:[ //Define Table Columns
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
                {title:"Trama", field:"trama", maxWidth: 100, },
                {title:"Durata", field:"durata"},
                {title:"Casa di Produzione", field:"casa_produzione"},
                {title:"Gradimento", field:"gradimento", formatter:"star", formatterParams:{
                    stars:5,
                }}
            ]
        });
        /*table.on("tableBuilt", function(){
            var rows = table.getRows();
            table.replaceData("/SAW/Progetto_SAW/private/get_review.php") //load data from php via ajax request
            .then(function(){
                rows.forEach(function(row){
                    row.update({"gradimento": "/SAW/Progetto_SAW/private/get_review.php?id_i"});
                });
            })
        }); //trigger when the table is built*/

        table.on("rowClick", function(e, row){ //trigger an alert message when the row is clicked
            var data = row.getData(); // get data of the clicked row
            var url = "/SAW/Progetto_SAW/public/moovie_page.php?NomeFilm=" + data.nome; // construct the URL
            window.location.href = url; // redirect to the URL
        });