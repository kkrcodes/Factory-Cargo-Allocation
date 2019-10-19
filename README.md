# Factory-Cargo-Allocation
 A web-based factory cargo allocation system made in PHP to fetch allocated cargo efficiently in a factory.
 
 How it works
 ------------
 <ul>
 <li>Records of cargo available in the factory is stored in the database.</li>
 <li>Whenever a factory worker needs a certain item of a specified quantity, he searches the factory cargo allocation system for the item specifying the required quantity.</li>
 <li>The factory cargo allocation system acts as the interface between the worker and the database, searches for the item in the database, and allots the required quantity of the item detailing the box numbers of the cargo to be picked up.
 <li>The system issues a warning if the item or required quantity is not available.</li>
 </ul>
 
