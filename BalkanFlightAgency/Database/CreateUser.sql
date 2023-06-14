create user 'helper'@'localhost'
identified by 'vmm_123';

grant INSERT, SELECT
on book_flights.*
to 'helper'@'localhost';