(function() {
  var location_path;

  location_path = window.location.pathname;

  /*
  Add trailing slash to Ajax Request url if not already present
  */

  window.REQUEST_PATH = location_path[location_path.length - 1] !== "/" ? location_path + "/" : location_path;

  window.Ticket = Backbone.Model.extend({});

  window.TicketView = Backbone.View.extend({
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
    url: REQUEST_PATH + ".json"
  });

  window.TicketCollectionView = Backbone.View.extend({
    templateSelector: "#TicketCollectionTemplate",
    initialize: function() {
      _.bindAll(this, "render");
      this.collection.bind("reset", this.render);
      this.template = _.template($(this.templateSelector).html());
      return this;
    },
    render: function() {
      var $el, renderedContent, renderedTickets;
      $el = this.$el.html("");
      renderedTickets = [];
      this.collection.each(function(model) {
        var view;
        view = new TicketView({
          model: model
        });
        return renderedTickets.push(view.render().$el);
      });
      renderedContent = this.template({
        tickets: renderedTickets
      });
      window.$TicketContainer.html("");
      window.$TicketContainer.append($(renderedContent));
      /*
            BINDING INDEX PAGE ELEMENTS
            Binding needs to be placed here because the DOM elements are dynamically
            generated, and binding needs to be done every time they are generated.
      */
      $(".ticket-row").mouseenter(function(event) {
        return $(event.currentTarget).find(".ticket-actions").show();
      });
      $(".ticket-row").mouseleave(function(event) {
        return $(event.currentTarget).find(".ticket-actions").hide();
      });
      window.$TicketContainer.find("[rel=tooltip]").tooltip({
        placement: "left",
        delay: 10
      });
      return this;
    }
  });

  window.ViewTicketView = Backbone.View.extend({
    tagName: "table",
    id: "TicketTable",
    className: "table table-bordered table-condensed  table-striped",
    templateSelector: "#TicketViewTemplate",
    initialize: function() {
      _.bindAll(this, "render");
      this.model.bind("change", this.render);
      this.template = _.template($(this.templateSelector).html());
      return this;
    },
    render: function() {
      var renderedContent;
      renderedContent = this.template(this.model.toJSON());
      this.$el.html(renderedContent);
      window.$TicketContainer.html("");
      window.$TicketContainer.append(this.$el);
      return this;
    }
  });

  window.TicketRouter = Backbone.Router.extend({
    routes: {
      "": "home",
      "index": "home",
      "view/:id": "view",
      "update/:id": "update"
    },
    _pre_route: function() {
      return $('.tooltip').remove();
    },
    initialize: function() {
      return setInterval(this.checkLogin, 60 * 1000);
    },
    checkLogin: function(error, type) {
      /*
            Reload the page if user has been logged out.
      */
      var $jxhr;
      $jxhr = $.getJSON(window.REQUEST_PATH + "../users/is_logged_in.json");
      $jxhr.success(function(status) {
        if (status.response !== true) return window.location.reload();
      });
      return this;
    },
    home: function() {
      this._pre_route();
      window.ticketCollection.fetch({
        error: this.checkLogin
      });
      return this;
    },
    view: function(id) {
      var ticketModel, ticketView;
      this._pre_route();
      ticketModel = new Ticket({});
      ticketModel.url = window.REQUEST_PATH + "view/" + id + ".json";
      ticketView = new ViewTicketView({
        model: ticketModel
      });
      ticketModel.fetch({
        "error": this.checkLogin
      });
      return this;
    },
    update: function(id) {
      var ticketModel, ticketView;
      this._pre_route();
      ticketModel = new Ticket({});
      ticketModel.url = window.REQUEST_PATH + "view/" + id + ".json";
      ticketView = new EditTicketView({
        model: ticketModel
      });
      ticketModel.fetch({
        "error": this.checkLogin
      });
      return this;
    }
  });

  jQuery(function() {
    window.$TicketContainer = $("#TicketContainer");
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
