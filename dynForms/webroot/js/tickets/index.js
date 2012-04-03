(function() {

  window.Ticket = Backbone.Model.extend({});

  window.TicketView = Backbone.View.extend({
    tagName: 'tr',
    templateSelector: "#TicketTemplate",
    initialize: function() {
      _.bindAll(this, "render");
      this.template = _.template($(this.templateSelector).html());
      return this;
    },
    render: function() {
      var renderedContent;
      renderedContent = this.template(this.model.toJSON());
      this.$el.html(renderedContent);
      return this;
    }
  });

  window.TicketCollection = Backbone.Collection.extend({
    model: window.Ticket,
    url: "getTickets.json"
  });

  window.TicketCollectionView = Backbone.View.extend({
    tagName: "table",
    id: "TicketTable",
    initialize: function() {
      _.bindAll(this, "render");
      this.collection.bind("reset", this.render);
      return this;
    },
    render: function() {
      var $TicketContainer, $el;
      $el = this.$el.html("");
      this.collection.each(function(model) {
        var view;
        view = new TicketView({
          model: model
        });
        return $el.append(view.render().$el);
      });
      $TicketContainer = $("#TicketContainer");
      $TicketContainer.html("");
      $TicketContainer.append(this.$el);
      return this;
    }
  });

  window.TicketRouter = Backbone.Router.extend({
    routes: {
      "": "home",
      "index": "home"
    },
    home: function() {
      window.ticketCollection.fetch();
      return this;
    }
  });

  jQuery(function() {
    window.ticketCollection = new TicketCollection;
    window.ticketCollectionView = new TicketCollectionView({
      collection: ticketCollection
    });
    window.ticketRouter = new TicketRouter();
    Backbone.history.start();
    /*
        Binding
    */
    $(".RefreshButton").click(function() {
      return window.ticketCollection.fetch();
    });
    return this;
  });

}).call(this);
