
jQuery ->
    $("#emailEmailForm").submit (event)->
        ret=false
        ret = confirm("Are you sure ?\nSend without a Subject ? ") if $(event.target).find("#emailSubject").val() is "" 
        ret = confirm("Are you sure ?\nSend without a Message body ? ") if $(event.target).find("#emailMessage").val() is ""
        ret
        false
    @