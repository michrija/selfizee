$(document).ready(function() {
    $("#id_photoListe").mpmansory(
				{
					childrenClass: 'kl_onePhoto', // default is a div
					columnClasses: 'padding', //add classes to items
					breakpoints:{
						lg: 3, 
						md: 3, 
						sm: 6,
						xs: 12
					},
					distributeBy: { order: false, height: false, attr: 'data-order', attrOrder: 'asc' }, //default distribute by order, options => order: true/false, height: true/false, attr => 'data-order', attrOrder=> 'asc'/'desc'
					onload: function (items) {
						//make somthing with items
					} 
				}
		);
});