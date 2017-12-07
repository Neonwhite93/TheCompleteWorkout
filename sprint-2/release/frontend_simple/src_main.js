/*
	Creators: Halie Carton, Nate Spence
	Modified: 9/13/2017
	
	JavaScript content corresponding to src_main.html
	
	-- handles behavior of accordions for exercise categories
	   so that accordions open in a mutually exclusive way.
*/


/* ------------------------------------------------------------
ACCORDION CONTENT
------------------------------------------------------------ */

/*
	Fill array with all accordions.
	Increment through array and set up onclick 
	event binding, so that accordions will open. 
*/

// create accordions array
var accordions = document.getElementsByClassName("accordion");

// iterate through accordions array, binding onclick event
// to target opening/closing behavior
for (i = 0; i < accordions.length; i++) 
{
	accordions[i].onclick = function()
	{
		toggle_accordion(this);
	
		/*
			Make only one accordion openable at a time...

			On open outer_accordion class,
			close all accordions except the opened accordion.

			On open inner_accordion class,
			close all inner_accordions except the opened accordion.
		*/
		for (i = 0; i < accordions.length; i++) 
		{
			var accord = accordions[i];
			
			// we don't want to collapse ourself 
			// immediately upon trying to open...
			if(accord != this)
			{
				// if any other accord is open, close it
				// note that this depends on the first class in the accordion's
				// classList array being "active"
				if(accord.classList.length > 0 && accord.classList[1] == "active")
				{
					toggle_accordion(accord);
				}
			}
		}
		
	};
}

/* Toggles the passed accordion object open or closed. */
function toggle_accordion(accordion)
{
	accordion.classList.toggle("active");
		
	var panel = accordion.nextElementSibling;
		
	if (panel.style.display === "block") 
	{
		panel.style.display = "none";
	}
	else 
	{
		panel.style.display = "block";
	}
}