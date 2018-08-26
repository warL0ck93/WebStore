<script>
    
    $(document).on('click', ".one-click", function(e){

    if($(this).data('lastClick') + 1000 > new Date().getTime()){

        e.stopPropagation();
        return false;
    }
    $(this).data('lastClick', new Date().getTime());
    return true;

});
</script>