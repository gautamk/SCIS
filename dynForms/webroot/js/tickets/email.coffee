
jQuery ->
    $("#emailEmailForm").submit (event) ->
        if $(event.target).find("#emailSubject").val() is "" 
            if confirm("Are you sure ?\nSend without a Subject ? ") isnt true
                return false
        if $(event.target).find("#emailMessage").val() is ""
            if confirm("Are you sure ?\nSend without a Message body ? ") isnt true
                return false
        true
    @