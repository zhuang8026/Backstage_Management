// chart.js
function getTableData(table) {
    // 這邊 增加 陣列
    const dataArray =[], 
        IdArray = [],
        NameArray = [],
        ImageArray = [],
        ColorArray = [],
        BrandArray = [];

    // loop table rows
    // 將 陣列 放入 table 
    table.rows({ search: "applied" }).every(function() {
        const data = this.data();
        IdArray.push(parseInt(data[1].replace(/\,/g, "")));
        NameArray.push(data[2]);
        ImageArray.push(data[3]);
        ColorArray.push(parseInt(data[4].replace(/\,/g, "")));
        BrandArray.push(parseInt(data[5].replace(/\,/g, "")));
    });


    // store all data in dataArray
    // 將 table 的 陣列 push 到 dataArray 並 返回值 
    dataArray.push(IdArray, NameArray, ImageArray, ColorArray, BrandArray);

    return dataArray;
}
// chart.js
function createHighcharts(data) {
    // console.log(data)
    Highcharts.setOptions({
        lang: {
            thousandsSep: ","
        }
    });
    
    Highcharts.chart("chart", {
        title: {
            text: "商場資料分析圖"
        },
        subtitle: {
            text: "商場訊息顯示"
        },
        xAxis: [
        {
            categories: data[1],
            labels: {
                rotation: -45
            }
        }
        ],
        yAxis: [
            {
                // first yaxis
                title: {
                    text: "評價分數"
                }
            },
            {
                // secondary yaxis
                title: {
                    text: "商品數量"
                },
                min: 0,
                opposite: true
            }
        ],
        series: [
            {
                name: "評價分數",
                color: "#211E55",
                type: "column", //column spline
                data: data[3],
                tooltip: {
                    valueSuffix: "/個"
                }
            },
            {
                name: "商品數量",
                color: "#FF404E",
                type: "column", //column spline
                data: data[4],
                yAxis: 1,
                tooltip: {
                    valueSuffix: "/個"
                }
            }
            
        ],
        tooltip: {
            shared: true
        },
        search: {
            backgroundColor: "#4E4F97",
            shadow: true
        },
        credits: {
            
        },
        noData: {
            style: {
                fontSize: "14px"
            }
        }
    });
}
// chart.js
function setTableEvents(table) {
    // listen for page clicks
    table.on("page", () => {
        draw = true;
    });

    // listen for updates and adjust the chart accordingly
    table.on("draw", () => {
        if (draw) {
            draw = false;
        } else {
            const tableData = getTableData(table);
            createHighcharts(tableData);
        }
    });
}

// chart.js
let draw = false;
function init() {
    // initialize DataTables
    const table = $("#dt-table").DataTable({
        "columnDefs": [ {
            // "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[1, "desc"]]
        // "order": [[ 3, "asc" ]]
    } );

    // 分析圖 
    // const table = $("#dt-table").DataTable();
    // get table data
    const tableData = getTableData(table);
    // create Highcharts
    createHighcharts(tableData);
    // table events
    setTableEvents(table);
}
init();


