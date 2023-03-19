# SQLtoPHPClassGen
- Post the files at the root of your desired website
- Configure resources/class.database.php with your credentials
- In generator.php, replace YOURDOMAINNAME by your domaine name - to restrain ajax calls
- Browse YOURDOMAINNAME/generator.php
- Select the table you want to generate class
- Give a name to your class ('Client', 'Token', 'Cart'....)
- Give the unique term you will use for index
- Click generate !

3 files per table are created :
  - resources/class.YOURCLASS.php   <-- Define all fields and get/set methods
  - resources/class.YOURCLASSmanager.php  <-- Define the mains functions (select, insert, delete, update) 
  - call_YOURCLASS.php     <-- Your entry point for API calls
 
