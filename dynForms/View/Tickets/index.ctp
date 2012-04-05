<script type="text/template" id="TicketTemplate">
		
		<td><%= DynamicFormResponse.email  %></td>
        <td>
        <%= DynamicFormResponse.brief_description === undefined ? DynamicFormResponse.description:DynamicFormResponse.brief_description %>
        </td>
        <td><%= DynamicFormResponse.status %></td>
        <td><%= DynamicFormResponse._id %></td>
        <td>
            <a href="#view/<%= DynamicFormResponse._id %>" 
            class="btn btn-small btn-info" rel="tooltip" title="Details" >
            <i class="icon-zoom-in"></i></a>

            <a href="#update/<%= DynamicFormResponse._id %>" 
            class="btn btn-small btn-info" rel="tooltip" title="Update" >
            <i class="icon-pencil"></i></a>
        </td>
        
</script>
<script type="text/template" id="TicketCollectionTemplate">
    <table class="table table-striped table-bordered">
        <caption><h3>List of Tickets</h3></caption>
        <thead>
            <tr>
                <th>Email</th>
                <th>Description</th>
                <th>Status</th>
                <th>Ticket ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <%_.each(tickets,function(val,key){%>
                <tr>
                <%= val.html() %>
                </tr>
            <%});%>
        </tbody>
    </table>
</script>
<script type="text/template" id="TicketViewTemplate" >
    <table class="table table-striped table-bordered table-condensed" >
    <!--
        Recurse through the list of Key value pairs 
        and Add them to the main Table
     -->
    <% function recurseTemplate(val,key) {%>
        <tr>
            <% if(typeof val === "object") {%>
                <th><%= key %></th>
                <% _.each(val,function(val,key){%>
                    <%= recurseTemplate(val,key) %>
                <%}); %>
            <% } else {%>
                    <td><%= key %></td>
                    <td><%= val %></td>
            <% } %>
        </tr>
    <%}%>
    <% _.each(DynamicFormResponse,function(val,key){ %>
        <% recurseTemplate(val,key) %>
    <% }); %>
    </table>
</script>
<script>
    /*
        Very Important
        Get the Url of the Tickets Controller
    */
    var TICKET_CONTROLLER_URL='<?php 
    $url = $this->Html->url(array(
            "controller" => "tickets",
            "action" => "index"
        ));
    echo $url."\/"
  ?>';
</script>
<div >
<button onclick="ticketRouter.navigate('index',{trigger: true});" class="btn btn-primary"  >Index</button>
</div>

<div id="TicketContainer"></div>