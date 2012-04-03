<script type="text/template" id="TicketIndexTemplate">
		<td><%= DynamicFormResponse._id %></td>
		<td><%= DynamicFormResponse.email  %></td>
		<td><%= DynamicFormResponse.brief_description %></td>
        <td><a href="#view/<%= DynamicFormResponse._id %>" class="btn" >View</a></td>
</script>
<script type="text/template" id="TicketViewTemplate" >
    <% _.each(DynamicFormResponse,function(val,key){ %>
        <tr>
            <td><%= key %></td>
            <td><%= val %></td>
        </tr>
    <% }); %>
</script>
<a href="#index" class="btn"  >Index</a>

<div id="TicketContainer">
	
</div>