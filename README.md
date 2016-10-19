**Trip Sorter**
-
This project attempts to solve the development test titled Trip Sorter located at 
http://promo.propertyfinder.ae/devtest/ by propertyfinder.ae.

Steps to execute the test:
-
1. Run the following command:
2. `$ composer dump-autoload`
3. Execute index.php file:
    * `$ php index.php`
    * Or through a browser if the project is located at localhost, for e.g.
    * http://localhost/trip-sorter/index.php
  
Steps to test against a very large input:
-
1. Open generate_input.php
2. Update the value of constant `INPUT_SIZE`
3. Execute generate_input.php script 
4. After the previous step, large.csv file should be populated with dummy boarding cards 
   of various types in a random order to create one single journey
5. Replace `'input.csv'` with `'large.csv'` in index.php file on line 15
6. Execute index.php file

Steps to extend the API for new types of transportation:
-
1. Create a new class under `\PropertyFinder\BoardingCards` that extends the abstract 
   class `\PropertyFinder\BoardingCards\BoardingCard`
2. The constructor accepts an array of fields. The array is NOT an associative array. The positions 0, 1 and 2 are 
   are reserved for mode of transportation, source and destination respectively. Hence, the data specific to this mode 
   of transportation should begin from position 3 onwards.
3. Implement the `getMessage()` method that returns back a description about the boarding card 
4. Add the case for this new mode of transportation in `createBoardingCard` method 
   in `\PropertyFinder\BoardingCards\BoardingCardFactory`

Algorithm performance:
-
Cards | Time (in milliseconds)
--- | ---
10 Cards | 0.2 
100 Cards | 1 
1000 Cards | 8 
10,000 Cards | 80 
100,000 Cards | 950 

* The sorting algorithm is implemented in `\PropertyFinder\TripSorter`

Author
-
* Juzer Shabbir Husain (https://www.linkedin.com/in/juzershabbirhusain)

