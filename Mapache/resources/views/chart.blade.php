@extends('partials.master')

@section('content')
<main class="main">
<br>
<div class="row col-12">
<div class="card shadow my-crystal-bg col-12">
  <h3 class="card-header">Gestion de Modulos</h3>
  <br>
  
  <div class="card-body">   

  <!-- chart -->

        <style>
            #chartdiv {
            width: 100%;
            height:550px;
            }
        </style>

            <script>
            am4core.ready(function() {

            
            // Themes begin
            am4core.useTheme(am4themes_frozen);
            // am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("chartdiv", am4plugins_forceDirected.ForceDirectedTree);
            var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

            chart.data = [
            {
                name: "Core",
                children: [
                {
                    name: "First",
                    children: [
                    { name: "A1", value: 100 },
                    { name: "A2", value: 60 }
                    ]
                },
                {
                    name: "Second",
                    children: [
                    { name: "B1", value: 135 },
                    { name: "B2", value: 98 }
                    ]
                },
                {
                    name: "Third",
                    children: [
                    {
                        name: "C1",
                        children: [
                        { name: "EE1", value: 130 },
                        { name: "EE2", value: 87 },
                        { name: "EE3", value: 55 }
                        ]
                    },
                    { name: "C2", value: 148 },
                    {
                        name: "C3", children: [
                        { name: "CC1", value: 53 },
                        { name: "CC2", value: 30 }
                        ]
                    },
                    { name: "C4", value: 26 }
                    ]
                },
                {
                    name: "Fourth",
                    children: [
                    { name: "D1", value: 415 },
                    { name: "D2", value: 148 },
                    { name: "D3", value: 89 }
                    ]
                },
                {
                    name: "Fifth",
                    children: [
                    {
                        name: "E1",
                        children: [
                        { name: "EE1", value: 33 },
                        { name: "EE2", value: 40 },
                        { name: "EE3", value: 89 }
                        ]
                    },
                    {
                        name: "E2",
                        value: 148
                    }
                    ]
                }

                ]
            }
            ];

            $.ajax({
                type:'GET',
                datatype: 'json',
                url: 'getdataforchart',
                success:function(data){
                        var real = JSON.parse(data);
                        console.log(real);
                        var num = Object.keys(real).length;

                        var dataway = [{ name: 'Mapache'}];
                        dataway[0]['children'] = new Array(num);
                        var i = 0;
                        $.each(real, function(k, v){
                            dataway[0]['children'][i] = {name: k, children: new Array(2)}
                            subdata = v;
                            var j = 0;
                                $.each(subdata, function(k2, v2){
                                    dataway[0]['children'][i]['children'][j] = { name: k2, value: v2}
                                    // console.log(k2);
                                    //  console.log(v2);
                                     j++;
                                })
                            i++;                     
                           
                        })
                        
                       console.log(chart.data);
                       console.log(dataway);
                       chart.data = dataway;


                    }
            });



           


            networkSeries.dataFields.value = "value";
            networkSeries.dataFields.name = "name";
            networkSeries.dataFields.children = "children";
            networkSeries.nodes.template.tooltipText = "{name}:{value}";
            networkSeries.nodes.template.fillOpacity = 1;
            networkSeries.manyBodyStrength = -20;
            networkSeries.links.template.strength = 0.8;
            networkSeries.minRadius = am4core.percent(2);

            networkSeries.nodes.template.label.text = "{name}"
            networkSeries.fontSize = 10;

            }); // end am4core.ready()
            </script>

            <!-- HTML -->
            <div id="chartdiv"></div>
    </div>
</div>
</div>

</main>
@endsection