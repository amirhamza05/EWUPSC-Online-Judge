<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Accepted', <?php echo '400' ?>],
          ['Wrong Answare', 100],
          ['Time Limit', 100],
          ['Runtime', 100],
          ['Compailation', 200]
        ]);

        // Set chart options
        var options = {
          
            chartArea:{
              left:40,
              top:15,
              bottom:10,
              width:"100%",
              height:"100%"
            },
             
            'backgroundColor': {
                'fill': '#E6F0F3',
                'opacity': 100
            },
            colors: ['#008000', '#FF0000', '#ec8f6e', '#f3b49f', '#f6c7b6']
            };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>
  <div class="row">

  <div class="col-md-0"></div>
  
  <div class="col-md-12">
    <div class="header_user">User Statistics Graph</div>
    <div class="user_info_cl">
    <div class="cart_box" id="chart_div"></div>
    </div>
  </div>
  <div class="col-md-0"></div>
</div>