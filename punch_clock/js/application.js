/*
 * Copyright (C) 2010 Envato
 * http://net.tutsplus.com/tutorials/javascript-ajax/using-jquery-to-manipulate-and-filter-data/
 *
 * Author: Noah Hendrix
 *
 * Noah is a Computer Science student at the University of Kansas. His
 * interests include web development in PHP/MySQL and Ruby on Rails.
 * He obsessively follows Tech Startups and has been known to have his
 * own entrepreneurial ambitions. His development environment of choice
 * is Mac OSX using a combination of TextMate and Coda.
 *
 * Find out more about him on twitter (@noahhendrix) or facebook.com/noahhendrix.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY. YOU USE AT YOUR OWN RISK. THE AUTHOR
 * WILL NOT BE LIABLE FOR DATA LOSS, DAMAGES, LOSS OF PROFITS OR ANY
 * OTHER  KIND OF LOSS WHILE USING OR MISUSING THIS SOFTWARE.
 */

$(document).ready(function() {
	zebraRows('tr:odd td', 'odd');
	
	$('tbody tr').hover(function(){
	  $(this).find('td').addClass('hovered');
	}, function(){
	  $(this).find('td').removeClass('hovered');
	});
	
	//default each row to visible
	$('tbody tr').addClass('visible');
	
	//overrides CSS display:none property
	//so only users w/ JS will see the
	//filter box
	$('#search').show();
	
	$('#filter').keyup(function(event) {
		//if esc is pressed or nothing is entered
    if (event.keyCode == 27 || $(this).val() == '') {
			//if esc is pressed we want to clear the value of search box
			$(this).val('');
			
			//we want each row to be visible because if nothing
			//is entered then all rows are matched.
      $('tbody tr').removeClass('visible').show().addClass('visible');
    }

		//if there is text, lets filter
		else {
      filter('tbody tr', $(this).val());
    }

		//reapply zebra rows
		$('.visible td').removeClass('odd');
		zebraRows('.visible:even td', 'odd');
	});
	
	//grab all header rows
	$('thead th').each(function(column) {
		$(this).addClass('sortable')
					.click(function(){
						var findSortKey = function($cell) {
							return $cell.find('.sort-key').text().toUpperCase() + ' ' + $cell.text().toUpperCase();
						};
						
						var sortDirection = $(this).is('.sorted-asc') ? -1 : 1;
						
						//step back up the tree and get the rows with data
						//for sorting
						var $rows		= $(this).parent()
																.parent()
																.parent()
																.find('tbody tr')
																.get();
						
						//loop through all the rows and find 
						$.each($rows, function(index, row) {
							row.sortKey = findSortKey($(row).children('td').eq(column));
						});
						
						//compare and sort the rows alphabetically
						$rows.sort(function(a, b) {
							if (a.sortKey < b.sortKey) return -sortDirection;
							if (a.sortKey > b.sortKey) return sortDirection;
							return 0;
						});
						
						//add the rows in the correct order to the bottom of the table
						$.each($rows, function(index, row) {
							$('tbody').append(row);
							row.sortKey = null;
						});
						
						//identify the column sort order
						$('th').removeClass('sorted-asc sorted-desc');
						var $sortHead = $('th').filter(':nth-child(' + (column + 1) + ')');
						sortDirection == 1 ? $sortHead.addClass('sorted-asc') : $sortHead.addClass('sorted-desc');
						
						//identify the column to be sorted by
						$('td').removeClass('sorted')
									.filter(':nth-child(' + (column + 1) + ')')
									.addClass('sorted');
						
						$('.visible td').removeClass('odd');
						zebraRows('.visible:even td', 'odd');
					});
	});
});


//used to apply alternating row styles
function zebraRows(selector, className)
{
	$(selector).removeClass(className)
							.addClass(className);
}

//filter results based on query
function filter(selector, query) {
	query	=	$.trim(query); //trim white space
  query = query.replace(/ /gi, '|'); //add OR for regex
  
  $(selector).each(function() {
    ($(this).text().search(new RegExp(query, "i")) < 0) ? $(this).hide().removeClass('visible') : $(this).show().addClass('visible');
  });
}
