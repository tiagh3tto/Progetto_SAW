$(document).ready(function() {
    // Manually trigger 'shown.bs.tab' event for the first tab
    $('a[data-toggle="tab"]:first').trigger('shown.bs.tab');
  });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            if (e.target.id === 'table1-tab') {
                var all_users_table = new Tabulator("#all-users-table", {
                    columnDefaults:{
                        minWidth: 150,  
                    },
                    layout:"fitColumns", //fit columns to width of data (optional)
                    responsiveLayout:"collapse", //hide columns that dont fit on the table
                    maxHeight:"100%", //do not let table get bigger than the height of its parent element
                    ajaxURL:"/SAW/Progetto_SAW/private/retrieve_all_usr_data.php", //ajax URL
                    //data:tabledata, //assign data to table
                    columns:[ //Define Table Columns
                        {formatter:"rowSelection", titleFormatter:"rowSelection", hozAlign:"right", headerSort:false, cellClick:function(e, cell){
                            cell.getRow().toggleSelect();
                        }},
                        {title:"Nome", field:"Nome"},
                        {title:"Cognome", field:"Cognome"},
                        {title:"Email", field:"Email"},
                        {title:"Admin", field:"Admin", hozAlign:"center", formatter:"tickCross"},
                        {title:"Data di Nascita", field:"Data_Nascita"},
                        {title:"Genere", field:"Genere"},
                        {title:"Nazionalità", field:"Nazionalità"},
                        {title:"Ban", field:"Ban", formatter:"html"},
                    ]
                });
            } else if (e.target.id === 'table2-tab') {
                var all_movies_table = new Tabulator("#all-movies-table", {
                    columnDefaults:{
                        minWidth: 100,  
                    },
                    layout:"fitColumns", //fit columns to width of data (optional)
                    responsiveLayout:"collapse", //hide columns that dont fit on the table
                    maxHeight:"100%", //do not let table get bigger than the height of its parent element
        
                    ajaxURL:"/SAW/Progetto_SAW/private/get_catalog.php", //ajax URL
                    //data:tabledata, //assign data to table
                    columns:[ //Define Table Columns
                        {formatter:"rowSelection", titleFormatter:"rowSelection", hozAlign:"right", headerSort:false, cellClick:function(e, cell){
                            cell.getRow().toggleSelect();
                        }},
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
                        //{title:"Trama", field:"trama", maxWidth: 100, editor:"textarea"},
                        {title:"Durata", field:"durata"},
                        {title:"Casa di Produzione", field:"casa_produzione"},
                        //{title:"Elimina", field:"Elimina", formatter:"html"},
                    ]
                });
            }
          });