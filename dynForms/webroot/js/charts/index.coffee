#window.location.pathname.charAt(window.location.pathname.length - 1) =="/" ? window.location.pathname:window.location.pathname+"/"
window.REQUEST_LOCATION = if window.location.pathname.charAt(window.location.pathname.length-1) is "/" then window.location.pathname else window.location.pathname+"/"
window._chart =null
window._new_chart = (title,series)->
    chart = new Highcharts.Chart {
        chart:{
            renderTo:"ChartContainer"
        }
        title:{
            text:title
        }
        tooltip: {
            formatter: () ->
                '<b>'+this.point.name+'</b>: '+this.percentage+' %'
        }
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    formatter:() ->
                        '<b>'+this.point.name+'</b>: '+this.percentage+' %'
                }
            }
        }
        series:[series]
    }
window.Router = Backbone.Router.extend {
    routes:{
        "":"index"
        "escalation":"escalation"
        "status":"status"
        "priority":"priority"
    }
    initialize:()->
        # Check if the user is logged in every minute
        setInterval @.checkLogin,60*1000 

    checkLogin:(error,type) ->
        ###
          Reload the page if user has been logged out.
        ###
        $jxhr = $.getJSON(window.REQUEST_LOCATION+"../users/is_logged_in.json")
        $jxhr.success (status)->
          window.location.reload() if status.response isnt true
        @
    index: ()->
        @

    priority: () ->
        jQuery.getJSON REQUEST_LOCATION+"priority.json", (response) ->
            if window._chart isnt null then window._chart.destroy()
            window._chart = window._new_chart "Priority Chart",response 
        @

    status:() ->
        jQuery.getJSON REQUEST_LOCATION+"status.json", (response) ->
            if window._chart isnt null then window._chart.destroy()
            window._chart = window._new_chart "Status Chart",response 
        @
    escalation: ()->
        jQuery.getJSON REQUEST_LOCATION+"escalation.json", (response) ->
            if window._chart isnt null then window._chart.destroy()
            window._chart = window._new_chart "Escalation Chart",response 
        @
    reload: ()->
        path = window.location.hash.replace "#",""
        @.navigate ""
        @.navigate path,true
}
jQuery ->
    window._router = new window.Router();
    Backbone.history.start();