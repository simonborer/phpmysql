# Bugs/Missing requirements
- Validation
	- Currently no server-side validation
	- Database validation
		- include in pull request as a .sql file
		- Triggers, stored procedures, or annotated ER diagrams
	- min/max not firing event on input[type=date]
	- Currently no enforcement of shift length standards (by day or week)
- Error handling - sketchy at best!

# Features
- Additional pages
	- It would be nice to see a 'menu' for the bakery
	- Archive of transactions
- Could we break the table into two, one for each location?
- Could we duplicate the table for each week that has a shift?
- Could we see an 'archive' table of past shifts?
- Currently alphabetized by first name, not great
- Add functionality for updating or deleting shifts
- Can we visualize this as a calendar rather than a table?
