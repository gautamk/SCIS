<script type="text/template" id="TicketIndexTemplate">
		<td><%= DynamicFormResponse._id %></td>
		<td><%= DynamicFormResponse.email  %></td>
		<td><%= DynamicFormResponse.brief_description %></td>
        <td><a href="#view/<%= DynamicFormResponse._id %>" class="btn" >View</a></td>
</script>
<script type="text/template" id="TicketViewTemplate" >
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
</script>
<script>
    /*
        Very Important
    */
    var TICKET_CONTROLLER_URL='<?php 
    $url = $this->Html->url(array(
            "controller" => "tickets",
            "action" => "index"
        ));
    echo $url."\/"
  ?>';
</script>

<button onclick="ticketRouter.navigate('index',{trigger: true});" class="btn"  >Index</button>

<div id="TicketContainer">
	
</div>