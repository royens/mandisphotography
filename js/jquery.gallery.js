jQuery(function() {
    /* mode is small or expanded, depending on the picture size */
    var mode = 'small';
    /* this is the index of the last clicked picture */
    var current = 0;

    /* first, let's build the thumbs for the selected album */
    buildThumbs();

    /* clicking on a thumb loads the image */
    jQuery('#thumbs-container img').live('click', function() {
        loadPhoto(jQuery(this),'cursorPlus');
    }).live('mouseover', function() {
        var $this = jQuery(this);
        $this.stop().animate({
            'opacity':'1.0'
        },200);
    }).live('mouseout', function() {
        var $this = jQuery(this);
        $this.stop().animate({
            'opacity':'0.4'
        },200);
    });

    /* when resizing the window resize the picture */
    jQuery(window).bind('resize', function() {
        resize(jQuery('#displayed'),0);
    });

    /* When hovering the main image change the mouse icons
     * when clicking on image, epxand it or make it smaller depending 
     * on the current mode.
     */
    jQuery('#displayed').live('mousemove', function(e){
        var $this = jQuery(this);
        var imageWidth = parseFloat($this.css('width'),10);

        var x = e.pageX - $this.offset().left;
        if(x < (imageWidth / 3))
            $this.addClass('cursorLeft').removeClass('cursorPlus cursorRight cursorMinus');
        else if(x > (2 * (imageWidth / 3)))
            $this.addClass('cursorRight').removeClass('cursorPlus cursorLeft cursorMinus');
        else {
            if(mode == 'expanded' ) {
                $this.addClass('cursorMinus')
                .removeClass('cursorLeft cursorRight cursorPlus');
            }
            else if(mode == 'small') {
                $this.addClass('cursorPlus')
                .removeClass('cursorLeft cursorRight cursorMinus');
            }
        }
    }).live('click', function() {
        var $this = jQuery(this);
        if(mode == 'expanded' && $this.is('.cursorMinus')) {
            mode='small';
            $this.addClass('cursorPlus')
            .removeClass('cursorLeft cursorRight cursorMinus');
            jQuery('#thumbs-wrapper').stop().animate({
                'bottom':'0px'
            }, 300);
            jQuery('#portfolio-header').stop().animate({
                'top':'0px'
            }, 300);
            jQuery('#image-wrapper').stop().animate({
                'padding-top':'104px'
            },300);
            resize($this,1);
        }
        else if (mode=='small' && $this.is('.cursorPlus')) {
            mode='expanded';
            $this.addClass('cursorMinus')
            .removeClass('cursorLeft cursorRight cursorPlus');
            if(jQuery(window).height() <= 800) {
                jQuery('#portfolio-header').stop().animate({
                    'top':'-70px'
                },300);
            }
            jQuery('#thumbs-wrapper').stop().animate({
                'bottom':'-85px'
            },300);
            if(jQuery(window).height() <= 800) {
                jQuery('#image-wrapper').stop().animate({
                    'padding-top':'33px'
                },300);
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
        var countImages = jQuery('#thumbs-container img').size();
        jQuery('#thumbs-container img').each(function(){

            var $this = jQuery(this);
            ++count;
            if(count == 1) {
                /* load 1 image into container */
                jQuery('<img id="displayed" class="cursorPlus" style="display:block;" />').load(function(){
                    var $first = jQuery(this);
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
            var $img = jQuery(this);
            finalW += $img.width() + 5;
        });
        $elem.css('width', finalW + 'px').css('visibility','visible');
    }

    function loadPhoto($thumb,cursorClass) {
        current = $thumb.index()+1;
        jQuery('#image-wrapper').empty();
        jQuery('#loading').show();
        jQuery('<img id="displayed" class="cursorClass" style="display:none;" title="' + $thumb.attr('title') + '" />').load(function() {
            var $this = jQuery(this);
            jQuery('#loading').hide();
            resize($this,0);
            if(!jQuery('#image-wrapper').find('img').length) {
                jQuery('#image-wrapper').append($this.fadeIn(1000));
                jQuery('#description').html($this.attr('title'));
            }
        }).attr('src',$thumb.attr('alt'));
    }

    function makeScrollable($wrapper, $container, contPadding) {
        // Get menu width
        var divWidth = $wrapper.width();

        // Remove scrollbars
        $wrapper.css({overflow:'hidden'});

        // Find last image container
        var lastLi = $container.find('img:last-child');
        $wrapper.scrollLeft(0);
        //When user move mouse over menu
        $wrapper.unbind('mousemove').bind('mousemove',function(e) {

            // As images are loaded ul width increases,
            // so we recalculate it each time
            var ulWidth = lastLi[0].offsetLeft + lastLi.outerWidth() + contPadding;

            var left = (e.pageX - $wrapper.offset().left) * (ulWidth-divWidth) / divWidth;
            $wrapper.scrollLeft(left);
        });
    }

    function resize($image, type) {
        var widthMargin = 10;
        var heightMargin = 0;
        var winHeight = jQuery(window).height();
        var winWidth = jQuery(window).width();
        console.log( 'Width ' + winWidth + ' Height ' + winHeight );

        if(mode == 'expanded' && winHeight <= 800) {
            console.log( 'inside height <= 800' );
            heightMargin = 62;
        }
        else if(mode == 'expanded' && winHeight > 800) {
            console.log( 'inside height > 800' );
            heightMargin = 180;
        }
        else if(mode == 'small') {
            console.log( 'inside mode is small' );
            heightMargin = 220;
            }

        //type 1 is animate type 0 is normal
        var windowH = winHeight-heightMargin;
        var windowW = winWidth-widthMargin;
        console.log( 'Changed Width ' + windowW + ' Changed Height ' + windowH );
        var theImage = new Image();
        theImage.src = $image.attr("src");
        var imgwidth = theImage.width;
        var imgheight = theImage.height;

        if((imgwidth > windowW) || (imgheight > windowH)) {
            if (imgwidth > imgheight){
                var newwidth = windowW;
                var ratio = imgwidth / windowW;
                var newheight = imgheight / ratio;
                theImage.height = newheight;
                theImage.width = newwidth;
                if(newheight > windowH) {
                    var newnewheight = windowH;
                    var newratio = newheight / windowH;
                    var newnewwidth = newwidth / newratio;
                    theImage.width = newnewwidth;
                    theImage.height = newnewheight;
                }
            }
            else {
                var newheight = windowH;
                var ratio = imgheight / windowH;
                var newwidth = imgwidth / ratio;
                theImage.height = newheight;
                theImage.width = newwidth;
                if(newwidth > windowW) {
                    var newnewwidth = windowW;
                    var newratio = newwidth / windowW;
                    var newnewheight = newheight / newratio;
                    theImage.height = newnewheight;
                    theImage.width = newnewwidth;
                }
            }
        }
        if((type==1) && (!jQuery.browser.msie))
            $image.stop(true).animate({
                'width':theImage.width+'px',
                'height':theImage.height+'px'
            },1000);
            else 
            $image.css({
                'width':theImage.width+'px',
                'height':theImage.height+'px'
            });
    }
});
