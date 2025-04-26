Accounts Management Web Software:

Project Overview:
	A simple and lightweight Accounts Management Software developed using core PHP and MySQLi.
	This system allows users to add debit, credit, and transaction details, automatically calculates the balance, and stores all the financial records securely in a MySQL database.

Features:
	Add debit and credit entries.
	Save transaction details like description and date.
	Auto-calculate and display the current balance.
	Edit toggle button to edit/ delete any entry.
	View all transactions in a tabular format.
	Download button to download all the entries in .xlsx file.
	Simple and user-friendly interface.
	Data storage using MySQLi database.

Technologies Used:
	PHP (Core PHP)
	MySQLi (Database)
	HTML, CSS (for the front-end)
	Bootstrap (for front-end)
	JQuery
	Ajax
	JavaScript

How to Run the Project:
	Clone or download this repository.
	Import the provided SQL file (in Database folder) into your MySQL server (or manually create the required table).
	Update dbhandle.php or connection file with your database credentials.
	Run the project using XAMPP, WAMP, or any local server.
	Access it through your browser at: http://localhost/your-project-folder/

Note:
	Make sure your local server (like Apache and MySQL) is running.
	Always sanitize and validate user inputs for production-level projects