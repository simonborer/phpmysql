<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'bakery_col');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
<!--We worked together: Artem Nahornyi n01261269 and Mykyta Vakulov n01301380-->

<!--I don't know what is the progbelem but we tried to insert new timetable and it is not work for us as a second time.
First time when we tried to add something it works and second - no.  -->
<!--Our tables below-->

<!--CREATE TABLE bakery_col.bakery_locations (
    location_id    int   PRIMARY KEY,
    address        VARCHAR(40)
);

CREATE TABLE bakery_col.bakery_employees (
    employee_id     int(4)   PRIMARY KEY,
    default_loc     int(4),
    foreign key (default_loc) references bakery_locations(location_id),
    first_name      VARCHAR(20),
    last_name       VARCHAR(20),
    employee_type   VARCHAR(10)
);
CREATE TABLE  bakery_col.bakery_shifts (
    shift_id        int(6)   PRIMARY KEY,
    employee_id     int(4),
    foreign key (employee_id) references bakery_employees(employee_id),
    location_id     int(4),
    foreign key (location_id) references bakery_locations(location_id),
    shift_date     DATE,
    start_time      TIME,
    end_time        TIME
);
drop table bakery_shifts
insert into bakery_col.bakery_locations(location_id, address)
values(1, "West")

insert into bakery_col.bakery_employees(employee_id, default_loc, first_name, last_name, employee_type)
values(3, 2, "Joy", "Moy", "Baker")

insert into bakery_col.bakery_shifts(shift_id, employee_id, location_id, shift_date, start_time, end_time)
values(1, 1, 1, '2018-12-25', '00:00:00', '05:00:00')

insert into bakery_col.bakery_shifts(shift_id, employee_id, location_id, shift_date, start_time, end_time)
values(3, 3, 1, '2018-12-25', '05:00:00', '10:00:00')

CREATE OR REPLACE VIEW schedule 
AS select
    concat(e.first_name, ' ', e.last_name) AS name,
    e.employee_type AS employee_type,
    l.address AS address,
    date_format(s.start_time, '%b %e') AS day,
    date_format(s.start_time, '%k:%i') AS start,
    date_format(s.end_time, '%k:%i') AS end
from
    ((bakery_shifts s
join bakery_employees e on
    ((s.employee_id = e.employee_id)))
join bakery_locations l on
    ((s.location_id = l.location_id)))
    -->