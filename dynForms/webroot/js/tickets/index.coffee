
window.Ticket = Backbone.Model.extend {}
window.TicketView = Backbone.View.extend {
  tagName: 'tr'
  templateSelector:"#TicketTemplate"
  
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
  url:"getTickets.json"
}
window.TicketCollectionView = Backbone.View.extend {
  tagName:"table"
  id:"TicketTable"
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

window.TicketRouter = Backbone.Router.extend {
  routes:{
    ""        :"home"
    "index"   :"home"
  }
  home: () ->
    window.ticketCollection.fetch()
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
  
