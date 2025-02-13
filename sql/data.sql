INSERT INTO country 
  (id, name, active)
VALUES
  (1, "CANADA", true),
  (2, "USA", true);

INSERT INTO state 
  (id, country_id, name, active)
VALUES
  (1, 1, "ONTARIO", true),
  (2, 1, "ALBERTA", true),
  (3, 2, "MICHIGAN", true);

INSERT INTO budget
  (id, minimum, maximum, active)
VALUES
  (1, 5, 99, true),
  (2, 100, 249, true),
  (3, 250, 499, true);
