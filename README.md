# Local Bus Management System

This is a local bus management system designed to facilitate the management of buses, routes, schedules, employees, and tickets for a local transportation service. The system is built using HTML, CSS, JavaScript, and PHP. Below is an overview of the database tables used in the system along with their respective fields.

## Database Tables

### `user`
- **id**: Unique identifier for the user
- **username**: Username of the user
- **phone**: Phone number of the user
- **email**: Email address of the user
- **usertype**: Type of the user (e.g., admin, employee, customer)
- **password**: Password of the user

### `depot`
- **depot_id**: Unique identifier for the depot
- **depot_name**: Name of the depot

### `bus`
- **bus_id**: Unique identifier for the bus
- **bus_name**: Name of the bus
- **model**: Model of the bus
- **capacity**: Seating capacity of the bus
- **ownership**: Ownership status of the bus
- **depot_id**: Identifier of the depot where the bus is stationed

### `employee`
- **emp_id**: Unique identifier for the employee
- **first_name**: First name of the employee
- **last_name**: Last name of the employee
- **dob**: Date of birth of the employee
- **type**: Type of employee (e.g., driver, conductor)
- **gender**: Gender of the employee
- **license_number**: License number of the employee (if applicable)
- **phone_no**: Phone number of the employee
- **salary**: Salary of the employee

### `route`
- **route_id**: Unique identifier for the route
- **start_point**: Starting point of the route
- **stop_point**: Ending point of the route
- **distance**: Distance covered by the route
- **no_of_Stops**: Number of stops in the route

### `schedule`
- **schedule_id**: Unique identifier for the schedule
- **route_id**: Identifier of the route associated with the schedule
- **start_time**: Departure time of the bus
- **stop_time**: Arrival time of the bus
- **bus_id**: Identifier of the bus scheduled for the route
- **c_id**: Identifier of the conductor assigned
- **d_id**: Identifier of the driver assigned

### `maintenance`
- **insurance_id**: Unique identifier for the insurance record
- **bus_id**: Identifier of the bus under maintenance
- **status**: Status of maintenance (e.g., pending, completed)
- **last_maintenance**: Date of the last maintenance
- **next_maintenance**: Date of the next maintenance

### `ticket`
- **ticket_id**: Unique identifier for the ticket
- **source_id**: Identifier of the source location
- **destination_id**: Identifier of the destination location
- **fare**: Fare of the ticket

### `stops`
- **stop_id**: Unique identifier for the stop
- **stop_name**: Name of the stop
- **route_id**: Identifier of the route associated with the stop

## Usage
- Ensure you have a compatible web server environment with PHP support.
- Import the provided SQL schema to set up the database.
- Configure the database connection in the PHP files as needed.
- Run the application and navigate through the provided interface to manage buses, routes, schedules, employees, and tickets.
- Login credentials are in the user table
