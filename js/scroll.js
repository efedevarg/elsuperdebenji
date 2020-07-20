$(document).scroll(function(){
    
    //En función del scroll se añade una class u otra
    $('.navbar').toggleClass('notScrolled', $(this).scrollTop() < $('.navbar').height() || $(this).scrollTop() == 0);
    $('.navbar').toggleClass('scrolled', $(this).scrollTop() > $('.navbar').height());
});
