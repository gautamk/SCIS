location_path = window.location.pathname
###
Add trailing slash to Ajax Request url if not already present
###
window.REQUEST_PATH = if location_path[location_path.length-1] isnt "/" then location_path+"/" else location_path

window.Ticket = Backbone.Model.extend {}

# View for each individual ticket in a collection
window.TicketView = Backbone.View.extend {
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
  url:REQUEST_PATH+".json"
}

# View for a Collection of Tickets
window.TicketCollectionView = Backbone.View.extend {
  templateSelector:"#TicketCollectionTemplate"
  initialize:() ->
    _.bindAll @,"render"
    # (Re)Render the view when collection is updated
    @.collection.bind "reset" , @.render
    @.template=_.template $(@.templateSelector).html()
    @
  render:() ->
    # Clear the Element for new markup
    $el = @.$el.html("")

    renderedTickets=[]
    @.collection.each (model) ->
      view = new TicketView {model:model}
      renderedTickets.push view.render().$el

    # Render the Tickets into the table
    renderedContent = @.template {tickets:renderedTickets}

    # Clear the Container of existing elements
    window.$TicketContainer.html "" 

    # Append rendered content
    window.$TicketContainer.append $ renderedContent

    ###
      BINDING INDEX PAGE ELEMENTS
      Binding needs to be placed here because the DOM elements are dynamically
      generated, and binding needs to be done every time they are generated.
    ###
    $(".ticket-row").mouseenter (event)->
      $(event.currentTarget).find(".ticket-actions").show()
    $(".ticket-row").mouseleave (event)->
      
      $(event.currentTarget).find(".ticket-actions").hide()
    window.$TicketContainer.find("[rel=tooltip]").tooltip({
        placement:"left"
        delay:10
    });

    @
}

# Render a Particular ticket
window.ViewTicketView = Backbone.View.extend {
  tagName:"table"
  id:"TicketTable"
  className:"table table-bordered table-condensed  table-striped"
  templateSelector:"#TicketViewTemplate"
  initialize:() ->
    _.bindAll @,"render"
    @.model.bind "change" , @.render
    @.template=_.template $(@.templateSelector).html()
    @
  render: ()->
    renderedContent = @.template @.model.toJSON();
    @.$el.html renderedContent
    window.$TicketContainer.html "" 
    window.$TicketContainer.append @.$el
    @
}

window.EditTicketView = Backbone.View.extend {
  tagName:"form"
  id:"TicketEditTable"
  className:""
  templateSelector:"#TicketEditTemplate"
  initialize: () ->
    
    _.bindAll @,"render"
    @.model.bind "change" , @.render
    @.template=_.template $(@.templateSelector).html()
    @
  render: ()->
    
    renderedContent = @.template @.model.toJSON();
    @.$el.html renderedContent
    window.$TicketContainer.html ""
    window.$TicketContainer.append @.$el
    console.log @.$el
    @
}

window.TicketRouter = Backbone.Router.extend {
  routes:{
    ""          :"home"
    "index"     :"home"
    "view/:id"  :"view"
    "update/:id":"update"
  }

  # Call this method before executing any routing
  _pre_route: ()->
    $('.tooltip').remove();

  initialize:()->
    # Check if the user is logged in every minute
    setInterval @.checkLogin,60*1000 

  checkLogin:(error,type) ->
    ###
      Reload the page if user has been logged out.
    ###
    $jxhr = $.getJSON(window.REQUEST_PATH+"../users/is_logged_in.json")
    $jxhr.success (status)->
      window.location.reload() if status.response isnt true
    @
  home: () ->
    @._pre_route()
    window.ticketCollection.fetch({
        error:@.checkLogin
    })
    @
  view: (id) ->
    @._pre_route()
    ticketModel = new Ticket {}
    ticketModel.url = window.REQUEST_PATH+"view/"+id+".json"
    ticketView = new ViewTicketView {
      model:ticketModel
    }
    ticketModel.fetch({
      "error": @.checkLogin
    })
    @
  update: (id) ->
    @._pre_route()
    ticketModel = new Ticket {}
    ticketModel.url = window.REQUEST_PATH+"view/"+id+".json"
    ticketView = new EditTicketView {
      model:ticketModel
    }
    ticketModel.fetch({
      "error": @.checkLogin
    })
    @
}

jQuery ->
  # Cache Ticket Container
  window.$TicketContainer = $("#TicketContainer")
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