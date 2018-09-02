create TABLE comment(
  id int AUTO_INCREMENT,
  task_id int,
  user_id int,
  comment text DEFAULT null,
  created TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (id)

#   CONSTRAINT fk_task_comment FOREIGN KEY (task_id) REFERENCES task(id) on UPDATE CASCADE on DELETE CASCADE ,
#   CONSTRAINT fk_task_user FOREIGN KEY (user_id) REFERENCES user(id) on UPDATE CASCADE on DELETE CASCADE

);


drop TABLE task_hodini;

create TABLE task_hodini(
  id int AUTO_INCREMENT,
  task_id int,
  user_id int,
  hodini SMALLINT,
  added TIMESTAMP DEFAULT current_timestamp(),
  PRIMARY KEY (id)
);


alter TABLE project_team ADD COLUMN status BOOLEAN DEFAULT 0;