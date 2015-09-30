

Welcome: scripts made by frank mckechnie with some help form previous projects.
--------------------------------------------------------------------------------------

Database settings
--------------------------------------------------------------------------------------

Open the directory the file /core/init.php these details have to be changed. It could have 
been added to the command line to request a users specific database details but that was not 
requested.

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'localhost', // your server  sometimes local ip 127.0.0.1
        'username' => 'root', // database username
        'password' => '',     //database password
        'db' => 'your database'
    )
);

How to run through the cli: php run.php products.csv
--------------------------------------------------------------------------------------
Runs off the php cli, which will allow you to run a script you have within a directory. 

So in this case its C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\test. 
Once the command line has been opened redirect to the directory you place the files in
and run the method above. The application  only works with run.php and it only allows for
products.csv This is because I commented the functionality to create a table on the fly 
because it was not stated for this test.

// DB::getInstance()->createTable($this->tableName, $this->headerRow); // make a database table from the data



Logs 
--------------------------------------------------------------------------------------

Logs are located within the classes folder /classes/logs

Create database 
--------------------------------------------------------------------------------------

CREATE TABLE products (
entity_id INT(8) PRIMARY KEY, 
attribute_set_id INT(8), 
type_id VARCHAR(16), 
activation_information TEXT, 
color INT(3), 
color_value VARCHAR(8),
computer_manufacturers INT(3), 
computer_manufacturers_value VARCHAR(30),
contrast_ratio TEXT,
contrast_ratio_value TEXT, 
cost DECIMAL(10, 2),
country_orgin TEXT, 
cpu_speed TEXT, 
cpu_speed_value TEXT, 
created_at TIMESTAMP,
custom_design_from TEXT,
custom_design_to TEXT,
custom_layout_update TEXT, 
description TEXT, 
dimension TEXT, 
enable_googlecheckout TEXT,
finish TEXT, gallery TEXT, 
gender TEXT, 
gender_value TEXT, 
gift_message_available INT(2),
harddrive_speed TEXT,
hardrive TEXT,
has_options INT(2),
image TEXT, 
image_label TEXT,
in_depth TEXT,
is_recurring TEXT, 
links_exist TEXT, 
links_purchased_separately TEXT,
links_title TEXT,
manufacturer TEXT,
manufacturer_value TEXT, 
max_resolution TEXT, 
media_gallery TEXT, 
megapixels TEXT, 
megapixels_value TEXT, 
memory TEXT, 
meta_description TEXT, 
meta_keyword TEXT, 
meta_title TEXT, 
minimal_price DECIMAL(10, 2),
model TEXT,
msrp TEXT, 
msrp_display_actual_price_type TEXT, 
msrp_enabled TEXT, 
name TEXT, 
news_from_date TEXT, 
news_to_date TEXT, 
old_id TEXT, 
price TEXT, 
price_type TEXT, 
price_view TEXT, 
processor TEXT, 
ram_size TEXT, 
recurring_profile TEXT, 
required_options TEXT, 
response_time TEXT, 
room TEXT, 
room_value TEXT, 
samples_title TEXT, 
screensize TEXT, 
shape TEXT, 
shipment_type TEXT, 
shirt_size TEXT, 
shirt_size_value TEXT, 
shoe_size TEXT, 
shoe_size_value TEXT, 
shoe_type TEXT, 
shoe_type_value TEXT, 
short_description TEXT, 
sku TEXT, 
sku_type TEXT, 
small_image TEXT, 
small_image_label TEXT, 
special_from_date TEXT, 
special_price TEXT, 
special_to_date TEXT, 
tax_class_id TEXT, 
thumbnail TEXT, 
thumbnail_label TEXT, 
updated_at TIMESTAMP, 
url_key TEXT, 
url_path TEXT, 
visibility INT(2), 
weight DECIMAL(10, 2),
weight_type TEXT
)

