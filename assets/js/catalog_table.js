        //catalog_table.js
        var searchBar = new URLSearchParams(window.location.search).get('searchBar');
        var filter = new URLSearchParams(window.location.search).get('filter');
        if(searchBar == null) searchBar = "";
        if(filter == null) filter = "";
        var table = new Tabulator("#catalog-table", {
            /*columnDefaults:{
                maxWidth: 250,  
            },*/
            layout:"fitColumns", //fit columns to width of data (optional)
            responsiveLayout:"collapse", //hide columns that dont fit on the table
            maxHeight:"100%", //do not let table get bigger than the height of its parent element
            ajaxURL:"/SAW/Progetto_SAW/private/get_catalog.php?searchBar=" + searchBar + "&filter=" + filter, //ajax URL
            //data:tabledata, //assign data to table
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
                //{title:"Trama", field:"trama", maxWidth: 100, },
                {title:"Durata", field:"durata"},
                {title:"Casa di Produzione", field:"casa_produzione"},
            ]
        });
        table.on("rowClick", function(e, row){ //trigger an alert message when the row is clicked
                var data = row.getData(); // get data of the clicked row
                var url = "/SAW/Progetto_SAW/public/moovie_page.php?NomeFilm=" + data.nome; // construct the URL
                window.location.href = url; // redirect to the URL
                });
        //catalog_table.setData()
        /*.then(function(){
            //run code after table has been successfully updated
        })
        .catch(function(error){
            //handle error loading data
        });*/