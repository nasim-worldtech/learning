## run
-- php artisan db:seed --class=CategoriesTableSeeder
-- php artisan db:seed --class=PricesTableSeeder

SELECT YEAR, COUNT(id) 
FROM prices
GROUP BY YEAR;

CREATE INDEX idx_year ON prices (YEAR);
ALTER TABLE prices DROP INDEX idx_year; 

SHOW CREATE TABLE prices;
