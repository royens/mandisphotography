jQuery(function() {
    /* mode is small or expanded, depending on the picture size */
    var mode = 'small';
    /* this is the index of the last clicked picture */
    var current = 0;

    /* first, let's build the thumbs for the selected album */
    buildThumbs();

    /* clicking on a thumb loads the image */
    jQuery('#thumbs-container img').live('click', function() {
        loadPhoto($(this),'cursorPlus');
    }).live('mouseover', function() {
        var $this = $(this);
        $this.stop().animate({'opacity':'1.0'},200);
    }).live('mouseout', function() {
        var $this = $(this);
        $this.stop().animate({'opacity':'0.4'},200);
    });

    $(window).bind('resize', function() {
        resize($('#displayed'),0);
    });

    jQuery('#displayed').live('mousemove', function(e){
        var $this = $(this);
        var imageWidth = parseFloat($this.css('width'),10);

        var x = e.pageX - $this.offset().left;
        if(x < (imageWidth / 3))
            $this.addClass('cursorLeft').removeClass('cursorPlus cursorRight cursorMinus');
        else if(x > (2 * (imageWidth / 3)))
            $this.addClass('cursorRight').removeClass('cursorPlus cursorLeft cursorMinus');
        else {
            if(mode == 'expanded' ) {
                $this.addClass('cursorMinus').removeClass('cursorLeft cursorRight cursorPlus');
            }
            else if(mode == 'small') {
                $this.addClass('cursorPlus').removeClass('cursorLeft cursorRight cursorMinus');
            }
        }
    }).live('click', function() {
        var $this = $(this);
        if(mode == 'expanded' && $this.is('.cursorMinus')) {
            mode='small';
            $this.addClass('cursorPlus')
            .removeClass('cursorLeft cursorRight cursorMinus');
            jQuery('#thumbs-wrapper').stop().animate({
                'bottom':'0px'
            }, 300);
            jQuery('#header-portfolio').stop().animate({
                'top':'0px'
            }, 300);
            jQuery('#image-wrapper').stop().animate({
                'padding-top':'96px'
            },300);
            resize($this,1);
        }
        else if (mode=='small' && $this.is('.cursorPlus')) {
            mode='expanded';
            $this.addClass('cursorMinus').removeClass('cursorLeft cursorRight cursorPlus');
            if($(window).height() < 800) {
                jQuery('#header-portfolio').stop().animate({
                    'top':'-70px'
                },300);
            }
            jQuery('#thumbs-wrapper').stop().animate({
                'bottom':'-85px'
            },300);
            if($(window).height() < 800) {
                jQuery('#image-wrapper').stop().animate({
                    'padding-top':'25px'
                }.300);
            }
            resize($this,1);
        }
        else if($this.is('.cursorRight')) {
            var $thumb = jQuery('#thumbs-container img:nth-child('+parseInt(current+1)+')');
            if($thumb.length) {
                ++current;
                loadPhoto($thumb, 'cursorRight');
            }
        }
        else if($this.is('.cursorLeft')) {
            var $thumb = jQuery('#thumbs-container img:nth-child('+parseInt(current-1)+')');
            if($thumb.length) {
                --current;
                loadPhoto($thumb, 'cursorLeft');
            }
        }
    });

    function buildThumbs() {
        current=1;
        jQuery('#image-wrapper').empty();
        jQuery('#loading').show();

        var count=0;
        var countImage = jQuery('#thumbs-container img').size();
        jQuery('#thumbs-container img').each(function(){

            var $this = $(this);
            ++count;
            if(count == 1) {
                /* load 1 image into container */
                jQuery('<img id="displayed" class="cursorPlus" style="display:block;" />').load(function(){
                    var $first = $(this);
                    jQuery('#loading').hide();
                    resize($first,0);
                    jQuery('#image-wrapper').append($first);
                    jQuery('#description').html($this.attr('title'));
                }).attr('src', $this.attr('alt'));
            }
            if(count == countImages) {
                thumbsDim(jQuery('#thumbs-container'));
                makeScrollable(jQuery('#thumbs-wrapper'), jQuery('#thumbs-container'), 15);
            }
        });
    }

    function thumbsDim($elem){
        var finalW = 0;
        $elem.find('img').each(function(i) {
            var $img = $(this);
            finalW += $img.width() + 5;
        });
        $elem.css('width', finalW+'px').css('visibility','visible');
    }
