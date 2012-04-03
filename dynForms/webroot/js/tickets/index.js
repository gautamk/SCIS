(function() {

  window.Ticket = Backbone.Model.extend({});

  window.TicketView = Backbone.View.extend({
    tagName: 'tr',
    templateSelector: "#TicketIndexTemplate",
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
    url: window.location.pathname + ".json"
  });

  window.TicketCollectionView = Backbone.View.extend({
    tagName: "table",
    id: "TicketTable",
    className: "table table-bordered  table-striped",
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

  window.ViewTicketView = Backbone.View.extend({
    tagName: "table",
    id: "TicketTable",
    className: "table table-bordered  table-striped",
    templateSelector: "#TicketViewTemplate",
    initialize: function() {
      _.bindAll(this, "render");
      this.model.bind("change", this.render);
      this.template = _.template($(this.templateSelector).html());
      return this;
    },
    render: function() {
      var $TicketContainer, renderedContent;
      renderedContent = this.template(this.model.toJSON());
      this.$el.html(renderedContent);
      $TicketContainer = $("#TicketContainer");
      $TicketContainer.html("");
      $TicketContainer.append(this.$el);
      return this;
    }
  });

  window.TicketRouter = Backbone.Router.extend({
    routes: {
      "": "home",
      "index": "home",
      "view/:id": "view"
    },
    home: function() {
      window.ticketCollection.fetch();
      return this;
    },
    view: function(id) {
      var ticketModel, ticketView;
      ticketModel = new Ticket({});
      ticketModel.url = "./view/" + id + ".json";
      ticketView = new ViewTicketView({
        model: ticketModel
      });
      ticketModel.fetch({
        "error": function(error, type) {
          if (type.status === 403) window.location.reload();
          return this;
        }
      });
      console.log(ticketView.$el);
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
