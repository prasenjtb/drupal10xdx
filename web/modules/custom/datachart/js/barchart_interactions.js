(function ($, Drupal) {
    Drupal.behaviors.chartClickBehavior = {
      attach: function (context, settings) {
        // Ensure Highcharts is loaded and charts exist
        if (typeof Highcharts !== 'undefined') {  // && Highcharts.charts
          Highcharts.charts.forEach(function (chart) {
            // Check if the chart object is not null or undefined
            if (chart && chart.series && chart.series[0] && !chart.clickHandlersAttached) {  
              chart.series[0].points.foreach(function (point){

                point.update({
                  events: {
                    click: function(){
                      let label = this.options.custom?.label;

                      if(label){
                        label = label.toLowerCase().replace(/[\s-]+/g, '_' );

                        const labelMap = {
                          're_submitted': 'resubmitted',
                          'pending_submission' : 'pending_submission',
                        }
                      }
                    }
                  }
                }, false);
              });
              // Perform operations on each chart instance
              // Example: Log the chart's title
              //console.log('Chart title:', chart.title.textStr);

              // Example: Redraw the chart
               chart.redraw();
              // chart.clickHandlersAttached = true;
            }
          });
        }
      }
    };
  })(jQuery, Drupal);