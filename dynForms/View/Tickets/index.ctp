<script type="text/template" id="TicketTemplate">
		
		<td><%= DynamicFormResponse.email  %></td>
        <td>
        <%= DynamicFormResponse.brief_description === undefined ? DynamicFormResponse.description:DynamicFormResponse.brief_description %>
        </td>
        <td><%= DynamicFormResponse.status %></td>
        <td><%= DynamicFormResponse._id %></td>
        <td class=" ">
            <div class=" ticket-actions btn-group">
                <a href="#view/<%= DynamicFormResponse._id %>" 
                class="btn btn-mini btn-info" rel="tooltip" title="Details" >
                <i class="icon-resize-full"></i></a>

                <a href="#update/<%= DynamicFormResponse._id %>" 
                class="btn btn-mini btn-info" rel="tooltip" title="Update" >
                <i class="icon-pencil"></i></a>
                <div>
            <div>
        </td>
        
</script>
<script type="text/template" id="TicketCollectionTemplate">

    <table class="table table-striped table-bordered" id="TicketCollectionTable" >
        <caption>
        <h3>List of Tickets
            <button title="Refresh" class="btn btn-success" onclick="ticketCollection.fetch();"><i class="icon-refresh" ></i></button>
        </h3>
        </caption>
        <thead>
            <tr>
                <th>Email</th>
                <th>Description</th>
                <th>Status</th>
                <th>Ticket ID</th>
                <th >Actions</th>
            </tr>
        </thead>
        <tbody>
            <%_.each(tickets,function(val,key){%>
                <tr class="ticket-row">
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

<script type="text/template" id="TicketEditTemplate">
    <table class="table table-bordered table-condensed  table-striped">
        <caption>Update</caption>
        <thead>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                <label for="Ticket-DynamicFormResponse-department_id">Department_ID</label>
                </td>
                <td><input type="text" id="Ticket-DynamicFormResponse-department_id" 
                value="<%=DynamicFormResponse.department_id %>" placeholder=""></td>
            </tr>
            <tr>
                <td>
                    <label for="Ticket-DynamicFormResponse-status">Status</label>
                </td>
                <td><input type="text" id="Ticket-DynamicFormResponse-status" 
                value="<%= DynamicFormResponse.status %>" placeholder=""></td>
            </tr>
            <tr>
                <td>
                <label for="Ticket-DynamicFormResponse-escalation">Escalation</label>
                </td>
                <td><input type="number" id="Ticket-DynamicFormResponse-escalation" 
                value="<%= DynamicFormResponse.escalation %>" placeholder=""></td>
            </tr>
            <tr>
                <td>
                    <label for="Ticket-DynamicFormResponse-priority">Priority<label>
                </td>
                <td><input type="number" id="Ticket-DynamicFormResponse-priority" 
                value="<%= DynamicFormResponse.priority %>" placeholder=""></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-large btn-primary">
                    Update Ticket
                    </button>
                </td>
            </tr>
        </tbody>
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
<style type="text/css">
    .ticket-actions{
        display:none;
    }
    #TicketCollectionTable td {
        padding:15px;
        margin:none;
        min-height:100px;
    }
</style> 
<div >
<button onclick="ticketRouter.navigate('index',{trigger: true});" class="btn btn-primary"  >Index</button>
</div>

<div id="TicketContainer"></div>