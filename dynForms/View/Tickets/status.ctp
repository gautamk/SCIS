<?php if($ticket == false): ?>
<div class="modal fade" id="TicketFormContainer">
  <div class="modal-header">
    <h3>Get Ticket</h3>
  </div>
  <div class="modal-body">
    <form id="GetTicketForm" class="form-inline" >
      <div class="control-group" style="padding:15px;">
        <label class="control-label" for="TicketID">
          <h3>Ticket ID :</h3>
        </label>
        <div class="controls">
          <div class="input-append">
            <input class="span3" id="TicketID" type="text"
              placeholder="Enter your ticket ID" name="id"
            ><button class="btn btn-primary"  type="submit">Get Status</button>
            <span style="display:none;" class="help-inline">ID should be a 24 character alphanumeric value</span>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="modal-footer">
    
  </div>
</div>

  <div id="" class="span5">
  
  </div><!-- /TicketFormContainer -->
  <script >
    $(document).ready(function(){

      /*
        Un-closeable modal window.
      */
      $("#TicketFormContainer").modal({
         keyboard: false,
         backdrop:"static"
      }).on('hidden',function(){
        // Show the modal window again when hidden
        $(this).modal("show");
      });

      $("#GetTicketForm").submit(function(evt){
        // Regex for a 24 character alpha numeric string
        var reg = new RegExp("^[a-z0-9]{24}$");
        if(event.target.id.value.search(reg) === -1){
          $(event.target).find(".control-group").removeClass("success").addClass("error");
          $(event.target).find(".help-inline").show();
        } else {
          $(event.target).find(".control-group").removeClass("error").addClass("success");
          $(event.target).find(".help-inline").hide();
          var id=event.target.id.value;
          var href = window.location.href;
          window.location.href += href.charAt(href.length-1)==="/"?id:"/"+id;
        }
        // Cancel form submission
        return false;
      });
    });
  </script>
<?php else: ?>
<div id="TicketContainer" class="hero-unit">
    <h1>Your ticket is <?php echo $ticket["DynamicFormResponse"]["status"]; ?></h1>
</div><!-- /TicketContainer -->
<?php endif; ?>