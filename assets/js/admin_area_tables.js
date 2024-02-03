//admin_area_tables.js

        /*const triggerTabList = document.querySelectorAll('#myTab button')
        triggerTabList.forEach(triggerEl => {
            const tabTrigger = new bootstrap.Tab(triggerEl)
            triggerEl.addEventListener('click', event => {
                event.preventDefault()
                tabTrigger.show()
            })
        })*/
    
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
        /*all_movies_table.setData()
        .then(function(){
            //run code after table has been successfully updated
        })
        .catch(function(error){
            //handle error loading data
        });*/

        var all_users_table = new Tabulator("#all-users-table", {
            columnDefaults:{
                minWidth: 100,  
            },
            layout:"fitColumns", //fit columns to width of data (optional)
            //responsiveLayout:"collapse", //hide columns that dont fit on the table
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
                {title:"Data di Nascita", field:"Data_Nascita"},
                {title:"Genere", field:"Genere"},
                {title:"Nazionalità", field:"Nazionalità"},
                
            ]
        });
        //Add row on "Add Row" button click
        document.getElementById("add-row").addEventListener("click", function(){
            all_users_table.addRow({}, false).then(function(row){
                row.getCells().forEach(function(cell){
                    cell.getElement().addEventListener('cellClick', makeCellEditable);
                });
            });
        });
        function makeCellEditable(e, cell) {
            cell.edit();
        }

        //Delete row on "Delete Row" button click
        document.getElementById("del-row").addEventListener("click", function(){
            all_users_table.deleteRow();
        });