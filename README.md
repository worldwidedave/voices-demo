# Voices.com demo application

## Overview
This application is written to demonstrate web development proficency.  As per instructions, no libraries where used outside of the lamp stack.  (I did end up needing to use mysqli, sorry)
## Folder/File Structure

 - **files**  - where files will be uploaded to, named via the id of the request
 - **html** - web hosting folder
 -- index.html
 -- **config** - contains configurations
 --- config.php  - configuration of db connection information
 -- **css**
 --- index.css
 --- theme.css - theme/fake library (common styling)
 -- **js**
 --- index.js
 -- **lib**
 --- db.php - database api
 -- **mvc**
 --- index.php - fake model controller
 - **sql**
 -- schema.sql - the schema to be loaded into the db
 -- data.sql - database instantiation data
  - docker-compose.yml
 - Dockerfile
 ## Database Tables
 
|  Request  | |
|--|--|
| id | unique identifier |
| name | name of the project |
| script | contains the script |
| country_id | link to country table |
| state_id | link to state table |
| filename | name of uploaded file |
| budget_id | link to budget table |

|  Country  | |
|--|--|
| id | unique identifier |
| name | country name |
| active | boolean to disable countries |

|  State  | |
|--|--|
| id | unique identifier |
| name | country name |
| country_id | link to associated country id (not used currently)|
| active | boolean to disable states/provinces |

|  Budget | |
|--|--|
| id | unique identifier |
| minumum | minimum budget |
| maximum | maximum budget |
| active | boolean to disable budgets |
## Running the application
Note: Must have docker installed.
 1. Checkout the repo to a local folder
 2. From within the folder, execute docker-compose up -d
 3. Access the page via http://localhost
 4. Database access phpadmin via http://localhost:8080 (root/password)

# Commentary
Many aspects of this program are not or only partially implemented, given this is a demo application.  The following outlines some of the points that have not been completely addressed.  Many of the interface and backend complexities would be resolved by using 3rd party libraries like BOOTSTRAP!!!
Cost/Benefit/Time was very much an aspect to deciding what to work on and what not to.
### Setup
 1. The configuration for docker is not ideal, but this was my first time using docker.
 2. There is an issue with the sql load where for some reason, the script field needed to be manually added after the deployment.
### Interface
1. All configurations should be sent from the config.php to the ux, such as max file size.
2. Responsiveness is solely for demonstration, and are not as pretty as they could be.
3. The inputs should be tested for acceptable characters
4. The paste event needs to be captured to address the above
5. Country to Province association should be implemented (but not for a demo...)
6. The browse file has no way to clear the file selection.
7. The budget is not perfectly aligned as I didn't want to juggle flexbox
8. The budget does not have a focus class to highlight it.
9. Dialog boxes should be replaced by pretty modals for confirmations
10. Some fading in and out would be nice after clicking submit
11. No accomodation has been made for localization 
### Server Side
1. Data is not validated (uploaded file size, escaping of characters)
2. I did not know how to access mysql without using a library.  I installed mysqli library.
3. Unit tests would have been pointless given the size and purpose of the application.
4. The uploaded files should be put into folders by id, not files named by id so future multi file is possible.
5. Configuration and php library files should be put outside of the html folder to ensure they cannot be accessed.
6. .htaccess file should be added to ensure restricted file Access
7. There should be a status field on the request table to allow for progress or removal without deletion.
8. The email is just to show I know how to send an email.  Third party libraries would make it prettier, and it should contain all of the information from the request.
