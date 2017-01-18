<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.getmdl.io/1.1.3/material.min.js" async></script>

<script>
  $(function(){
    $('.mdl-accordion__content').each(function(){
      var content = $(this);
      content.css('margin-top', -content.height());
    });

    $(document.body).on('click', '.mdl-accordion__button', function(){
      $(this).parent('.mdl-accordion').toggleClass('mdl-accordion--opened');
    });
  });
</script>

<script>
    $(function() {
        $('#search-field').keydown(function(){
            var keyword = $('#search-field').val();
            $('#search-form').attr('action', '<?php print URL ?>keres/' + keyword);
        });
    });
</script>

