use information_schema
;

show tables
;

select table_name, table_rows 
from information_schema.tables
where table_schema = 'northwind'
;