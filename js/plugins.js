var $ = jQuery.noConflict();

$.fn.extend({
  	organizeFeaturedCarousel: function(options) {
        var settings = {
        };
        settings = jQuery.extend(settings, options);

        return this.each(function() {
        	var listView = $(this);
        	var carousel = $('.featured-carousel');
        	listView.find('.list-view-item').appendTo(carousel);
        	listView.remove();
        	carousel.slick({
			    autoplay: true,
			    autoplaySpeed: 4000,
			    arrows: true,
			    centerMode: true,
			    centerPadding: '60px',
			    inifinite: true,
			    slidesToShow: 3,
			    dots: true
		    });
        });
 	}
});

$.fn.extend({
    organizeListView: function (options) {
    	var settings = {
    	};
    	settings = jQuery.extend(settings, options);

    	return this.each(function(){
    		var listView = $(this);
    		listView.find('.calendar').insertAfter(listView);

    		listView.children('.list-view-item').each(function() {
	    		var listItem = $(this);
	    		var dateTimeDiv = $('<div>', { class: 'show-times' });
	    		listItem.prepend(dateTimeDiv);
	    		dateTimeDiv.prepend(listItem.find('.dates, .times'));
	    		listItem.find('.ticket-price').addClass('text-center');
    		});
    	});
	}
});


$.fn.extend({
  	dropdownToggle: function(options) {
        var settings = {
        	'toggle': '#dropdown-toggle',
        	'dropdown': '#dropdown',
        };
        settings = jQuery.extend(settings, options);

        return this.each(function() {
        	var toggle = $(settings.toggle);
        	var dropdown = $(settings.dropdown);

        	toggle.click(function(e) {
	            e.preventDefault();
	            toggle.toggleClass('open');
	            dropdown.slideToggle();
        	});
        });
 	}
});

$.fn.extend({
  	OrganizeEventDetailPage: function(options) {
        var settings = {
        };
        settings = jQuery.extend(settings, options);

        return this.each(function() {
        	var $ = jQuery; // fixes $ conflict on EDP
        	var eventDetails = $('#primary');

        	eventDetails.find('.event-detail > img').wrap("<div class='event-image'></div>");


        	// Move Share items to sidebar and re-format
        	var sidebar = $('.sidebar');
        	var ticketDiv = $('.ticket-price');
        	ticketDiv.prependTo(sidebar);
        	ticketDiv.find('a').addClass('button');
        	ticketDiv.find('.price-range').appendTo(ticketDiv);

        	var oldShareBox = eventDetails.find('#toolbox');
        	oldShareBox.detach();
        	var shareBox = $('.shares');
        	var toolbox = shareBox.children('#toolbox');
        	oldShareBox.find('h4').prependTo(shareBox);
        	oldShareBox.find('.share-facebook a')
        		.appendTo(toolbox)
         		.addClass('button success tiny')
        		.wrap('<li>')
        		.html('<i class="fa fa-facebook"></i>');

        	oldShareBox.find('.share-twitter a')
        		.appendTo(toolbox)
        		.addClass('button success tiny')
        		.wrap('<li>')
        		.html('<i class="fa fa-twitter"></i>');

        	var calSync = $('.calendars .button-group');

        	$(eventDetails).find('.ical-sync a')
        		.appendTo(sidebar.find('.ical'))
        		.addClass('button success tiny')
        		.html('<i class="fa fa-calendar-o"></i> <span>iCal</span>');
        	
        	$(eventDetails).find('.gcal-sync a')
        		.appendTo(sidebar.find('.gcal'))
        		.addClass('button success tiny')
        		.html('<i class="fa fa-calendar-o"></i> <span>Google Calendar</span>');


        	// Create links out of artist names
        	var artistBoxes = $('.artist-boxes');
	        artistBoxes.find('.links a')
	        	.addClass('more')
	        	.prepend('<i class="fa fa-caret-right"></i>');
	        
	        artistBoxes.find('.artist-box-support').addClass('artist-box-headliner');
	        var sidebarNav = sidebar.find('.sub-nav');

	        artistBoxes.find('.artist-box-headliner').each(function(){
	        	var artist = $(this);
	        	var artistName = artist.find('.artist-name').text();
	        	var artistStr = (artistName.replace(/[^a-zA-Z 0-9]+/g, '').replace(/ /g,'')).toLowerCase();
	        	artist.attr('id', artistStr);
	        	artist.attr('data-magellan-destination', artistStr);
	        	var navItem = $('<a>', { href: ('#' + artistStr),
	        							text: artistName });
	        	navItem.appendTo(sidebarNav).wrap('<li>');
	        	navItem.parent().attr('data-magellan-arrival', artistStr);
	        });
        });
 	}
});


$.fn.extend({
    toggleAccordionIcons: function (options) {
        var settings = {
          accordionSelector: '.accordion-navigation',
          activeIconClass: 'fa-minus',
          inactiveIconClass: 'fa-plus'
        };
        settings = jQuery.extend(settings, options);

        return this.each(function(){
        	var container = $(this);
        	var allAccordions = container.find(settings.accordionSelector);
        	var toggleIndicators = allAccordions.find('i');

			container.on('toggled', function (event, accordion) {
				toggleIndicators.removeClass(settings.activeIconClass).addClass(settings.inactiveIconClass);
				container.find('.active i').addClass(settings.activeIconClass);
			});
        });
    }
});  