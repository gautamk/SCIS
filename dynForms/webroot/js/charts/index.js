// Generated by CoffeeScript 1.3.1
(function() {

  window.REQUEST_LOCATION = window.location.pathname.charAt(window.location.pathname.length - 1) === "/" ? window.location.pathname : window.location.pathname + "/";

  window._chart = null;

  window._new_chart = function(title, series) {
    var chart;
    return chart = new Highcharts.Chart({
      chart: {
        renderTo: "ChartContainer"
      },
      title: {
        text: title
      },
      tooltip: {
        formatter: function() {
          return '<b>' + this.point.name + '</b>: ' + this.percentage + ' %';
        }
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
            enabled: true,
            color: '#000000',
            connectorColor: '#000000',
            formatter: function() {
              return '<b>' + this.point.name + '</b>: ' + this.percentage + ' %';
            }
          }
        }
      },
      series: [series]
    });
  };

  window.Router = Backbone.Router.extend({
    routes: {
      "": "index",
      "escalation": "escalation",
      "status": "status",
      "priority": "priority"
    },
    initialize: function() {
      return setInterval(this.checkLogin, 60 * 1000);
    },
    checkLogin: function(error, type) {
      /*
                Reload the page if user has been logged out.
      */

      var $jxhr;
      $jxhr = $.getJSON(window.REQUEST_LOCATION + "../users/is_logged_in.json");
      $jxhr.success(function(status) {
        if (status.response !== true) {
          return window.location.reload();
        }
      });
      return this;
    },
    index: function() {
      return this;
    },
    priority: function() {
      jQuery.getJSON(REQUEST_LOCATION + "priority.json", function(response) {
        if (window._chart !== null) {
          window._chart.destroy();
        }
        return window._chart = window._new_chart("Priority Chart", response);
      });
      return this;
    },
    status: function() {
      jQuery.getJSON(REQUEST_LOCATION + "status.json", function(response) {
        if (window._chart !== null) {
          window._chart.destroy();
        }
        return window._chart = window._new_chart("Status Chart", response);
      });
      return this;
    },
    escalation: function() {
      jQuery.getJSON(REQUEST_LOCATION + "escalation.json", function(response) {
        if (window._chart !== null) {
          window._chart.destroy();
        }
        return window._chart = window._new_chart("Escalation Chart", response);
      });
      return this;
    },
    reload: function() {
      var path;
      path = window.location.hash.replace("#", "");
      this.navigate("");
      return this.navigate(path, true);
    }
  });

  jQuery(function() {
    window._router = new window.Router();
    return Backbone.history.start();
  });

}).call(this);
