location_path = window.location.pathname
###
Add trailing slash to Ajax Request url if not already present
###
window.REQUEST_PATH = if location_path[location_path.length-1] isnt "/" then location_path+"/" else location_path



window.Ticket = Backbone.Model.extend {}
window.TicketView = Backbone.View.extend {
  tagName: 'tr'
  templateSelector:"#TicketIndexTemplate"
  
  initialize:() ->
    _.bindAll @,"render"
    @.template=_.template $(@.templateSelector).html()
    @
    
  render:() ->
    renderedContent = @.template @.model.toJSON();
    @.$el.html renderedContent
    @
    
}
window.TicketCollection = Backbone.Collection.extend {
  model:window.Ticket,
  url:REQUEST_PATH+".json"
}
window.TicketCollectionView = Backbone.View.extend {
  tagName:"table"
  id:"TicketTable"
  className:"table table-bordered  table-striped"
  initialize:() ->
    _.bindAll @,"render"
    # (Re)Render the view when collection is updated
    @.collection.bind "reset" , @.render
    @
  render:() ->
    $el = @.$el.html("")
    @.collection.each (model) ->
      view = new TicketView {model:model}
      $el.append view.render().$el
    $TicketContainer = $("#TicketContainer")
    $TicketContainer.html "" 
    $TicketContainer.append @.$el 
    @
}

# Render a Particular ticket
window.ViewTicketView = Backbone.View.extend {
  tagName:"table"
  id:"TicketTable"
  className:"table table-bordered  table-striped"
  templateSelector:"#TicketViewTemplate"
  initialize:() ->
    _.bindAll @,"render"
    @.model.bind "change" , @.render
    @.template=_.template $(@.templateSelector).html()
    @
  render: ()->
    renderedContent = @.template @.model.toJSON();
    @.$el.html renderedContent
    $TicketContainer = $("#TicketContainer")
    $TicketContainer.html "" 
    $TicketContainer.append @.$el
    @


}
window.TicketRouter = Backbone.Router.extend {
  routes:{
    ""          :"home"
    "index"     :"home"
    "view/:id"  :"view"
  }
  home: () ->
    window.ticketCollection.fetch()
    @
  view: (id) ->
    ticketModel = new Ticket {}
    ticketModel.url = window.REQUEST_PATH+"view/"+id+".json"
    ticketView = new ViewTicketView {
      model:ticketModel
    }
    
    ticketModel.fetch({
      "error": (error,type) ->
        window.location.reload() if type.status is 403
        @

    })
    #console.log ticketView.$el
    @
}

jQuery ->
  window.ticketCollection = new TicketCollection 
  window.ticketCollectionView = new TicketCollectionView({collection:ticketCollection})
  window.ticketRouter = new TicketRouter()
  Backbone.history.start()
  ###
    Binding
  ###
  $(".RefreshButton").click () ->
    window.ticketCollection.fetch()
  @
  
