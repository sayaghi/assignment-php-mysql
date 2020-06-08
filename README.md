# assignment-php-mysql
The assignment is to create a very basic shopping site and for that I have used php with mysql. 

The aim of the assignment is to have a shopping site that has the following features.

➢	User Sign up and Sign in

➢	List items available in the shop

➢	Add items to cart of the user who has currently logged in

➢	Show the total amount and no. Of items during checkout

➢	Items in the cart should be saved for later checkout option

To achieve the above a database with the following tables would be useful. Please look into the shopsmart.sql file for details on creation of tables and adding records,etc.

➢	user - basic user details

➢	products - products availble in shop

➢	purchase - transaction table for all user purchases

➢	cart - cart details saved for checkout later option

I have added 7 php scripts to manage the data and front end.

➢	welcome.php - General login page. In case login fails you can retry or register.

➢	register.php - Registration page which on successful registration takes you to the welcome page for login.

➢	index.php - User is taken to this page on successful login, where a list of available products are displayed which can be added to the cart or removed at anytime. Option to empty cart at anytime is available. The user's previous cart left for checkout later is retrieved and displayed.

➢	dbcontroller.php - script used by index.php and other files for connecting to the database and querying the database.

➢	checkout.php - User is taken to this page on checking out cart items from the index page. The user can buy items from cart or logout from here as a result of which the cart items are saved for checkout later.

➢	logout.php - Ends the user's session updates cart info in database and provides option for login again.

➢	user_details.php - API for accessing user details and purchase history as a JSON object. Input is taken using GET.
Input taken from url. Eg: https://localhost/user_details.php?uid=1&auth=$2y$10$Rmcydolzwot6xZKfQFlFnumrrPoIlsHsbBc/SjaMIvF8uYglH9bVm
