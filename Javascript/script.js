$(document).ready(function(){
    
    $('#contact-form').submit(function(e){
        
        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#contact-form').serialize();
        
        $.ajax({
            
            type : 'POST',
            url : 'php/contact.php',
            data : postdata,
            dataType : 'json',
            success : function(result){
                 
                if(result.isSuccess){
                    $("#contact-form").append("<p class='thank-you'>Votre message a bien été envoyé. Merci de m'avoir contacté.</p>");
                    $("#contact-form")[0].reset();
                }else{
                    $("#firstname + .comments").html(result.firstnameError);
                    $("#name + .comments").html(result.nameError);
                    $("#email + .comments").html(result.emailError);
                    $("#phone + .comments").html(result.phoneError);
                    $("#message + .comments").html(result.messageError);
                }
                
            },
            
        })
        
    });
    
    $("#hobbies .card-body").hide();
    
    $("#hobbies #card1 .card-header").hover(function(){
        $("#hobbies #card1 .card-body").slideToggle(500);
    
    });
    
    $("#hobbies #card2 .card-header").hover(function(){
        $("#hobbies #card2 .card-body").slideToggle(500);
    
    });
    
    $("#hobbies #card3 .card-header").hover(function(){
        $("#hobbies #card3 .card-body").slideToggle(500);
    
    });
    
    $("#hobbies #card4 .card-header").hover(function(){
        $("#hobbies #card4 .card-body").slideToggle(500);
    
    });
    
    
    $(".navbar a, footer a").on("click", function(event){
    
        event.preventDefault();
        var hash = this.hash;
        
        $('body,html').animate({scrollTop: $(hash).offset().top} , 900 , function(){window.location.hash = hash;})
        
    });
    
})