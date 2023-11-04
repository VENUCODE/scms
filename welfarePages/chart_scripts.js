
anychart.onDocumentReady(function () {
  let bar_chart_data = [];
  function updateChartData(sseData) {
    bar_chart_data = sseData.map(item => [item.WID, item.SolvedComplaintsCount]);
    chart.data(bar_chart_data);
    chart.draw();
  }
  var source = new EventSource("../api/welfare_api/warden_stats.php");

  source.onmessage = (e) => {
   console.log(e.data)
   console.log(e.data);
      const sseData = JSON.parse(e.data);
  
      updateChartData(sseData);
  };
  anychart.theme('lightBlue');

// Function to update the chart data and redraw the chart
var chart = anychart.column3d();
  // turn on chart animation
  chart.animation(true);
  // set chart title text settings
  chart.title('Problems Solved by Wardens');
  chart.column();

  chart
    .tooltip()
    .position('center-top')
    .anchor('center-bottom')
    .offsetX(0)
    .offsetY(10)
    .format('{%Value} solved');

    // set scale minimum
  chart.yScale().minimum(0);
    
    // set yAxis labels formatter
  chart.yAxis().labels().format('{%Value}{groupsSeparator: }');

  chart.tooltip().positionMode('point');
  chart.interactivity().hoverMode('by-x');
  chart.xAxis().title('Wardens');
  chart.yAxis().title('No of problems');

  chart.container('container');
  chart.draw();
  
  source.onmessage = (e) => {
    console.log(e.data);
    // Parse the SSE data
    const sseData = JSON.parse(e.data);
  
    // Update chart data and redraw
    bar_chart_data = sseData.map(item => [item.WID, parseInt(item.SolvedComplaintsCount)]);
    chart.data(bar_chart_data);
  
    // Update x-axis and y-axis labels
    chart.xAxis().labels().format('{%Value}');
    chart.yAxis().labels().format('{%Value}');
  
    chart.draw();
  };
});
    // // create pie chart with passed data
    // let piechart_data=[['PENDING', 20],
    // ['SOLVED', 50],
    // ['REPORTED', 30]]
    // var chart = anychart.pie(piechart_data);
    // chart.animation(true);
    // // creates palette
    // var palette = anychart.palettes.distinctColors();
    // palette.items([
    //   { color: '#7d9db6' },
    //   { color: '#8db59d' },
    //   { color: '#f38367' }
    // ]);

    // // set chart radius
    // chart
    //   .radius('43%')
    //   // create empty area in pie chart
    //   .innerRadius('60%')
    //   // set chart palette
    //   .palette(palette);

    // // set outline settings
    // chart
    //   .outline()
    //   .width('3%')


    // // format tooltip
    // chart.tooltip().format('Percent Value: {%PercentValue}%');

    // // create standalone label and set label settings
    // var label = anychart.standalones.label();
    // label
    //   .enabled(true)
    //   .text('Complaints stats')
    //   .width('100%')
    //   .height('100%') 
    //   .adjustFontSize(true, true)
    //   .minFontSize(10)
    //   .maxFontSize(25)
    //   .fontColor('#60727b')
    //   .position('center')
    //   .anchor('center')
    //   .hAlign('center')
    //   .vAlign('middle');

    // // set label to center content of chart
    // chart.center().content(label);

    // // set container id for the chart
    // chart.container('piechart');
    // // initiate chart drawing
    // chart.draw();


