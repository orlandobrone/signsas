<html>
<head>
<!-- mapa -->
<!-- css -->						
<link href="css/jplist.css" rel="stylesheet" type="text/css" />
<link href="css/jlocator.css" rel="stylesheet" type="text/css" />

<!-- jlocator is based on jplist plugin: http://jplist.no81no.com -->
<script src="js/jplist.min.js"></script>	

<!-- jlocator -->		
<script src="http://maps.google.com/maps/api/js?sensor=false&libraries=places,geometry"></script>
<script src="js/jlocator.min.js"></script>

<!-- for IE 7: json support and ie 7 style -->
<!--[if lt IE 8]>
<script src="js/json2.min.js"></script>
<![endif]-->

<script type='text/javascript'>	
   $('document').ready(function(){				
      $('#jlocator').jlocator();
   });
</script>      
</head>
<body>
<!-- STORE LOCATOR DEMO -->
<div id="jlocator">

   <!-- panel -->
   <div class="panel" data-type="panel">
   
      <!-- controls -->
      <div class="controls" data-type="controls">
      
         <div class="box">
            <div 
               class="drop-down left" 
               data-control-type="drop-down" 
               data-control-name="sort" 
               data-control-action="sort"
               data-datetime-format="{month}/{day}/{year}"> <!-- {year}, {month}, {day}, {hour}, {min}, {sec} -->
               
               <ul>
                  <li><span data-path="default">Sort by</span></li>
                  <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
                  <li><span data-path=".title" data-order="desc" data-type="text">Title Z-A</span></li>
               </ul>
            </div>
            
            <input 
               class="autocomplete left"
               data-control-type="autocomplete" 
               data-control-name="autocomplete" 
               data-control-action="filter"
               data-radius="100000" 
               type="text"
               placeholder="Enter a location"
            /><!-- data-radius in meters -->
         </div>
         
         <div class="box">
         
            <!-- checkbox filters -->
            <div 
               class="cb-group-filter left"
               data-control-type="checkbox-group-filter"
               data-control-action="filter"
               data-control-name="themes-art">
               
               <div class="cb">
                  <input 			
                     data-path=".art" 									
                     id="art" 
                     type="checkbox" 									
                  />
                  <label for="art">Art</label>
               </div>										
            </div>
            
            <!-- checkbox filters -->
            <div 
               class="cb-group-filter left"
               data-control-type="checkbox-group-filter"
               data-control-action="filter"
               data-control-name="themes-history">
               
               <div class="cb">
                  <input 
                     data-path=".history"									
                     id="history" 
                     type="checkbox" />
                  <label for="history">History</label>
               </div>									
            </div>
            
         </div>
         
         <div class="box">
         
            <!-- paging -->
            <div 
               class="paging-results left" 
               data-type="Page {current} of {pages}" 
               data-control-type="label" 
               data-control-name="paging" 
               data-control-action="paging"></div>
               
            <div 
               class="paging left" 
               data-control-type="placeholder" 
               data-control-name="paging" 
               data-control-action="paging"
               data-items-per-page="5"></div>
            </div>
      </div>
      
      <!-- store list -->
      <div class="stores box" data-type="stores">
         
         <!-- store -->
         <div 
            data-type="store" 
            class="store box"
            data-latitude="39.8252813" 
            data-longitude="-86.1857915">
            <p class="art">
               <span class="title" data-type="title">Indianapolis Museum of Art</span>,<br>
               <span data-type="address">4000 Michigan Road</span>,<br>
               <span data-type="city">Indianapolis</span>,<br>
               <span data-type="state">Indiana</span>,<br>
               <!--span data-type="zipcode"></span><br/-->
               <span data-type="country">United States</span><br/>
               <span class="tags">Tags: Art</span>
            </p>
         </div>
         
         <!-- store -->
         <div 
            data-type="store" 
            class="store box"
            data-latitude="40.7609666" 
            data-longitude="-73.97723259999998">
            <p class="art">
               <span class="title" data-type="title">The Museum of Modern Art</span>,<br>
               <span data-type="address">11 West 53 Street</span>,<br>
               <span data-type="city">New York</span>,<br>
               <span data-type="state">NY</span> 
               <span data-type="zipcode">10019</span>,<br>
               <span data-type="country">United States</span><br/>
               <span class="tags">Tags: Art</span>
            </p>
         </div>
         
         ...
         
      </div>
      
      <!-- no results -->
      <div class="box no-results" data-type="no-results">
         <p>No results found</p>
      </div>
      
   </div>
   
   <!-- map -->
   <div class="map" data-type="map"></div>
   
</div>
<!-- end of STORE LOCATOR DEMO -->
</body>
</html>