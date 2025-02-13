/* create the lookup tables */
CREATE TABLE country (
  id INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  active BOOLEAN NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE state (
  id INT NOT NULL,
  country_id INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  active BOOLEAN NOT NULL,
  PRIMARY KEY (id)
);
  
CREATE TABLE budget (
  id INT NOT NULL,
  minimum INT NOT NULL,
  maximum INT NOT NULL,
  active BOOLEAN NOT NULL,
  PRIMARY KEY (id)
);

/* create the main request table */
CREATE TABLE request (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  country_id INT NOT NULL,
  state_id INT NOT NULL,
  filename VARCHAR(255),
  budget_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (country_id)
    REFERENCES country(id),
  FOREIGN KEY (state_id)
    REFERENCES state(id),
  FOREIGN KEY (budget_id)
    REFERENCES budget(id)
);


  
